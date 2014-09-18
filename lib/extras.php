<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }
  $title .= get_bloginfo('name');
  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);
add_theme_support( 'buddypress' );

// clean up unwanted JS scripts
function my_print_scripts(){
   if ( !is_admin() ) {
      wp_deregister_script('ai1ec_requirejs');
   }
}
add_action('wp_print_scripts', 'my_print_scripts');

// clean up unwanted CSS
function my_print_css() {
   if ( !is_admin() ) {
      wp_deregister_style('ai1ec-render_css');
      wp_deregister_style('ai1ec-event');
      wp_deregister_style('ai1ec-calendar');
   }
}
add_action('wp_print_styles', 'my_print_css');

add_image_size( 'featured', 1600, 600, true);
add_image_size( 'articlethumb', 345, 189, true);
add_image_size( 'mainthumb',710, 380,true);



function create_post_types(){
register_post_type('featured',
  array(
    'labels'  => array(
      'name'      => __('Featured Slides'),
      'singular_name' => __('Featured Slide')
      ),
    'public'    => true,
    'has_archive' => false,
    'menu_position' => 5,
    'publicly_queryable' => true,
    'supports' => array('title', 'thumbnail', 'revisions')
  )
);

register_post_type('stories',
  array(
    'labels'  => array(
      'name'      => __('Stories'),
      'singular_name' => __('Story')
      ),
    'public'    => true,
    'has_archive' => true,
    'menu_position' => 5,
    'publicly_queryable' => true,
    'supports' => array('title', 'thumbnail', 'revisions', 'editor'),
    'taxonomies' => array('post_tag')
  )
);

register_post_type('inventory',
  array(
    'labels'  => array(
      'name'      => __('Open Data Inventory'),
      'singular_name' => __('Open Data Inventory')
      ),
    'public'    => true,
    'has_archive' => true,
    'menu_position' => 5,
    'publicly_queryable' => true,
    'supports' => array('title', 'revisions', 'editor'),
    'taxonomies' => array('post_tag')
  )
);



register_post_type('tutorial',
  array(
    'labels'  => array(
      'name'      => __('Tutorials'),
      'singular_name' => __('Tutorial')
      ),
    'public'    => true,
    'has_archive' => true,
    'menu_position' => 5,
    'publicly_queryable' => true,
    'supports' => array('title', 'thumbnail', 'revisions', 'editor'),
    'taxonomies' => array('post_tag')
  )
);

  register_taxonomy(
    'tutorial_cats',
    'tutorial',
    array(
      'labels' => array(
        'name' => "Types of Tutorials",
        'add_new_item' => 'Add New Tutorial Type',
        'new_item_name' => 'New Tutorial Type'
      ),
      'show_ui' => true,
      'show_admin_column' => true,
      'show_tagcloud' => false,
      'hierarchical' => true
    )
  );






}
add_action('init', 'create_post_types');


function featuredSlides($n){
  $args = array(
    'post_type'     => 'featured',
    'posts_per_page'  => $n
  );

  $query = new WP_Query($args);
  $output = "";
  foreach($query->posts as $post){
    $imageID = get_post_thumbnail_id($post->ID);
    $image = wp_get_attachment_image_src($imageID, 'featured');

    $background = "<img src='".$image[0]."' alt='".$post->post_title."'>";
    $output .= "<div class='slide'>\n";
    $output .= $background;
    $output .= "<div class='slidecontent'><div class='addpadding'>\n";

    $content = get_post_meta($post->ID, 'slidecontent');
    // $url     = get_post_meta($post->ID, 'url');


    $output .= $content[0];
    $output .= "</div></div>\n";
    $output .= "</div>\n";
  }

  return $output;
}




function getNews($count, $cats, $type, $bootwidth = 4, $not = false){
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $big  = 99999999;
    $args = array(
    'post_type'     => 'post',
    'orderby'       => 'date',
    'order'         => 'DESC',
    'posts_per_page'=> $count,
    'offset'        => $offset,
    'paged'         => $paged 
  );
  
  if($not){
    $args['category__not_in'] = $cats;
  }else{
    $args['category__in'] = $cats;
  }

  $query = new WP_Query($args);
  foreach($query->posts as $post){
    $output .= getNewsItems($post, $bootwidth);
  }

  $total = $query->max_num_pages;
  $output .= paginate_links(array(
    'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'        => $format,
    'current'       => max( 1, $paged ),
    'total'         => $total,
    'mid_size'      => 3,
    'type'          => 'list',
    'prev_text'     => 'Previous',
    'next_text'     => 'Next',
  ));

  return $output;
}

