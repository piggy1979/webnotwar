<?php while (have_posts()) : the_post(); ?>
<?php 
function processArray($postid, $ids){
  $nonnews =  array(1768, 350, 1739);
  $check = false;
  foreach($nonnews as $n){
    if(in_array($n, $ids)) $check = true;
  }
  return $check;
}

$cats = get_the_category($post->ID);

$ids = array();
foreach($cats as $category){
  $ids[] = $category->cat_ID;
}

if( !processArray($post->ID, $ids) && $post->post_type == 'post' ){
    get_template_part('templates/newspage');
}else{
?>

  <article>


  <section id="stories" class="col-sm-8">
      <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail('large');
      } ?>
      <h2><?php the_title(); ?></h2>
      <?php get_template_part('templates/entry-meta'); ?>
      <div class='sitecontent'>
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
    
    echo getPosts(5, 'stories','title', 12, false); 

    ?>
    </div>
    <h4 class="popular nav">Popular</h4>
    <div class="slide">

    <?php 
    wpp_get_mostpopular("range=weekly&limit=5&post_type=stories");
    ?>
    </div>
  </div><!-- end of tabs -->
    <?php get_template_part('templates/author'); ?>
        <?php dynamic_sidebar('sidebar-primary'); ?>

    </div>

  </section>  


  </article>
<?php 
}

endwhile; 

?>
