<article id="post-<?php the_ID(); ?>" class="col s4" <?php post_class(); ?>>
<div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <?php echo shurre_post_thumbnail()?>
    </div>
    <div class="card-content">
      <span class="grey-text text-darken-4">
      <?php
		if ( is_singular() ) :
			the_title( '<h4 class="entry-title">', '</h4>' );
		else :
			echo '<h4 class="entry-title">'.get_the_title().'</h4>';
			// the_title( '<a href="' . get_permalink($post->ID) . '" rel="bookmark">', '</a></h4>' );
		endif;
        ?>
      <p>
			<?php 
				echo get_excerpt();
			?>
			</p>
        <footer class="entry-footer">
						<?php 
						// shurre_entry_footer(); 
						$categorias = get_the_category();
						foreach ($categorias as $key => $categoria) {
							if (get_cat_name($categoria->category_parent) === 'Platos' ){
							?>
							<div class="row">
								<div class="chip">
									<i class="material-icons">local_dining</i>
									<?php echo $categoria->cat_name?>
								</div>
							</div>
							<?php 
							}

							if (get_cat_name($categoria->category_parent) === 'Regiones' ){
							?>
							<div class="row">
								<div class="chip">
									<i class="material-icons">language</i>
									<?php echo $categoria->cat_name?>
								</div>
							</div>
							<?php 
							}

							if (get_cat_name($categoria->category_parent) === 'Ocasiones' ){
								?>
									<div class="row">
										<div class="chip">
											<i class="material-icons">label</i>
											<?php echo $categoria->cat_name?>
										</div>
									</div>
								<?php 
							}

							// if ( in_category( 'Ocasiones') )  {
							// 	echo '<div class="row">
							// 	<div class="chip">
							// 		<i class="material-icons">label</i>
							// 		Ésta en ocasiones
							// 	</div>
							// </div>';
							// 	// Lo que queramos hacer 
							// }

						}
		?>
        </footer><!-- .entry-footer -->
			</span>
    </div>
		<div class="card-action">
				<a href="<?php echo get_permalink($post->ID) ?>">Ir a la receta</a>
		</div>
  </div>

<?php /*
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				shurre_posted_on();
				shurre_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
    </header><!-- .entry-header -->
   
	

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
		
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
</article><!-- #post-<?php the_ID(); */?>
</article>