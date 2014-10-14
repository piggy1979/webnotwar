<?php while (have_posts()) : the_post(); ?>
  <?php // get_template_part('templates/page', 'header'); ?>

	<section id="stories" class="col-sm-8">
		<h1>Stories</h1>
		<div class='headermsg'><a class="news" href="/stories">View Latest Stories</a></div>
		<div class="row">
		<?php echo getPosts(2, 'stories','preview', 6); ?>
		</div>
	</section>

	<section id="news" class='col-sm-4'>
		<h1>Community News</h1>
		<div class='headermsg'><a class="news" href="/community/news">View all News</a></div>
		<?php echo getPosts(5, array(1768, 350, 1739),'title', 12, true); ?>
	</section>	



<?php

$events = getUpcomingEvents(5);

if($events){
?>
	<section id="news" class='col-sm-4'>
		<h1>Upcoming Events</h1>
		<div class="headermsg"><a class="news" href="/community/events">View all Events</a></div>
		<?php echo $events; ?>

	</section>	

<?php } ?>


	<section id="tutorials" class="col-sm-12">
		<h1>Latest Tutorials</h1>
		<div class='headermsg'><a class="news" href="/open-source">View all Tutorials</a></div>
		<div class="row">
		<?php echo getTutorials(4, array(350, 1739),'preview' , 3); ?>
		</div>
	</section>

<?php // get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
