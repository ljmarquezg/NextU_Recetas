<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ShUrRe
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">			
				<?php
					if ( have_posts() ) :
						if ( is_home() && ! is_front_page() ) :
				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php
						endif;

						show_category('Ocasiones');
						show_category('Platos');
						show_category('Paises');

						// echo '<div class="row">';
						// 	echo '<h5 class="card-panel blue lighten-2 white-text text-darken-0"> <i class="material-icons">local_dining</i> Nuevo Post de Platos </h5>';
						// 	/* Start the Loop */
						// 	echo '<div class="col m12">';
						// 	query_posts('category_name=Platos');
						// 	if (have_posts()):			
						// 		$i = 0; while (have_posts() && $i < 3) :
						// 				the_post();
						// 				get_template_part( 'template-parts/content-index', get_post_type() );
						// 				$i++;
						// 			endwhile;
						// 	else:
						// 		echo 'No hay recetas en esta categoría';

						// 	endif;
						// 		echo '</div>';
						// 	echo '</div>';
						
						// echo '<div class="row">';
						// 	echo '<h5 class="card-panel yellow darken-2 white-text text-darken-0"> <i class="material-icons">label</i> Nuevo Post de Ocasiones </h5>';
						// 	/* Start the Loop */
						// 	echo '<div class="col m12">';
						// 	query_posts('category_name=Ocasiones');			
						// 	$i = 0; while (have_posts() && $i < 3) :
						// 			the_post();
						// 			get_template_part( 'template-parts/content-index', get_post_type() );
						// 			$i++;
						// 		endwhile;
						// 	echo '</div>';
						// echo '</div>';

						// echo '<div class="row">';
						// 	echo '<h5 class="card-panel teal darken-2 white-text text-darken-0"> <i class="material-icons">language</i> Nuevo Post de Paises </h5>';
						// 	/* Start the Loop */
						// 	query_posts('category_name=Paises');			
						// 	$i = 0; while (have_posts() && $i < 3) :
						// 			the_post();
						// 			get_template_part( 'template-parts/content-index', get_post_type() );
						// 			$i++;
						// 		endwhile;
						// 	echo '</div>';
						// echo '</div>';

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
				?>
				
			</div><!--row-->
			<?php
				// get_sidebar();
				get_footer();
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
