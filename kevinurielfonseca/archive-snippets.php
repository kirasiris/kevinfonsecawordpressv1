<?php get_header(); ?>
<?php include("includes/page-header.php"); ?>
<div class="container" style="margin-bottom: 20px">
    <!-- Page Heading -->
    <div class="row">
		<div class="col-md-12">
            <div style="margin-bottom: 20px;">
                <button class="btn btn-sm btn-default" data-toggle="portfilter" data-target="all">All</button>
					<?php 
                        $terms = get_terms("snippets_categories"); // Get all the terms from the specific Custom Taxonomy
                        $termsString .=  $term->slug;
                        $count = count($terms); // How many terms?
                        if ( $count > 0 ):  // If there are more than one
                            foreach ( $terms as $term ) :  // For each term:
                                echo "<button class='btn btn-sm btn-primary' data-toggle='portfilter' data-target='".$term->slug."'>".$term->name."</button>\n";
                            endforeach;
                        endif; 
                    ?>
            </div>
		<?php 
			$snippets_query = new WP_Query(array(
				'post_type' => 'snippets',
				'order' => 'DESC',
				'posts_per_page' => -1,
			));
		?>
		<?php if($snippets_query->have_posts()) : while($snippets_query->have_posts()) : $snippets_query->the_post();?>
			<?php $terms_snippets = get_the_terms( get_the_ID(''), 'snippets_categories'); ?>
            <?php
				$terms_snippet_slugs = array();
				foreach ($terms_snippets as $tp) {
					$terms_snippet_slugs[] = $tp->slug;
				}
				$terms_snippet_csv = implode (' ',$terms_snippet_slugs);
			?>
        	<a class="label label-info" href="<?php the_permalink(); ?>" data-tag="<?php echo $terms_snippet_csv; ?>"><?php the_title(); ?></a>
		<?php endwhile; ?>
		<?php  else : ?>
        	<div class="alert alert-danger text-center"><p>No snippet</p></div>
		<?php endif; ?>
		</div>
    </div>
</div><!-- /Container -->
<!-- /.row -->
<?php get_footer(); ?>