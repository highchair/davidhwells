<?php
/**
 * David H Wells functions and definitions
 */


if ( ! function_exists( 'davidhwells_setup' ) ) :
function davidhwells_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

  /*
	 * Enable support for Post Thumbnails on posts and pages.
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 800, 450, true ); // 16:9 ratio.
  add_image_size('progression-gallery-index', 700, 1200, false);
	add_image_size('progression-gallery-single', 1200, 1800, false);
	add_image_size('progression-gallery-single-thumb', 200, 126, false);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
  /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	
	/*
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );
	add_post_type_support( 'portfolio', 'post-formats' );
	
	/*
	 * This theme uses wp_nav_menu() in two locations
	 */
  if (function_exists('register_nav_menu')) {
    register_nav_menus(
      array(
        'primary' => 'Primary Menu',
        'social' => 'Social Media menu'
      )
    );
  }
}
endif; // davidhwells_setup
add_action( 'after_setup_theme', 'davidhwells_setup' );


// Register Sidebars
function davidhwells_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Single Post', 'davidhwells' ),
		'id'            => 'sidebar-single-post',
		'description'   => 'Add widgets here to appear in your sidebar for single blog posts',
		'before_widget' => '<div id="%1$s" class="widget widget__sidebar widget__sidebar-single-post %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="dw-sidebar--title widget--title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Sidebar Archives', 'davidhwells' ),
		'id'            => 'sidebar-archives',
		'description'   => 'Add widgets here to appear in your sidebar for the blog landing page and category pages',
		'before_widget' => '<div id="%1$s" class="widget widget__sidebar widget__sidebar-archives %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="dw-sidebar--title widget--title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'davidhwells' ),
		'id'            => 'sidebar-page',
		'description'   => 'Add widgets here to appear in your sidebar for any page',
		'before_widget' => '<div id="%1$s" class="widget widget__sidebar widget__sidebar-page %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="dw-sidebar--title widget--title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'davidhwells_widgets_init' );


if ( ! function_exists( 'davidhwells_posted_on' ) ) :
  /* Prints HTML with meta information for the current post-date/time and author */
  function davidhwells_posted_on() {
  	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>' ),
  		esc_url( get_month_link(get_the_time('Y'), get_the_time('m')) ),
  		esc_attr( get_the_time() ),
  		esc_attr( get_the_date( 'c' ) ),
  		esc_html( get_the_date() ),
  		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
  		esc_attr( sprintf( __( 'View all posts by %s', 'progression' ), get_the_author() ) ),
  		esc_html( get_the_author() )
  	);
  }
endif;


// Add query strings to the oEmbed URL from Vimeo sources
function davidhwells_vimeo_args($provider, $url, $args) {
  if ( strpos($provider, '//vimeo.com/') !== false ) {
    $args = array(
      'title' => 0,
      'byline' => 0,
      'portrait' => 0,
      'badge' => 0
    );
    $provider = add_query_arg( $args, $provider );
  }
  return $provider;   
}
add_filter('oembed_fetch_url','davidhwells_vimeo_args', 10, 3);


// Show child pages with a Shortcode
function dw_list_child_pages() { 
  global $post; 

  if ( is_page() && $post->post_parent ) {
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  } else {
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
  }

  if ( $childpages ) {
  	$string = '<ul class="dw--nav--child-pages">' . $childpages . '</ul>';
  }
  return $string;
}
add_shortcode('dw_childpages', 'dw_list_child_pages');


/* - - - - - Mostly unchanged under here. Simplified. 

  Based on Progression theme Zyra
  Removed the core set up function
  Removed a WooCommerce function
  
  - - - - - */



/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */

