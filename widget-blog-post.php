<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Blog_Post extends Widget_Base {

	public function get_name() {
		return 'blog-post';
	}

	public function get_title() {
		return __( 'Blog Post', 'extend-elementor' );
	}

	public function get_icon() {
		return 'post';
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
			'layout_style',
			[
				'label' => __( 'Blog Layout', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'Style 1',
				'section' => 'section_content_tab',
				'options' => [
					'Style 1' => __( 'Style 1', 'elementor' ),
					'Style 2' => __( 'Style 2', 'elementor' ),
					'Style 3' => __( 'Style 3', 'elementor' )
				],
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => __( 'Show post category over image?', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'False',
				'section' => 'section_content_tab',
				'options' => [
					'True' => __( 'True', 'elementor' ),
					'False' => __( 'False', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' => __( 'Show image?', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'False',
				'section' => 'section_content_tab',
				'options' => [
					'True' => __( 'True', 'elementor' ),
					'False' => __( 'False', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'show_featured',
			[
				'label' => __( 'Show large featured blog post?', 'extend-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'False',
				'section' => 'section_content_tab',
				'options' => [
					'True' => __( 'True', 'elementor' ),
					'False' => __( 'False', 'elementor' ),
				],
			]
		);

	}

	protected function render() {

		$settings = $this->get_settings();

		// get our input from the widget settings.

		$layout_style = ! empty( $settings['layout_style'] ) ? $settings['layout_style'] : '';
		$show_category = ! empty( $settings['show_category'] ) ? $settings['show_category'] : '';
		$show_image = ! empty( $settings['show_image'] ) ? $settings['show_image'] : '';
		$show_featured = ! empty( $settings['show_featured'] ) ? $settings['show_featured'] : '';
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
    $args = array(
        'post_type' => 'post',
        'paged' => $paged
    );
    $query = query_posts( $args );
		?>

		<?php if (have_posts()) : while (have_posts()) : the_post (); ?>
			<?php if ($layout_style == "Style 1" || ($show_featured == "True" && $query->current_post == 0 && !is_paged())) { ?>
				<div <?php post_class('blog-post'); ?> id="post-<?php the_ID(); ?>">
					<header class="blog-post__header">
						<?php if ($show_category == "True" && $show_image == "True") : ?><?php if(!has_category('Uncategorized') && has_category()) : ?><span class="blog-post__category"><?php the_category(', '); ?></span><?php endif; endif; ?>
						<?php if ($show_image == "True") : the_post_thumbnail( 'full-width', array('class' => 'blog-post__large-image') ); endif; ?>
					</header>
					<h2 class="blog-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<small class="blog-post__meta"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/comments.png';?>" class="comment-count" /><?php comments_number('0', '1', '%'); ?> <span class="separator">|</span> Written By: <?php the_author(); ?></small>
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

			<?php if (($layout_style == "Style 2" && $show_featured == "True" && $query->current_post !== 0 && !is_paged()) || ( $layout_style == "Style 2" && $show_featured == "False" && !is_paged()) ) { ?>
				<div <?php post_class('blog-post blog-post__style-2'); ?> id="post-<?php the_ID(); ?>">
					<div class="row">
						<header class="blog-post__header col-sm-5">
							<?php if ($show_category == "True" && $show_image == "True") : ?><?php if(!has_category('Uncategorized') && has_category()) : ?><span class="blog-post__category"><?php the_category(', '); ?></span><?php endif; endif; ?>
							<?php if ($show_image == "True") : the_post_thumbnail( 'full-width', array('class' => 'blog-post__large-image') ); endif; ?>
						</header>
						<div class="col-sm-7">
							<h2 class="blog-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<small class="blog-post__meta"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/comments.png';?>" class="comment-count" /><?php comments_number('0', '1', '%'); ?> <span class="separator">|</span> Written By: <?php the_author(); ?></small>
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if (($layout_style == "Style 3" && $show_featured == "True" && $query->current_post !== 0 && !is_paged()) || ( $layout_style == "Style 3" && $show_featured == "False" && !is_paged()) ) { ?>
				<div <?php post_class('blog-post blog-post__style-3'); ?> id="post-<?php the_ID(); ?>">
					<h2 class="blog-post__title elementor-heading-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<small class="blog-post__meta"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/comments.png';?>" class="comment-count" /><?php comments_number('0', '1', '%'); ?> <span class="separator">|</span> Written By: <?php the_author(); ?></small>
					<div class="row">
						<header class="blog-post__header col-sm-5">
							<?php if ($show_category == "True" && $show_image == "True") : ?><?php if(!has_category('Uncategorized') && has_category()) : ?><span class="blog-post__category"><?php the_category(', '); ?></span><?php endif; endif; ?>
							<?php if ($show_image == "True") : the_post_thumbnail( 'full-width', array('class' => 'blog-post__large-image') ); endif; ?>
						</header>
						<div class="col-sm-7">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php endwhile; ?>
			<div class="navigation">
				<div class="next-posts"><?php next_posts_link(); ?></div>
				<div class="prev-posts"><?php previous_posts_link(); ?></div>
			</div>
			<?php wp_reset_query(); ?>
		<?php else : ?>

			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<h1>Not Found</h1>
			</div>

		<?php endif; ?>
		<?php }


	protected function content_template() {}

	public function render_plain_content() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Blog_Post );
Plugin::instance()->frontend->init();
