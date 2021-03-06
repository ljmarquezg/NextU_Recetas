<?php
/**
 * Responsible for the plugin settings.
 *
 * @link       http://bootstrapped.ventures
 * @since      1.2.0
 *
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/includes/public
 */

/**
 * Responsible for the plugin settings.
 *
 * @since      1.2.0
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/includes/public
 * @author     Brecht Vandersmissen <brecht@bootstrapped.ventures>
 */
class WPRM_Settings {
	/**
	 * Cached version of the plugin settings.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      array    $settings    Array containing the plugin settings.
	 */
	private static $settings = array();

	/**
	 * Defaults for the plugin settings.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      array    $defaults    Default values for unset settings.
	 */
	private static $defaults = array(
		// Appearance.
		'recipe_snippets_automatically_add' => false,
		'recipe_snippets_alignment' => 'center',
		'recipe_snippets_text' => '[wprm-recipe-jump] [wprm-recipe-print]',
		'recipe_snippets_background_color' => '#2c3e50',
		'recipe_snippets_text_color' => '#ffffff',
		'recipe_image_use_featured' => false,
		'recipe_author_display_default' => 'disabled',
		'recipe_author_custom_default' => '',
		'show_nutrition_label' => 'disabled',
		'nutrition_label_zero_values' => false,
		'template_font_size' => '',
		'template_font_header' => '',
		'template_font_regular' => '',
		'template_recipe_image' => '',
		'template_instruction_image' => '',
		'template_instruction_image_alignment' => 'left',
		'template_ingredient_list_style' => 'disc',
		'template_instruction_list_style' => 'decimal',
		'template_color_border' => '#aaaaaa',
		'template_color_background' => '#ffffff',
		'template_color_text' => '#333333',
		'template_color_link' => '#3498db',
		'template_color_header' => '#000000',
		'template_color_icon' => '#343434',
		'template_color_comment_rating' => '#343434',
		'template_color_accent' => '#2c3e50',
		'template_color_accent_text' => '#ffffff',
		'template_color_accent2' => '#3498db',
		'template_color_accent2_text' => '#ffffff',
		'comment_rating_position' => 'above',
		'default_recipe_template' => 'simple',
		'default_print_template' => 'clean-print',
		'print_credit' => '',
		// Features.
		'features_manage_access' => 'manage_options',
		'features_import_access' => 'manage_options',
		'features_comment_ratings' => true,
		'features_custom_style' => true,
		// Features Premium.
		'features_adjustable_servings' => true,
		'features_user_ratings' => false,
		// Advanced.
		'metadata_keywords_in_template' => true,
		'metadata_pinterest_optout' => false,
		'metadata_pinterest_disable_print_page' => false,
		'metadata_nonfood_allowed' => false,
		'recipe_css' => '',
		'print_css' => '',
	);

	/**
	 * Register actions and filters.
	 *
	 * @since    1.2.0
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_submenu_page' ), 20 );
		add_action( 'admin_post_wprm_settings_appearance', array( __CLASS__, 'form_save_settings_appearance' ) );
		add_action( 'admin_post_wprm_settings_labels', array( __CLASS__, 'form_save_settings_labels' ) );
		add_action( 'admin_post_wprm_settings_features', array( __CLASS__, 'form_save_settings_features' ) );
		add_action( 'admin_post_wprm_settings_import', array( __CLASS__, 'form_save_settings_import' ) );
		add_action( 'admin_post_wprm_settings_advanced', array( __CLASS__, 'form_save_settings_advanced' ) );

		add_action( 'wprm_settings_page', array( __CLASS__, 'settings_page' ) );
	}

	/**
	 * Add the settings submenu to the WPRM menu.
	 *
	 * @since    1.2.0
	 */
	public static function add_submenu_page() {
		add_submenu_page( 'wprecipemaker', __( 'WPRM Settings', 'wp-recipe-maker' ), __( 'Settings', 'wp-recipe-maker' ), 'manage_options', 'wprm_settings', array( __CLASS__, 'settings_page_template' ) );
	}