function getInventory($count){
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $big  = 99999999;
    $args = array(
    'post_type'     => 'inventory',
    'orderby'       => 'date',
    'order'         => 'DESC',
    'posts_per_page'=> $count,
    'offset'        => $offset,
    'paged'         => $paged 
  );

  $query = new WP_Query($args);
  foreach($query->posts as $post){
    $output .= getInventoryItems($post, 12);
  }

  $total = $query->max_num_pages;
  $output .= paginate_links(array(
    'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'        => $format,
    'current'       => max( 1, $paged ),
    'total'         => $total,
    'mid_size'      => 3,
    'type'          => 'list',
    'prev_text'     => 'Previous',
    'next_text'     => 'Next',
  ));

  return $output;
}

function getInventoryItems($post, $width){

  if($width >= 4){
      $output .= "<h2><a href='".get_field('url', $post->ID)."'>" . $post->post_title . "</a></h2>\n";

    // large preview area, show details. Authord Date.
    $output .= "<div class='meta'>\n";
    $output .= "<span>".get_field("location", $post->ID)."</span>\n";
    $output .= "</div>\n";
    $output .= "<div class='excerpt'>".$post->post_content."</div>\n";
  }
  return $output;
}



function getNewsItems($post, $width){

  if($width >= 4){
      $output .= "<h2><a href='".get_permalink($post->ID)."'>" . $post->post_title . "</a></h2>\n";

    // large preview area, show details. Authord Date.
    $output .= "<div class='meta'>\n";
    $output .= "<span class='author'>By <a href='".get_author_posts_url($post->post_author) ."' rel='Author'> " . get_the_author_meta('display_name', $post->post_author) . "</a></span>";
    $output .= "<span class='date'><time datetime='".get_the_date("Y-m-d", $post->ID)."'>".get_the_date("F j, Y", $post->ID)."</time></span>\n";
    $output .= "</div>\n";
    $output .= "<div class='excerpt'><p>".limit_words($post->post_content, 30)."</p><p><a href='".get_permalink($post->ID)."' class='btn'>Read More</a></p></div>\n";
  }
  return $output;
}

function getTutorials($count, $cats, $type, $bootwidth = 4, $offset = null, $pagnate = false){

  $big  = 99999999;

  $args = array(
    'post_type'     => 'tutorial',
    'orderby'       => 'date',
    'order'         => 'DESC',
    'posts_per_page'=> $count,
    'offset'        => $offset
  );


  // if pagnate is checked fire up the pagination.
  if($pagnate === true){
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $args['paged'] = $paged;
  }
  // we are sorting by tags
  //$tag = 'unity';

  $tag = ( get_query_var( 'tagged' ) ) ? get_query_var( 'tagged' ) : null;
  $cat = ( get_query_var( 'cattut' ) ) ? get_query_var( 'cattut' ) : null;

  if( ($tag != null) && ($tag != "All")) {
    $args['tag'] = $tag;
  }

  // sort by category
  if(($cat != null) && ($cat != "All Categories")){
    $args['tax_query'] = array(array(
        'taxonomy'  =>  'tutorial_cats',
        'field'     =>  'slug',
        'terms'     =>  $cat
      ));
  }


  $query = new WP_Query($args);
  $count = 1;
  $output .= "<div class='clear'>\n";
  foreach($query->posts as $post){
    if($type == 'preview'){
      
      $output .= "<div class='col-sm-".$bootwidth." ctastate'>";
      $output .= getPreview($post, $bootwidth);
      $output .= "</div>\n";

      if(  $count%4 == 0 && $count > 1 ) $output .= "</div><div class='clear'>\n";
      $count++;
    }
    if($type == 'title'){
      $output .= getTitles($post);
    }

  }
  $output .= "</div>\n";
  if($type == 'title') $output = "<ul>" . $output . "</ul>\n";

  if($pagnate === true){
    $total = $query->max_num_pages;
    $output .= paginate_links(array(
      'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'        => $format,
      'current'       => max( 1, $paged ),
      'total'         => $total,
      'mid_size'      => 3,
      'type'          => 'list',
      'prev_text'     => 'Previous',
      'next_text'     => 'Next',
    ));
  }

  return $output;
}


