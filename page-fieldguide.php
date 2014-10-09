<?php
/*
Template Name: Field Guide Template
*/
?>
  <script type="text/javascript">

  $(document).ready(function(){
    $(".tooltip").tooltipster({
      position: 'bottom'
    });
  });

  </script>

  <article>

<div class="fieldguide ">
  <section id="stories" class="storypage">
    <div class="sitecontent col-sm-8">
      <?php echo wpautop($post->post_content); ?>

<ul id="pagenav">
  <li class="prev"><?php echo previous_page_not_post('Previous Chapter', false); ?></li>
  <li class="next"><?php echo next_page_not_post('Next Chapter', false); ?></li>
</ul>

    </div>

    <div class="col-sm-4">
      <h1>Field Guide Index</h1>
      <ul>
  <?php
  /* MENU */

  $args = array(
    'depth'       => 0,
    'child_of'    => 12950,
    'menu_class'  => 'fieldguide',
    'echo'        => false,
    'title_li'    => __('')
    //,'walker'      => new Imp_Title_Walker()
  );
  $menu = wp_list_pages($args);
  echo $menu;
  ?>
    </ul>
  </div>



  </section>
</div>




  </article>



