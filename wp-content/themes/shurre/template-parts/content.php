<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ShUrRe
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header card-panel teal darken-4 white-color white-text text-darken-0">
		<?php
		if ( is_singular() ) :
			the_title( '<h5 class="entry-title" style="margin:0">', '</h5>' );
		else :
			the_title( '<h5 class="entry-title" style="margin:0"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
		endif;
		?>
		
	</header><!-- .entry-header -->

	<?php shurre_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'shurre' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shurre' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
