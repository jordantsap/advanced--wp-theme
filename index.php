<?php
get_header();
?>

<h1>index.php</h1>
<?php
if (have_posts()) :
  while (have_posts()) : the_post(); ?>

  <?php get_template_part( 'article' ); ?>

  <?php endwhile;
  else :
  echo "<p>No content</p>";
endif;
  ?>

<?php
get_footer();
?>
