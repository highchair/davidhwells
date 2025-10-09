<?php
/**
 * progression Theme Customizer
 *
 * @package progression
 */


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function progression_customize_preview_js() {
	wp_enqueue_script( 'progression_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'progression_customize_preview_js' );



/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function progression_customizer( $wp_customize ) {
	
	// Adds abaillity to add text area
	if ( class_exists( 'WP_Customize_Control' ) ) { 
		# Adds textarea support to the theme customizer 
		class ProgressionTextAreaControl extends WP_Customize_Control { 
			public $type = 'textarea'; 
			public function __construct( $manager, $id, $args = array() ) { 
				$this->statuses = array( '' => __( 'Default', 'progression' ) ); 
				parent::__construct( $manager, $id, $args ); 
			}   
			
			public function render_content() { 
				echo '<label> 
				<span class="customize-control-title">' . esc_html( $this->label ) . '</span> 
				<textarea rows="5" style="width:100%;" '; $this->link(); echo '>' . esc_textarea( $this->value() ) . '</textarea> 
				</label>'; } 
			}   
		}
		
//Add Section Page of Theme Settings
    $wp_customize->add_section(
        'options_panel_progression',
        array(
            'title' => __('Theme Settings', 'progression'),
            'description' => __('Main Theme Settings', 'progression'),
            'priority' => 70,
        )
    );

	
	//Comment Options
	$wp_customize->add_setting( 
		'comment_progression',
		array (
		'sanitize_callback' => 'progression_sanitize_text',
		)
	);
	$wp_customize->add_control(
   'comment_progression',
   	array(
	   	'label' => __('Display comments for pages?', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'comment_progression',
			'type' => 'checkbox',
			'priority'   => 34,
	    )
	);
	
	//Comment Options
	$wp_customize->add_setting( 
		'sidebar_progression_hide',
		array (
		'sanitize_callback' => 'progression_sanitize_text',
		)
	);
	$wp_customize->add_control(
   'sidebar_progression_hide',
   	array(
	   	'label' => __('Hide Sidebar by Default?', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'sidebar_progression_hide',
			'type' => 'checkbox',
			'priority'   => 35,
	    )
	);
}
add_action( 'customize_register', 'progression_customizer' );

function progression_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
