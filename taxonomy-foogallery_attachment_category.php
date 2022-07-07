<?php
get_header();

?>
<style>
.fg-image {
    width: 1800px !important;
    height: 300px !important;
}
	.navbar-light .navbar-nav .nav-link {
    color: rgba(0,0,0,.5);
    font-size: 20px;
    font-family: 'Skia';
    font-weight: 600;
}
	.category:before {
    display: block;
    font-family: FontAwesome;
    content: '\f077';
    font-size: 35px;
    text-align: right;
    /* left: -46px; */
}
</style>
<?php if(isset($_GET['foogallery_attachment_category'])): ?>
<?php 
 $getSlug = $_GET['foogallery_attachment_category'];
 $foo_term = get_term_by('slug', strtolower($getSlug), 'foogallery_attachment_category');
  

$terms = get_terms( array(
    'taxonomy' => 'foogallery_attachment_category',
    'hide_empty' => false,
) );

//   if(isset($_GET['cat_id']) || isset($_GET['cat_id']) )
//   {
	$cat_id = $_GET['cat_id'];
	  $query = $wpdb->get_results("SELECT object_id from wp_term_relationships where term_taxonomy_id =  $foo_term->term_id");
	$all_posts = [];
		if(count((array)$query))
		{
			foreach($query as $qu)
			{
				array_push($all_posts,$qu->object_id);
			}
		}
  		


  //}




?>
<?php endif; ?>

<section id="foo_galleries">
<div class="container px-0">
	<nav class="navbar navbar-expand-lg navbar-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav foo-cats">
      <?php if(count($terms) > 0): ?>
	  <?php foreach($terms as $term): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url().'/?foogallery_attachment_category='.$term->slug.'&cat_id='.$term->term_id; ?>"><?php echo $term->name; ?></a>
      </li>
    <?php endforeach; ?>
	<?php endif; ?>
    </ul>
	  <ul class="navbar-nav ml-auto">
	   <li class="nav-item">
      
			<a class="nav-link btn" href="javascript:void(0)">Filters</a>
		 
      </li>
	  </ul>
  </div>
</nav>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
	$(".category").hide();
 $('.btn').click(function() {
    $('.category').slideToggle("slow");
    // Alternative animation for example
    // slideToggle("fast");
  });
});
</script>
	<div class="category">
	<div class="container px-0">
		<div class="category-bg">
			<h2 class="heading">By CATEGORY</h2>
			<ul>
				<?php if(count($terms) > 0): ?>
	  <?php foreach($terms as $term): ?>
				<li class="nav-item"><a class="nav-link" href="<?php echo site_url().'/?foogallery_attachment_category='.$term->slug.'&cat_id='.$term->term_id; ?>"><?php echo $term->name; ?></a></li>
				
				 <?php endforeach; ?>
	<?php endif; ?>
			</ul>

			<div class="tag">
			  <h2 class="heading">By TAG</h2>
			</div>
<div class="points">
	<ul>
		
	
		<?php
    $tags = get_tags();
    if ( $tags ) :
        foreach ( $tags as $tag ) : ?>
            <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
        <?php endforeach; ?>
    <?php endif; ?>
	</ul>
	</div>		

		</div>		
	</div>
</div>
	<div class="video-sec">
	<div class="container px-0">
		<div class="row">
			<?php if(count($all_posts) > 0): ?>
		<?php foreach($all_posts as $post): ?>
			<div class="col-sm-6 py-0 px-0">
				 <?php $id = ($post - 1); echo do_shortcode('[foogallery id='.$id.']'); ?>
			</div>
<?php endforeach; ?>
		<?php endif; ?>
			

		</div>
	</div>  
</div>
	
	</div>
</section>

<?php get_footer(); ?>