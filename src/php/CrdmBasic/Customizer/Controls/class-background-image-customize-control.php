<?php
/**
 * Contains the Background_Image_Customize_Control class.
 *
 * @package crdm-basic
 */

declare(strict_types = 1);

namespace CrdmBasic\Customizer\Controls;

/**
 * A WP_Customize_Control for background image configuration
 *
 * Allows for controlling the repeat, size, attachment and position of a background image.
 */
class Background_Image_Customize_Control extends \WP_Customize_Control {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'crdm-basic-background-image';

	/**
	 * Exports control parameters for JS.
	 *
	 * @inheritDoc
	 */
	public function to_json() {
		parent::to_json();

		$this->json['position_description'] = esc_html__( 'left top, x%, y%, xpos ypos (px)', 'crdm-basic' );
		$this->json['position_placeholder'] = esc_html__( 'Position', 'crdm-basic' );

		foreach ( $this->settings as $key => $id ) {
			$this->json['settings'][ $key ] = [
				'link'  => $this->get_link( $key ),
				'value' => $this->value( $key ),
				'id'    => $id->id ?? '',
			];
		}

		$this->json['repeat_choices']     = [
			''          => esc_html__( 'Repeat', 'crdm-basic' ),
			'repeat-x'  => esc_html__( 'Repeat x', 'crdm-basic' ),
			'repeat-y'  => esc_html__( 'Repeat y', 'crdm-basic' ),
			'no-repeat' => esc_html__( 'No Repeat', 'crdm-basic' ),
		];
		$this->json['size_choices']       = [
			''        => esc_html__( 'Size (Auto)', 'crdm-basic' ),
			'100'     => esc_html__( '100% Width', 'crdm-basic' ),
			'cover'   => esc_html__( 'Cover', 'crdm-basic' ),
			'contain' => esc_html__( 'Contain', 'crdm-basic' ),
		];
		$this->json['attachment_choices'] = [
			''        => esc_html__( 'Attachment', 'crdm-basic' ),
			'fixed'   => esc_html__( 'Fixed', 'crdm-basic' ),
			'local'   => esc_html__( 'Local', 'crdm-basic' ),
			'inherit' => esc_html__( 'Inherit', 'crdm-basic' ),
		];
	}

	/**
	 * Prints the Underscore.js template for the control.
	 *
	 * @inheritDoc
	 */
	public function content_template() {
		?>
<# _.each( [ [ data.settings.repeat, data.repeat_choices ], [ data.settings.size, data.size_choices ], [ data.settings.attachment, data.attachment_choices] ], function( tuple ) {
	if ( tuple[0] ) { #>
		<label>
			<select {{{ tuple[0].link }}}>
				<# _.each( tuple[1], function( label, choice ) { #>
					<option value="{{{ choice }}}" <# if ( choice === tuple[0].value ) { #> selected="selected" <# } #>>{{{ label }}}</option>
				<# } ) #>
			</select>
		</label>
	<# }
} ); #>

<# if ( data.settings.position ) { #>
	<label>
		<input name="{{{ data.settings.position.id }}}" type="text" {{{ data.settings.position.link }}} value="{{{ data.settings.position.value }}}" placeholder="{{{ data.position_placeholder }}}" />
			<p class="description">{{{ data.position_description }}}</p>
	</label>
<# } #>
		<?php
	}
}
