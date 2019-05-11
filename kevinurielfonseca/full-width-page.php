<?php 
/*
Template Name: Full-Width Page/Post/Portfolio/Video
Template Post Type: page,post
*/ ?>
<?php get_header(); ?>
<?php include("includes/page-header.php"); ?>
<div class="container">
<?php include("includes/previousandnextpost.php") ?>
<div class="row">
<!-- Blog Entries Column -->
<div class="col-md-12">
<article>
<!-- First Blog Post -->
<?php if(have_posts()) :  while(have_posts()) : the_post(); ?>
<!-- Make views count possible -->
<?php setPostViews(get_the_ID()); ?>
                    <!------ Child pages and parent page --->
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
<!-- Show buttons if they are not empty -->
<?php $demostracion_url = get_post_meta($post->ID, 'url_para_ver_demo', true); ?>
<?php if ($demostracion_url == '#') : ?>
<?php else: ?>
<a href="<?php echo demo_url(get_the_ID()); ?>" class="btn btn-default" target="_blank" rel="noopener"><i class="fa fa-eye" aria-hidden="true"></i> View demo</a>
<?php endif; ?>
<!-- /Show buttons if they are not empty -->
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
<div class="alert alert-danger text-center"><p>No post found</p></div>
<?php endif; ?>
</div>
</div>
<!-- /.row -->
<?php get_footer(); ?>