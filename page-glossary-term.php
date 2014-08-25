  <article>

  <section id="stories" class="col-sm-8 storypage">

		<div class="">
    <?php echo getGlossary(); ?>
    </div>

  </section>

  <section id="news" class='col-sm-4 floaty'>
    <div id="sticky">
          <h5>Submit a Word</h5>
          <?php
          gravity_form(4, false, false, true, null);
          ?>
    </div>
  </section>  


  </article>