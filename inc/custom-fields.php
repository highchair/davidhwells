<?php
function add_custom_meta_boxes() {
    $meta_box = array(
        'id'         => 'progression_page_settings', // Meta box ID
        'title'      => __('Page Settings', 'progression'), // Meta box title
        'pages'      => array('page'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_slider',
                'name' => __('Homepage Slider: Insert Slider Shortcode', 'progression'),
                'desc' => __('<br>Copy/paste in your slider shortcode.', 'progression'),
                'type' => 'text',
                'std' => ''
			),
            array(
                'id' => 'progression_gallery_home',
                'name' => __('Homepage Gallery: Add a Gallery on Homepage', 'progression'),
                'desc' => __('<br>Add-in the gallery title that you would like to use on the homepage.', 'progression'),
                'type' => 'text',
                'std' => ''
			),
            array(
                'id' => 'progression_home_category_slug',
                'name' => __('Homepage Posts: Add Latest Gallery Posts on Homepage', 'progression'),
                'desc' => __('<br>Add-in the gallery category that you would like to use on the homepage.  Add-in multiple categories seperated by a comma to use multiple categories. (Leave blank to pull in all portfolio posts).', 'progression'),
                'type' => 'text',
                'std' => ''
			),
            array(
                'id' => 'progression_map',
                'name' => __('Contact Form Shortcode', 'progression'),
                'desc' => __('<br>Add-in your map shortcode to display a large map.', 'progression'),
                'type' => 'text',
                'std' => ''
			)
        )
    );
    dev7_add_meta_box( $meta_box );
	
	
    $meta_box5 = array(
        'id'         => 'progression_post_settings2', // Meta box ID
        'title'      => __('Post Settings', 'progression'), // Meta box title
        'pages'      => array('portfolio'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
			array(
				'id' => 'checkboxes',
                'name' => __('Gallery Settings', 'progression'),
                'desc' => __('', 'progression'),
				'type' => 'checkboxes',
				'std' => '',
				'choices' => array(
					'progression_disable_content' => 'Hide Content/Related Works/Footer (Display Gallery Only)',
					'progression_disable_gallery' => 'Hide Gallery at top (Display Content/Related Works/Footer Only)',
					'progression_thumb_gallery' => 'Remove Thumbnail Navigation (Set this option globally under Appearance > Customizer)',
					'progression_croppp_gallery' => 'Uncrop images (Set this option globally under Appearance > Customizer)'
				)
			),
            array(
                'id' => 'progression_media_embed',
                'name' => __('Video Link (Youtube/Vimeo)', 'progression'),
                'desc' => __('<br>Paste in your video embed code here', 'progression'),
                'type' => 'text',
                'std' => ''
            ),
            array(
                'id' => 'progression_external_link',
                'name' => __('External Link on Portfolio Index (Override Post Link)', 'progression'),
                'desc' => __('<br>Make your post link to another page', 'progression'),
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box5 );
	
	
	
    $meta_box2 = array(
        'id'         => 'progression_post_settings', // Meta box ID
        'title'      => __('Post Settings', 'progression'), // Meta box title
        'pages'      => array('post'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_media_embed',
                'name' => __('Audio/Video Embed', 'progression'),
                'desc' => __('<br>Paste in your video embed code here', 'progression'),
                'type' => 'textarea',
                'std' => ''
            ),
            array(
                'id' => 'progression_external_link',
                'name' => __('External Link', 'progression'),
                'desc' => __('<br>Make your post link to another page', 'progression'),
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box2 );
	
}
add_action( 'dev7_meta_boxes', 'add_custom_meta_boxes' );
?>