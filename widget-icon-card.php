<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Icon_Card extends Widget_Base {

	public function get_id() {
		return 'icon-card';
	}

	public function get_name() {
		return 'icon-card';
	}

	public function get_title() {
		return __( 'Icon Card', 'extend-elementor' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'icon-box';
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
			'headline_text',
			[
				'label' => __( 'Headline', 'extend-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter headline text', 'extend-elementor' ),
				'section' => 'section_content_tab',
				'selector' => '{{WRAPPER}} .elementor-icon-card-title',
			]
		);

		$this->add_control(
			'body_text',
			[
				'label' => __( 'Body Text', 'extend-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'title' => __( 'Enter body text', 'extend-elementor' ),
				'section' => 'section_content_tab',
			]
		);

		$this->add_control(
			'icon_image',
			[
				'label' => __( 'Icon Image', 'extend-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'section' => 'section_content_tab'
			]
		);

		$this->add_control(
			'background_image',
			[
				'label' => __( 'Background Image', 'extend-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'section' => 'section_content_tab'
			]
		);

		$this->add_control(
			'links_to',
			[
				'label' => __( 'Links To', 'extend-elementor' ),
				'type' => Controls_Manager::URL,
				'section' => 'section_content_tab'
			]
		);

		$this->add_control(
			'section_style_card',
			[
				'type'  => Controls_Manager::SECTION,
				'label' => __( 'Card Styles', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'section' => 'section_style_card',
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'background_image[url]!' => ''
				]
			]
		);
	}

	protected function render() {

		$settings = $this->get_settings();

		$custom_text = ! empty( $settings['headline_text'] ) ? $settings['headline_text'] : '';
		$body_text = ! empty( $settings['body_text'] ) ? $settings['body_text'] : '';
		$links_to = ! empty( $settings['links_to']['url'] ) ? $settings['links_to'] : '';
		$icon_image = ! empty( $settings['icon_image']['url'] ) ? $settings['icon_image']['url'] : '';
		$background_image = ! empty( $settings['background_image']['url'] ) ? $settings['background_image']['url'] : '';
		$text_color = ! empty( $settings['text_color'] ) ? $settings['text_color'] : '';

		if( $links_to ) {
		?>
			<a href="<?php echo $links_to['url']; ?>" target="<?php echo $links_to['is_external'] == true ? '_blank' : '_parent' ?>" >
		<? } ?>
		<?php if($background_image) { ?>
			<div class="icon-card <?php echo $layout; ?>" style="background: url(<?php echo $background_image; ?>) center center no-repeat">
		<?php } else { ?>
			<div class="icon-card <?php echo $layout; ?>">
		<?php } ?>
			<?php if($custom_text) { ?><h5 class="icon-card__title" style="color: <?php echo $text_color; ?>"><?php echo $custom_text; ?></h5><?php } ?>
			<div class="icon-card__content">
				<img src="<?php echo $icon_image; ?>" class="icon-card__image" />
				<p class="icon-card__body" style="color: <?php echo $text_color; ?>"><?php echo $body_text; ?></p>
			</div>
		</div>
		<?php
			if( $links_to ) {
		?>
			</a>
		<?php }
	}

	protected function content_template() {}

	public function render_plain_content( $settings = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Icon_Card );
