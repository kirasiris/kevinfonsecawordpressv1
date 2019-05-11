<div class="col-md-4" id="sidebar-listado">
<aside>
<!-- Search -->
<div class="well" id="sidebar"><h4 id="sidebarh4">Search</h4>
<form role="search" method="get" id="searchform" class="searchform" action="<?php bloginfo('url') ?>">
    <div class="input-group">
        <input class="form-control" name="s" placeholder="Write here..." >
        <input type="hidden" name="post_type" value="post, portfolios, snippets" />
        <span class="input-group-btn">
        	<button class="btn btn-primary" type="submit">Go!</button>
        </span>
    </div>
</form>
</div>
<?php if(is_single()) : ?>
<!-- Metadata -->
<div class="well hidden-xs" id="sidebar"><h4 id="sidebarh4">Info:</h4>
<i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
<br>
<i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?><br>
<i class="fa fa-eye" aria-hidden="true"></i> <?php echo getPostViews(get_the_ID()); ?><br>
<i class="fa fa-clock-o"></i> Published: <?php the_time('M j, Y'); ?><br>
<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Last edition: <?php the_modified_date('M j, Y'); ?><br>
</div>
<?php endif; ?>
<!-- Archives Form -->
<div class="well hidden-xs" id="sidebar"><h4 id="sidebarh4">Archives:</h4>
<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;" class="form-control">
  <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
  <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
</select>
</div>
<!-- Sidebar in Wordpress backend -->
<?php if(is_active_sidebar('sidebar')) : ?>
<?php dynamic_sidebar('sidebar'); ?>
<?php endif; ?>
</aside>
</div>