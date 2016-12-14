<?php
/**
 * Plugin Name: Extend Elementor
 * Description: Custom elements added to Elementor
 * Plugin URI:
 * Version: 0.0.10
 * Author: Chad Bartels
 * Author URI: http://www.bluebeandev.com
 * Text Domain: extend-elementor
 */
if ( ! defined( 'ABSPATH' ) ) exit;
// This file is pretty much a boilerplate WordPress plugin.
// It does very little except including wp-widget.php
class ExtendElementor {
	private static $instance = null;
	public static function get_instance() {
		if ( ! self::$instance )
			self::$instance = new self;
		return self::$instance;
	}
	public function init(){
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
	}
	public function widgets_registered() {
		// We check if the Elementor plugin has been installed / activated.
		if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){
			// We look for any theme overrides for this custom Elementor element.
			// If no theme overrides are found we use the default one in this plugin.
			$widget_simple_card = 'plugins/elementor/widget-simple-card.php';
			$widget_basic_card = 'plugins/elementor/widget-basic-card.php';
			$widget_icon_card = 'plugins/elementor/widget-icon-card.php';
			// $widget_blog_post = 'plugins/elementor/widget-blog-post.php';
			$widget_email_form = 'plugins/elementor/widget-email-form.php';
			$widget_single_post = 'plugins/elementor/widget-single-post.php';

			$template_file_1 = locate_template($widget_simple_card);
			if ( !$template_file_1 || !is_readable( $template_file_1 ) ) {
				$template_file_1 = plugin_dir_path(__FILE__).'widget-simple-card.php';
			}
			if ( $template_file_1 && is_readable( $template_file_1 ) ) {
				require_once $template_file_1;
			}

			$template_file_2 = locate_template($widget_basic_card);
			if ( !$template_file_2 || !is_readable( $template_file_2 ) ) {
				$template_file_2 = plugin_dir_path(__FILE__).'widget-basic-card.php';
			}
			if ( $template_file_2 && is_readable( $template_file_2 ) ) {
				require_once $template_file_2;
			}

			$template_file_3 = locate_template($widget_blog_post);
			if ( !$template_file_3 || !is_readable( $template_file_3 ) ) {
				$template_file_3 = plugin_dir_path(__FILE__).'widget-blog-post.php';
			}
			if ( $template_file_3 && is_readable( $template_file_3 ) ) {
				require_once $template_file_3;
			}

			$template_file_4 = locate_template($widget_email_form);
			if ( !$template_file_4 || !is_readable( $template_file_4 ) ) {
				$template_file_4 = plugin_dir_path(__FILE__).'widget-email-form.php';
			}
			if ( $template_file_4 && is_readable( $template_file_4 ) ) {
				require_once $template_file_4;
			}

			$template_file_5 = locate_template($widget_icon_card);
			if ( !$template_file_5 || !is_readable( $template_file_5 ) ) {
				$template_file_5 = plugin_dir_path(__FILE__).'widget-icon-card.php';
			}
			if ( $template_file_5 && is_readable( $template_file_5 ) ) {
				require_once $template_file_5;
			}

			$template_file_6 = locate_template($widget_single_post);
			if ( !$template_file_6 || !is_readable( $template_file_6 ) ) {
				$template_file_6 = plugin_dir_path(__FILE__).'widget-single-post.php';
			}
			if ( $template_file_6 && is_readable( $template_file_6 ) ) {
				require_once $template_file_6;
			}
		}
	}
}
ExtendElementor::get_instance()->init();
