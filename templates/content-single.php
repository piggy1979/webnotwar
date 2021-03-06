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
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_sharing_toolbox"></div>
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
    if($post->post_type == "stories"){
      echo getPosts(5, 'stories','title', 12, false); 
    }else if($post->post_type == "opensource"){
      echo getPosts(5, 'opensource', 'title', 12, false);
    }else{
      echo getPosts(5, array(1768, 350, 1739),'title', 12, false); 
    }

    ?>
    </div>
    <h4 class="popular nav">Popular</h4>
    <div class="slide">

    <?php 
    if($post->post_type == "stories"){
      wpp_get_mostpopular("range=weekly&limit=5&post_type=stories"); 
    }else if($post->post_type == "opensource"){
      wpp_get_mostpopular("range=weekly&limit=5&post_type=opensource"); 
    }else{
      wpp_get_mostpopular("range=weekly&limit=5&cat=1768");     
    }
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
