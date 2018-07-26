<?php declare( strict_types=1 );

namespace Crdm\Admin;

class PageSubtitle {

	public function __construct() {
		$this->initHooks();
	}

	protected function initHooks() {
		add_action( 'save_post', [ $this, 'saveSubtitle' ] );
		add_action( 'edit_form_after_title', [ $this, 'showSubtitleInputField' ] );
	}

	public function saveSubtitle( int $postId ) {
		if ( ! isset( $_POST['crdm_page_subtitle'] ) ) {
			return false;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return false;
		}

		if ( ! isset( $_POST['post_type'] ) || $_POST['post_type'] != 'page' ) {
			return false;
		}

		if ( ! current_user_can( 'edit_page', $postId ) ) {
			return false;
		}

		return update_post_meta( $postId, 'crdm_page_subtitle', stripslashes( esc_attr( $_POST['crdm_page_subtitle'] ) ) );
	}

	public function showSubtitleInputField( \WP_Post $post ) {
		?>
		<div>
			<label class="screen-reader-text" id="subtitle-prompt-text"
			       for="crdm_page_subtitle"><?php _e( 'Zadejte podnadpis', 'crdm_basic' ); ?></label>
			<input type="text" name="crdm_page_subtitle" id="crdm_page_subtitle"
			       value="<?php echo esc_html( get_post_meta( $post->ID, 'crdm_page_subtitle', true ) ); ?>"
			       size="30" style="width: 100%;"
			       placeholder="<?php _e( 'Zadejte podnadpis', 'crdm_basic' ); ?>"
			       spellcheck="true" autocomplete="off"/>
		</div>
		<?php
	}

}