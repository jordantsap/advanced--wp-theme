<?php

/*====================
ADMIN PAGE FUNCTIONS
=====================
*/

function jordantheme_add_admin_page(){
  //gernerate admin page
  add_menu_page( 'JTheme Options', 'JTheme Options', 'manage_options', 'jordan_theme_config', 'jordantheme_admin_config', /*'icon-url',*/ $position = null );
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )

  //generate admin subpages// first subpage needs to be exact name slug function as the parent page

  // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )
  add_submenu_page( 'jordan_theme_config', 'General Settings', 'General Settings', 'manage_options', 'jordan_theme_config', 'jordantheme_admin_config' );

  add_submenu_page( 'jordan_theme_config', 'Theme Css', 'Theme Css', 'manage_options', 'jordan_theme_css', 'jordantheme_css' );

  //Activate custom settings
  add_action( 'admin_init', 'jordantheme_admintheme_settings');
}
add_action( 'admin_menu', 'jordantheme_add_admin_page');


function jordantheme_admintheme_settings() {
  // register_setting( $option_group, $option_name, $args = array() )
  register_setting( 'jt-settings-group', 'profile_picture');
  register_setting( 'jt-settings-group', 'first_name' );
  register_setting( 'jt-settings-group', 'last_name' );
  register_setting( 'jt-settings-group', 'twitter_link', 'jt_sanitize_twitter_link' );
  register_setting( 'jt-settings-group', 'facebook_link' );
  register_setting( 'jt-settings-group', 'linkedin_link' );
  register_setting( 'jt-settings-group', 'user_description' );

  add_settings_section( 'jt-general-options', 'JT Options', 'jt_general_options', 'jordan_theme_config' );

  // add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() );
add_settings_field( 'setting-profile-picture', 'Profile Picture', 'jt_generalsetting_profile_picture', 'jordan_theme_config', 'jt-general-options' /*$args = array()*/ );
  add_settings_field( 'setting-name', 'Full Name', 'jt_generalsetting_fullname', 'jordan_theme_config', 'jt-general-options' /*$args = array()*/ );

  add_settings_field( 'setting-description', 'User Description', 'jt_generalsetting_userdescription', 'jordan_theme_config', 'jt-general-options' /*$args = array()*/ );

  add_settings_field( 'setting-twitter', 'Twitter Profile', 'jt_generalsetting_twitter', 'jordan_theme_config', 'jt-general-options' /*$args = array()*/ );

  add_settings_field( 'setting-facebook', 'Facebook Profile', 'jt_generalsetting_facebook', 'jordan_theme_config', 'jt-general-options' /*$args = array()*/ );

  add_settings_field( 'setting-linkedin', 'Linkedin Profile', 'jt_generalsetting_linkedin', 'jordan_theme_config', 'jt-general-options' /*$args = array()*/ );

}

/*===================
 settings page fields functions
 ====================
*/

function jt_generalsetting_profile_picture() {
  $picture = esc_attr( get_option('profile_picture'));
  echo '<input type="hidden" name="profile_picture" value="'.$picture.'" id="profile-picture"/>';
  echo '<input type="button" class="button button-secondary" id="upload_profile_picture" value="Upload Profile Picture"/>';
}
function jt_generalsetting_fullname() {
  $firstname = esc_attr( get_option('first_name'));
  $lastname = esc_attr( get_option('last_name'));
  echo '<input type="text" name="first_name" value="'.$firstname.'" placeholder="First Name"/>';
  echo '<input type="text" name="last_name" value="'.$lastname.'" placeholder="Last Name"/>';
}
function jt_generalsetting_userdescription() {
  $user_description = esc_attr( get_option('user_description'));
  echo '<input type="text" name="user_description" value="'.$user_description.'" placeholder="User Description"/>';
  echo '<p class="description">User Description</p>';
}
function jt_generalsetting_twitter() {
  $twitter = esc_attr( get_option('twitter_link'));
  echo '<input type="text" name="twitter_link" value="'.$twitter.'" placeholder="Twitter Link"/>';
  echo '<p class="description">Input only Twitter username without @</p>';
}
function jt_generalsetting_facebook() {
  $facebook = esc_attr( get_option('facebook_link'));
  echo '<input type="text" name="facebook_link" value="'.$facebook.'" placeholder="Facebook Link"/>';
  echo '<p class="description">Input Facebook username</p>';
}
function jt_generalsetting_linkedin() {
  $linkedin = esc_attr( get_option('linkedin_link'));
  echo '<input type="text" name="linkedin_link" value="'.$linkedin.'" placeholder="Linkedin Link"/>';
  echo '<p class="description">Input Linkedin username</p>';
}

/*========================
Sanitization functions for fields
========================
*/
function jt_sanitize_twitter_link($input) {
  $output = sanitize_text_field( $input );
  $output = str_replace('@', '', $output);
  return $output;
}

function jt_general_options() {
  echo "Customize info";
}

function jordantheme_admin_config() {
  //generate all admin pages
  require_once( get_template_directory() . "/inc/templates/jt-admin-general-settings.php");

}
function jordantheme_css(){
  echo "<h1>Css settings page</h1>";
}
