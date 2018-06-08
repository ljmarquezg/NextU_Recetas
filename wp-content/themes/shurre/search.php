<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ShUrRe
 */

get_header();
?>

	<section id="primary" class="content-area row">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h5 class="page-title card-panel teal darken-2 white-text text-darken-0">
				<i class="material-icons">search</i>
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'shurre' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h5>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content-index', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
