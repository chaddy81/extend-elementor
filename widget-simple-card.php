<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Simple_Card extends Widget_Base {

	public function get_id() {
		return 'simple-card';
	}

	public function get_name() {
		return 'simple-card';
	}

	public function get_title() {
		return __( 'Simple Card', 'extend-elementor' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-post-list';
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
			'card_style',
			[
				'label' => __( 'Card Style', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'section' => 'section_content_tab',
				'options' => [
					'none' => __( 'None', 'elementor' ),
					'Style 1' => __( 'Style 1', 'elementor' ),
					'Style 2' => __( 'Style 2', 'elementor' ),
					'Style 3' => __( 'Style 3', 'elementor' ),
					'Style 4' => __( 'Style 4', 'elementor' ),
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
			'color_overlay',
			[
				'label' => __( 'Show color overlay', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'False',
				'section' => 'section_style_card',
				'tab' => Controls_Manager::TAB_STYLE,
				'options' => [
					'True' => __( 'True', 'elementor' ),
					'False' => __( 'False', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Overlay Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.52)',
				'section' => 'section_style_card',
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'color_overlay' => 'True'
				]
			]
		);

		$this->add_control(
			'accent_color',
			[
				'label' => __( 'Accent Color', 'extend-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'section' => 'section_style_card',
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_style!' => 'Style 1'
				]
			]
		);

	}

	protected function render() {

		$settings = $this->get_settings();

		// get our input from the widget settings.

		$card_style = ! empty( $settings['card_style'] ) ? $settings['card_style'] : '';
		$custom_text = ! empty( $settings['headline_text'] ) ? $settings['headline_text'] : ' (no text was entered ) ';
		$links_to = ! empty( $settings['links_to']['url'] ) ? $settings['links_to'] : ' (no url was entered) ';
		$background_image = ! empty( $settings['background_image']['url'] ) ? $settings['background_image']['url'] : '';
		$color_overlay = ! empty( $settings['color_overlay'] ) ? $settings['color_overlay'] : '';
		$overlay_color = ! empty( $settings['overlay_color'] ) && $settings['color_overlay'] == true ? $settings['overlay_color'] : '';
		$accent_color = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '';

		switch ($card_style) {
		    case "Style 1":
		        $layout = "simple-card--center-content";
		        break;
		    case "Style 2":
		        $layout = "simple-card--center-content simple-card--with-accent";
		        break;
		    case "Style 3":
		        $layout = "simple-card--center-content simple-card--with-accent-bottom";
		        break;
				case "Style 4":
		        $layout = "simple-card--center-content simple-card--with-border";
		        break;
		    default:

		}

		if( $links_to ) {
		?>
			<a href="<?php echo $links_to['url']; ?>" target="<?php echo $links_to['is_external'] == true ? '_blank' : '_parent' ?>" >
		<? } ?>
		<div class="simple-card <?php echo $layout; ?>" style="background: url(<?php echo $background_image; ?>) top center no-repeat">
			<?php if($color_overlay === 'True') : ?><div class="simple-card__overlay" style="background-color: <?php echo $overlay_color; ?>"></div><?php endif; ?>
			<h5 style="background-color: <?php echo ($card_style == 'Style 2' || $card_style == 'Style 3') ? $accent_color : 'none'; ?>; border-top-color: <?php echo $accent_color; ?>"><?php echo $custom_text; ?></h5>
		</div>
		<?php
			if( $links_to ) {
		?>
			</a>
		<?php }
	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Simple_Card );
