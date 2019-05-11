<?php
  function wpb_customize_register($wp_customize){
////// Showcase Section
    $wp_customize->add_section('showcase', array(
      'title'   => __('Showcase', 'kevinurielfonseca'),
      'description' => sprintf(__('Options for showcase','kevinurielfonseca')),
      'priority'    => 130
    ));
	
    $wp_customize->add_setting('showcase_image', array(
      'default'   => get_bloginfo('template_directory').'/img/showcase.jpg',
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'showcase_image', array(
      'label'   => __('Showcase Image', 'kevinurielfonseca'),
      'section' => 'showcase',
      'settings' => 'showcase_image',
      'priority'  => 1
    )));
    $wp_customize->add_setting('showcase_attachment', array(
      'default'   => _x('unset', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('showcase_attachment', array(
      'label'   => __('Showcase Image Attachment Value', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 2
    ));
	
    $wp_customize->add_setting('showcase_heading', array(
      'default'   => _x('Custom Bootstrap Wordpress Theme', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('showcase_heading', array(
      'label'   => __('Showcase Heading', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 3
    ));

	
    $wp_customize->add_setting('showcase_heading_color', array(
      'default'   => _x('#ffffff', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('showcase_heading_color', array(
      'label'   => __('Showcase Color de Heading y Texto', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 4
    ));
    $wp_customize->add_setting('showcase_text', array(
      'default'   => _x('Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('showcase_text', array(
      'label'   => __('Texto', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 5
    ));
////////////////////Kevin.php
    $wp_customize->add_setting('btn_text_first_biography', array(
      'default'   => _x('Ver Blog', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('btn_text_first_biography', array(
      'label'   => __('Texto para Primer Boton', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 6
    ));
    $wp_customize->add_setting('btn_url_first_biography', array(
      'default'   => _x('#', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('btn_url_first_biography', array(
      'label'   => __('URL de Primer Boton', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 7
    ));
    $wp_customize->add_setting('btn_text_second_biography', array(
      'default'   => _x('Ver Portfolio', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('btn_text_second_biography', array(
      'label'   => __('Texto para Segundo Boton', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 8
    ));
    $wp_customize->add_setting('btn_url_second_biography', array(
      'default'   => _x('#', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('btn_url_second_biography', array(
      'label'   => __('URL de Segundo Boton', 'kevinurielfonseca'),
      'section' => 'showcase',
      'priority'  => 9
    ));
	
/////////////////////// Custom 404 Page
    $wp_customize->add_section('404 Page', array(
      'title'   => __('404 Page', 'kevinurielfonseca'),
      'description' => sprintf(__('Options for 404 Page','kevinurielfonseca')),
      'priority'    => 140
    ));
    $wp_customize->add_setting('404_image', array(
      'default'   => get_bloginfo('template_directory').'/img/404.jpg',
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, '404_image', array(
      'label'   => __('404 Page Image', 'kevinurielfonseca'),
      'section' => '404 Page',
      'settings' => '404_image',
      'priority'  => 10
    )));
	
    $wp_customize->add_setting('404_attachment', array(
      'default'   => _x('unset', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('404_attachment', array(
      'label'   => __('404 Image Attachment Value', 'kevinurielfonseca'),
      'section' => '404 Page',
      'priority'  => 11
    ));
	
    $wp_customize->add_setting('404_heading', array(
      'default'   => _x('Error, Error, Error!!!!!', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
	
	
    $wp_customize->add_control('404_heading', array(
      'label'   => __('Heading', 'kevinurielfonseca'),
      'section' => '404 Page',
      'priority'  => 12
    ));
	
    $wp_customize->add_setting('404_heading_color', array(
      'default'   => _x('#ffffff', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('404_heading_color', array(
      'label'   => __('Color de Heading y Texto', 'kevinurielfonseca'),
      'section' => '404 Page',
      'priority'  => 13
    ));
    $wp_customize->add_setting('404_texto', array(
      'default'   => _x('Regresa!!', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('404_texto', array(
      'label'   => __('Texto', 'kevinurielfonseca'),
      'section' => '404 Page',
      'priority'  => 14
    ));
	
/////////////////////// Boxes de Front-Page
   $wp_customize->add_section('boxes', array(
		'title'          => __('Boxes', 'business'),
		'description'    => sprintf( __('Options for homepage boxes', 'business')
		),
		'priority'       => 150,
 	));
	// BOX 1
	$wp_customize->add_setting( 'caja1_heading', array(
		'default'   => _x('Box 1 Heading', 'business'),
		'type'      => 'theme_mod'
	));
	$wp_customize->add_control( 'caja1_heading', array(
		'label'    => __('Box 1 Heading', 'business'),
		'section'  => 'boxes',
		'priority' => 15,
	));
 	$wp_customize->add_setting( 'caja1_texto', array(
 		'default'              => _x('Maecenas sed diam eget risus varius blandit sit amet non magna.', 'business'),
 		'type'                 => 'theme_mod'
 	));
 	$wp_customize->add_control( 'caja1_texto', array(
 		'label'    => __('Texto para Box 1', 'business'),
 		'section'  => 'boxes',
 		'priority' => 16,
 	));
 	$wp_customize->add_setting( 'caja1_icon', array(
 		'default'              => _x('bar-chart', 'business'),
 		'type'                 => 'theme_mod'
 	));
 	$wp_customize->add_control( 'caja1_icon', array(
 		'label'    => __('Icono para Box 1', 'business'),
 		'section'  => 'boxes',
 		'priority' => 17,
 	));
 	// BOX 2
 	$wp_customize->add_setting( 'caja2_heading', array(
 		'default'              => _x('Box 2 Heading', 'business'),
 		'type'                 => 'theme_mod'
 	));
 	$wp_customize->add_control( 'caja2_heading', array(
 		'label'    => __('Box 2 Heading', 'business'),
 		'section'  => 'boxes',
 		'priority' => 18,
 	));
 	$wp_customize->add_setting( 'caja2_texto', array(
 		'default'              => _x('Maecenas sed diam eget risus varius blandit sit amet non magna.', 'business'),
 		'type'                 => 'theme_mod'
 	));
 	$wp_customize->add_control( 'caja2_texto', array(
 		'label'    => __('Texto para Box 2', 'business'),
 		'section'  => 'boxes',
 		'priority' => 19,
 	));
	$wp_customize->add_setting( 'caja2_icon', array(
		'default'              => _x('code', 'business'),
		'type'                 => 'theme_mod'
	));
	$wp_customize->add_control( 'caja2_icon', array(
		'label'    => __('Icono para caja 2', 'business'),
		'section'  => 'boxes',
		'priority' => 20,
	));
	// BOX 3
	$wp_customize->add_setting( 'caja3_heading', array(
		'default'              => _x('Box 3 Heading', 'business'),
		'type'                 => 'theme_mod'
	));
	$wp_customize->add_control( 'caja3_heading', array(
		'label'    => __('Box 3 Heading', 'business'),
		'section'  => 'boxes',
		'priority' => 21,
	));
	$wp_customize->add_setting( 'caja3_texto', array(
		'default'              => _x('Maecenas sed diam eget risus varius blandit sit amet non magna.', 'business'),
		'type'                 => 'theme_mod'
	));
	$wp_customize->add_control( 'caja3_texto', array(
		'label'    => __('Texto para Box 3', 'business'),
		'section'  => 'boxes',
		'priority' => 22,
	));
	$wp_customize->add_setting( 'caja3_icon', array(
		'default'              => _x('desktop', 'business'),
		'type'                 => 'theme_mod'
	));
	$wp_customize->add_control( 'caja3_icon', array(
		'label'    => __('Icono para Box 3', 'business'),
		'section'  => 'boxes',
		'priority' => 23,
	));
/////////////////////// Social Links - Footer
    $wp_customize->add_section('Social Links', array(
      'title'   => __('Social Links', 'kevinurielfonseca'),
      'description' => sprintf(__('Options for Social Links','kevinurielfonseca')),
      'priority'    => 24
    ));
    $wp_customize->add_setting('icon_link_github', array(
      'default'   => _x('#', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('icon_link_github', array(
      'label'   => __('Social URL para Github', 'kevinurielfonseca'),
      'section' => 'Social Links',
      'priority'  => 25
    ));
    $wp_customize->add_setting('icon_link_facebook', array(
      'default'   => _x('#', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('icon_link_facebook', array(
      'label'   => __('Social URL para Facebook', 'kevinurielfonseca'),
      'section' => 'Social Links',
      'priority'  => 26
    ));
	
	 $wp_customize->add_setting('icon_link_twitter', array(
      'default'   => _x('#', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('icon_link_twitter', array(
      'label'   => __('Social URL para Twitter', 'kevinurielfonseca'),
      'section' => 'Social Links',
      'priority'  => 27
    ));
	
	 $wp_customize->add_setting('icon_link_instagram', array(
      'default'   => _x('#', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('icon_link_instagram', array(
      'label'   => __('Social URL para Instagram', 'kevinurielfonseca'),
      'section' => 'Social Links',
      'priority'  => 28
    ));
	
	 $wp_customize->add_setting('icon_link_youtube', array(
      'default'   => _x('#', 'kevinurielfonseca'),
      'type'      => 'theme_mod'
    ));
    $wp_customize->add_control('icon_link_youtube', array(
      'label'   => __('Social URL para Youtube channel', 'kevinurielfonseca'),
      'section' => 'Social Links',
      'priority'  => 29
    ));
// end of customizer function //
  }
  add_action('customize_register', 'wpb_customize_register');