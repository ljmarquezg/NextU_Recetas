<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ShUrRe
 */
?>
<aside id="secondary" class="widget-area cyan darken-3">
<ul id="slide-out" class="sidenav">
<div class="card" style="margin:0;">
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
	<?php 
			get_search_form();
			agregar_receta();
	?>
	
	<?php 
// Get menu object
	$menu_name = 'sidebar';
	$locations = get_nav_menu_locations();
	$menu_id = $locations[ $menu_name ] ;
	$items_menu = wp_get_nav_menu_object($menu_id);
	// Echo count of items in menu
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	}else{
		if ($items_menu > 0){
		?>
		<div class="menu-category">
		<ul class="collection with-header">
        <li class="collection-header"><h6><b>Categorías</b></h6></li>
				<?php
							wp_nav_menu( array(
							'theme_location' => 'sidebar',
							'menu_id' => 'sidebar-menu',
							'menu' => 'sidebar',
						) );
					}
				?>
			<p>Puede agergar mas información agregando widgets en el panel de Apariencias > Widgets > Sidebar</p>
			</ul>
	<?php		
	}		
	?>
	
  </div>
	

	
</ul>
</aside><!-- #secondary -->