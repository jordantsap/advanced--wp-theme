<h1>jordan theme general settings</h1>
<h1>Preview</h1>
<?php
$firstname = esc_attr( get_option('first_name'));
$lastname = esc_attr( get_option('last_name'));
$fullname = $firstname . ' ' . $lastname;
$user_description = esc_attr( get_option('user_description'));
$twitter = esc_attr( get_option('twitter_link'));
$facebook = esc_attr( get_option('facebook_link'));
$linkedin = esc_attr( get_option('linkedin_link'));
 ?>
<div class="jt_admin_preview">
  <div class="preview-inner">
    <h1 class="jt-fullname">
      <?php print ($fullname); ?>
    </h1>
    <h2 class="jt-description">
      <?php
      if($user_description) :
        echo "$user_description";
      else :
        echo "No description";
      endif;
       ?>
    </h2>
    <div class="icons-wrapper">
      <?php echo $twitter . $facebook . $linkedin; ?>
    </div>
  </div>
</div>


<?php settings_errors( ); ?>
<form class="jt-admin-form" action="options.php" method="post">

  <?php settings_fields('jt-settings-group') ?>

  <?php do_settings_sections( 'jordan_theme_config' ); ?>

  <?php submit_button( ); ?>

</form>
