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
    <div id="fieldguidemenu">
      <ul>
  <?php
  /* MENU */

  $args = array(
    'depth'       => 0,
    'child_of'    => 12950,
    'menu_class'  => 'fieldguide',
    'echo'        => false,
    'title_li'    => __(''),
    'walker'      => new Imp_Title_Walker()
  );

  $menu = wp_list_pages($args);
  echo $menu;
  ?>
    </ul>
  </div>

<div class="fieldguide">
  <section id="stories" class="col-sm-12 storypage">
    <div class="sitecontent">
      <?php echo wpautop($post->post_content); ?>
    </div>
<ul id="pagenav">
  <li class="prev"><?php echo previous_page_not_post('Previous Chapter', false); ?></li>
  <li class="next"><?php echo next_page_not_post('Next Chapter', false); ?></li>
</ul>
  </section>
</div>


  </article>



