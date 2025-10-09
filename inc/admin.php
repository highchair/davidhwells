<?php
  
function dw_remove_dashboard_widgets() {
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   // Right Now
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Recent Comments
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );  // Incoming Links
  //remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );   // Plugins
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );  // Quick Press
  //remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );  // Recent Drafts
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );   // WordPress blog
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );   // Other WordPress News
  // use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.
}
add_action( 'wp_dashboard_setup', 'dw_remove_dashboard_widgets' );


function dw_register_instructions_widget() {
	global $wp_meta_boxes;
	
	wp_add_dashboard_widget(
		'dw_dashboard_instructions',
		'DavidHWells.com Instructions',
		'dw_dashboard_instructions_display'
	);
	
	$dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

	$my_widget = array( 'dw_dashboard_instructions' => $dashboard['dw_dashboard_instructions'] );
 	unset( $dashboard['dw_dashboard_instructions'] );

 	$sorted_dashboard = array_merge( $my_widget, $dashboard );
 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

function dw_dashboard_instructions_display() {
?>
  <p>This custom theme for DavidHWells.com will function like WordPress for most things. <b><a href="/wp-admin/edit.php">Posts</a></b> are still blog posts in the normal way, and so are <b><a href="/wp-admin/edit.php?post_type=page">Pages</a></b>.</p>
  <p>For this theme, however, there are some important things to remember:</p>
  <h2>Get started with a new Portfolio post</h2>
  <p><b><a href="/wp-admin/edit.php?post_type=portfolio">Portfolio</a></b> is the post type for the portfolio. Add new portfolio items and organize them with the custom Post Formats. <b>WP Better Attachments</b> is used (bottom of the main column) to organize the individual images in each gallery. Featured images can be applied as normal. </p>
<?php
}

add_action( 'wp_dashboard_setup', 'dw_register_instructions_widget' );
