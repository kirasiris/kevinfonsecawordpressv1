</div>
<!-- Footer -->
<!-- Latest Posts and Latests Comments -->
<section>
  <div class="container">
    <div class="row"> 
      <!-- Recent Posts -->
      <div class="col-md-6">
        <div class="well">
          <h4 style="text-align:center;">Recent Posts</h4>
          <?php $postslist = get_posts('numberposts=5&order=DESC'); ?>
          <?php  if($postslist) : foreach ($postslist as $post) : setup_postdata($post); ?>
          <div class="media"> <a class="pull-left" href="<?php the_permalink();?>">
            <?php the_post_thumbnail('post-recientes', array('class'=>'media-object')); ?>
            </a>
            <div class="media-body">
              <h5 class="media-heading"><a href="<?php the_permalink();?>">
                <?php the_title();?>
                </a></h5>
              <small id="small-footer">
              <?php the_time('M j, Y'); ?>
              </small> </div>
          </div>
          <?php endforeach; ?>
          <?php else : ?>
          <div class="alert alert-danger">No post found</div>
          <?php endif; ?>
        </div>
      </div>
      <!-- /Recent Posts --> 
      <!-- Recent Comments -->
      <div class="col-md-6">
        <div class="well">
          <h4 style="text-align:center;">Recent Comments</h4>
          <?php $postcomments = get_comments('number=4&status=approve&order=DESC') ;?>
          <?php if($postcomments) : foreach($postcomments as $comment) : ?>
          <div class="media"> <a class="pull-left" href="<?php echo esc_url( $comment->comment_author_url ); ?>" target="_blank"><?php echo get_avatar( $comment->comment_author_email, 60 ); ?></a>
            <div class="media-body">
              <h5 class="media-heading"><a href="<?php echo esc_url( $comment->comment_author_url ); ?>"><?php echo $comment->comment_author; ?></a> en <a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>"><?php echo $comment->post_title; ?></a></h5>
              <!--<div class="media-body"><?php echo wp_html_excerpt($comment->comment_content,10) ; ?></div>--> 
              <small id="small-footer">
              <?php the_time('M j, Y'); ?>
              </small> </div>
          </div>
          <?php endforeach; ?>
          <?php else : ?>
          <div class="alert alert-danger">No comments found</div>
          <?php endif; ?>
        </div>
      </div>
      <!-- /Recent Comments --> 
    </div>
  </div>
</section>
<!-- Footer Menu -->
<section id="extra-footer-links">
  <div class="container">
    <?php
           wp_nav_menu( array(
               'menu'              => 'secondary',
               'theme_location'    => 'secondary',
               'depth'             => 2,
               'container'         => '',
               'container_class'   => '',
			   'container_id'      => '',
               'menu_class'        => 'pagination',
               'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
               'walker'            => new wp_bootstrap_navwalker())
           );
       ?>
  </div>
</section>
<!-- Footer Links -->
<footer>
  <div class="row">
    <div class="container">
      <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 footer-creditos">
        <p>&copy; <?php echo Date('Y'); ?> - <a href="<?php bloginfo('url'); ?>">
          <?php bloginfo('name'); ?>
          </a> ,inc. All rights reserved. <i class="fa fa-code" id="fa-code"></i> made with <i class="fa fa-heart" aria-hidden="true" id="fa-heart"></i> &#38; &#9749; by Kevin</p>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 footer-icons">
        <?php if(get_theme_mod('icon_link_github', '#') != '') : ?>
        <a href="<?php echo get_theme_mod('icon_link_github', '#'); ?>" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>
        <?php endif;?>
        <?php if(get_theme_mod('icon_link_facebook', '#') != '') : ?>
        <a href="<?php echo get_theme_mod('icon_link_facebook', '#'); ?>" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
        <?php endif; ?>
        <?php if(get_theme_mod('icon_link_twitter', '#') != '') : ?>
        <a href="<?php echo get_theme_mod('icon_link_twitter', '#'); ?>" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
        <?php endif; ?>
        <?php if(get_theme_mod('icon_link_instagram', '#') != '') : ?>
        <a href="<?php echo get_theme_mod('icon_link_instagram', '#'); ?>" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
        <?php endif; ?>
        <?php if(get_theme_mod('icon_link_youtube', '#') != '') : ?>
        <a href="<?php echo get_theme_mod('icon_link_youtube', '#'); ?>" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-youtube fa-2x" aria-hidden="true"></i></a>
        <?php endif; ?>
        <a href="https://wordpress.org/" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-wordpress fa-2x" aria-hidden="true"></i></a> <a href="https://www.w3.org/TR/html5/" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-html5 fa-2x" aria-hidden="true"></i></a> <a href="https://www.w3.org/standards/techs/css#w3c_all" target="_blank" rel="noopener nofollow noreferrer"><i class="fa fa-css3 fa-2x" aria-hidden="true"></i></a> </div>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row --> 
</footer>
<a href="#top" class="cd-top cd-is-visible cd-fade-out">Top</a> 
<!-- /.container --> 
<!-- WordPress Scripts -->
<?php wp_footer(); ?>
<!-- Master js (Jquery always goes first,Bootstrap, Unicorn Buttons, and Back to top ) --> 
<script src="<?php bloginfo('template_url'); ?>/js/master.js" type="text/javascript"></script> 
<!-- owl carousel --> 
<script src="<?php bloginfo('template_url'); ?>/js/owl.carousel.js"></script> 
<script>
SyntaxHighlighter.all();

jQuery(document).ready(function($) {

  var owl = $('.owl-carousel');
  

   $('.owl-carousel').owlCarousel({
 
      autoPlay: 2000, //Set AutoPlay to 1 second
 
      items : [4],
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  })
 
 
  // Custom Navigation Events
  $(".next").click(function(){
    owl.trigger('owl.next');
  })
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl.trigger('owl.stop');
  })
 
});
</script>
</body>
</html>