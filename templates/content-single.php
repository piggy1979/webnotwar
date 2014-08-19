<?php while (have_posts()) : the_post(); ?>
  <article>



  <section id="stories" class="col-sm-8">
      <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail('large');
      } ?>
      <h2><?php the_title(); ?></h2>
      <?php get_template_part('templates/entry-meta'); ?>
      <?php the_content(); ?>
      <?php comments_template('/templates/comments.php'); ?>

  </section>

  <section id="news" class='col-sm-4'>
    <h1>News</h1>
    <div class='headermsg'><a class="news" href="/news">View all News</a></div>
    <?php echo getPosts(12, array(1768, 350, 1739),'title', 12, true); ?>
  </section>  


  </article>
<?php endwhile; ?>
