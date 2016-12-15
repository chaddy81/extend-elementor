<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Basic_Card extends Widget_Base {

	public function get_id() {
		return 'basic-card';
	}

	public function get_name() {
		return 'basic-card';
	}

	public function get_title() {
		return __( 'Basic Card', 'extend-elementor' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-posts-group';
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
			'basic_card_style',
			[
				'label' => __( 'Card Style', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one',
				'section' => 'section_content_tab',
				'options' => [
					'one' => __( 'Style 1', 'elementor' ),
					'two' => __( 'Style 2', 'elementor' ),
					'three' => __( 'Style 3', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'header_text',
			[
				'label' => __( 'Card Header', 'extend-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter card header text', 'extend-elementor' ),
				'section' => 'section_content_tab',
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
			'description_text',
			[
				'label' => __( 'Description', 'extend-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'title' => __( 'Enter description text', 'extend-elementor' ),
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

	}

	protected function render() {

		$settings = $this->get_settings();

		// get our input from the widget settings.

		$basic_card_style = ! empty( $settings['basic_card_style'] ) ? $settings['basic_card_style'] : '';
		$header_text = ! empty( $settings['header_text'] ) ? $settings['header_text'] : '';
		$custom_text = ! empty( $settings['headline_text'] ) ? $settings['headline_text'] : ' (no text was entered ) ';
		$description_text = ! empty( $settings['description_text'] ) ? $settings['description_text'] : '';
		$links_to = ! empty( $settings['links_to']['url'] ) ? $settings['links_to'] : '';
		$background_image = ! empty( $settings['background_image']['url'] ) ? $settings['background_image']['url'] : '';
		$color_overlay = ! empty( $settings['color_overlay'] ) ? $settings['color_overlay'] : '';
		$overlay_color = ! empty( $settings['overlay_color'] ) ? $settings['overlay_color'] : '';

		switch ($basic_card_style) {
		    case "one":
		        $layout = "basic-card";
		        break;
		    case "two":
		        $layout = "basic-card basic-card__stacked";
		        break;
				case "three":
		        $layout = "basic-card basic-card__stacked basic-card__stacked--alternative";
		        break;
		    default:

		}
		?>
		<?php if($basic_card_style == "one") { ?>
			<div class="<?php echo $layout; ?>" style="background: url(<?php echo $background_image; ?>) center center no-repeat">
				<?php if($header_text) { ?><p class="basic-card__category"><?php echo $header_text; ?></p> <?php } ?>
				<div class="basic-card__container">
					<div class="basic-card__content">
						<h4 class="basic-card__title"><?php echo $custom_text; ?></h4>
						<?php if($description_text) { ?><p class="basic-card__description"><?php echo $description_text; ?></p><?php } ?>
						<?php if($links_to) : ?>
							<a href="<?php echo $links_to['url']; ?>" target="<?php echo $links_to['is_external'] == true ? '_blank' : '_parent' ?>" class="basic-card__link">Read More</a>
						<?php endif; ?>
					</div>
					<?php if($color_overlay === 'True') : ?><div class="basic-card__overlay" style="background-color: <?php echo $overlay_color; ?>"></div><? endif; ?>
				</div>
			</div>
		<?php } ?>

		<?php if($basic_card_style == "two") { ?>
			<?php if($links_to) : ?>
				<a href="<?php echo $links_to['url']; ?>" target="<?php echo $links_to['is_external'] == true ? '_blank' : '_parent' ?>">
			<?php endif; ?>
				<div class="<?php echo $layout; ?>">
					<?php if($header_text) { ?><p class="basic-card__category"><?php echo $header_text; ?></p> <?php } ?>
					<div class="basic-card__content" style="background: url(<?php echo $background_image; ?>) center center no-repeat">
						<h4 class="basic-card__title"><?php echo $custom_text; ?></h4>
						<?php if($color_overlay === 'True') : ?><div class="basic-card__overlay" style="background-color: <?php echo $overlay_color; ?>"></div><? endif; ?>
					</div>
					<?php if($description_text) { ?><p class="basic-card__description"><?php echo $description_text; ?></p><?php } ?>
				</div>
			<?php if($links_to) : ?></a><?php endif; ?>
		<?php } ?>

		<?php if($basic_card_style == "three") { ?>
			<?php if($links_to) : ?>
				<a href="<?php echo $links_to['url']; ?>" target="<?php echo $links_to['is_external'] == true ? '_blank' : '_parent' ?>">
			<?php endif; ?>
				<div class="<?php echo $layout; ?>">
					<?php if($header_text) { ?><p class="basic-card__category"><?php echo $header_text; ?></p> <?php } ?>
					<div class="basic-card__content-image" style="background: url(<?php echo $background_image; ?>) center center no-repeat">
					<?php if($color_overlay === 'True') : ?><div class="basic-card__overlay" style="background-color: <?php echo $overlay_color; ?>"></div><? endif; ?></div>
					<div class="basic-card__content">
						<h4 class="basic-card__title"><?php echo $custom_text; ?></h4>
						<?php if($description_text) { ?><p class="basic-card__description"><?php echo $description_text; ?></p><?php } ?>
					</div>
				</div>
			<?php if($links_to) : ?></a><?php endif; ?>
		<?php } ?>
	<?php }

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Basic_Card );
