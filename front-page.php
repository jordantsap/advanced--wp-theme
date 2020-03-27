<?php
get_header();
?>

<?php
if (have_posts()) :
  while (have_posts()) : the_post();
    the_content( );
  endwhile;

  else :
  // echo "<p>No content</p>";
endif;
  ?>
  <!-- wp-query section-->
  <ul class="list-group">
  <?php
  $postcat = new WP_Query('cat=1&posts_per_page=3');
  if ($postcat->have_posts()) :
    while ($postcat->have_posts()) : $postcat->the_post(); ?>
      <a href="<?php the_permalink(); ?>">
        <h1 class="list-group-item"><?php the_title(); ?></h1>
      </a>
      <div class="list-group-item list-group-item-info mb-3">
        <?php the_excerpt(); ?>
      </div>
    <?php endwhile;

    else :
    // echo "<p>No content</p>";
  endif;
  // KIND OF ALWAYS NEEDED AFTYER wpquery
  wp_reset_postdata();
    ?>
  </ul>

<?php
get_footer();
?>
