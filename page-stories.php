  <article>

  <section id="stories" class="col-sm-8 storypage">

		<div class="row">
		<?php echo getPosts(1, array(1768),'preview', 12); ?>
		</div>
		<div class="row clear">
		<?php echo getPosts(2, array(1768),'preview', 6, false,1); ?>
		</div>
		<div class="row clear">
		<?php echo getPosts(2, array(1768),'preview', 6, false,3); ?>
		</div>

  </section>

  <section id="news" class='col-sm-4 floaty'>
    <div id="sticky">
          <h4 class="recent nav">Recent</h4>
    <div id="tabs">

    <div class="slide">
    <?php echo getPosts(5, array(1768, 350, 1739),'title', 12, false); ?>
    </div>
    <h4 class="popular nav">Popular</h4>
    <div class="slide">

    <?php 
    wpp_get_mostpopular("range=weekly&limit=5&cat=1768");
    ?>
    </div>
  </div><!-- end of tabs -->
    <?php //get_template_part('templates/author'); ?>
    </div>
  </section>  


  </article>