	/**
	 * Settings page to output.
	 *
	 * @since    1.5.0
	 * @param		 mixed $sub Sub settings page to display.
	 */
	public static function settings_page( $sub ) {
		if ( 'appearance' === $sub ) {
			require_once( WPRM_DIR . 'templates/admin/settings/appearance.php' );
		} elseif ( 'labels' === $sub ) {
			require_once( WPRM_DIR . 'templates/admin/settings/labels.php' );
		} elseif ( 'features' === $sub ) {
			require_once( WPRM_DIR . 'templates/admin/settings/features.php' );
		} elseif ( 'import' === $sub ) {
			require_once( WPRM_DIR . 'templates/admin/settings/import.php' );
		} elseif ( 'advanced' === $sub ) {
			require_once( WPRM_DIR . 'templates/admin/settings/advanced.php' );
		}
	}

	/**
	 * Get the template for the settings page.
	 *
	 * @since    1.2.0
	 */
	public static function settings_page_template() {
		require_once( WPRM_DIR . 'templates/admin/settings.php' );
	}

	/**
	 * Get the value for a specific setting.
	 *
	 * @since    1.2.0
	 * @param		 mixed $setting Setting to get the value for.
	 */
	public static function get( $setting ) {
		$settings = self::get_settings();

		if ( isset( $settings[ $setting ] ) ) {
			return $settings[ $setting ];
		} else {
			return self::get_default( $setting );
		}
	}

	/**
	 * Get the default for a specific setting.
	 *
	 * @since    1.7.0
	 * @param	 mixed $setting Setting to get the default for.
	 */
	public static function get_default( $setting ) {
		$defaults = self::get_defaults();
		if ( isset( $defaults[ $setting ] ) ) {
			return $defaults[ $setting ];
		} else {
			return false;
		}
	}

	/**
	 * Get the default settings.
	 *
	 * @since    1.5.0
	 */
	public static function get_defaults() {
		return apply_filters( 'wprm_settings_defaults', self::$defaults );
	}

	/**
	 * Get all the settings.
	 *
	 * @since    1.2.0
	 */
	public static function get_settings() {
		// Lazy load settings.
		if ( empty( self::$settings ) ) {
			self::load_settings();
		}

		return self::$settings;
	}

	/**
	 * Load all the plugin settings.
	 *
	 * @since    1.2.0
	 */
	private static function load_settings() {
		self::$settings = apply_filters( 'wprm_settings', get_option( 'wprm_settings', array() ) );
	}

	/**
	 * Update the plugin settings.
	 *
	 * @since    1.5.0
	 * @param		 array $settings_to_update Settings to update.
	 */
	public static function update_settings( $settings_to_update ) {
		$settings = self::get_settings();

		if ( is_array( $settings_to_update ) ) {
				$settings = array_merge( $settings, $settings_to_update );
		}

		update_option( 'wprm_settings', $settings );
		self::$settings = $settings;
	}