function getPosts($count, $cats, $type, $bootwidth = 4, $not = false, $offset = null){
  // $count = amount of items
  // $cats = array of the categories to include or exclude
  // $type = "preview, title, full"
  // $bootwidth = the bootstrap width to apply to a col-sm-# width
  // $not = set to true to make the cats listed to be ignored rather than used.

  $posttype = 'post';
  if($cats == "stories") $posttype = 'stories';
  $args = array(
    'post_type'     => $posttype,
    'orderby'       => 'date',
    'order'         => 'DESC',
    'posts_per_page'=> $count,
    'offset'        => $offset
  );
  
  if($not === true){
    $args['category__not_in'] = $cats;
  }else if($not !== false){
    $args['category__in'] = $cats;
  }

  $query = new WP_Query($args);
  foreach($query->posts as $post){
    if($type == 'preview'){
      $output .= "<div class='col-sm-".$bootwidth."'>";
      $output .= getPreview($post, $bootwidth);
      $output .= "</div>\n";
    }
    if($type == 'title'){
      $output .= getTitles($post);
    }

  }
  if($type == 'title') $output = "<ul>" . $output . "</ul>\n";
  return $output;

}

function getTitles($post){
  $output = "<li><a href='".get_permalink($post->ID)."'>" . $post->post_title . "</a></li>\n";
  return $output;
}

function getPreview($post, $width){

  $thumb = 'articlethumb';
  if($width == 12) $thumb = 'mainthumb';

  $imageID = get_post_thumbnail_id($post->ID);
  $image = wp_get_attachment_image_src($imageID, $thumb);

  if(!$image[0]){
    // there is no image so lets add a placeholder.
    $image[0] = "/images/placeholder-710x380.jpg";
  }


  $output .= "<img class='previewimg' src='".$image[0]."' alt='".$post->post_title."'>\n";
  if($width >= 4){
      $output .= "<h2><a href='".get_permalink($post->ID)."'>" . $post->post_title . "</a></h2>\n";

    // large preview area, show details. Authord Date.
    $output .= "<div class='meta'>\n";
    $output .= "<span class='author'>By <a href='".get_author_posts_url($post->post_author) ."' rel='Author'> " . get_the_author_meta('display_name', $post->post_author) . "</a></span>";
    $output .= "<span class='date'><time datetime='".get_the_date("Y-m-d", $post->ID)."'>".get_the_date("F j, Y", $post->ID)."</time></span>\n";
    $output .= "</div>\n";
    $output .= "<div class='excerpt'><p>".limit_words($post->post_content, 30)."</p><p><a href='".get_permalink($post->ID)."' class='btn'>Read More</a></p></div>\n";
  }else{

    $cats = get_the_tags($post->ID);
    $catstring = "default";
    if($cats){
      foreach($cats as $cat){
         if( stristr($cat->name, 'phone') || stristr($cat->name, 'mobile') ){
            $catstring = 'mobile';
            continue;
         }
         if( stristr($cat->name, 'open') || stristr($cat->name, 'open') ){
            $catstring = 'opendata';
            continue;
         }

      }
    }

    $output .= "<div class='cat ".$catstring."'>\n";
    $output .= "<h4><a href='".get_permalink($post->ID)."'>" . $post->post_title . "</a></h4>\n";
    $output .= "<div class='excerpt'><p>".limit_words($post->post_content, 15)."</p>\n";
    $output .= "</div></div>\n";
  }


 // $output .= "<div class='".$post->author."'>" 
  return $output;
}

