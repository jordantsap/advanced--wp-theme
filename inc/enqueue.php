<?php

/*====================
ADMIN ENQUEUE FUNCTIONS
=====================
*/

function jt_load_admin_scripts($hook) {
  // echo $hook;
  if ('toplevel_page_jordan_theme_config' != $hook) {
    return;
  }
  //register style file
  wp_register_style( 'jt_admin', get_template_directory_uri() . '/css/jt-admin.css', array(), '1.0', 'all' );
  //trigger above style
  wp_enqueue_style( 'jt_admin' );
}

// assign trigger only in admin area with -> add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 )
add_action( 'admin_enqueue_scripts', 'jt_load_admin_scripts');