	/**
	 * Save the appearance settings.
	 *
	 * @since    1.7.0
	 */
	public static function form_save_settings_appearance() {
		if ( isset( $_POST['wprm_settings'] ) && wp_verify_nonce( sanitize_key( $_POST['wprm_settings'] ), 'wprm_settings' ) ) { // Input var okay.
			$recipe_snippets_automatically_add = isset( $_POST['recipe_snippets_automatically_add'] ) && sanitize_key( $_POST['recipe_snippets_automatically_add'] ) ? true : false; // Input var okay.
			$recipe_snippets_alignment = isset( $_POST['recipe_snippets_alignment'] ) ? sanitize_key( wp_unslash( $_POST['recipe_snippets_alignment'] ) ) : ''; // Input var okay.
			$recipe_snippets_text = isset( $_POST['recipe_snippets_text'] ) ? sanitize_text_field( wp_unslash( $_POST['recipe_snippets_text'] ) ) : ''; // Input var okay.
			$recipe_snippets_background_color = isset( $_POST['recipe_snippets_background_color'] ) ? sanitize_text_field( wp_unslash( $_POST['recipe_snippets_background_color'] ) ) : ''; // Input var okay.
			$recipe_snippets_text_color = isset( $_POST['recipe_snippets_text_color'] ) ? sanitize_text_field( wp_unslash( $_POST['recipe_snippets_text_color'] ) ) : ''; // Input var okay.

			$recipe_image_use_featured = isset( $_POST['recipe_image_use_featured'] ) && sanitize_key( $_POST['recipe_image_use_featured'] ) ? true : false; // Input var okay.
			$recipe_author_display_default = isset( $_POST['recipe_author_display_default'] ) ? sanitize_text_field( wp_unslash( $_POST['recipe_author_display_default'] ) ) : ''; // Input var okay.
			$recipe_author_custom_default = isset( $_POST['recipe_author_custom_default'] ) ? sanitize_text_field( wp_unslash( $_POST['recipe_author_custom_default'] ) ) : ''; // Input var okay.
			$show_nutrition_label = isset( $_POST['show_nutrition_label'] ) ? sanitize_text_field( wp_unslash( $_POST['show_nutrition_label'] ) ) : ''; // Input var okay.
			$nutrition_label_zero_values = isset( $_POST['nutrition_label_zero_values'] ) && sanitize_key( $_POST['nutrition_label_zero_values'] ) ? true : false; // Input var okay.

			$template_font_size = isset( $_POST['template_font_size'] ) ? sanitize_text_field( wp_unslash( $_POST['template_font_size'] ) ) : ''; // Input var okay.
			$template_font_header = isset( $_POST['template_font_header'] ) ? sanitize_text_field( wp_unslash( $_POST['template_font_header'] ) ) : ''; // Input var okay.
			$template_font_regular = isset( $_POST['template_font_regular'] ) ? sanitize_text_field( wp_unslash( $_POST['template_font_regular'] ) ) : ''; // Input var okay.
			$template_recipe_image = isset( $_POST['template_recipe_image'] ) ? sanitize_text_field( wp_unslash( $_POST['template_recipe_image'] ) ) : ''; // Input var okay.
			$template_instruction_image = isset( $_POST['template_instruction_image'] ) ? sanitize_text_field( wp_unslash( $_POST['template_instruction_image'] ) ) : ''; // Input var okay.
			$template_instruction_image_alignment = isset( $_POST['template_instruction_image_alignment'] ) ? sanitize_key( wp_unslash( $_POST['template_instruction_image_alignment'] ) ) : ''; // Input var okay.
			$template_ingredient_list_style = isset( $_POST['template_ingredient_list_style'] ) ? sanitize_key( $_POST['template_ingredient_list_style'] ) : ''; // Input var okay.
			$template_instruction_list_style = isset( $_POST['template_instruction_list_style'] ) ? sanitize_key( $_POST['template_instruction_list_style'] ) : ''; // Input var okay.

			$template_color_border = isset( $_POST['template_color_border'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_border'] ) ) : ''; // Input var okay.
			$template_color_background = isset( $_POST['template_color_background'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_background'] ) ) : ''; // Input var okay.
			$template_color_text = isset( $_POST['template_color_text'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_text'] ) ) : ''; // Input var okay.
			$template_color_link = isset( $_POST['template_color_link'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_link'] ) ) : ''; // Input var okay.
			$template_color_header = isset( $_POST['template_color_header'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_header'] ) ) : ''; // Input var okay.
			$template_color_icon = isset( $_POST['template_color_icon'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_icon'] ) ) : ''; // Input var okay.
			$template_color_accent = isset( $_POST['template_color_accent'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_accent'] ) ) : ''; // Input var okay.
			$template_color_accent_text = isset( $_POST['template_color_accent_text'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_accent_text'] ) ) : ''; // Input var okay.
			$template_color_accent2 = isset( $_POST['template_color_accent2'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_accent2'] ) ) : ''; // Input var okay.
			$template_color_accent2_text = isset( $_POST['template_color_accent2_text'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_accent2_text'] ) ) : ''; // Input var okay.

			$template_color_comment_rating = isset( $_POST['template_color_comment_rating'] ) ? sanitize_text_field( wp_unslash( $_POST['template_color_comment_rating'] ) ) : ''; // Input var okay.
			$comment_rating_position = isset( $_POST['comment_rating_position'] ) ? sanitize_key( $_POST['comment_rating_position'] ) : ''; // Input var okay.

			$default_recipe_template = isset( $_POST['default_recipe_template'] ) ? sanitize_text_field( wp_unslash( $_POST['default_recipe_template'] ) ) : ''; // Input var okay.
			$default_print_template = isset( $_POST['default_print_template'] ) ? sanitize_text_field( wp_unslash( $_POST['default_print_template'] ) ) : ''; // Input var okay.
			$print_credit = isset( $_POST['print_credit'] ) ? wp_kses_post( wp_unslash( $_POST['print_credit'] ) ) : ''; // Input var okay.

			$settings = array();

			$settings['recipe_snippets_automatically_add'] = $recipe_snippets_automatically_add;
			if ( $recipe_snippets_alignment ) { $settings['recipe_snippets_alignment'] = $recipe_snippets_alignment; }
			$settings['recipe_snippets_text'] = $recipe_snippets_text;
			if ( $recipe_snippets_background_color ) { $settings['recipe_snippets_background_color'] = $recipe_snippets_background_color; }
			if ( $recipe_snippets_text_color ) { $settings['recipe_snippets_text_color'] = $recipe_snippets_text_color; }

			$settings['recipe_image_use_featured'] = $recipe_image_use_featured;

			if ( in_array( $recipe_author_display_default, array( 'disabled', 'post_author', 'custom' ) ) ) {
				$settings['recipe_author_display_default'] = $recipe_author_display_default;
			}
			$settings['recipe_author_custom_default'] = $recipe_author_custom_default;
			if ( in_array( $show_nutrition_label, array( 'disabled', 'left', 'center', 'right' ) ) ) {
				$settings['show_nutrition_label'] = $show_nutrition_label;
			}
			$settings['nutrition_label_zero_values'] = $nutrition_label_zero_values;

			$settings['template_font_size'] = $template_font_size;
			$settings['template_font_header'] = $template_font_header;
			$settings['template_font_regular'] = $template_font_regular;
			$settings['template_recipe_image'] = $template_recipe_image;
			$settings['template_instruction_image'] = $template_instruction_image;
			if ( $template_instruction_image_alignment ) { $settings['template_instruction_image_alignment'] = $template_instruction_image_alignment; }
			if ( $template_ingredient_list_style ) { $settings['template_ingredient_list_style'] = $template_ingredient_list_style; }
			if ( $template_instruction_list_style ) { $settings['template_instruction_list_style'] = $template_instruction_list_style; }

			if ( $template_color_border ) { $settings['template_color_border'] = $template_color_border; }
			if ( $template_color_background ) { $settings['template_color_background'] = $template_color_background; }
			if ( $template_color_text ) { $settings['template_color_text'] = $template_color_text; }
			if ( $template_color_link ) { $settings['template_color_link'] = $template_color_link; }
			if ( $template_color_header ) { $settings['template_color_header'] = $template_color_header; }
			if ( $template_color_icon ) { $settings['template_color_icon'] = $template_color_icon; }
			if ( $template_color_accent ) { $settings['template_color_accent'] = $template_color_accent; }
			if ( $template_color_accent_text ) { $settings['template_color_accent_text'] = $template_color_accent_text; }
			if ( $template_color_accent2 ) { $settings['template_color_accent2'] = $template_color_accent2; }
			if ( $template_color_accent2_text ) { $settings['template_color_accent2_text'] = $template_color_accent2_text; }

			if ( $template_color_comment_rating ) { $settings['template_color_comment_rating'] = $template_color_comment_rating; }
			if ( $comment_rating_position ) { $settings['comment_rating_position'] = $comment_rating_position; }

			if ( $default_recipe_template ) { $settings['default_recipe_template'] = $default_recipe_template; }
			if ( $default_print_template ) { $settings['default_print_template'] = $default_print_template; }
			$settings['print_credit'] = $print_credit;

			self::update_settings( $settings );
		}
		wp_safe_redirect( admin_url( 'admin.php?page=wprm_settings&sub=appearance' ) );
		exit();
	}

	/**
	 * Save the labels settings.
	 *
	 * @since    1.10.0
	 */
	public static function form_save_settings_labels() {
		if ( isset( $_POST['wprm_settings'] ) && wp_verify_nonce( sanitize_key( $_POST['wprm_settings'] ), 'wprm_settings' ) ) { // Input var okay.
			$labels = array();

			foreach ( $_POST as $id => $value ) { // Input var okay.
				if ( 'wprm_label_' === substr( $id, 0, 11 ) ) {
					$uid = sanitize_key( substr( $id, 11 ) );
					$labels[ $uid ] = sanitize_text_field( wp_unslash( $value ) );
				}
			}

			WPRM_Template_Helper::update_labels( $labels );
		}
		wp_safe_redirect( admin_url( 'admin.php?page=wprm_settings&sub=labels' ) );
		exit();
	}

	/**
	 * Save the features settings.
	 *
	 * @since    1.7.0
	 */
	public static function form_save_settings_features() {
		if ( isset( $_POST['wprm_settings'] ) && wp_verify_nonce( sanitize_key( $_POST['wprm_settings'] ), 'wprm_settings' ) ) { // Input var okay.
			$features_manage_access = isset( $_POST['features_manage_access'] ) ? sanitize_text_field( wp_unslash( $_POST['features_manage_access'] ) ) : ''; // Input var okay.
			$features_import_access = isset( $_POST['features_import_access'] ) ? sanitize_text_field( wp_unslash( $_POST['features_import_access'] ) ) : ''; // Input var okay.
			$features_comment_ratings = isset( $_POST['features_comment_ratings'] ) && sanitize_key( $_POST['features_comment_ratings'] ) ? true : false; // Input var okay.
			$features_custom_style = isset( $_POST['features_custom_style'] ) && sanitize_key( $_POST['features_custom_style'] ) ? true : false; // Input var okay.
			$features_adjustable_servings = isset( $_POST['features_adjustable_servings'] ) && sanitize_key( $_POST['features_adjustable_servings'] ) ? true : false; // Input var okay.
			$features_user_ratings = isset( $_POST['features_user_ratings'] ) && sanitize_key( $_POST['features_user_ratings'] ) ? true : false; // Input var okay.

			$settings = array();

			if ( $features_manage_access ) { $settings['features_manage_access'] = $features_manage_access; }
			if ( $features_import_access ) { $settings['features_import_access'] = $features_import_access; }
			$settings['features_comment_ratings'] = $features_comment_ratings;
			$settings['features_custom_style'] = $features_custom_style;
			$settings['features_adjustable_servings'] = $features_adjustable_servings;
			$settings['features_user_ratings'] = $features_user_ratings;

			self::update_settings( $settings );
		}
		wp_safe_redirect( admin_url( 'admin.php?page=wprm_settings&sub=features' ) );
		exit();
	}

	/**
	 * Save the import settings.
	 *
	 * @since    1.20.0
	 */
	public static function form_save_settings_import() {
		if ( isset( $_POST['wprm_settings'] ) && wp_verify_nonce( sanitize_key( $_POST['wprm_settings'] ), 'wprm_settings' ) ) { // Input var okay.
			$import_range_keyword = isset( $_POST['import_range_keyword'] ) ? sanitize_text_field( wp_unslash( $_POST['import_range_keyword'] ) ) : ''; // Input var okay.
			$import_units = isset( $_POST['import_units'] ) ? wp_kses_post( wp_unslash( $_POST['import_units'] ) ) : ''; // Input var okay.
			$import_notes_identifier = isset( $_POST['import_notes_identifier'] ) ? sanitize_key( wp_unslash( $_POST['import_notes_identifier'] ) ) : ''; // Input var okay.
			$import_notes_remove_identifier = isset( $_POST['import_notes_remove_identifier'] ) && sanitize_key( $_POST['import_notes_remove_identifier'] ) ? true : false; // Input var okay.

			$settings = array();

			$settings['import_range_keyword'] = $import_range_keyword;
			$settings['import_units'] = preg_split( '/[\r\n]+/', $import_units );
			$settings['import_notes_identifier'] = $import_notes_identifier;
			$settings['import_notes_remove_identifier'] = $import_notes_remove_identifier;

			self::update_settings( $settings );
		}
		wp_safe_redirect( admin_url( 'admin.php?page=wprm_settings&sub=import' ) );
		exit();
	}

	/**
	 * Save the advanced settings.
	 *
	 * @since    1.7.0
	 */
	public static function form_save_settings_advanced() {
		if ( isset( $_POST['wprm_settings'] ) && wp_verify_nonce( sanitize_key( $_POST['wprm_settings'] ), 'wprm_settings' ) ) { // Input var okay.
			$metadata_keywords_in_template = isset( $_POST['metadata_keywords_in_template'] ) && sanitize_key( $_POST['metadata_keywords_in_template'] ) ? true : false; // Input var okay.
			$metadata_pinterest_optout = isset( $_POST['metadata_pinterest_optout'] ) && sanitize_key( $_POST['metadata_pinterest_optout'] ) ? true : false; // Input var okay.
			$metadata_pinterest_disable_print_page = isset( $_POST['metadata_pinterest_disable_print_page'] ) && sanitize_key( $_POST['metadata_pinterest_disable_print_page'] ) ? true : false; // Input var okay.
			$metadata_nonfood_allowed = isset( $_POST['metadata_nonfood_allowed'] ) && sanitize_key( $_POST['metadata_nonfood_allowed'] ) ? true : false; // Input var okay.
			$recipe_css = isset( $_POST['recipe_css'] ) ? wp_kses_post( wp_unslash( $_POST['recipe_css'] ) ) : ''; // Input var okay.
			$print_css = isset( $_POST['print_css'] ) ? wp_kses_post( wp_unslash( $_POST['print_css'] ) ) : ''; // Input var okay.
			$reset_settings_to_default = isset( $_POST['reset_settings_to_default'] ) && sanitize_key( $_POST['reset_settings_to_default'] ) ? true : false; // Input var okay.

			$settings = array();

			$settings['metadata_keywords_in_template'] = $metadata_keywords_in_template;
			$settings['metadata_pinterest_optout'] = $metadata_pinterest_optout;
			$settings['metadata_pinterest_disable_print_page'] = $metadata_pinterest_disable_print_page;
			$settings['metadata_nonfood_allowed'] = $metadata_nonfood_allowed;
			$settings['recipe_css'] = $recipe_css;
			$settings['print_css'] = $print_css;

			if ( $reset_settings_to_default ) {
				delete_option( 'wprm_settings' );
				self::$settings = array();
			} else {
				self::update_settings( $settings );
			}
		}
		wp_safe_redirect( admin_url( 'admin.php?page=wprm_settings&sub=advanced' ) );
		exit();
	}
}

WPRM_Settings::init();