function sectionTitle($cat=null){
  // known ids.
  // 1768 is for stories.
  global $post;

  $cats = get_the_category($post->ID);

  $ids = array();
  foreach($cats as $category){
    $ids[] = $category->cat_ID;
  }
  $subnav = "";
  if($post->post_parent != 0){
    $subnav .= getParentElements($post->post_parent);
  }
  $name = "";

  

  // stories!
  if( in_array(1768, $ids) ){
    // it does contain the category so now fetch its title.
    $name = "Stories";
    $output .= "<div class='sectiontitle'>".$subnav."<span class=''>".$name."</span>";
    $output .= "<div class='sectionlinks'>\n";
    $output .= "<a class='back' href='/stories'>Back</a>\n";
    $output .= "<a class='story' href='mailto:mwnwcan@microsoft.com'>Tell Us Your Story</a>\n";
    $output .= "</div></div>\n";
    return $output;
  }
  // news  
  if( !in_array(array(1768, 350, 1739), $ids) && $post->post_type == 'post' ){
    // it does contain the category so now fetch its title.
    $name = "News";
    $output .= "<div class='sectiontitle'>".$subnav."<span class=''>".$name."</span>";
    $output .= "<div class='sectionlinks'>\n";
    $output .= "<a class='back' href='/news'>Back</a>\n";
  //  $output .= "<a class='story' href='mailto:mwnwcan@microsoft.com'>Tell Us Your Story</a>\n";
    $output .= "</div></div>\n";
    return $output;
  }
  if($post->post_type == "stories"){
    $name = "Stories";
    $output .= "<div class='sectiontitle'>".$subnav."<span class=''>".$name."</span>";
    $output .= "<div class='sectionlinks'>\n";
    $output .= "<a class='story' href='mailto:mwnwcan@microsoft.com'>Tell Us Your Story</a>\n";
    $output .= "</div></div>\n";
    return $output;
  }
  if($post->post_name == "news"){
    $name = "From the Community";
    $output .= "<div class='sectiontitle'>".$subnav."<span class=''>".$name."</span>";
    $output .= "<div class='sectionlinks'>\n";
  //  $output .= "<a class='story' href='mailto:mwnwcan@microsoft.com'>Tell Us Your Story</a>\n";
    $output .= "</div></div>\n";
    return $output;
  }
  if($post->post_name == "events"){
    $name = "Calendar of Events";
    $output .= "<div class='sectiontitle'>".$subnav."<span class=''>".$name."</span>";
    $output .= "<div class='sectionlinks'>\n";
  //  $output .= "<a class='story' href='mailto:mwnwcan@microsoft.com'>Tell Us Your Story</a>\n";
    $output .= "</div></div>\n";
    return $output;
  }
  if($post->post_name == "glossary-term"){
    $name = "Glossary";
    $output .= "<div class='sectiontitle'>".$subnav."<span class=''>".$name."</span>";
    $output .= "<div class='sectionlinks'>\n";
    $output .= "<a class='story' href='mailto:mwnwcan@microsoft.com'>Request a Definition</a>\n";
    $output .= "</div>\n";
    $output .= "</div>\n";
    $output .= "<div id='gloslinks'><ul>\n";
    ob_start();
    ?>
      <li><span class='filter' data-filter=".filternum">#</span></li>
      <li><span class='filter' data-filter=".filtera">a</span></li> 
      <li><span class='filter' data-filter=".filterb">b</span></li> 
      <li><span class='filter' data-filter=".filterc">c</span></li> 
      <li><span class='filter' data-filter=".filterd">d</span></li> 
      <li><span class='filter' data-filter=".filtere">e</span></li> 
      <li><span class='filter' data-filter=".filterf">f</span></li> 
      <li><span class='filter' data-filter=".filterg">g</span></li> 
      <li><span class='filter' data-filter=".filterh">h</span></li> 
      <li><span class='filter' data-filter=".filteri">i</span></li> 
      <li><span class='filter' data-filter=".filterj">j</span></li> 
      <li><span class='filter' data-filter=".filterk">k</span></li> 
      <li><span class='filter' data-filter=".filterl">l</span></li> 
      <li><span class='filter' data-filter=".filterm">m</span></li> 
      <li><span class='filter' data-filter=".filtern">n</span></li> 
      <li><span class='filter' data-filter=".filtero">o</span></li> 
      <li><span class='filter' data-filter=".filterp">p</span></li> 
      <li><span class='filter' data-filter=".filterq">q</span></li> 
      <li><span class='filter' data-filter=".filterr">r</span></li> 
      <li><span class='filter' data-filter=".filters">s</span></li> 
      <li><span class='filter' data-filter=".filtert">t</span></li> 
      <li><span class='filter' data-filter=".filteru">u</span></li> 
      <li><span class='filter' data-filter=".filterv">v</span></li> 
      <li><span class='filter' data-filter=".filterw">w</span></li> 
      <li><span class='filter' data-filter=".filterx">x</span></li> 
      <li><span class='filter' data-filter=".filtery">y</span></li> 
      <li><span class='filter' data-filter=".filterz">z</span></li> 

    <?php 
    $output .= ob_get_clean();
    $output .= "</ul></div>\n"; 
    return $output;
  }
  // EVENTS
  if($post->post_type == 'ai1ec_event'){
    $name = "Events";
    $output .= "<div class='sectiontitle'>".$subnav."<span>".$name."</span></div>";
    return $output;
  }

  if($post->post_name == 'about'){
    $name = get_post_meta($post->ID, 'header_replacement');
    $output .= "<div class='sectiontitle'>".$subnav."<div class='container abouttitle'>".$name[0]."</div></div>";
    return $output;  
  }
  if($post->post_name == 'tutorials'){
    $name = "Tutorials";
    $output .= "<div class='sectiontitle'>".$subnav."<span>".$name."</span></div>";
    return $output;  
  }
  if(is_search()){
    $name = "Search Results";
    $output .= "<div class='sectiontitle'>".$subnav."<span>".$name."</span></div>";
    return $output;  
  }
  // default
  if(!is_front_page()){
    $name = $post->post_title;
    $output .= "<div class='sectiontitle'>".$subnav."<span class='container'>".$name."</span>";
  //  $output .= "<div class='sectionlinks'>\n";
  //  $output .= "<a class='story' href='mailto:mwnwcan@microsoft.com'>Tell Us Your Story</a>\n";
    $output .= "</div>\n";
  }

  return $output;
}

