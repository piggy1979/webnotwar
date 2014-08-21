<?php 
/* get author details */
?>

<div class="authordetails">

	<?php echo get_avatar(get_the_author_meta('ID')); ?>
	<div class="details">
		<h4>Author</h4>
		<h3><?php echo get_the_author(); ?></h3>
		<p><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">View Profile</a></p>
	</div>
</div>