<?php get_header(); ?>
<style>
.showcase{
	background:url(<?php echo get_theme_mod('showcase_image', get_bloginfo('template_url').'/img/showcase.jpg'); ?>) no-repeat center center;
	background-attachment:<?php echo get_theme_mod('showcase_attachment'); ?>;
	color: <?php echo get_theme_mod('showcase_heading_color'); ?> ;
}
.showcase h1,h2{
	color: <?php echo get_theme_mod('showcase_heading_color'); ?> ;
}
.img-thumbnail{
	background-color: rgba(115, 115, 115, 0.63);
	border:0px;
	border-radius:0px;
}
article{
	padding:0px;
	box-shadow:none;
}
</style>
<!-- Showcase -->
<section class="showcase">
<div class="container text-center">
<?php echo get_avatar( '1', $size, $default, 'El Que Todo Lo Ve', array('class'=>'img-thumbnail') ); ?>
<h1><?php echo get_theme_mod('showcase_heading', 'Welcome to Kevin Fonseca Wordpress Theme'); ?></h1>
<p><?php echo get_theme_mod('showcase_text', 'Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam'); ?></p>
<?php if(get_theme_mod ('btn_text_first_biography', 'Get Started') != '') : ?>
<a class="btn btn-danger btn-md" href="<?php echo get_theme_mod('btn_url_first_biography', '#'); ?>" rel="noopener nofollow noreferrer" target="_blank"><?php echo get_theme_mod('btn_text_first_biography', 'Get Started'); ?></a>
<?php endif; ?>
<?php if(get_theme_mod ('btn_text_second_biography', 'Get Started') != '') : ?>
<a class="btn btn-info btn-md" href="<?php echo get_theme_mod('btn_url_second_biography', '#'); ?>" rel="noopener nofollow noreferrer" target="_blank"><?php echo get_theme_mod('btn_text_second_biography', 'Get Started'); ?></a>
<?php endif; ?>
</div>
</section>
<!-- The main content div -->
<?php global $post; ?>
<?php if($post->post_content): ?>
<?php if(have_posts()) : the_post(); ?>
<div class="container-fluid" id="kevin_container">
<div class="row">
<div class="container" id="kevin_page_container">
                    <!-- Child Pages and Parent Page -->
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
<!-- The main content -->                    
<article>
<?php the_content(); ?>
</article>
</div>
</div>
</div>

<?php endif; endif; ?>
<!-- Boxes -->
<section class="boxes">
<div class="container">
<div class="row">
<!-- Widget Boxes -->
<?php if(is_active_sidebar('Call to action')) : ?>
<div class="col-md-12">
<?php dynamic_sidebar('Call to action'); ?>
</div>
<?php endif; ?>
<!-- Customizer Boxes -->
<?php if(get_theme_mod('caja1_icon')!='') : ?>
<div class="col-md-4">
<div class="box">
<i class="fa fa-<?php echo get_theme_mod('caja1_icon','bar-chart'); ?> fa-5x" aria-hidden="true"></i>
<h4><?php echo get_theme_mod('caja1_heading','Box 1 Heading'); ?></h4>
<p><?php echo get_theme_mod('caja1_texto','Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.'); ?></p>
</div>
</div>
<?php endif ?>
<?php if(get_theme_mod('caja2_icon')!='') : ?>
<div class="col-md-4">
<div class="box">
<i class="fa fa-<?php echo get_theme_mod('caja2_icon','bar-chart'); ?> fa-5x" aria-hidden="true"></i>
<h4><?php echo get_theme_mod('caja2_heading','Box 2 Heading'); ?></h4>
<p><?php echo get_theme_mod('caja2_texto','Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.'); ?></p>
</div>
</div>
<?php endif ?>
<?php if(get_theme_mod('caja3_icon')!='') : ?>
<div class="col-md-4">
<div class="box">
<i class="fa fa-<?php echo get_theme_mod('caja3_icon','bar-chart'); ?> fa-5x" aria-hidden="true"></i>
<h4><?php echo get_theme_mod('caja3_heading','Box 3 Heading'); ?></h4>
<p><?php echo get_theme_mod('caja3_texto','Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.'); ?></p>
</div>
</div>
<?php endif ?>
<!-- Clearfix -->
<div class="clearfix"></div>
<!-- Widget Boxes -->
<?php if(is_active_sidebar('box1')) : ?>
<div class="col-md-4">
<?php dynamic_sidebar('box1'); ?>
</div>
<?php endif; ?>
<?php if(is_active_sidebar('box2')) : ?>
<div class="col-md-4">
<?php dynamic_sidebar('box2'); ?>
</div>
<?php endif; ?>
<?php if(is_active_sidebar('box3')) : ?>
<div class="col-md-4">
<?php dynamic_sidebar('box3'); ?>
</div>
<?php endif; ?>
<div class="col-md-12" id="col-md-12-frontpage">
<?php if(is_active_sidebar('Call to action 2')) : ?>
<?php dynamic_sidebar('Call to action 2'); ?>
<?php endif; ?>
</div>
</div>
</div>
</section>
<?php get_footer(); ?>