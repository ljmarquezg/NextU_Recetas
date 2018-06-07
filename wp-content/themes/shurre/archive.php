<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ShUrRe
 */

get_header();
?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				$categoria = get_query_var('category_name', 0);
				if ( $categoria === 'platos') :
					the_archive_title( '<div class="card-panel blue lighten-2 white-text text-darken-0"> <i class="material-icons">local_dining</i><h2 style="display: inline;margin-left: 10px; font-size:2.28rem;">', '</h2></div>' );
				elseif ( $categoria === 'ocasiones') :
					the_archive_title( '<div class="card-panel yellow darken-2 white-text text-darken-0"> <i class="material-icons">label</i><h2 style="display: inline;margin-left: 10px; font-size:2.28rem;">', '</h2></div>' );
				elseif ( $categoria === 'paises') :
					the_archive_title( '<div class="card-panel teal darken-2 white-text text-darken-0"> <i class="material-icons">language</i><h2 style="display: inline;margin-left: 10px; font-size:2.28rem;">', '</h2></div>' );
				endif;			
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-index', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
