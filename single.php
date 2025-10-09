<?php

  get_header();
  
  // Start the loop.
	while ( have_posts() ) : 
	  the_post();
	  
	  $comment_count = get_comments_number();
?>

		<section id="main" class="content">
			
			<?php 
        if ( isset($_SERVER['SERVER_NAME']) ) {
          $haystack = $_SERVER['SERVER_NAME'];
          $needle   = 'thewellspoint';
          $pos = strpos($haystack, $needle);
          if ( $pos == true) { ?>
      <div class="referrer-notice">
        <h3>The WellsPoint is now DavidHWells.com/blog/. Please update your bookmarks accordingly.</h3>
      </div>
      <?php }
      } ?>
      <!--
        <?php
        //print_r($haystack);
        //echo '</br></br>';
        //print_r($_SERVER)
        ?>
      -->
			
			<div class="container">
        <div class="column--row column--default">
          
          <article id="post-<?php the_ID(); ?>" <?php post_class('column--main dw-single'); ?>>
            <?php
              if ( has_post_thumbnail() ) {
                echo '<div class="dw-single--featimage">' . the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ) . '</div>';
              }
            ?>
            <header class="dw-single--header">
              <?php the_title( '<h1 class="dw-single--title">', '</h1>' ); ?>
              <ul class="dw-post--meta dw-single--meta__top">
          			<li class="dw-single--meta--category"><i class="fa fa-folder-open"></i><?php the_category(', '); ?></li>
          			<?php if ( comments_open() && $comment_count > 0 ) { ?>
          			<li class="dw-single--meta--comment-count"><i class="fa fa-comments"></i><?php comments_popup_link( 'No responses', _x( '1 Response', 'comments number', 'progression' ), _x( '% Responses', 'comments number', 'progression' ) ); ?></li>
          			<?php } ?>
          		</ul>
        		</header>
  	
          	<div class="dw-single--content typography">
          	  <?php the_content(); ?>
          	  
          	  <?php edit_post_link( 'Edit this Post', '<p class="admin--edit">', '</p>', 'admin--edit--link' ); ?>
          	</div>
          	
          	<footer class="dw-single--footer">
            	<ul class="dw-post--meta dw-single--meta__top">
          			<li class="dw-single--meta--author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></li>
          			<li class="dw-single--meta--date"><i class="fa fa-calendar"></i><?php davidhwells_posted_on(); ?></li>
            		<?php the_tags( '<li class="dw-single--meta--tags"><i class="fa fa-tag"></i>', ', ', '</li>' ); ?> 
          		</ul>
<?php 
  // Previous/next post navigation.
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav" aria-hidden="true">Next</span> ' .
			'<span class="screen-reader-text">Next post: </span> ' .
			'<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav" aria-hidden="true">Previous</span> ' .
			'<span class="screen-reader-text">Previous post:</span> ' .
			'<span class="post-title">%title</span>',
	) );
?>

            </footer>
<?php
  // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		echo '<div class="dw-comments">';
		comments_template();
		echo '</div>';
	endif;
?>

          </article>

<?php
  if ( is_active_sidebar( 'sidebar-single-post' ) ) {
      echo '<aside class="dw-sidebar dw-sidebar__single-post column--complementary">';
      dynamic_sidebar( 'sidebar-single-post' );
      echo '</aside>';
  }
?>
  
        </div>
      </div>
    </section>

<?php
	// End the loop.
	endwhile;
  		
  get_footer();
?>
