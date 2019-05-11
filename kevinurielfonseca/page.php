<?php get_header(); ?>
<!-- Page Content -->
<?php include("includes/page-header.php"); ?>
<div class="container">
<div class="row">
<!-- Blog Entries Column -->
<div class="col-md-8">
<article>
<!-- First Blog Post -->
<?php if(have_posts()) : ?>
<?php  while(have_posts()) : the_post(); ?>
                    <!------ Child Pages and Parent Page --->
					<?php if(page_is_parent() || $post->post_parent > 0) : ?>
						<div class="pagination pull-right">
							<li>
								<span class="parent-link"><a href="<?php echo get_the_permalink(get_top_parent()); ?>"><?php echo get_the_title(get_top_parent()); ?></a></span>
								<?php
									$args = array(
										'child_of' => get_top_parent(),
										'title_li' => ''
									);
								?>
								<?php wp_list_pages($args); ?>
							</li>
						</div>
						<div class="clearfix"></div>
					<?php endif; ?>
<!-- Carousel -->
<?php if ( get_post_gallery() ) : $gallery = get_post_gallery( get_the_ID(), false ); ?>
<div id="carousel-example-generic" class="carousel slide">
<?php functions_indicators($post) ?>
<!--<div class="carousel-inner">-->
<?php function_slides($post) ?>
<!--</div>-->
<!-- Controls -->
<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
<span class="icon-prev"></span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
<span class="icon-next"></span>
</a>
</div>
<br>
<?php endif; ?>
<!-- /Carousel -->
<?php the_content(); ?>
<?php include("includes/share.php"); ?>
</article>
<!-- Box Author -->
<?php if(is_single()) : ?>
<?php echo wpb_author_info_box( $content )  ?>
<?php endif; ?>
<!-- Related Posts -->
<?php include ('includes/relatedpost.php'); ?>
<!-- Comments -->
<?php comments_template(); ?>
<?php  endwhile ?>
<?php else : ?>
<div class="alert alert-danger text-center"><p>No page found</p></div>
<?php endif; ?>
</div>
<!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>
</div>
<!-- /.row -->
<?php get_footer(); ?>