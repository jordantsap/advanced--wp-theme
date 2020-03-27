</div> <!-- main container end here--->

<?php if (dynamic_sidebar( 'bottom1' )) :?>
<section id="bottom">
  <div class="container">
    <div class="row">
      <div class="col">
        <?php dynamic_sidebar( 'bottom1' ) ?>
      </div>
      <div class="col">
        <?php dynamic_sidebar( 'bottom2' ) ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if( get_theme_mod( 'jordantheme-footer-top-section-publish' ) == 'Yes') { ?>
<section id="footer-top">
  <div class="container">
    <div class="row mt-5 mb-5">
      <div class="col-3 text-center">
        <img src="<?php echo wp_get_attachment_url( get_theme_mod( 'jordantheme-footer-top-section-image' )) ?>" alt="<?php echo get_theme_mod( 'jordantheme-footer-top-section-title' ) ?>">
      </div>
      <div class="col-9 text-center">
        <a href="<?php echo get_permalink( get_theme_mod('jordantheme-footer-top-section-link')) ?>">
          <?php echo get_theme_mod( 'jordantheme-footer-top-section-title' ) ?>
        </a>
        <?php echo wpautop( get_theme_mod( 'jordantheme-footer-top-section-textarea' ) ) ?>
      </div>
    </div>
  </div>
</section>
<?php } ?>

<footer class="site-footer">

<div class="container-fluid">

  <div class="row">

    <div class="col">
          <p><?php bloginfo( 'name' ) ?> - &copy; <?php echo date('Y'); ?></p>
    </div>

    <div class="col">

        <nav class="footer-nav">
          <?php $args = array('theme_location' => 'footermenu') ?>
          <?php wp_nav_menu( $args ); ?>
        </nav>

    </div>

  </div>

</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
