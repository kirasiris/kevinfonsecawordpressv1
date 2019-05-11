<!-- Previous and Next Post -->
<?php if(is_single()) : ?>
<!-- Para pantallas grandes -->
<div class="btn-group btn-group-justified hidden-sm hidden-xs" role="group" aria-label="..." id="nextpreviouslinks">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default btn-sm"> Previous: <?php previous_post_link( '%link', '%title'); ?></button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default btn-sm"><a href="<?php echo get_post_type() ?>"><i class="fa fa-th" aria-hidden="true"></i></a></button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default btn-sm"> Next: <?php next_post_link( '%link', '%title' ); ?></button>
  </div>
</div>
<?php endif; ?>
<!-- /Previous and Next Post -->