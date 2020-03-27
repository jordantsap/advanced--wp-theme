<!-- All pages wp file -->

<?php
/*INCLUDE HEADER.PHP FILE*/
get_header();
?>

<h1>page.php</h1>
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

        <article class="post">
          page.php
          <h2>
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
            </a>
          </h2>
          <p class="post-info">
            <?php the_time( 'F jS, Y g:i a' ) ?> | <a href="<?php echo get_author_posts_url( get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
            <?php
            // required variables
              $categories = get_the_category(  );
              $separator = ", ";
              $output = "";

              if ($categories) {
                echo "| Category: ";
                foreach ($categories as $category) {
                  $output .= '<a href="' . get_category_link($category->term_id).'">' . $category->cat_name . '</a>' . $separator;
                }
                echo trim($output, $separator);
              }
            ?>
          </p>
          <?php the_post_thumbnail('banner') ?>
          <!-- alternative the_content function is for all content -->
          <p>
            <?php the_content(); ?>
          </p>

        </article>

        <?php endwhile;
        else :
        echo "<p>No content</p>";
      endif;
        ?>
    </div>

    <?php get_sidebar( ); ?>

  </div>

<?php
get_footer();
?>
