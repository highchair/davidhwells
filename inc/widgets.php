<?php
  
// Creating the widget 
class dw_craftsy_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      // Base ID of your widget
      'dw_craftsy', 

      // Widget name will appear in UI
      __('Craftsy Widget', 'wpb_widget_domain'), 

      // Widget description
      array( 'description' => __( 'Add a Craftsy Instructor badge', 'wpb_widget_domain' ), )
    );
  }

  // Creating widget front-end
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $craftsy_url = $instance['craftsy_url'];
    
    // before and after widget arguments are defined by themes
    echo $args['before_widget'];

    echo '<div class="dw_craftsy">';
    echo '<div class="dw_craftsy--logo"><img src="'.get_template_directory_uri().'/images/craftsy_logo.png" alt="Craftsy"></div>';
    echo '<div class="dw_craftsy--content"><p>'.$title.'</p>';
    echo '<div class="dw_craftsy--action"><a class="button button--primary" href="'.$craftsy_url.'">Visit Craftsy</a></div>';
    echo '</div></div>';
    
    echo $args['after_widget'];
  }
		
  // Widget Backend 
  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    } else {
      $title = __( 'I&rsquo;m a Craftsy Instructor', 'wpb_widget_domain' );
    }

    // Widget admin form
    if ( isset( $instance[ 'craftsy_url' ] ) ) {
      $craftsy_url = $instance[ 'craftsy_url' ];
    } else {
      $craftsy_url = __( 'Enter your full Craftsy URL', 'wpb_widget_domain' );
    }
  ?>
  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
  </p>
  <p>
    <label for="<?php echo $this->get_field_id( 'craftsy_url' ); ?>"><?php _e( 'Craftsy URL:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'craftsy_url' ); ?>" name="<?php echo $this->get_field_name( 'craftsy_url' ); ?>" type="text" value="<?php echo esc_attr( $craftsy_url ); ?>">
  </p>
  <?php 
  }
	
  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['craftsy_url'] = ( ! empty( $new_instance['craftsy_url'] ) ) ? urlencode( strip_tags( $new_instance['craftsy_url'] ) ) : '';
    return $instance;
  }
} // End dw_craftsy_widget


// Register and load the widgets
function wpb_load_widget() {
	register_widget( 'dw_craftsy_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

?>