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
    <!--Importar estilo del sitio-->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url')?>" />
    <!--Importar materialize.css-->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri();?>/css/materialize.min.css"  media="screen,projection"/> -->
    <!--Importar estilo personalizados-->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="<?php get_stylesheet_directory_uri();?>/css/custom-style.css" /> -->
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
          <?php
          if ( is_front_page() && is_home() ) :
          ?>
          <!-- <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> -->
          <?php
          else :
          ?>
          <!-- <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p> -->
          <?php
          endif;
          ?>
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

        <ul id="slide-out" class="sidenav">
    <div class="card">
      <div class="card-image">
        <!-- <img src="<?php echo get_stylesheet_directory_uri()?>/img/sidebar_bk.jpeg)"> -->
        <?php 
          if (the_custom_logo()):
            echo the_custom_logo(); 
          else:
          ?>
          <!--a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a-->
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php echo get_stylesheet_directory_uri()?>/img/logo.png" class="logo">
          </a>
          <!-- <?php bloginfo( 'name' ); ?></a> -->
          <?php
          endif;
          ?>
          
        <span class="card-title">
        <?php 
          $recipes_description = get_bloginfo( 'description', 'display' );
          if ( $recipes_description || is_customize_preview() ) :
            echo $recipes_description;
          ?>
          <?php endif;?>
        </span>
      </div>
      <div class="card-content">
        <?php get_search_form(); ?>
      </div>
	  
	 
      <ul class="collection with-header">
        <li class="collection-header"><h4>First Names</h4></li>
        <li class="collection-item">Alvin</li>
        <li class="collection-item">Alvin</li>
        <li class="collection-item">Alvin</li>
        <li class="collection-item">Alvin</li>
      </ul>
</ul>

</header><!-- #masthead -->

<div id="content" class="site-content">
