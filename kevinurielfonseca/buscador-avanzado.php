<?php
/*
Template Name: Advanced Search
Template Post Type: page
*/
?>
<?php get_header(); ?>
<?php include("includes/page-header.php"); ?>
<div class="container">
<div class="row">

<div id="my-adv-search">
<!-- Post Type -->
<div class="col-md-3">
    <div class="form-group">
        <label for="q_post_type">Post Type</label>
        <select class="form-control" id="q_post_type">
            <option selected>Please selec an option</option>
            <?php
			$args = array(
				'public'	=> true,
				'_builtin' => false,				
			);
			$post_types = get_post_types($args);
				foreach( $post_types as $post_type ) {
					echo '<option>' . $post_type . '</option>' ;	
				}
			?>
        </select>
    </div>
</div>

<!-- Taxonomy -->
<div class="col-md-3">
    <div class="form-group">
        <label for="q_taxonomy">Taxonomy</label>
        <select class="form-control" multiple id="q_taxonomy">
            <option value="any" selected>Any</option>
			<?php 
            $args = array(
              'public'   => true,
              '_builtin' => false
            ); 
            $output = 'names'; // or objects
            $operator = 'and'; // 'and' or 'or'
            $taxonomies = get_taxonomies( $args, $output, $operator ); 
            if ( $taxonomies ) {
              foreach ( $taxonomies  as $taxonomy ) {
                echo '<option>' . $taxonomy . '</option>';
              }
            }
            ?>
        </select>
    </div>
</div>

<!-- Year -->
<div class="col-md-3">
    <div class="form-group">
        <label for="q_year">Year</label>
        <select class="form-control" id="q_year">
            <option value="any" selected>Any</option>
            <?php
			$args = array(
				'public'	=> true,
				'_builtin'	=> false,
				'type'		=> 'yearly',
				'format'	=> 'option',
			);
			wp_get_archives($args);
			?>
        </select>
    </div>
</div>

<!-- Orderby -->
<div class="col-md-3">
    <div class="form-group">
        <label for="q_orderby">Order by</label>
        <select class="form-control" multiple id="q_orderby">
            <option value="any" selected>Any</option>
            <?php
            foreach ( [
              'author'        => 'Author',
              'comment_count' => 'Popularity (# of Comments)',
              'year'          => 'Year',
              'views_count'   => 'Views',
			  'order'		  => 'ASC ? DESC',
			  'nonce'		  => '',
            ] as $value => $label ) {
              printf( '<option value="%s">%s</option>',
                esc_attr( $value ), esc_html( $label ) );
            }
            ?>
        </select>
    </div>
</div>

<!-- Nonce field. -->
<?php wp_nonce_field( 'my-adv-search', 'q_nonce' ); ?>

<!-- Search Button -->
<div class="col-md-12">
    <div class="btn-group pull-right" data-toggle="buttons">
        <label class="btn btn-default form-check-label">
            <input class="form-check-input" autocomplete="off" type="radio" name="order" id="q_order-asc" value="ASC"> ASC
        </label>
        <label class="btn btn-default form-check-label">
            <input class="form-check-input" autocomplete="off" type="radio" name="order" id="q_order-desc" value="DESC" checked> DESC
        </label>
    </div>
    <input type="submit" class="btn btn-primary" id="buscar_btn" value="Search">
    <noscript>&lt;b&gt;Your browser does not support Javascript, this making it unable to display the posts.&lt;/b&gt;</noscript>
    <div id="resultados" style="margin-top:5px;"></div>
</div>
</div><!-- End #my-adv-search -->


</div>
</div>
<br>
<?php get_footer(); ?>
<script type="text/javascript">
jQuery( function( $ ){
    var ajaxurl = '/wordpress/wp-admin/admin-ajax.php';

    function searchPosts( btn ) {
        var _btn_text = btn.value,
            q_order;

        btn.disabled = true;
        btn.value = 'Searching..';

        q_order = $( '#q_order-asc' ).is( ':checked' ) ? 'ASC' : 'DESC';

        return $.post( ajaxurl, {
            action: 'my_adv_search',
            q_nonce: $( '#q_nonce' ).val(),
            q_post_type: $( '#q_post_type' ).val(),
            q_taxonomy: $( '#q_taxonomy' ).val(),
            q_year: $( '#q_year' ).val(),
            q_orderby: $( '#q_orderby' ).val(),
            q_order: q_order,
        } ).done( function( s ){
            if ( 'session_expired' === s ) {
                location.reload();
                return;
            }

            $( '#resultados' ).html( s );
        } ).always( function(){
            btn.value = _btn_text;
            btn.disabled = false;
        } );
    }

    $( '#buscar_btn', '#my-adv-search' ).on( 'click', function( e ){
        e.preventDefault();

        // Run AJAX search.
        searchPosts( this );

        // Remove button focus.
        this.blur();
    } );
} );
</script>