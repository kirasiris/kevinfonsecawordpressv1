<?php get_header(); ?>
<?php include("includes/page-header.php"); ?>
<div class="container">
<?php include("includes/previousandnextpost.php") ?>
<div class="row">
<div class="col-md-8">
<!-- Article -->
<article>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<!-- Make views count possible -->
<?php setPostViews(get_the_ID()); ?>
<!-- Carousel -->
<?php if ( get_post_gallery() ) : $gallery = get_post_gallery( get_the_ID(), false ); ?>
<div id="carousel-example-generic" class="carousel slide">
<?php functions_indicators($post) ?>
<?php function_slides($post) ?>
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
<div class="alert alert-danger text-center"><p>No post found</p></div>
<?php endif; ?>
</div>
<!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>
</div>
<!-- /.row -->
<?php get_footer(); ?>