<?php get_header(); ?>
<?php include("includes/page-header.php"); ?>
<div class="container">
<div class="pull-left">
				<button class="btn btn-default btn-sm" data-toggle="portfilter" data-target="all">All</button>
					<?php 
                        $terms = get_terms("portfolio_categories"); // Get all the terms from the specific Custom Taxonomy
                        $termsString .=  $term->slug;
                        $count = count($terms); // How many terms?
                        if ( $count > 0 ):  // If there are more than one
                            foreach ( $terms as $term ) :  // For each term:
                                echo "<button class='btn btn-sm btn-primary' data-toggle='portfilter' data-target='".$term->slug."'>".$term->name."</button>\n";
                            endforeach;
                        endif;
                    ?>
			</div>
            <div class="hidden-xs hidden-sm pull-right">
                <button class="btn btn-primary btn-sm" onclick="one()"><i class="fa fa-stop" aria-hidden="true"></i></button>
                <button class="btn btn-primary btn-sm" onclick="two()"><i class="fa fa-th-large" aria-hidden="true"></i></button>
                <button class="btn btn-primary btn-sm" onclick="three()"><i class="fa fa-th" aria-hidden="true"></i></button>
                <button class="btn btn-primary btn-sm" onclick="four()">4</button>
            </div>           
			<div class="clearfix"></div>           
			<div class="row store">
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$portfolio_query = new WP_Query(array(
                'post_type' => 'portfolio',
                'order' => 'DESC',
				'posts_per_page' => get_option('posts_per_page'),
				'paged'           =>  $paged,
            ));
            ?>
			<?php if($portfolio_query->have_posts()) : while($portfolio_query->have_posts()) : $portfolio_query->the_post();?>
			<?php $terms_portfolio = get_the_terms( $post->ID, 'portfolio_categories'); ?>
            <?php
				$terms_portfolio_slugs = array();
				foreach ($terms_portfolio as $tp) {
					$terms_portfolio_slugs[] = $tp->slug;
				}
				$terms_portfolio_csv = implode (' ',$terms_portfolio_slugs);
			?>
               <div class="col-md-4  products text-center"  data-tag="<?php echo $terms_portfolio_csv; ?>">
                <?php if(has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                <?php if(has_post_thumbnail()) {
                    the_post_thumbnail('portfolio-page', array('class' => 'img-responsive'));
                    } else {
                        echo no_image();
                    }
                ?></a>
                <?php endif; ?>
                    <div class="products-info">
                    <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                    <!-- Show buttons if there are not empty -->
                    <!-- View demo button -->
                    <?php $demostracion_url = get_post_meta($post->ID, 'url_para_ver_demo', true); ?>
                    <?php if ($demostracion_url == '#') : ?>
                    <?php else: ?>
                    <a href="<?php echo demo_url(get_the_ID()); ?>" class="btn btn-default btn-sm" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <?php endif; ?>
                    <!-- Github Free File Button -->
                    <?php $archivo_url = get_post_meta($post->ID, 'url_para_descargar_archivo_gratis', true); ?>
                    <?php if ($archivo_url == '#') : ?>
                    <?php else : ?>
                    <a href="<?php echo descargar_url(get_the_ID()); ?>" class="btn btn-info btn-sm" target="_blank" rel="noopener nofollow noreferrer" download><i class="fa fa-download" aria-hidden="true"></i></a>
                    <?php endif; ?>
                    </div>
               </div>
            <?php endwhile; ?>
				<!-- Section: Pagination -->
				<div class="clearfix"></div>
				<div class="col-md-12"><?php numeric_pagination(); ?></div>
            <?php else : ?>
            <div class="alert alert-danger" style="width:100%">No portfolio found</div>
            <?php endif; ?>
            </div>
</div>
<!-- /.row -->
<script type="text/javascript">
/*    document.onkeypress = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onmousedown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            //alert('No F-keys');
            return false;
        }
    }
document.onkeydown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    };
var message="Sorry, right-click has been disabled"; 
/////////////////////////////////// 
function clickIE() {if (document.all) {(message);return false;}} 
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) { 
if (e.which==2||e.which==3) {(message);return false;}}} 
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;} 
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;} 
document.oncontextmenu=new Function("return false") */
// Portfolio grid
// Get the elements with class="products"
;var elements = document.getElementsByClassName("products");

// Declare a "loop" variable
var i;

// Full-width images
function one() {
    for (i = 0; i < elements.length; i++) {
        elements[i].style.flex = "100%"; 
    }
}

// Two images side by side
function two() {
    for (i = 0; i < elements.length; i++) {
        elements[i].style.flex = "45%"; 
    }
}

// Three images side by side
function three() {
    for (i = 0; i < elements.length; i++) {
        elements[i].style.flex = "25%"; 
    }
}

// Four images side by side
function four() {
    for (i = 0; i < elements.length; i++) {
        elements[i].style.flex = "20%"; 
    }
}
</script>
<?php get_footer(); ?>