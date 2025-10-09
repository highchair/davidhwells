<?php
  // Custom blog landing page
  // Set the homepage in Settings > Reading to be a page called "Home"
  // The template "front-page.php" will be used
  // Set the posts page to a page called "Blog" or similar
  // This page will use the home.php or index.php templates

  get_header();

  // Copy of Archive.php
  if ( have_posts() ) {
?>
		<section id="main" class="content">
			<div class="container">
        <div class="column--row column--default">

        <?php
        /* Removed for a fatal error February 2023:
          Uncaught Error: Undefined constant "SERVER_NAME" in /home/dh_adceba/davidhwells.com/wp-content/themes/davidhwells/home.php:18
          
          $haystack = $_SERVER[SERVER_NAME];
          $needle   = 'thewellspoint';
          $pos = strpos($haystack, $needle);
          if ( $pos == true) { */ ?>
        <!--<div class="referrer-notice">
          <h3>The WellsPoint is now DavidHWells.com/blog/. Please update your bookmarks accordingly.</h3>
        </div>-->
        <?php //} ?>
        <?php
          //print_r($haystack);
          //echo '</br></br>';
          //print_r($_SERVER)
        ?>

          <header class="dw-archive--header">
            <h1 class="dw-archive--title">Recent Blog Posts</h1>
    			</header>
    			<div class="column--main">
		<?php
			while ( have_posts() ) : the_post(); // Start the Loop.
    ?>

            <article class="dw-archive--post">
              <div class="dw-archive--post--featimage">
              <?php
                if ( has_post_thumbnail() ) {
                  echo '<a href="'.esc_url( get_permalink() ).'" rel="bookmark">';
                  the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
                  echo '</a>';
                }
              ?>
              </div>
              <div class="dw-archive--post--content">
            		<?php
            			the_title( sprintf( '<h2 class="dw-archive--post--title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            			the_content( sprintf(
            				'Read More',
            				the_title( '<span class="screen-reader-text">', '</span>', false )
            			) );
            		?>
            	</div>
              <ul class="dw-post--meta">
          			<li class="dw-single--meta--date"><i class="fa fa-calendar"></i><?php davidhwells_posted_on(); ?></li>
            		<?php //the_tags( '<li class="dw-single--meta--tags"><i class="fa fa-tag"></i>', ', ', '</li>' ); ?> 
          		</ul>
            </article>
			
    <?php
			endwhile; // End the loop.

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => 'Previous',
				'next_text'          => 'Next',
				'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>',
			) );

	// If no content...
	} else {
			
			echo '<h1 class="dw-archive--title">No posts found</h1>';

	} // end if ( have_posts() )
?>

        </div>
<?php
  if ( is_active_sidebar( 'sidebar-archives' ) ) {
      echo '<aside class="dw-sidebar dw-sidebar__archive column--complementary">';
      dynamic_sidebar( 'sidebar-archives' );
      echo '</aside>';
  } ?>
        
      </div>
    </section>
<?php
  get_footer();
?>