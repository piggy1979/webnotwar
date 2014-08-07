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
      wp_deregister_script('jquery');
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
