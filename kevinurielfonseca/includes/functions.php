<?php
function wpb_theme_setup(){
// Registering nav/menus
	register_nav_menus(array(
      'primary' => __('Menu Principal', 'kevinurielfonseca'),
	  'secondary' => __('Menu Secundario' , 'kevinurielfonseca'),  
    ));
	
// File support
	 add_theme_support('custom-logo');
	 add_theme_support('post-thumbnails');
	 add_image_size('post-recientes',75,75);
	 add_image_size('portfolio-page',700,400);
	}
	add_action('after_setup_theme','wpb_theme_setup');

// Excerpth lenght
	function set_excerpt_length(){
		return 45;
		}
	add_filter('excerpt_length' , 'set_excerpt_length');

// No featured image
function no_image(){
	echo '<img src="https://tse2.mm.bing.net/th?id=OIP.br8fDbauw02nh3J4V6BfRAHaHa&pid=15.1&P=0&w=300&h=300" class="img-responsive">';
}

// Show menu page parent and its child pages
	function get_top_parent(){
		global $post;
		if($post->post_parent){
			$ancestors = get_post_ancestors($post->ID);
			return $ancestors[0];
		}
		return $post->ID;
	}
	function page_is_parent(){
		global $post;
		$pages = get_pages('child_of='.$post->ID);
		return count($pages);
	}

// Block the public access to the REST API /wp-json
function kuaf_restricted_rest_api_access( $access ) {
 
	return new WP_Error( 'rest_cannot_access', 'Lo siento pero he bloqueado el REST API de la website para evitar el accesso publico al contenido de la website', array( 
		'status' => 403 
	) );
 
}
add_filter( 'rest_authentication_errors', 'kuaf_restricted_rest_api_access' );

