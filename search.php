<?php
get_header();
?>

<?php
if (have_posts()) : ?>

	<h2>Search results for: <?php the_search_query(); ?></h2>
  <?php while (have_posts()) : the_post(); ?>

	<?php get_template_part( 'article' ); ?>

  <?php endwhile;
  else :
  echo "<p>No content</p>";
endif;
  ?>


<?php
get_footer();
?>
