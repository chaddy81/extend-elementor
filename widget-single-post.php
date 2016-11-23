<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Single_Post extends Widget_Base {

  public function get_name() {
    return 'single-post';
  }

  public function get_title() {
    return __( 'Single Post', 'extend-elementor' );
  }

  public function get_icon() {
    return 'post';
  }

  public function get_published_posts() {
    $args = array(
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => 'post',
      'post_status'      => 'publish',
      'suppress_filters' => true 
    );

    $posts_array = get_posts( $args );
    $posts = [''];
    foreach($posts_array as $post) {
      array_push($posts, $post->post_title);
    }
    return $posts;
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
      'single_post',
      [
        'label' => __( 'Select Post to Display', 'extend-elementor' ),
        'type' => Controls_Manager::SELECT,
        'default' => null,
        'section' => 'section_content_tab',
        'options' => $this->get_published_posts()       
      ]
    );

  }

  protected function render() {
    global $post;

    $settings = $this->get_settings();
    $id = ! empty ( $settings['single_post'] ) ? $settings['single_post'] : ' No post selected ';
    $post_id = get_page_by_title( $this->get_published_posts()[$id], null, 'post' )->ID;
    $args = array(
        'p' => $post_id
    );
    $query = get_posts( $args );
    // $query = new \WP_Query( $args );
    ?>
  
    <?php if($id > 0) : ?>
      <?php foreach($query as $post) : setup_postdata($post); ?>
        <div id="primary" class="content-area">
          <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php first_header_meta(); ?>
                <?php if ( has_post_thumbnail() ): ?>
                <div class="post-thumbnail"><?php the_post_thumbnail(); ?></div>
                <?php endif; ?>
              </header><!-- .entry-header -->

              <div class="entry-content">
                <?php echo $post->post_content; ?>
              </div><!-- .entry-content -->

              <?php first_footer_meta(); ?>
            </article><!-- #post-## -->

            <?php
              // If comments are open or we have at least one comment, load up the comment template
              if ( comments_open() || '0' != get_comments_number() ) :
                comments_template();
              endif;
            ?>
          </main><!-- #main -->
        </div><!-- #primary -->
      <?php endforeach; ?>
    <?php else : ?>
      <h4>No Post Selected </h4>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <?php }


  protected function content_template() {}

  public function render_plain_content() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Single_Post );
Plugin::instance()->frontend->init();
