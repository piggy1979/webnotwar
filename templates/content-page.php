  <article>



  <section id="stories" class="col-sm-8">
      <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail('large');
      } ?>
      <?php the_content(); ?>

  </section>

  <section id="news" class='col-sm-4 floaty'>
    <div id="sticky">
          <h4 class="recent nav">Recent</h4>
    <div id="tabs">

    <div class="slide">
    <?php 
    
    echo getPosts(5, array(1768, 350, 1739),'title', 12, false); 

    ?>
    </div>
    <h4 class="popular nav">Popular</h4>
    <div class="slide">

    <?php 
    wpp_get_mostpopular("range=weekly&limit=5&cat=1768");
    ?>
    </div>
  </div><!-- end of tabs -->
    </div>
  </section>  


  </article>

