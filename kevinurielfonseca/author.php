<?php get_header(); ?>
<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
<!-- Box author -->
<div class="container">
<div class="author-box">
<?php echo get_avatar( get_the_author_meta( 'ID' )); ?>
<b>About the Author</b>
<p><?php echo $curauth->display_name; ?></p>
<p><?php echo $curauth->user_description; ?></p>
<a target="_blank" href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a>
</div>
</div>
<!-- Post by author -->
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
<h3>Posts de <?php echo $curauth->display_name; ?></h3>
</div>
</div>
<div class="row">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<div class="col-xs-12 col-sm-6 col-md-4" style="display:inline-block">
<article>
<div class="panel">
<?php if(has_post_thumbnail()) : ?>
<a href="<?php the_permalink(); ?>" class="thumbnail">
<?php the_post_thumbnail(); ?>
</a>
<?php endif; ?>
<div class="content">
<ul class="list-unstyled list-inline">
<li>By: <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></li>
<li><?php the_time('F j, Y g:i a'); ?></li>
</ul>
<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
<p><?php the_excerpt(); ?></p>
<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
</div>
</div>
</article>
</div>
<?php endwhile; else : ?>
<div class="alert alert-danger text-center"><p>No post found</p></div>
<?php endif ;?>
</div>
<!-- Pager -->
<ul class="pager">
<li><?php previous_posts_link( 'Newer' ); ?></li>
<li><?php next_posts_link( 'Older' ); ?></li>
</ul>
</div>
<?php get_footer(); ?>