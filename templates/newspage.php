 <article>

  <section id="stories" class="col-sm-8">
      <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail('large');
      } ?>
      <h2><?php the_title(); ?></h2>
      <?php get_template_part('templates/entry-meta'); ?>
      <div class="sitecontent">
      <?php the_content(); ?>
    </div>
      <?php comments_template('/templates/comments.php'); ?>

  </section>

  <section id="news" class='col-sm-4 floaty'>
    <div id="sticky">
          <h4 class="recent nav">Recent</h4>
    <div id="tabs">

    <div class="slide">
    <?php 
    
    echo getPosts(5, array(1768, 350, 1739),'title', 12, true); 

    ?>
    </div>
    <h4 class="popular nav">Popular</h4>
    <div class="slide">

    <?php 
    wpp_get_mostpopular("range=weekly&limit=5&cat=-1768,-350,-1739&post_type=post");
    ?>
    </div>
  </div><!-- end of tabs -->
    <?php get_template_part('templates/author'); ?>
    </div>
  </section>  


  </article>