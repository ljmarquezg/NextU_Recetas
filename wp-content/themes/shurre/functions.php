<?php
/**
 * ShUrRe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ShUrRe
 */

if ( ! function_exists( 'shurre_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shurre_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ShUrRe, use a find and replace
		 * to change 'shurre' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shurre', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'shurre' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shurre_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'shurre_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shurre_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'shurre_content_width', 640 );
}
add_action( 'after_setup_theme', 'shurre_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shurre_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'shurre' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shurre' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shurre_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shurre_scripts() {

	wp_enqueue_style( 'materializestyle', get_stylesheet_directory_uri().'/css/materialize.min.css' );

	wp_enqueue_style( 'shurre-style', get_stylesheet_uri() );

	wp_enqueue_script( 'shurre-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'shurre-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'javascript', get_stylesheet_directory_uri() . '/js/jquery-2.1.1.min.js', array( 'jquery' ), '1.0', true );
	
	wp_enqueue_script( 'materializejs', get_stylesheet_directory_uri() . '/js/materialize.min.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'init', get_stylesheet_directory_uri() . '/js/init.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shurre_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function shurre_post_thumbnail(){
	$thumbnail = get_stylesheet_directory_uri().'/img/food.jpeg';
	if (has_post_thumbnail()){
		return the_post_thumbnail();
	}
	return '<img class="responsive shurre" src="'.$thumbnail.'" alt="">';
	
}

	/*=================================================================================
			Incrementar el limite de memoria de Wordpress
	==================================================================================*/
	define( 'WP_MEMORY_LIMIT', '256M' );
	/*=======================================================================================
			Limitar el numero de caracteres a mostrar en el index
	=========================================================================================*/
  
	function get_excerpt($limit, $source = null){

		if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
		$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $limit);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		$excerpt = $excerpt;
		// .'... <a href="'.get_permalink($post->ID).'">more</a>';
		return $excerpt;
	}

	/*=======================================================================================
			Mostrar la información del post como tarjetas Materialize
	=========================================================================================*/
	function show_category($cat_name){
		if ($cat_name === 'Platos'){
			$background_color = 'blue lighten-2';
		}elseif ($cat_name === 'Ocasiones') {
			$background_color = 'yellow darken-2';
		}elseif ($cat_name === 'Paises') {
			$background_color = 'teal darken-2';
		}

		echo '<div class="row">';
				echo '<h5 class="card-panel '. $background_color .' white-text text-darken-0"> <i class="material-icons">local_dining</i> Nuevo Post de '. $cat_name. ' </h5>';
				/* Start the Loop */
				echo '<div class="col m12">';
				query_posts('category_name='.$cat_name);			
				$i = 0; while (have_posts() && $i < 3) :
						the_post();
						get_template_part( 'template-parts/content-index', get_post_type() );
						$i++;
					endwhile;
				echo '</div>';
			echo '</div>';
	}


	add_filter( 'wp_nav_menu_items', 'items_menu', 10, 2);

	function items_menu( $items, $args ) {
	
		if ($args->theme_location == 'primary') {
			if (is_user_logged_in())
			{


                  } else {
                   
                    echo '<a href="'.wp_login_url().'" rel="home"><i class="material-icons">assignment_turned_in</i>Iniciar Sesión</a>'; 
				  }

				$items .= '<li">
							<a href="'. wp_logout_url(get_permalink()) .'"> <i class="material-icons">arrow_back</i>Cerrar Sesión. </a>
							</li>';
			}
			else
			{
				$items .= '<li>
							<a href="'. wp_login_url(get_permalink()) .'"> <i class="material-icons">description</i>Registrarse</a> 
							</li>';
				$items .= '<li>
							<a href="'. wp_login_url(get_permalink()) .'"><i class="material-icons">contacts</i>'. __("Log In") .'</a>
							</li>';

			}
	
		return $items;
	}