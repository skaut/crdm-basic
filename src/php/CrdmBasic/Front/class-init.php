<?php
/**
 * Contains the Init class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Front;

/**
 * Initializes the user-facing part of the theme.
 *
 * Enqueues all the scripts and styles, adds all the header and footer styles.
 */
final class Init {

	/**
	 * Init class constructor.
	 * Enqueues all the scripts and styles, adds all the header and footer styles.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'load_all_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'load_all_scripts' ] );

		add_action( 'generate_before_header', [ $this, 'before_header' ] );
		add_action( 'generate_after_header', [ $this, 'after_header' ] );

		add_action(
			'generate_after_header',
			function () {
				// Removes default page header image.
				remove_action( 'generate_after_header', 'generate_featured_page_header', 10 );
			},
			1
		);
		add_action( 'generate_after_header', [ $this, 'custom_page_header_image' ], 25 );

		add_filter(
			'generate_show_title',
			function ( $show ) {
				// Hide default main title if the page has featured image.
				if ( is_page() && has_post_thumbnail() ) {
					return false;
				}

				return $show;
			},
			20
		);

		add_action(
			'generate_footer',
			function () {
				// Hides the copyright.
				remove_action( 'generate_footer', 'generate_construct_footer' );
			},
			1
		);
	}

	/**
	 * Enqueues all the styles
	 *
	 * Adds all the styles for the user-facing part of the theme
	 */
	public function load_all_styles() {
		if ( is_rtl() ) {
			wp_enqueue_style( 'generatepress-rtl', CRDMBASIC_PARENT_TEMPLATE_URL . 'rtl.css', [], CRDMBASIC_APP_VERSION );
		}

		wp_enqueue_style(
			'crdm-main',
			CRDMBASIC_TEMPLATE_URL . 'frontend/index.css',
			[ 'generate-style' ],
			CRDMBASIC_APP_VERSION
		);
	}

	/**
	 * Enqueues all the scripts
	 *
	 * Adds all the scripts for the user-facing part of the theme
	 */
	public function load_all_scripts() {
		wp_enqueue_script(
			'crdm-main',
			CRDMBASIC_TEMPLATE_URL . 'frontend/index.js',
			[ 'jquery' ],
			CRDMBASIC_APP_VERSION,
			true
		);
	}

	/**
	 * Executed before the GeneratePress header is printed.
	 *
	 * Adds the header container.
	 */
	public function before_header() {
		?>
		<div class="crdm_header">
		<?php
	}

	/**
	 * Executed after the GeneratePress header is printed.
	 *
	 * Adds the header container and the header images.
	 */
	public function after_header() {
		?>
		<div class="crdm_header__bg_1 grid-container grid-parent"></div>
		<div class="crdm_header__bg_2-container grid-container grid-parent">
			<div class="crdm_header__bg_2-container-content"></div>
		</div>
		<div class="crdm_header__bg_3 grid-container grid-parent"></div>
		</div>
		<?php
	}

	/**
	 * Executed after the GeneratePress header is printed.
	 *
	 * Adds the page header image.
	 */
	public function custom_page_header_image() {
		if ( function_exists( 'generate_page_header' ) ) {
			return;
		}

		if ( ! is_page() ) {
			return;
		}

		if ( ! has_post_thumbnail() ) {
			return;
		}

		?>
		<div class="page-header-image crdm_page-header grid-container grid-parent">
			<?php
			the_post_thumbnail(
				// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				apply_filters( 'generate_page_header_default_size', 'full' ),
				[
					'itemprop' => 'image',
					'alt'      => the_title_attribute( 'echo=0' ),
				]
			);
			?>
			<div class="crdm_page-header_captions">
				<?php
				do_action( 'crdmbasic_before_page_header_title' );
				?>
				<h1><?php the_title(); ?></h1>
				<?php
				do_action( 'crdmbasic_after_page_header_title' );
				?>
			</div>
		</div>
		<?php
	}

}
