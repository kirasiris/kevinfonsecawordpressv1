<?php get_header(); ?>
<?php include("includes/page-header.php"); ?>
<div class="container">
<?php include("includes/previousandnextpost.php") ?>
	<div class="row">
    	<div class="col-md-12">
            <!-- Article -->
            <article>
            <?php if(have_posts()) : the_post(); ?>
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
            <?php the_tags(); ?>
            <?php include("includes/share.php"); ?>
            </article>
            <!-- Box Author -->
            <?php if(is_single()) : ?>
            <?php echo wpb_author_info_box( $content )  ?>
            <?php endif; ?>
            <!-- Categories -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title"><i class="fa fa-tag" aria-hidden="true"></i> Categories</h1>
                </div>
                <div class="panel-body">
                <?php 
                global $post;
                $terms = wp_get_post_terms( get_the_ID(), 'portfolio_categories');
                if ($terms) {
                    $output = array();
                    foreach ($terms as $term) {
                        $output[] = '<a href="' .get_term_link( $term->slug, 'portfolio_categories') .'"><span class="label label-success">' .$term->name .'</span></a>';
                    }
                    echo join( ' ', $output );
                } else {
                    echo '<a><span class="label label-success">Sin categoria</span></a>';
                }
                ?>
                </div>
            </div>
            <!-- Tags -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title"><i class="fa fa-tags" aria-hidden="true"></i> Tags</h1>
                </div>
                <div class="panel-body">
                <?php 
                global $post;
                $terms = wp_get_post_terms( get_the_ID(), 'portfolio_tags');
                if ($terms) {
                    $output = array();
                    foreach ($terms as $term) {
                        $output[] = '<a href="' .get_term_link( $term->slug, 'portfolio_tags') .'"><span class="label label-success">' .$term->name .'</span></a>';
                    }
                    echo join( ' ', $output );
                } else {
                    echo '<a><span class="label label-success">Sin categoria</span></a>';
                }
                ?>
                </div>
            </div>
            <!-- Related Posts -->
            <?php include ('includes/relatedpost.php'); ?>
            <!-- Comments -->
            <?php comments_template(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>