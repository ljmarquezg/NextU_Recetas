<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package recipes
 */

?>

	</div><!-- #content -->



        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Shurre</h5>
                <p class="grey-text text-lighten-4">Blog diseñado para mostrar listado de recetas para NextU</p>
              </div>
              <div class="col l4 offset-l2 s12">
              <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
                <div id="sidebar-footer">
                <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                </div>
              <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2018 Luis José Márquez González
            <a class="grey-text text-lighten-4 right" href="https://www.behance.com/ljmarquezg">Ver Portafolio</a>
            </div>
          </div>
        </footer>
            


	<!-- <footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'recipes' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'recipes' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'recipes' ), 'recipes', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div>
	</footer>#colophon -->
</div><!-- #page -->
<!--Incluir Javascript-->
<!-- <script type="text/javascript" src="<?php echo  get_stylesheet_directory_uri();?>/js/jquery-2.1.1.min.js"></script> -->
<!--Incluir materialize.js-->
<!-- <script type="text/javascript" src="<?php echo  get_stylesheet_directory_uri();?>/js/materialize.min.js"></script> -->
<?php wp_footer(); ?>
</body>
</html>
