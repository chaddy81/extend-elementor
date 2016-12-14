<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Email_Form extends Widget_Base {

	public function get_id() {
		return 'email-form';
	}

	public function get_name() {
		return 'email-form';
	}

	public function get_title() {
		return __( 'Email Form', 'extend-elementor' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'form-horizontal';
	}

	protected function _register_controls() {

		$this->add_control(
			'section_content_tab',
			[
				'label' => __( 'Content', 'extend-elementor' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'form_style',
			[
				'label' => __( 'Form Style', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'section' => 'section_content_tab',
				'options' => [
					'none' => __( 'None', 'elementor' ),
					'Style 1' => __( 'Style 1', 'elementor' ),
					'Style 2' => __( 'Style 2', 'elementor' ),
					'Style 3' => __( 'Style 3', 'elementor' )
				],
			]
		);

		$this->add_control(
			'headline_text',
			[
				'label' => __( 'Headline', 'extend-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter headline text', 'extend-elementor' ),
				'section' => 'section_content_tab',
			]
		);

		$this->add_control(
			'sub_text',
			[
				'label' => __( 'Sub Text', 'extend-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter sub text', 'extend-elementor' ),
				'section' => 'section_content_tab',
			]
		);

		$this->add_control(
			'header_text',
			[
				'label' => __( 'Header Text', 'extend-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter header text', 'extend-elementor' ),
				'section' => 'section_content_tab',
				'condition' => [
					'form_style' => 'Style 3'
				]
			]
		);

		$this->add_control(
			'form_image',
			[
				'label' => __( 'Form Image', 'extend-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'section' => 'section_content_tab',
				'condition' => [
					'form_style' => 'Style 1'
				]
			]
		);

		$this->add_control(
			'form_code',
			[
				'label' => __( 'Form Code', 'extend-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'section' => 'section_content_tab'
			]
		);

		$this->add_control(
			'section_style_forms',
			[
				'type'  => Controls_Manager::SECTION,
				'label' => __( 'Form Styles', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'section' => 'section_style_forms',
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'headline_color',
			[
				'label' => __( 'Headline Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'section' => 'section_style_forms',
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'message_color',
			[
				'label' => __( 'Message Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'section' => 'section_style_forms',
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'form_field_color',
			[
				'label' => __( 'Form Field Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'section' => 'section_style_forms',
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'form_field_font_color',
			[
				'label' => __( 'Form Field Font Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'section' => 'section_style_forms',
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		// $this->add_control(
		// 	'form_modal',
		// 	[
		// 		'label' => __( 'Show form as modal?', 'extend-elementor' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'false',
		// 		'section' => 'section_content_tab',
		// 		'options' => [
		// 			'false' => __( 'False', 'elementor' ),
		// 			'true' => __( 'True', 'elementor' ),
		// 		],
		// 		'condition' => [
		// 			'form_style' => 'Style 3'
		// 		]
		// 	]
		// );

	}

	protected function render() {
		$settings = $this->get_settings();

		// get our input from the widget settings.

		$form_style = ! empty( $settings['form_style'] ) ? $settings['form_style'] : '';
		$custom_text = ! empty( $settings['headline_text'] ) ? $settings['headline_text'] : '';
		$sub_text = ! empty( $settings['sub_text'] ) ? $settings['sub_text'] : '';
		$header_text = ! empty( $settings['header_text'] ) ? $settings['header_text'] : '';
		$form_image = ! empty( $settings['form_image']['url'] ) ? $settings['form_image']['url'] : '';
		// $form_modal = ! empty( $settings['form_modal'] ) ? $settings['form_modal'] : '';
		$form_code = ! empty( $settings['form_code'] ) ? $settings['form_code'] : ' No Form Code ';

		$button_color = ! empty( $settings['button_color'] ) ? $settings['button_color'] : '';
		$headline_color = ! empty( $settings['headline_color'] ) ? $settings['headline_color'] : '';
		$message_color = ! empty( $settings['message_color'] ) ? $settings['message_color'] : '';
		$form_field_color = ! empty( $settings['form_field_color'] ) ? $settings['form_field_color'] : '';
		$form_field_font_color = ! empty( $settings['form_field_font_color'] ) ? $settings['form_field_font_color'] : '';
		?>

		<?php if ($form_style == "Style 1"): ?>
			<div class="email-form email-form--style-1 clearfix">
				<style type="text/css">
					.email-form.email-form--style-1 h4 {
						color: <?php echo $headline_color; ?> !important;
					}
					.email-form.email-form--style-1 p {
						color: <?php echo $message_color; ?> !important;
					}
					.email-form.email-form--style-1 input {
						background: <?php echo $form_field_color; ?> !important;
						color: <?php echo $form_field_font_color; ?> !important;
					}
					.email-form.email-form--style-1 input[type=submit] {
						background: <?php echo $button_color; ?> !important;
					}
				</style>
				<div class="col-md-3">
					<?php if ($form_image) : ?>
						<img src="<?php echo $form_image; ?>" align="left" />
					<?php endif; ?>
				</div>
				<div class="col-md-9">
					<?php if ($custom_text) : ?><h4><?php echo $custom_text; ?></h4><?php endif; ?>
					<?php if ($sub_text) : ?><p><?php echo $sub_text; ?></p><?php endif; ?>
					<?php echo $form_code; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($form_style == "Style 2"): ?>
			<div class="email-form email-form--style-2 clearfix">
				<style type="text/css">
					.email-form.email-form--style-2 h4 {
						color: <?php echo $headline_color; ?> !important;
					}
					.email-form.email-form--style-2 p {
						color: <?php echo $message_color; ?> !important;
					}
					.iemail-form.email-form--style-2 nput {
						background: <?php echo $form_field_color; ?> !important;
						color: <?php echo $form_field_font_color; ?> !important;
					}
					.email-form.email-form--style-2 input[type=submit] {
						background: <?php echo $button_color; ?> !important;
					}
				</style>
				<div class="col-md-4 text">
					<?php if ($custom_text) : ?><h4><?php echo $custom_text; ?></h4><?php endif; ?>
					<?php if ($sub_text) : ?><p><?php echo $sub_text; ?></p><?php endif; ?>
				</div>
				<div class="col-md-8 form">
					<?php echo $form_code; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($form_style == "Style 3"): ?>
			<div class="email-form email-form--style-3 text-xs-center">
				<style type="text/css">
					.email-form.email-form--style-3 h4 {
						color: <?php echo $headline_color; ?> !important;
					}
					.email-form.email-form--style-3 p {
						color: <?php echo $message_color; ?> !important;
					}
					.email-form.email-form--style-3 input {
						background: <?php echo $form_field_color; ?> !important;
						color: <?php echo $form_field_font_color; ?> !important;
					}
					.email-form.email-form--style-3 input[type=submit] {
						background: <?php echo $button_color; ?> !important;
					}
				</style>
				<?php if($header_text): ?><p class="header-text"><?php echo $header_text; ?></p> <?php endif; ?>
				<div class="body-content">
					<?php if ($custom_text) : ?><h4><?php echo $custom_text; ?></h4><?php endif; ?>
					<?php if ($sub_text) : ?><p><?php echo $sub_text; ?></p><?php endif; ?>
					<?php echo $form_code; ?>
				</div>
		<?php endif; ?>
<?php }

	protected function content_template() {}

	public function render_plain_content( $settings = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Email_Form );
