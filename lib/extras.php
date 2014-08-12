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


    $background = " style='background-image: url(".$image[0].")' ";
    $output .= "<div class='slide' ".$background.">\n";
    $output .= "<div class='slidecontent'><div class='addpadding'>\n";
    $output .= "<h2>".$post->post_title."</h2>\n";
    if(get_post_meta($post->ID, 'url')[0] && get_post_meta($post->ID, 'link_title')[0] ){
    $output .= "<a href='". get_post_meta($post->ID, 'url')[0] ."' class='btn bko'>". get_post_meta($post->ID, 'link_title')[0] ."</a>\n";
    }
    $output .= "</div></div>\n";
    $output .= "</div>\n";
  }

  return $output;
}


function getPosts($count, $cats, $type, $bootwidth = 4, $not = false){
  // $count = amount of items
  // $cats = array of the categories to include or exclude
  // $type = "preview, title, full"
  // $bootwidth = the bootstrap width to apply to a col-sm-# width
  // $not = set to true to make the cats listed to be ignored rather than used.

  $args = array(
    'post_type'     => 'post',
    'orderby'       => 'date',
    'order'         => 'DESC',
    'posts_per_page'=> $count,
  );
  
  if($not){
    $args['category__not_in'] = $cats;
  }else{
    $args['category__in'] = $cats;
  }

  $query = new WP_Query($args);

  foreach($query->posts as $post){
    if($type == 'preview'){
      $output .= "<div class='col-sm-".$bootwidth."'>";
      $output .= getPreview($post);
      $output .= "</div>\n";
    }
    if($type == 'title'){
      $output .= "<ul>\n";
      $output .= getTitles($post);
      $output .= "</ul>\n";
    }

  }
  return $output;

}

function getTitles($post){
  $output = "<li><a href='".get_permalink($post->ID)."'>" . $post->post_title . "</a></li>\n";
  return $output;
}

function getPreview($post){

  $imageID = get_post_thumbnail_id($post->ID);
  $image = wp_get_attachment_image_src($imageID, 'articlethumb');

  print_r($post);

  $output .= "<img class='previewimg' src='".$image[0]."' alt='".$post->post_title."'>\n";
  $output .= "<h2><a href='".get_permalink($post->ID)."'>" . $post->post_title . "</a></h2>\n";
 // $output .= "<div class='".$post->author."'>" 
  return $output;
}