// Desabilitar default gallery shortcut y display a custom slider
remove_shortcode( 'gallery' );
function wp_get_attachment( $attachment_id ) {

	
    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

function functions_indicators() {
$special_gallery = get_post_gallery( $post, false );
$ids = explode( ",", $special_gallery['ids'] );
$html = '<ol class="carousel-indicators">';
foreach( $ids as $id ) {
    $link   = wp_get_attachment_url( $id );
    $class = ( $i == 0 ) ? 'active ' : '';
    $i++;
    $b=1;
    $html .= '<li data-target="#carousel-example-generic" data-slide-to="'.($i - $b).'" '. 'class="'.$class.'"></li>';
} 
$html .= '</ol>';
echo $html;


}

function function_slides() {
$special_gallery = get_post_gallery( $post, false );
$ids = explode( ",", $special_gallery['ids'] );
$html = '<div class="carousel-inner">';
foreach( $ids as $id ) {
    $link   = wp_get_attachment_url( $id );
    $attachment_meta = wp_get_attachment($id);
    $class = ( $i == 0 ) ? 'active ' : '';
    $i++;
    $html .= '<div class="item '.$class. '"><img src="' . $link . '">' . '<div class="carousel-caption"><h4>'.$attachment_meta['title'].'</h4><p>'.$attachment_meta['description']. '</p></div></div>';
} 
$html .= '</div>';
echo $html;
}
add_shortcode( 'gallery' , 'gallery_filter' );

// URL de ver demo
function demo_url($postID){
	$demo_url = 'url_para_ver_demo';
	$demostracion_url = get_post_meta($postID, $demo_url, true);
	if($demostracion_url==''){
		delete_post_meta($postID,$demo_url);
		add_post_meta($postID,$demo_url, '#');
		return "#";
		}
	return $demostracion_url;
	}
// URL de descarga de archivo gratis
function descargar_url($postID){
	$descargar_url = 'url_para_descargar_archivo_gratis';
	$archivo_url = get_post_meta($postID, $descargar_url, true);
	if($archivo_url==''){
		delete_post_meta($postID,$descargar_url);
		add_post_meta($postID,$descargar_url, '#');
		return '#';
		}
	return $archivo_url;
	}
// Mostrar primer imagen de post como la featured image
function autoset_featured() {
    global $post;
    $already_has_thumb = has_post_thumbnail($post->ID);
        if (!$already_has_thumb)  {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
            if ($attached_image) {
                foreach ($attached_image as $attachment_id => $attachment) {
                    set_post_thumbnail($post->ID, $attachment_id);
                }
            }
        }
	}
	
	add_action('the_post', 'autoset_featured');
	add_action('save_post', 'autoset_featured');
	add_action('draft_to_publish', 'autoset_featured');
	add_action('new_to_publish', 'autoset_featured');
	add_action('pending_to_publish', 'autoset_featured');
	add_action('future_to_publish', 'autoset_featured');
// Botones para editor
function add_more_buttons($buttons) {
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[]='styleselect';

 return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");
// Login Page
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
// Archivos Permitidos a subir
function edit_upload_types($existing_mimes = array()) {
	$existing_mimes['woff'] = 'font/woff';
	$existing_mimes['zip'] = 'application/zip';
	$existing_mimes['epub'] = 'application/epub+zip';
	$existing_mimes['mobi'] = 'application/x-mobipocket-ebook';
	$existing_mimes['m4r'] = 'audio/aac';
	$existing_mimes['aif'] = 'audio/x-aiff';
	$existing_mimes['aiff'] = 'audio/aiff';
	$existing_mimes['psd'] = 'image/photoshop';
	$existing_mimes['exe'] = 'application/octet-stream';
	$existing_mimes['apk'] = 'application/vnd.android.package-archive';
	$existing_mimes['msi'] = 'application/x-ole-storage';
	$existing_mimes['csv'] = 'text/csv';
	return $existing_mimes;
}
add_filter('upload_mimes', 'edit_upload_types');
// Funcion para remover mensaje de Bienvenida
remove_action('welcome_panel', 'wp_welcome_panel');
//Remover creditos de Wordpress
function remove_footer_admin () {
echo 'Powered by <a href="http://www.wordpress.org" target="_blank" rel="noopener">WordPress</a> | Design by: <a href="https://blogpersonal.net/" target="_blank" rel="noopener noreferrer">Kevin Fonseca</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');
//Cambiar default gravatar por otro
function wpb_new_gravatar ($avatar_defaults) {
$myavatar = 'https://vignette3.wikia.nocookie.net/assassinscreed/images/4/4b/ACI_Default.jpg/revision/latest?cb=20150322230631';
$avatar_defaults[$myavatar] = "Default Gravatar";
return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'wpb_new_gravatar' );
// Agrega un logo personalizado al Dashboard de Wordpress
function wpb_custom_logo() {
echo 
'<style type="text/css">
#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {background: url(' . get_bloginfo('stylesheet_directory') . '/img/logo.png) no-repeat !important;background-position: 0 0;color:rgba(0, 0, 0, 0);}
#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {background-position: 0 0;}
</style>
';
}
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');

// Numero de usuarios registrados en dashboard widget
function wpb_user_count() { 
$usercount = count_users();
$result = $usercount['total_users']; 
return $result; 
}
add_shortcode('user_count', 'wpb_user_count');
// Widget para usuarios registrados en Dashboard
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Numero de Usuarios registrados', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
echo '<h1 style="text-align:center;">'. wpb_user_count() .'</h1>';
}
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

// Fecha de Registro de Usuario
function kuaf_modify_user_table( $columns ) {
 
	// unset( $columns['posts'] ); // maybe you would like to remove default columns
	$columns['registration_date'] = 'Registration date'; // add new
 
	return $columns;
 
}
add_filter( 'manage_users_columns', 'kuaf_modify_user_table' );
// Consigue la informacion necesaria para saber la fecha de registro de cada usuario
function kuaf_modify_user_table_row( $row_output, $column_id_attr, $user ) {
 
	$date_format = 'j M, Y H:i';
 
	switch ( $column_id_attr ) {
		case 'registration_date' :
			return date( $date_format, strtotime( get_the_author_meta( 'registered', $user ) ) );
			break;
		default:
	}
 
	return $row_output;
 
}
add_filter( 'manage_users_custom_column', 'kuaf_modify_user_table_row', 10, 3 );
// Haz sortable la informacion anterior de la fecha de registro de cada usuario
function kuaf_make_registered_column_sortable( $columns ) {
	return wp_parse_args( array( 'registration_date' => 'registered' ), $columns );
}
add_filter( 'manage_users_sortable_columns', 'kuaf_make_registered_column_sortable' );
// Filtrar Posts por Author
function kuaf_filter_by_the_author() {
	$params = array(
		'name' => 'author', // Este es el atributo "name" para el <select>
		'show_option_all' => 'All authors' // Label para todos los authores(muestra posts sin filtro)
	);
 
	if ( isset($_GET['user']) )
		$params['selected'] = $_GET['user']; // Elije usuario seleccionado mediante la variable $_GET
 
	wp_dropdown_users( $params ); // Print la lista de author preparada
}
 
add_action('restrict_manage_posts', 'kuaf_filter_by_the_author');
// Nuevos Inputs para Contacto de Usuario
$extra_fields =  array( 
	array( 'facebook', __( 'Facebook Username', 'rc_cucm' ), true ),
	array( 'twitter', __( 'Twitter Username', 'rc_cucm' ), true ),
	array( 'googleplus', __( 'Google+ ID', 'rc_cucm' ), true ),
	array( 'linkedin', __( 'Linked In ID', 'rc_cucm' ), false ),
	array( 'pinterest', __( 'Pinterest Username', 'rc_cucm' ), false ),
	array( 'wordpress', __( 'WordPress.org Username', 'rc_cucm' ), false ),
	array( 'phone', __( 'Phone Number', 'rc_cucm' ), true ),
	array( 'country', __( 'Country', 'rc_cucm' ), true ),
	array( 'state', __( 'State', 'rc_cucm' ), true ),
	array( 'address', __( 'Address', 'rc_cucm' ), true )
);
function kuaf_add_user_contactmethods( $user_contactmethods ) {

	// Get fields
	global $extra_fields;
	
	// Display each fields
	foreach( $extra_fields as $field ) {
		if ( !isset( $contactmethods[ $field[0] ] ) )
    		$user_contactmethods[ $field[0] ] = $field[1];
	}

    // Returns the contact methods
    return $user_contactmethods;
}
add_filter( 'user_contactmethods', 'kuaf_add_user_contactmethods' );
function kuaf_register_form_display_extra_fields() {
	
	// Get fields
	global $extra_fields;

	// Display each field if 3th parameter set to "true"
	foreach( $extra_fields as $field ) {
		if ( $field[2] == true ) { 
		$field_value = isset( $_POST[ $field[0] ] ) ? $_POST[ $field[0] ] : '';
		echo '<p>
			<label for="'. esc_attr( $field[0] ) .'">'. esc_html( $field[1] ) .'<br />
			<input type="text" name="'. esc_attr( $field[0] ) .'" id="'. esc_attr( $field[0] ) .'" class="input" value="'. esc_attr( $field_value ) .'" size="20" /></label>
			</label>
		</p>';
		} // endif
	} // end foreach
}
add_action( 'register_form', 'kuaf_register_form_display_extra_fields' );

function kuaf_user_register_save_extra_fields( $user_id, $password = '', $meta = array() )  {

	// Get fields
    global $extra_fields;
    
    $userdata       = array();
    $userdata['ID'] = $user_id;
    
    // Save each field
    foreach( $extra_fields as $field ) {
    	if( $field[2] == true ) { 
	    	$userdata[ $field[0] ] = $_POST[ $field[0] ];
	    } // endif
	} // end foreach

    $new_user_id = wp_update_user( $userdata );
}
add_action( 'user_register', 'kuaf_user_register_save_extra_fields', 100 );

// Cambiar Orden de Columnas para Posts, Pages and CPTs en admin
add_filter('manage_posts_columns', 'columns_order', 5); // for Posts
add_filter('manage_pages_columns', 'columns_order', 5); // for Pages

function columns_order( $columns ) {
  $columns['id'] = 'ID'; // $colums['id'] = 'Column Title';
  $columns['title'] = 'Title'; // $colums['title'] = 'Column Title';
  $columns['img'] = 'Featured Image'; // $colums['img'] = 'Column Title';
  return $columns;
}

// Contenido de Columna id para Posts, Pages and CPTs
add_action('manage_posts_custom_column', 'id_content', 5, 2);
add_action('manage_pages_custom_column', 'id_content', 5, 2);

function id_content($column, $id ){
	if( 'id' == $column)
		echo $id;
}

// Contenido de columna img para Posts, Pages and CPTs
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 3);
add_filter('manage_pages_custom_column', 'manage_img_column', 10, 3);