//if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */

	
//function progression_setup() {
//
//	// Post Thumbnails	
//	add_image_size('progression-blog', 900, 470, true); // Blog Index
//	add_image_size('progression-gallery-index', 700, 1200, false); // Masonry Gallery Image Size
//	add_image_size('progression-gallery-single', 1200, 1800, false); // Single Post Image (Gallery Full Size non-cropping)
//	add_image_size('progression-gallery-single-thumb', 200, 126, false); // Single Post Thumbnail on Gallery
//	add_image_size('progression-gallery-related', 600, 450, true); // Masonary Gallery Cropped Image
//	
//	add_theme_support( 'title-tag' );
//	
//	/**
//	 * Make theme available for translation
//	 * Translations can be filed in the /languages/ directory
//	 * If you're building a theme based on progression, use a find and replace
//	 * to change 'progression' to the name of your theme in all the template files
//	 */
//	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );
//
//	/**
//	 * Add default posts and comments RSS feed links to head
//	 */
//	add_theme_support( 'automatic-feed-links' );
//	
//	// Include widgets
//	//require( get_template_directory() . '/widgets/widgets.php' );
//	
//	/**
//	 * Enable support for Post Formats
//	 */
//	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );
//	add_post_type_support( 'portfolio', 'post-formats' );
//	
//	/**
//	 * This theme uses wp_nav_menu() in one location.
//	 */
//	register_nav_menus( array(
//		'primary' => __( 'Primary Menu', 'progression' ),
//	) );
//	
//}
//endif; // progression_setup
//add_action( 'after_setup_theme', 'progression_setup' );



function progression_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "<p>To view this protected post, enter the password below:</p>", "progression") . '
    <label for="' . $label . '">' . __( "Password: ", "progression" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="password-protected-pro" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" id="submit-pro" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'progression_password_form' );


/**
 * Registering Custom Post Type
 */
add_action('init', 'progression_portfolio_init');
function progression_portfolio_init() {
	register_post_type(
		'portfolio',
		array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio Item'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio'),
			'supports' => array('title', 'editor', 'thumbnail', 'comments'),
			'can_export' => true,
			'menu_position' => 4,
			'menu_icon' => 'dashicons-portfolio',
		)
	);

	register_taxonomy(
	  'portfolio-category',
	  'portfolio',
	  array(
	    'hierarchical' => true,
	    'label' => 'Portfolio Categories',
	    'query_var' => true,
	    'rewrite' => true
    )
  );
}



/* custom portfolio posts per page
function progression_post_queries( $query ) {
	
	$portfolio_count = get_theme_mod('portfolio_posts_page_pro');
	
	if ($query->is_main_query()){
	
  	if(is_tax( 'portfolio-category' )) {
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', $portfolio_count);
    }
	}
	
	if(is_post_type_archive( 'portfolio' )){
      $query->set('posts_per_page', $portfolio_count);
	}
}
add_action( 'pre_get_posts', 'progression_post_queries' ); */



/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'davidhwells-style', get_stylesheet_uri() );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Amatic+SC', array( 'davidhwells-style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );


add_action( 'wp_print_styles', 'progression_deregister_styles', 100 );
function progression_deregister_styles() {
	wp_deregister_style( 'wpba_front_end_styles' );
}


