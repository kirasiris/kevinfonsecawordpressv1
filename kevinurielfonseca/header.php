<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
<meta name="description" content="<?php bloginfo('description') ?>">
<!-- Master Css -->
<link href="<?php bloginfo('template_url'); ?>/css/master.css" rel="stylesheet">
<!-- Owl carousel -->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/owl.carousel.css">
<!-- Main Css -->
<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Navigation -->
<header>
<nav class="navbar navbar-inverse navbar-fixed-top navbar-expand-lg" role="navigation">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
				</button>
                <?php if(has_custom_logo()) : ?><?php the_custom_logo(); ?>
                <?php else : ?>
                <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
                <?php endif; ?>
            </div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php
                           wp_nav_menu( array(
                               'menu'              => 'primary',
                               'theme_location'    => 'primary',
                               'depth'             => 2,
                               'container'         => '',
                               'container_class'   => '',
                               'container_id'      => '',
                               'menu_class'        => 'nav navbar-nav',
                               'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                               'walker'            => new wp_bootstrap_navwalker())
                           );
                       ?>
                      <ul class="nav navbar-nav navbar-right">
                      <?php if(is_user_logged_in()) : ?>
                        <li class="dropdown">
                        <?php global $current_user; get_currentuserinfo(); ?>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $current_user->display_name ?> <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo admin_url(); ?>">Profile</a></li>
                            <li><a href="<?php echo get_edit_user_link(); ?>">Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Log out</a></li>
                          </ul>
                        </li>
                        <?php else : ?>
                        <li><a href="<?php echo wp_login_url(get_permalink()); ?>">Login</a></li>
                        <li><a href="<?php echo wp_registration_url(); ?>">Register</a></li>
                        <!--<li><a href="<?php echo wp_lostpassword_url(); ?>">Lost Password</a></li>-->
                      <?php endif; ?>
                      </ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
</header>