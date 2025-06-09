<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header id="site-header">
    <div class="container">
      <?php get_template_part('template-parts/header-megamenu'); ?>
    </div>
  </header>
</body>
</html>