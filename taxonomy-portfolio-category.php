<?php
  get_header();
  
  if ( have_posts() ) {
    
    $found_posts = $wp_the_query->post_count;
    $grid_layout = 'card__duo';
    if ($found_posts == 3 or $found_posts >= 6) {
      $grid_layout = 'card__trio';
    }
?>

    <section id="main" class="content">
			<div class="container">
				<article class="content--main">
					<header class="dw-archive--header">
    				<?php
      				// the_archive_title() in this instance returns "Portfolio Category: [Taxonomy Term Name]"
      				// So we use the code below to simplify the output
      				
      				echo '<h1 class="dw-archive--title">';
      				single_cat_title('');
      				echo '</h1>';
    				?>
    			</header>
					<div class="card--grid <?php echo $grid_layout ?>">
    <?php
			while ( have_posts() ) : the_post(); // Start the Loop.
    ?>

            <div id="num-<?php echo $counter ?>" class="card<?php if( has_post_format( 'video' ) ): ?> card__video<?php endif; ?>">
							<a href="<?php the_permalink(); ?>" class="card--link" title="<?php the_title(); ?>">
								<span class="card--overlay">
									<h2 class="card--title"><?php the_title(); ?></h2>
								</span>
								<span class="card--img-wrapper">
									<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title(), 'class' => 'card--img' ) ); ?>
								</span>
							</a>
						</div>
			
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

          </div><?php // end .card--grid ?>
        </article>
      </div><?php // end .container ?>
    </section>
<?php
  get_footer();
?>
