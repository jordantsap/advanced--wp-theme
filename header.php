<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title><?php bloginfo('name') ?></title>
    <?php wp_head(); ?>
  </head>

<body <?php body_class(); ?>>

<div class="container">

<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

  <header class="site-header">
    <div class="header-search">
      <?php get_search_form( ); ?>
    </div>
    <h1> <a href="<?php echo home_url(); ?>">
      <?php bloginfo( 'name' ) ?>
    </h1>
    </a>
    <h2><?php bloginfo( 'description' ) ?></h2>

    <nav class="site-nav">
      <?php $args = array('theme_location' => 'mainmenu') ?>
      <?php wp_nav_menu( $args ); ?>
    </nav>

  </header>

</div>

<div class="container"> <!--Start header bottom container-->
