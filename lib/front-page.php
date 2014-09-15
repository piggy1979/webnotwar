<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/slideshow'); ?>
  <?php get_template_part('templates/page', 'header'); ?>

	<section id="stories" class="col-sm-8 row">
		<h1>Stories</h1>
		<div class="row">
		<?php echo getPosts(2, array(1768),'preview', 6); ?>
		</div>
	</section>

	<section id="news" class='col-sm-4'>
		<h1>News</h1>
		<?php echo getPosts(8, array(1768),'title', 12, true); ?>
	</section>	

	<section id="tutorials" class="col-sm-12">
		<h1>Latest Tutorials</h1>
		<?php echo getPosts(2, array('tutorials'),'preview'); ?>
	</section>

  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
