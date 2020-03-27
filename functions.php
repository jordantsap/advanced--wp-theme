<?php

require get_template_directory() . '/inc/function-admin.php';
require get_template_directory() . '/inc/enqueue.php';

function myStyles() {

  wp_enqueue_style( 'style', get_stylesheet_uri() );

  wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css');
}
add_action( 'wp_enqueue_scripts', 'myStyles');

//register style file
wp_register_style( 'jt_admin', get_template_directory_uri() . '/css/jt-admin.css', array(), '1.0', 'all' );
//trigger above style
wp_enqueue_style( 'jt_admin' );

// get top parent id with custom function
function get_top_ancestor_id() {
  global $post;
  // return parent id
  if($post->post_parent) {
    $ancestors = array_reverse(get_post_ancestors( $post->ID ));//get_post_ancestors is wp function returns array
    return $ancestors[0];
  }
  return $post->ID;
}

// if page has children??
function has_children(){

  global $post;

  $pages = get_pages( 'child_of=' . $post->ID ); //get_pages=wp function returns array
  return count($pages);
}

// customize excerpt
function custom_excerpt_length( $length ){
  return 10;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// theme setup
function jordantheme_setup(){
  // navigation menus

  //nav menu locations
  register_nav_menus( $locations = array(
    'mainmenu' => __('Primary Menu'),
    'footermenu' => __('Footer Menu')
  ));

//background image support
add_theme_support( 'custom-background' );
// custom header support
add_theme_support( 'custom-header' );

// // post-formats support px create content, content-image, content-audio post formats to match .php files like joomla positions
// tutorial https://www.youtube.com/watch?v=ut5b0gSpV1w&list=PLriKzYyLb28nUFbe0Y9d-19uVkOnhYxFE&index=7
add_theme_support( 'post-formats', array('aside','image','video','gallery','link','quote','status','audio','chat') );

  // featured image support
  add_theme_support( 'post-thumbnails');
  add_image_size( 'small-thumbnail', 180, 120, false );//name-width-height-crop
  add_image_size( 'banner', 920, 210, array('left', 'top') );//name-width-height-crop
}
add_action( 'after_setup_theme', 'jordantheme_setup');

/*=============================
add widget support to theme
==============================
*/
function wpThemeWidgetsInit() {

  register_sidebar( array(
    'name' => 'Sidebar', //displayed
    'id' => 'sidebar',
    'before_widget' => '<div class="widget-item">',
    'after_widget' => '</div>'
  ));
  register_sidebar( array(
    'name' => 'Bottom 1', //displayed
    'id' => 'bottom1',
    'before_widget' => '<div class="bottom-1-widget-item">',
    'after_widget' => '</div>'
  ));
  register_sidebar( array(
    'name' => 'Bottom 2', //displayed
    'id' => 'bottom2',
    'before_widget' => '<div class="bottom-2-widget-item">',
    'after_widget' => '</div>'
  ));

}
add_action( 'widgets_init', 'wpThemeWidgetsInit' );

//add footer top section to admin customize screen
function jordantheme_footer_top($wp_customize) {
  //add section to admin customize theme
  //wp object->wp method('my var name', additional options)
  $wp_customize->add_section('jordantheme-footer-top-section', array(
    'title' => 'Footer top section'
  ));
  //foreach field need a setting(db) and a control(user display)
  //wp object->wp method('my var name', additional options)

  $wp_customize->add_setting('jordantheme-footer-top-section-publish', array(
    'default' => 'No'
  ));
  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'jordan-theme-publish-var', array(
    'label' => 'Publish section?',
    'section' => 'jordantheme-footer-top-section',
    'settings' => 'jordantheme-footer-top-section-publish',
    'type' => 'select',
    'choices' => array('No' => 'No', 'Yes'=> 'Yes')
  )));

  $wp_customize->add_setting('jordantheme-footer-top-section-title', array(
    'default' => 'Title setting'
  ));
  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'jordan-theme-title-var', array(
    'label' => 'Title Label',
    'section' => 'jordantheme-footer-top-section',
    'settings' => 'jordantheme-footer-top-section-title',
    'type' => 'text'
  )));

  $wp_customize->add_setting('jordantheme-footer-top-section-link');
  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'jordan-theme-link-var', array(
    'label' => 'Title Link',
    'section' => 'jordantheme-footer-top-section',
    'settings' => 'jordantheme-footer-top-section-link',
    'type' => 'dropdown-pages'
  )));

  $wp_customize->add_setting('jordantheme-footer-top-section-textarea', array(
    'default' => 'TextArea setting'
  ));
  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'jordan-theme-textarea-var', array(
    'label' => 'Text Area Label',
    'section' => 'jordantheme-footer-top-section',
    'settings' => 'jordantheme-footer-top-section-textarea',
    'type' => 'textarea'
  )));

    $wp_customize->add_setting('jordantheme-footer-top-section-image');
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'jordan-theme-image-var', array(
      'label' => 'Image',
      'section' => 'jordantheme-footer-top-section',
      'settings' => 'jordantheme-footer-top-section-image',
      'width'=> 750,
      'height' => 400
    )));
}
//add_action( hook, 'function name' )
add_action( 'customize_register', 'jordantheme_footer_top' );

/*============================
 custom post types
 ==========================
*/
function jordan_custom_post_type(){
  //admin area
  $labels = array(
    // altering default wp labels
    'name'=> 'Jordan Post Type',
    'singular_name' => 'Jordan Post Type',
    'add_new'=> 'Add New',
    'all_items' => 'All Items',
    'edit_item' => 'Edit Item',
    'new_item'=> 'New Item',
    'search_item' => 'Search Item',
    'not_found'=> 'Not Found',
    'not_found_in_trash'=> 'Not Found in Trush',
    'parent_item_colon' => 'Parent Item'
  );
  $args = array(
    'labels'=> $labels,
    'public' => true,
    'has_archive'=> true,
    'publicly_queryable' => true,
    'query_var'=> true,
    'rewrite'=> true,
    'capability_type' => 'post',//grabs default settings
    'hierarchical' => false,
    'supports'=> array(
      'title',
      'editor',
      'excerpt',
      'thumbnail',
      'revisions'
    ),
     'taxonomies' => array('category', 'post_tag'),
     'menu_position'=> '',
     'exclude_from_search'=> false
  );
  //register post type with slug , arguments
  register_post_type('myposttype', $args);

}
add_action( 'init', 'jordan_custom_post_type');
//update permalinks after new post type

/*
=================================
custom taxonomies
======================
*/
function jordan_taxonomies() { //categories for custom postr type
  //add new taxonomy hierarchical
  // altering default wp labels inm admin
  $labels = array(
    'name' => 'Portfolio Types',
    'singular_name' => 'Portfolio Type',
    'search_items' => 'Search Portfolio Types',
    'all_items'=> 'All Portfolio Types',
    'parent_item'=> __('Parent Portfolio Type'),
    'parent_item_colon' => __('Parent Portfolio Type'),
    'add_new_item'=> 'Add new Portfolio Type',
    'edit_item' => 'Edit Portfolio Type',
    'new_item_name'=> 'New Portfolio Type Name',
    'menu_name' => 'Portfolio Type'
  );
  $args = array(
    'hierarchical' => true, //category based tag=not hierarchical=false
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'portfoliotype')
  );

  //register and add action for new taxonomy hierarchical
  register_taxonomy( 'portfoliotype', 'myposttype', $args );
}
add_action( 'init', 'jordan_taxonomies');
?>
