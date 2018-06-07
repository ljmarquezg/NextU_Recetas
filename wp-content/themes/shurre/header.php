<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
  *
  * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
  *
  * @package recipes
  */

  ?>
  <!doctype html>
  <html <?php language_attributes(); ?>>
  <head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://behance.net/ljmarquezg">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> <!--Define los caracteres del documento -->
    <meta charset="<?php bloginfo('charset')?>" />
    <title><?php wp_title()?> </title>
    <!--Optimizar el sitio para dispositivos móviles-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--Importar Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Definir el favicon del sitio-->
    <link rel="shorcut icon" href="<?php echo  get_stylesheet_directory_uri()?>/favicon.ico">
    <!--<script src="main.js"></script> -->
    <link rel="pingback" href="<?php bloginfo('pingback_url');?>">            

	<?php wp_head(); ?>
	
  </head>

  <body <?php body_class(); ?>>
    <div id="page" class="site">
      <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'recipes' ); ?></a>
      <header id="masthead" class="site-header">
        <div class="site-branding">
        </div><!-- .site-branding -->
        <div class="navbar-fixed">
          <nav class="main-menu">
            <div class="nav-wrapper">
              <ul id="nav-mobile" class="hide-on-med-and-down">
                <?php
                wp_nav_menu( array(
                'theme_location'  => 'menu-1',
                'menu_id'         => 'primary-menu',
                ) );
                ?>
                </ul>
            </div>

          </nav><!-- #site-navigation -->
        </div>
</header><!-- #masthead -->

<div id="content" class="site-content">