/*function pro_mobile_menu_insert()
{
    ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		'use strict';

	<?php if( is_page_template('page-about.php') ): global $post; ?><?php if(has_post_thumbnail()): ?>
		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), ''); ?>	
		$("#about-me-content-bg").backstretch([ "<?php echo esc_attr($image[0]);?>" ],{ fade: 750, centeredY:true }); 
	<?php endif ?><?php endif ?>
	
	<?php if( is_page_template('homepage.php') ): ?>
		
		//var $container = $('#gallery-masonry').masonry();
		// layout Masonry again after all images have loaded
		//$container.imagesLoaded( function() {
		//	$(".gallery-item-pro").addClass('opacity-pro');
		//	$container.masonry({
	 	//  		itemSelector: '.gallery-item-pro',
		//		columnWidth: function() { return this.size.innerWidth / <?php echo get_theme_mod('column_count_home_pro', '3'); ?>; }
	 	//	});
		//});
		
		// Begin Infinite Scroll
		$container.infinitescroll({
			errorCallback: function(){  $('#infinite-nav-pro').delay(500).fadeOut(500, function(){ $(this).remove(); }); },
		  navSelector  : '#infinite-nav-pro',    // selector for the paged navigation 
		  nextSelector : '.nav-previous a',  // selector for the NEXT link (to page 2)
		  itemSelector : '.gallery-item-pro',     // selector for all items you'll retrieve
	   		loading: {
	   		 	img: '<?php echo esc_url( get_template_directory_uri() );?>/images/loader.gif',
	   			 msgText: "",
	   		 	finishedMsg: "<div id='no-more-posts'><?php _e( "No more posts", "progression" ); ?></div>",
	   		 	speed: 0, }
		},
		  // trigger Masonry as a callback
		  function( newElements ) {
			  
		    var $newElems = $( newElements );
			
		    $('.gallery-progression').flexslider({
				animation: "fade",      
				slideDirection: "horizontal", 
				slideshow: false,         
				slideshowSpeed: 7000,  
				animationDuration: 200,        
				directionNav: true,             
				controlNav: true
		    });
			
			$(".gallery-video-pro").fitVids();
			//$newElems.imagesLoaded(function(){
			//	$(".gallery-item-pro").addClass('opacity-pro');
			//    $container.masonry( 'appended', $newElems );
			//});
		  }
		);
		
		<?php if (get_theme_mod( 'gallery_paginaton_pro_2', 'gal_infinite_pagination_pro' ) == 'gal_infinite_pagination_pro') : ?>
		// Pause Infinite Scroll
		$(window).unbind('.infscr');
		// Resume Infinite Scroll
		$('.nav-previous a').click(function(){
			$container.infinitescroll('retrieve');
			return false;
		});
		// End Infinite Scroll
		<?php endif; ?>
		
	   // Adding column size fix
	    //Masonry.prototype._getMeasurement = function (measurement, size) {
	    //    var option = this.options[measurement];
	    //    var elem;
	    //    if (!option) {
	    //        this[measurement] = 0;
	    //    } else if (typeof option === 'function') {
	    //        this[measurement] = option.call(this);
	    //    } else {
	    //        if (typeof option === 'string') {
	    //            elem = this.element.querySelector(option);
	    //        } else if (isElement(option)) {
	    //            elem = option;
	    //        }
	    //        this[measurement] = elem ? getSize(elem)[size] : option;
	    //    }
	    //};
	    // End Adding columnWidth: function() { return this.size.innerWidth / 3; } Size Fix
	<?php endif ?>
		
	<?php if( is_tax('gallery-category')): ?>
		
		// Default Masonry Load Code
		//var $container = $('#gallery-masonry').masonry();
		// layout Masonry again after all images have loaded
		//$container.imagesLoaded( function() {
		//	$(".gallery-item-pro").addClass('opacity-pro');
		//	$container.masonry({
	 	//  		itemSelector: '.gallery-item-pro',
		//		columnWidth: function() { return this.size.innerWidth / <?php echo get_theme_mod('portfolio_col_progression', '3'); ?>; }
	 	//	});
		//});
		// END Default Masonry Load Code
		
		// Begin Infinite Scroll
		$container.infinitescroll({
			errorCallback: function(){  $('#infinite-nav-pro').delay(500).fadeOut(500, function(){ $(this).remove(); }); },
		  navSelector  : '#infinite-nav-pro',    // selector for the paged navigation 
		  nextSelector : '.nav-previous a',  // selector for the NEXT link (to page 2)
		  itemSelector : '.gallery-item-pro',     // selector for all items you'll retrieve
	   		loading: {
	   		 	img: '<?php echo esc_url( get_template_directory_uri() );?>/images/loader.gif',
	   			 msgText: "",
	   		 	finishedMsg: "<div id='no-more-posts'><?php _e( "No more posts", "progression" ); ?></div>",
	   		 	speed: 0, }
		  },
		  // trigger Masonry as a callback
		  function( newElements ) {
			  
		    var $newElems = $( newElements );
			
		    $('.gallery-progression').flexslider({
				animation: "fade",      
				slideDirection: "horizontal", 
				slideshow: false,         
				slideshowSpeed: 7000,  
				animationDuration: 200,        
				directionNav: true,             
				controlNav: true
		    });
			
			$(".gallery-video-pro").fitVids();
			//$newElems.imagesLoaded(function(){
			//	$(".gallery-item-pro").addClass('opacity-pro');
			//    $container.masonry( 'appended', $newElems );
			//});
		  }
		);
		
		<?php if (get_theme_mod( 'gallery_paginaton_pro_2', 'gal_infinite_pagination_pro' ) == 'gal_infinite_pagination_pro') : ?>
		// Pause Infinite Scroll
		$(window).unbind('.infscr');
		// Resume Infinite Scroll
		$('.nav-previous a').click(function(){
			$container.infinitescroll('retrieve');
			return false;
		});
		// End Infinite Scroll
		<?php endif; ?>
		
	   // Adding column size fix
	    //Masonry.prototype._getMeasurement = function (measurement, size) {
	    //    var option = this.options[measurement];
	    //    var elem;
	    //    if (!option) {
	    //        this[measurement] = 0;
	    //    } else if (typeof option === 'function') {
	    //        this[measurement] = option.call(this);
	    //    } else {
	    //        if (typeof option === 'string') {
	    //            elem = this.element.querySelector(option);
	    //        } else if (isElement(option)) {
	    //            elem = option;
	    //        }
	    //        this[measurement] = elem ? getSize(elem)[size] : option;
	    //    }
	    //};
	    // End Adding columnWidth: function() { return this.size.innerWidth / 3; } Size Fix
	<?php endif ?>
		
	<?php if( is_home() ): ?>
	    $('#infinite-pro').infinitescroll({
			errorCallback: function(){  $('#infinite-nav-pro').delay(500).fadeOut(500, function(){ $(this).remove(); }); },
		  navSelector  : '#infinite-nav-pro',    // selector for the paged navigation 
		  nextSelector : '.nav-previous a',  // selector for the NEXT link (to page 2)
		  itemSelector : '.infinite-container',     // selector for all items you'll retrieve
	   		loading: {
	   		 	img: '<?php echo esc_url( get_template_directory_uri() );?>/images/loader.gif',
	   			 msgText: "",
	   		 	finishedMsg: "<div id='no-more-posts'><?php _e( "No more posts", "progression" ); ?></div>",
	   		 	speed: 0, }
		  },
	       // trigger callback
   	         function( newElements ) {
   	   	   	 $(".container-blog").fitVids();
		     $('.gallery-progression').flexslider({
		 		animation: "fade",      
		 		slideDirection: "horizontal", 
		 		slideshow: false,         
		 		slideshowSpeed: 7000,  
		 		animationDuration: 200,        
		 		directionNav: true,             
		 		controlNav: true
		     });   
   	         }
   	       );
 		  <?php if (get_theme_mod( 'blog_pagination_pro') == 'infinite_pagination_pro') : ?>
 	      // Load More Button Code
 	      $(window).unbind('.infscr');
 	      jQuery("#infinite-nav-pro a").click(function(){
 	          jQuery('#infinite-pro').infinitescroll('retrieve');
 	              return false;
 	      });	
   	   	$(document).ajaxError(function(e,xhr,opt){ if (xhr.status == 404) $('#infinite-nav-pro a').remove();	});
 	   	// End Load More Button
 		<?php endif; ?>
	<?php endif ?>
		
	});
	</script>
    <?php
}
add_action('wp_footer', 'pro_mobile_menu_insert');*/

/*
	MetaBox Options from Dev7studios
*/
require get_template_directory() . '/inc/dev7_meta_box_framework.php';
require get_template_directory() . '/inc/custom-fields.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Plugin Activiation
 */
require get_template_directory() . '/tgm-plugin-activation/plugin-activation.php';

// Customize the Admin
require get_template_directory() . '/inc/admin.php';

// Add our custom Widgets
require get_template_directory() . '/inc/widgets.php';
