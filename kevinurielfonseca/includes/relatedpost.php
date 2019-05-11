<?php 
$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
}

$args = array(
  'post_type' => get_post_type(),
  'category__in' 			=> $category_ids,
  'post__not_in' 			=> array($post->ID),
  'post_status' => 'publish',
  'orderby'   			=> 'author title',
  'posts_per_page'		=> 10, // Number of related posts that will be shown.
  'ignore_sticky_posts'	=> 1
);

$my_query = new wp_query( $args );
?>
<?php if(is_single()) : ?>

<?php if($my_query->have_posts()) : ?>
<div class="row">
  <div class="col-md-12">
    <h3 style="margin-top:0px">Related posts</h3>
    <div class="customNavigation"> <a class="btn btn-default btn-sm prev"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> <a class="btn btn-default btn-sm next"><i class="fa fa-arrow-right" aria-hidden="true"></i></a> <a class="btn btn-default btn-sm play"><i class="fa fa-play" aria-hidden="true"></i></a> <a class="btn btn-default btn-sm stop"><i class="fa fa-stop" aria-hidden="true"></i></a> </div>
    <div id="owl-demo" class="owl-carousel">
      <?php while($my_query->have_posts()) : $my_query->the_post(); ?>
      <div class="products text-center">
      <div class="item">
	      <a href="<?php the_permalink();?>" target="_blank">
          <?php if(has_post_thumbnail()) : ?>
            <?php the_post_thumbnail(array('class' => 'img-responsive')); ?>
          <?php else : ?>
            <?php echo no_image(); ?>
          <?php endif; ?>
        </a>
      </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
  <?php endif; ?>
<?php endif; ?>
<?php
$post = $orig_post;
wp_reset_query();
?>