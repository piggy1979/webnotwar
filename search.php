<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div class="container">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/searchcontent', get_post_format()); ?>
<?php endwhile; ?>
</div>
<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav container">
    <ul class="page-numbers">
      <li class="previous"><?php previous_posts_link(__('&larr; Back ', 'roots')); ?></li>
      <li class="next"><?php next_posts_link(__('Next &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
