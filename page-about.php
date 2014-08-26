  <article>

  <section id="stories" class="col-sm-12 storypage">

  <?php echo $post->post_content; ?>

  </section>

  <section id="tutorials" class="col-sm-12">
    <div class="row">
    
<?php

  $rows = get_field('ctas');

  foreach($rows as $row){

    $row['image'];
    
    echo "<div class='col-sm-4'>\n";
    echo "<img class='previewimg' src='".$row['image']['sizes']['articlethumb']."' alt='".$row['title']."'>\n";
    echo $row['content'];
    echo "</div>\n";
  }

?>
    </div>
  </section>


  </article>