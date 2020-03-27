<!-- All pages wp file -->

<?php
get_header();
/*
This block registers a new template
Template Name: Archive
*/
?>
<h1>archive.php</h1>

<?php
if (has_children() OR $post->post_parent > 0) {?>

  <nav class="site-nav children-links clearfix">

      <!-- display the top ancestor link -->
      <span class="parent-link">
        <a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>">
          <?php echo get_the_title(get_top_ancestor_id()); ?>
        </a>
      </span>
    <ul>
        <?php
        // child pages variable
        $args = array(
          // get child elements
          'child_of' => get_top_ancestor_id(), //main id only=$post->ID,
          // remove pagenav title
          'title_li' => ''
        );
        // list child page links
        wp_list_pages($args);
        ?>
    </ul>
  </nav>

<?php } ?>

  <div class="row">

    <div class="col-9">

      <?php
      if (have_posts()) :
        while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'article' ); ?>

        <?php endwhile;
        else :
        echo "<p>No content</p>";
      endif;
        ?>
    </div>

    <?php get_sidebar( ); ?>

<?php
get_footer();
?>
