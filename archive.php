<?php
  get_header();
  
  if ( have_posts() ) {
?>
		<section id="main" class="content">
			<div class="container">
        <div class="column--row column--default">
          <header class="dw-archive--header">
    				<?php
    					the_archive_title( '<h1 class="dw-archive--title">', '</h1>' );
    					the_archive_description( '<div class="dw-archive--taxonomy-description">', '</div>' );
    				?>
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