function manage_img_column($column_name, $post_id) {
    if( $column_name === 'img' ) {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
        return true;
    }
}

// Cambiar Orden de Columnas para Users en admin
add_filter('manage_users_columns', 'users_columns', 5); // For Users
add_action('manage_users_custom_column',  'users_columns_content', 10, 3);

function users_columns($columns) {
  $n_columns = array();
  $move = 'ID'; // what to move
  $before = 'username'; // move before this
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}


function users_columns_content($value, $column, $id){
	if ( 'ID' == $column )
		return $id;
	return $value;

}

// Sidebar y Posicion de Widgets
	function wpb_init_widgets($id){
		register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div class="well" id="sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="sidebarh4">',
		'after_title' => '</h4>',
		));
 
// Widget front-page
		register_sidebar(array(
		'name' => 'Call To Action',
		'id' => 'call-to-action',
		'before_widget' => '<div class="well">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));
		
		register_sidebar(array(
		'name' => 'Call To Action 2',
		'id' => 'call-to-action-2',
		'before_widget' => '<div class="box">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));
		
		register_sidebar(array(
		'name' => 'Box 1',
		'id' => 'box1',
		'before_widget' => '<div class="box">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));
		
		register_sidebar(array(
		'name' => 'Box 2',
		'id' => 'box2',
		'before_widget' => '<div class="box">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));
		
		register_sidebar(array(
		'name' => 'Box 3',
		'id' => 'box3',
		'before_widget' => '<div class="box">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));
		
/// Widget frontal video page
		register_sidebar(array(
		'name' => 'widgetvideopage',
		'id' => 'widgetvideopage',
		'before_widget' => '<div class="box">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="sidebarh4">',
		'after_title' => '</h4>',
		));
		
		}
		
	add_action('widgets_init', 'wpb_init_widgets');

// Function to display number of views.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 Views";
    }
    return $count.' Views';
}

// Function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Add it to a column in WP-Admin
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
add_filter('manage_posts_columns', 'posts_column_views');
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
// Author Box
function wpb_author_info_box( $content ) {
 
global $post;
 
if ( is_single() && isset( $post->post_author ) ) {
 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
 
if ( empty( $display_name ) )
$display_name = get_the_author_meta( 'nickname', $post->post_author );
 
$user_description = get_the_author_meta( 'user_description', $post->post_author );
 
$user_website = get_the_author_meta('url', $post->post_author);
 
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
  
if ( ! empty( $display_name ) )
 
$author_details = '<p class="author_name">About ' . $display_name . '</p>';
 
if ( ! empty( $user_description ) )

$author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>'; 
$author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';  
 
if ( ! empty( $user_website ) ) {
 
$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';
 
} else { 
$author_details .= '</p>';
}
 
$content = $content . '<section class="author_box hidden-xs" >' . $author_details . '</section>';
}
return $content;
}
 
// Add our function to the post content filter 
//add_action( 'the_content', 'wpb_author_info_box' );
 
// Allow HTML in author bio section 
remove_filter('pre_user_description', 'wp_filter_kses');
?>
<?php
// Filtrar Post por Date Range
class kuafDateRange{
 
	function __construct(){
 
		// if you do not want to remove default "by month filter", remove/comment this line
		add_filter( 'months_dropdown_results', '__return_empty_array' );
 
		// include CSS/JS, in our case jQuery UI datepicker
		add_action( 'admin_enqueue_scripts', array( $this, 'jqueryui' ) );
 
		// HTML of the filter
		add_action( 'restrict_manage_posts', array( $this, 'form' ) );
 
		// the function that filters posts
		add_action( 'pre_get_posts', array( $this, 'filterquery' ) );
 
	}
 
	/*
	 * Add jQuery UI CSS and the datepicker script
	 * Everything else should be already included in /wp-admin/ like jquery, jquery-ui-core etc
	 * If you use WooCommerce, you can skip this function completely
	 */
	function jqueryui(){
		wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
	}
 
	/*
	 * Two input fields with CSS/JS
	 * If you would like to move CSS and JavaScript to the external file - welcome.
	 */
	function form(){
 
		$from = ( isset( $_GET['kuafDateFrom'] ) && $_GET['kuafDateFrom'] ) ? $_GET['kuafDateFrom'] : '';
		$to = ( isset( $_GET['kuafDateTo'] ) && $_GET['kuafDateTo'] ) ? $_GET['kuafDateTo'] : '';
 
		echo '<style>
		input[name="kuafDateFrom"], input[name="kuafDateTo"]{
			line-height: 28px;
			height: 28px;
			margin: 0;
			width:125px;
		}
		</style>
 
		<input type="text" name="kuafDateFrom" placeholder="Date From" value="' . $from . '" />
		<input type="text" name="kuafDateTo" placeholder="Date To" value="' . $to . '" />
 
		<script>
		jQuery( function($) {
			var from = $(\'input[name="kuafDateFrom"]\'),
			    to = $(\'input[name="kuafDateTo"]\');
 
			$( \'input[name="kuafDateFrom"], input[name="kuafDateTo"]\' ).datepicker();
			// by default, the dates look like this "April 3, 2017" but you can use any strtotime()-acceptable date format
    			// to make it 2017-04-03, add this - datepicker({dateFormat : "yy-mm-dd"});
 
 
    			// the rest part of the script prevents from choosing incorrect date interval
    			from.on( \'change\', function() {
				to.datepicker( \'option\', \'minDate\', from.val() );
			});
 
			to.on( \'change\', function() {
				from.datepicker( \'option\', \'maxDate\', to.val() );
			});
 
		});
		</script>';
 
	}
 
	/*
	 * The main function that actually filters the posts
	 */
	function filterquery( $admin_query ){
		global $pagenow;
 
		if (
			is_admin()
			&& $admin_query->is_main_query()
			// by default filter will be added to all post types, you can operate with $_GET['post_type'] to restrict it for some types
			&& in_array( $pagenow, array( 'edit.php', 'upload.php' ) )
			&& ( ! empty( $_GET['kuafDateFrom'] ) || ! empty( $_GET['kuafDateTo'] ) )
		) {
 
			$admin_query->set(
				'date_query', // I love date_query appeared in WordPress 3.7!
				array(
					'after' => $_GET['kuafDateFrom'], // any strtotime()-acceptable format!
					'before' => $_GET['kuafDateTo'],
					'inclusive' => true, // include the selected days as well
					'column'    => 'post_date' // 'post_modified', 'post_date_gmt', 'post_modified_gmt'
				)
			);
 
		}
 
		return $admin_query;
 
	}
 
}
new kuafDateRange();

// Breadcrumb

function get_breadcrumb() {
	
if ( is_front_page() ) {
			return;
		}
		if ( get_theme_mod( 'ct_ignite_show_breadcrumbs_setting' ) == 'no' ) {
			return;
		}
		global $post;
		$defaults  = array(
			'separator_icon'      => '/',
			'breadcrumbs_id'      => 'breadcrumbs',
			'breadcrumbs_classes' => 'breadcrumb',
			'home_title'          => esc_html__( 'Home', 'ignite' )
		);
		$args      = apply_filters( 'ct_ignite_breadcrumbs_args', wp_parse_args( $args, $defaults ) );
		$separator = '<span class="separator"> ' . esc_html( $args['separator_icon'] ) . ' </span>';
		/***** Begin Markup *****/
		// Open the breadcrumbs
		$html = '<ol id="'. esc_attr( $args['breadcrumbs_id'] ) . '" class="' . esc_attr( $args['breadcrumbs_classes'] ) . '">';
		// Add Homepage link & separator (always present)
		$html .= '<span class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . esc_attr( $args['home_title'] ) . '">' . esc_html( $args['home_title'] ) . '</a></span>';
		$html .= $separator;
		// Post
		if ( is_singular( 'post' ) ) {
			
			$category = get_the_category( $post->ID );
			$category_values = array_values( $category );
			$last_category = end( $category_values );
			$cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
			$cat_parents = explode( ',', $cat_parents );
			foreach ( $cat_parents as $parent ) {
				$html .= '<span class="item-cat">' . wp_kses( $parent, wp_kses_allowed_html( 'a' ) ) . '</span>';
				$html .= $separator;
			}
			$html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . esc_attr( get_the_title() ) . '">' . wp_strip_all_tags( get_the_title() ) . '</span></span>';
		} elseif ( is_singular( 'page' ) ) {
			if ( $post->post_parent ) {
				$parents = get_post_ancestors( $post->ID );
				$parents = array_reverse( $parents );
				foreach ( $parents as $parent ) {
					$html .= '<span class="item-parent item-parent-' . esc_attr( $parent ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent ) . '" href="' . esc_url( get_permalink( $parent ) ) . '" title="' . esc_attr( get_the_title( $parent ) ) . '">' . wp_strip_all_tags( get_the_title( $parent ) ) . '</a></span>';
					$html .= $separator;
				}
			}
			$html .= '<span class="item-current item-' . $post->ID . '"><span title="' . esc_attr( get_the_title() ) . '"> ' . wp_strip_all_tags( get_the_title() ) . '</span></span>';
		} elseif ( is_singular( 'attachment' ) ) {
			$parent_id        = $post->post_parent;
			$parent_title     = get_the_title( $parent_id );
			$parent_permalink = esc_url( get_permalink( $parent_id ) );
			$html .= '<span class="item-parent"><a class="bread-parent" href="' . esc_url( $parent_permalink ) . '" title="' . esc_attr( $parent_title ) . '">' . wp_strip_all_tags( $parent_title ) . '</a></span>';
			$html .= $separator;
			$html .= '<span class="item-current item-' . $post->ID . '"><span title="' . esc_attr( get_the_title() ) . '"> ' . wp_strip_all_tags( get_the_title() ) . '</span></span>';
		} elseif ( is_singular() ) {
			$post_type         = get_post_type( $post->ID );
			$post_type_object  = get_post_type_object( $post_type );
			$post_type_archive = get_post_type_archive_link( $post_type );
			$html .= '<span class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . wp_strip_all_tags( $post_type_object->labels->name ) . '</a></span>';
			$html .= $separator;
			$html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . $post->post_title . '">' . wp_strip_all_tags( $post->post_title ) . '</span></span>';
		} elseif ( is_category() ) {
			$parent = get_queried_object()->category_parent;
			if ( $parent !== 0 ) {
				$parent_category = get_category( $parent );
				$category_link   = get_category_link( $parent );
				$html .= '<span class="item-parent item-parent-' . esc_attr( $parent_category->slug ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent_category->slug ) . '" href="' . esc_url( $category_link ) . '" title="' . esc_attr( $parent_category->name ) . '">' . esc_html( $parent_category->name ) . '</a></span>';
				$html .= $separator;
			}
			$html .= '<span class="item-current item-cat"><span class="bread-current bread-cat" title="' . $post->ID . '">' . single_cat_title( '', false ) . '</span></span>';
		} elseif ( is_tag() ) {
			$html .= '<span class="item-current item-tag"><span class="bread-current bread-tag">' . single_tag_title( '', false ) . '</span></span>';
		} elseif ( is_author() ) {
			$html .= '<span class="item-current item-author"><span class="bread-current bread-author">' . get_queried_object()->display_name . '</span></span>';
		} elseif ( is_day() ) {
			$html .= '<span class="item-current item-day"><span class="bread-current bread-day">' . get_the_date() . '</span></span>';
		} elseif ( is_month() ) {
			$html .= '<span class="item-current item-month"><span class="bread-current bread-month">' . get_the_date( 'F Y' ) . '</span></span>';
		} elseif ( is_year() ) {
			$html .= '<span class="item-current item-year"><span class="bread-current bread-year">' . get_the_date( 'Y' ) . '</span></span>';
		} elseif ( is_archive() ) {
			$custom_tax_name = get_queried_object()->name;
			$html .= '<span class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html( $custom_tax_name ) . '</span></span>';
		} elseif ( is_search() ) {
			$html .= '<span class="item-current item-search"><span class="bread-current bread-search">'. esc_html( __("Search results for:", "ignite") ) . ' ' . get_search_query() . '</span></span>';
		} elseif ( is_404() ) {
			$html .= '<span>' . __( 'Error 404', 'ignite' ) . '</span>';
		} elseif ( is_home() ) {
			$html .= '<span>' . esc_html( get_the_title( get_option( 'page_for_posts' ) ) ) . '</span>';
		}
		$html .= '</ol>';
		$html = apply_filters( 'ct_ignite_breadcrumbs_filter', $html );
		echo wp_kses_post( $html );
		
}

// Paginacion Numerica
function numeric_pagination() {
    
	if( !is_home() && !is_search() && !is_archive() || !have_posts() )
	/* If the pages are not index, search and archive and/or none of them have post, display nothing */	
		return; 
	/* Otherwise, initialize pagination */
    global $wp_query;
    /* Stop the code if there is only a single page page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
    /*Add current page into the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    /*Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
	
    echo '<nav aria-label="pagination"><ul class="pagination">' . "\n";
    /*Display Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
    /*Display Link to first page*/
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        if ( ! in_array( 2, $links ) )
        echo '<li></li>';
    }
    /* Link to current page */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    /* Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
		echo '<li></li>' . "\n";
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
    echo '</ul></nav>' . "\n";
}

// Buscador Avanzado
add_action( 'wp_ajax_my_adv_search', 'ajax_my_adv_search' );
add_action( 'wp_ajax_nopriv_my_adv_search', 'ajax_my_adv_search' );
function ajax_my_adv_search() {
    if ( ! check_ajax_referer( 'my-adv-search', 'q_nonce', false ) ) {
        echo 'session_expired';
        wp_die();
    }

    $post_type = isset( $_POST['q_post_type'] ) ? $_POST['q_post_type'] : '';
    $taxonomy = isset( $_POST['q_taxonomy'] ) ? $_POST['q_taxonomy'] : [];
    $year = isset( $_POST['q_year'] ) ? $_POST['q_year'] : '';
    $orderby = isset( $_POST['q_orderby'] ) ? $_POST['q_orderby'] : [];
    $order = isset( $_POST['q_order'] ) ? $_POST['q_order'] : '';

    // Note that if $post_type is 'any', all post statuses will be included. In
    // that case, you may want to set specific post statuses below.
    $post_status = 'publish';

    $taxonomy = array_filter( (array) $taxonomy );
    if ( ! in_array( 'any', $taxonomy ) ) {
        $taxonomy = array_unique( array_map( 'trim', $taxonomy ) );

        add_filter( 'posts_join', function( $c ) use ( $taxonomy ) {
            if ( ! empty( $taxonomy ) ) {
                global $wpdb;
                // 1 below is one/number and not the lowercase of L
                $c .= " INNER JOIN {$wpdb->term_relationships} AS ctr1 ON ctr1.object_id = {$wpdb->posts}.ID" .
                    " INNER JOIN {$wpdb->term_taxonomy} AS ctt1 ON ctt1.term_taxonomy_id = ctr1.term_taxonomy_id";
            }
            return $c;
        } );

        add_filter( 'posts_where', function( $c ) use ( $taxonomy ) {
            if ( ! empty( $taxonomy ) ) {
                $tax_list = array_map( 'esc_sql', $taxonomy );
                $tax_list = "'" . implode( "', '", $tax_list ) . "'";

                // 1 below is one/number and not the lowercase of L
                $c .= " AND ( ctt1.taxonomy IN ($tax_list) )";
            }
            return $c;
        } );
    }

    if ( ! is_numeric( $year ) ) {
        $year = '';
    }

    $orderby = array_filter( (array) $orderby );
    if ( in_array( 'any', $orderby ) ) {
        // Don't sort by post date.
        $orderby2 = false;
    } else {
        $orderby = array_unique( array_map( 'trim', $orderby ) );

        // TRUE if we're sorting by year.
        $ob_year = false;

        foreach ( $orderby as $i => $s ) {
            // Sort posts by year.
            if ( 'year' === $s ) {
                $ob_year = true;
                unset( $orderby[ $i ] );
            }

            // Sort posts by views count. Note that this would only return
            // posts that have the custom field 'post_views_count'.
            if ( 'views_count' === $s ) {
                $meta_key = 'post_views_count';
                $orderby2 = 'meta_value_num';
                unset( $orderby[ $i ] );
            }
        }

        add_filter( 'posts_orderby', function( $c, $q ) use ( $ob_year ) {
            if ( $ob_year ) {
                global $wpdb;

                // Use the value parsed by WP_Query.
                $order = $q->get( 'order' );

                $c .= $c ? ', ' : '';
                $c .= "YEAR({$wpdb->posts}.post_date) $order";
            }
            return $c;
        }, 10, 2 );

        $ok = isset( $orderby2 );
        if ( ! $ok && empty( $orderby ) ) {
            // Don't sort by post date.
            $orderby2 = false;
        } elseif ( ! $ok ) {
            // Pass to WP_Query as a string.
            $orderby2 = implode( ' ', $orderby );
        }
    }

    $q = new WP_Query( [
        'post_status' => $post_status,
        'post_type'   => array($post_type),
        'year'        => $year,
        'meta_key'    => isset( $meta_key ) ? $meta_key : '',
        'orderby'     => $orderby2,
        'order'       => $order,
		'posts_per_page' => -1,
    ] );
?>
<?php if ( $q->have_posts() ) : ?>
<div class="panel-heading">
    <h1 class="panel-title">Resultado de Busqueda</h1>
</div>
<div class="panel-body" style="padding: 0;">

	<?php while ( $q->have_posts() ) : $q->the_post();
            // Do not duplicate posts
            $post_id = get_the_ID();

            if (in_array($post_id, $do_not_duplicate)) {
                continue; // We've already seen this post ID, so skip the rest of the loop
            }

            $do_not_duplicate[] = $post_id; ?>
    <div class="list-group" style="margin: 0px;">
        <a href="<?php the_permalink() ?>" class="list-group-item" id="populares"><?php the_title(); ?><strong class="label label-success pull-right"><?php echo get_post_type( get_the_ID() ); ?></strong></a>
    </div>
<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php
    wp_die();
}


//Comentarios
function advanced_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
 
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div class="comment-author vcard">
     <?php echo get_avatar($comment,$size='100' ); ?>
     
       <div class="comment-meta"><a href="<?php the_author_meta( 'user_url'); ?>"><?php printf(__('%s'), get_comment_author_link()) ?></a></div>
       <small><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?></small>
     </div>
     <div class="clear"></div>
 
     <?php if ($comment->comment_approved == '0') : ?>
       <em><?php _e('Your comment is awaiting moderation.') ?></em>
       <br />
     <?php endif; ?>
 
     <div class="comment-text">	
         <?php comment_text() ?>
     </div>
 
   <div class="reply">
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
   </div>
   <div class="clear"></div>
<?php } ?>
<?php
// Para borrar comentarios deirectamente de la website y no del dashboard solamente
 function delete_comment_link($id) {
  if (current_user_can('edit_post')) {
    echo '<a href="'.admin_url("comment.php?action=cdc&c=$id").'">Delete/Borrar</a> ';
    echo '<a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">Spam</a>';
  }
}
?>
<?php
//// Capa extra contra comentarios spam
 function check_referrer() {
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == “”) {
        wp_die( __('Please enable referrers in your browser, or, if you\'re a spammer, get out of here!') );
    }
}
 
add_action('check_comment_flood', 'check_referrer');