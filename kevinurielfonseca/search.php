<?php get_header(); ?>  
<!-- Page Content -->
<?php include("includes/page-header.php"); ?>
<div class="container">
<div class="row">
<!-- Blog Entries Column -->
<div class="col-md-8" id="blog-listado">
<!-- First Blog Post -->
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<article>
<div class="card">
<div class="panel-header">
<h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
</div>
<div class="row" id="archive">
<?php if(has_post_thumbnail()) : ?>
<div class="col-md-6">
<a href="<?php the_permalink(); ?>" class="thumbnail">
<?php the_post_thumbnail(); ?>
</a>
</div>
<div class="col-md-6">
<p><?php echo (get_the_excerpt()); ?></p>
</div>
<?php else : ?>
<div class="col-md-12"><p><?php echo (get_the_excerpt()); ?></p></div>
<?php endif; ?>
</div>
<div class="panel-footer">
<div class="row">
<div class="col-lg-10 col-md-9 col-sm-8 pull-left">
<i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
<i class="fa fa-folder-open"></i> <?php the_category(','); ?> 
<i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?> 
<i class="fa fa-eye" aria-hidden="true"></i> <?php echo getPostViews(get_the_ID()); ?> 
<i class="fa fa-clock-o"></i> <?php the_time('M j, Y'); ?> 
</div>
<div class="col-lg-2 col-md-3 col-sm-4 pull-right">
<a href="<?php the_permalink(); ?>" class="btn-primary btn-sm">Read More »</a>
</div>
</div>
</div>
</div>
</article>
<?php endwhile; ?>
<?php else : ?>
<div class="alert alert-danger text-center"><p>No post found</p></div>
<?php endif; ?>
<!-- Pager -->
<?php numeric_pagination(); ?>
</div>
<!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>
</div>
<!-- /.row -->
<?php get_footer(); ?>