<?php get_header(); ?>
<style>
.pagenotfound{
	background:url(<?php echo get_theme_mod('404_image', get_bloginfo('template_url').'/img/404.jpg'); ?>) no-repeat center center;
	background-attachment:<?php echo get_theme_mod('404_attachment'); ?>;
	color: <?php echo get_theme_mod('404_heading_color'); ?> ;
	height: 100vh;
}
</style>
<section class="pagenotfound">
<div class="container">
<h1><?php echo get_theme_mod('404_heading', 'Error, Error, Error!!!!!'); ?></h1>
<p><?php echo get_theme_mod('404_texto', 'Go back to Home!!'); ?></p>
<a href="<?= bloginfo('url'); ?>" class="btn btn-primary btn-lg">Go back to Home</a>
</div>
</section>
<?php get_footer(); ?>