function getParentElements($id){

  if($id == 12950){
    $args = array(
      'child_of'  => 10080,
      'depth'     => 1,
      'echo'      => 0,
      'title_li'  => __('')
    );
      $output .= "<div class='subcontainer'><div class='container'><ul>\n";
      $output .= wp_list_pages($args);
      $output .= "</ul></div></div>\n";
      return $output;
  }

  $args = array(
    'child_of'  => $id,
    'depth'     => 1,
    'echo'      => 0,
    'title_li'  => __('')

  );
  $output .= "<div class='subcontainer'><div class='container'><ul>\n";
  $output .= wp_list_pages($args);
  $output .= "</ul></div></div>\n";
 return $output;
}

function getGlossary(){
  $args = array(
      'post_type'       =>  'glossary',
      'posts_per_page'  =>  -1,
      'order'           => 'ASC',
      'orderby'         => 'title'
  );
  $query = new WP_Query($args);
  $output = "<dl><div>\n";

  foreach($query->posts as $post){
    if(strcasecmp($post->post_title[0],$currentAlpha) != 0 ){
      $output .= "</div>\n";
      $currentAlpha = $post->post_title[0];
      $currentAlpha = strtolower(preg_replace("/[\d]/","#",$currentAlpha));
      $current = $currentAlpha;
      if($currentAlpha == "#"){$current = "num";}
      $output .= "<div class='mix filter".$current."'>\n";
      $output .= "<h3 id='".$currentAlpha."'>". $currentAlpha . "</h3>\n";
    }
    $output .= "<dt>" . $post->post_title . "</dt>\n";
    $output .= "<dd>" .strip_tags($post->post_content) . "</dd>\n";


  }
  $output .= "</div></dl>\n";
  return $output;
}
function showCats($type){
  $args = array(
    'taxonomy' => $type
  );

  $cats = get_categories($args);
  $output .= "<select name='cattut' id='cattut'>\n";
  $output .= "<option>All Categories</option>\n";

  foreach($cats as $cat){
    $output .= "<option value='". $cat->slug ."' data-value=". $cat->slug .">" . $cat->name . "</option>\n";
  }
  $output .= "</select>\n";
  return $output;
  //print_r($cats);
}




function limit_words($string, $word_limit){
  $newstring = strip_tags($string);
    $words = explode(" ",$newstring);

    foreach($words as $i => $word){
      if(stristr($word, 'http')){
        unset($words[$i]);
      }
    }

  
    return implode(" ",array_splice($words,0,$word_limit));
}
  
function add_query_vars_filter( $qvars ){
  $qvars[] = "cattut";
  $qvars[] = "tagged";
  return $qvars;
}
add_filter( 'query_vars', 'add_query_vars_filter',10,1 );

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="page-numbers"';
}

/* WALKER CLASS */


class Imp_Title_Walker extends Walker_Page {

  function start_el(&$output, $page, $depth, $args, $current_page){

 extract($args, EXTR_SKIP);
$css_class = array('page_item', 'page-item-'.$page->ID);
if ( !empty($current_page) ) {
$_current_page = get_post( $current_page );
if ( in_array( $page->ID, $_current_page->ancestors ) )
$css_class[] = 'current_page_ancestor';
if ( $page->ID == $current_page )
$css_class[] = 'current_page_item';
elseif ( $_current_page && $page->ID == $_current_page->post_parent )
$css_class[] = 'current_page_parent';
}
elseif ( $page->ID == get_option('page_for_posts') ) {
$css_class[] = 'current_page_parent';
}
 $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );


    $output .= "<li class='".$css_class."'><a class='tooltip' href='".get_page_link($page->ID)."' title='".esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title, $page->ID ) ) )."'>".esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title, $page->ID ) ) )."</a>";

  }




}

