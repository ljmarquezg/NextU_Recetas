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
			/*=======================================================================================
				Registrar el menú lateral en el panel de menús de wordpress
			=========================================================================================*/
			'sidebar' => __( 'Menu Lateral', 'shurre' )
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

		function get_my_search_form( $echo = true ) {
			/**
			 * Fires before the search form is retrieved, at the start of get_search_form().
			 *
			 * @since 2.7.0 as 'get_search_form' action.
			 * @since 3.6.0
			 *
			 * @link https://core.trac.wordpress.org/ticket/19321
			 */
			do_action( 'pre_get_search_form' );
		 
			$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';
		 
			/**
			 * Filters the HTML format of the search form.
			 *
			 * @since 3.6.0
			 *
			 * @param string $format The type of markup to use in the search form.
			 *                       Accepts 'html5', 'xhtml'.
			 */
			$format = apply_filters( 'search_form_format', $format );
		 
			$search_form_template = locate_template( 'searchform.php' );
			if ( '' != $search_form_template ) {
				ob_start();
				require( $search_form_template );
				$form = ob_get_clean();
			} else {
				if ( 'html5' == $format ) {
					$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
						<label>
							<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
							<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" />
						</label>
						<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
					</form>';
				} else {
					$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
						<div>
							<label class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</label>
							<input type="text" value="' . get_search_query() . '" name="s" id="s" />
							<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
						</div>
					</form>';
				}
			}
		 
			/**
			 * Filters the HTML output of the search form.
			 *
			 * @since 2.7.0
			 *
			 * @param string $form The search form HTML output.
			 */
			$result = apply_filters( 'get_search_form', $form );
		 
			if ( null === $result )
				$result = $form;
		 
			if ( $echo )
				echo $result;
			else
				return $result;
		}

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
	}else{
		echo '<img class="responsive shurre" src="'.$thumbnail.'" alt="">';
	}	
	
}

	/*=================================================================================
			Incrementar el limite de memoria de Wordpress
	==================================================================================*/
	define( 'WP_MEMORY_LIMIT', '256M' );
	/*=======================================================================================
			Limitar el numero de caracteres a mostrar en el index
	=========================================================================================*/
  
	function get_excerpt($limit=200, $source = null){
		if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
		$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $limit);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		$excerpt = $excerpt.'...';
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
		}elseif ($cat_name === 'Regiones') {
			$background_color = 'teal darken-2';
		}
		$args = array(
			'category_name' => $cat_name,
			'posts_per_page' => 3,
			'order' => 'DESC',
			'orderby' => 'date'
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : ?>
		<div class="row">
			<h5 class="card-panel <?php echo $background_color ?> white-text text-darken-0"> <i class="material-icons">local_dining</i> Nuevo Post de <?php echo $cat_name?> </h5>
			<!-- the loop -->
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php get_template_part( 'template-parts/content-index', get_post_type() );?>
			<?php endwhile; ?>
			<!-- end of the loop -->
		</div>
		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif;
	}

	/*=============================================================
		Generar menú superior de manera automática
	==============================================================*/
	function mostrar_menu() {
		  $items ='<li>
			<a href="'.get_category_link(get_cat_ID('Platos')).'"><i class="material-icons">local_dining</i>Platos</a>
		  </li>';
		  $items .='<li>
			<a href="'.get_category_link(get_cat_ID('Ocasiones')).'"><i class="material-icons">label</i>Ocasiones</a>
		  </li>';
		  $items .='<li>
			<a href="'.get_category_link(get_cat_ID('Regiones')).'"><i class="material-icons">language</i>Regiones</a>
		  </li>';
		  
			$items .= '<li>
						<a href="https://behance.net/ljmarquezg"><i class="material-icons">contacts</i>Acerca de mi</a>
					  </li>';
			if (is_user_logged_in()){
				$items .= '<li>
					<a href="'. wp_logout_url(get_home_url()) .'"> <i class="material-icons">arrow_back</i>Cerrar Sesión</a> 
				</li>';
			}
			if (!is_user_logged_in()){
			$items .= 
				'<li>
					<a href="'. wp_login_url() .'"> <i class="material-icons">arrow_forward</i>Iniciar Sesión</a> 
				</li>';
			$items .=
				'<li>
					<a href="'. wp_registration_url() .'"> <i class="material-icons">description</i>Registrarse</a> 
				</li>';
			}		
		return $items;
	}

	/*=============================================================
		Activar plugin para iniciar sesion con redes sociales
	==============================================================*/
	function run_activate_plugin( $plugin ) {
		$current = get_option( 'active_plugins' );
		$plugin = plugin_basename( trim( $plugin ) );
	
		if ( !in_array( $plugin, $current ) ) {
			$current[] = $plugin;
			sort( $current );
			do_action( 'activate_plugin', trim( $plugin ) );
			update_option( 'active_plugins', $current );
			do_action( 'activate_' . trim( $plugin ) );
			do_action( 'activated_plugin', trim( $plugin) );
		}
	
		return null;
	}
	run_activate_plugin( 'nextend-facebook-connect/nextend-facebook-connect.php' );
	/*=============================================================
		Incluir plugin para activación de recetas directamente en el tema
	==============================================================*/
	require dirname( __FILE__ ).'/wp-recipe-maker/wp-recipe-maker.php' ;


	/*********************************************
	 	Permitir al usuario agregar recetas nuevas
	*********************************************/
	function agregar_receta() {
			if (is_user_logged_in()){
			echo '<li>
				<a href="'.get_site_url().'/wp-admin/post-new.php" class="waves-effect waves-light btn orange darken-1"><i class="material-icons left  white-text">edit</i>Agregar Receta</a>
			</li>';
		};			
		return $items;
	}

	/*********************************************
	 	Widgets en footer
	*********************************************/
	add_action( 'widgets_init', 'register_widget_footer' );
	function register_widget_footer() {
		register_sidebar(array(
		'name' => __('Pie de página'),
		'id' => 'sidebar-footer',
		'before_widget' => '<div class="widget-footer">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
		));
	}


	
?>
