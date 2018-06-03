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
			<div class="row">
				
				<?php
					if ( have_posts() ) :
						if ( is_home() && ! is_front_page() ) :
				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php
						endif;
						echo '<div class="card-panel blue lighten-2 white-text text-darken-0"> <i class="material-icons">local_dining</i> Nuevo Post de Platos </div>';
						/* Start the Loop */
						echo '<div class="col l12">';
						query_posts('category_name=Platos');
						// foreach ($query as $key => $post) {
					
						while ( have_posts() ) :
							the_post();
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', get_post_type() );
						// }
						endwhile;
						echo '</div>';
						
						echo '<div class="col l12">';
						echo '<div class="card-panel yellow darken-2 white-text text-darken-0"> <i class="material-icons">label</i> Nuevo Post de Ocasiones </div>';
						/* Start the Loop */
						$query = query_posts('category_name=Ocasiones');
						foreach ($query as $key => $post) {
					
						// while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content-index', get_post_type() );
						}
						// endwhile;
						echo '</div>';

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
