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

  // wp uploader function
  wp_enqueue_media();
  //admin js file
  wp_register_script( 'jt-admin-script', get_template_directory_uri() . '/js/jt-admin.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script('jt-admin-script');
}

// assign trigger only in admin area with -> add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 )
add_action( 'admin_enqueue_scripts', 'jt_load_admin_scripts');
