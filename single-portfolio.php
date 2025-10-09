<?php

  get_header();
  
  // Start the loop.
	while ( have_posts() ) :
	  the_post();
?>

		<section id="main" class="content">
<?php
    if( has_post_format( 'video' ) ) { ?>
      <div class="dw-gallery--wrapper dw-gallery--wrapper__video">
        <div class="gallery-video-pro dw-gallery--video">
          <div class="embed-container">
            <?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_media_embed', true)); ?>
          </div>
        </div>
      </div>
<?php
    } else {
  
      // Start the gallery using Fotorama. 
      // No initialization script, just data attributes and a class name
      // Documentation: http://fotorama.io/customize/
      
      if (get_post_meta($post->ID, 'checkboxes_progression_disable_gallery', true)) {
      } else {
        $gallery_dots_nav_pro = (get_theme_mod( 'gallery_dots_nav_pro')) ? ' dot-navigation-pro' : '';
        $gallery_data_arrows = (get_theme_mod( 'gallery_next_pro', '1' )) ? '' : 'data-arrows="false"';
        $gallery_fullscreen = (get_theme_mod( 'gallery_fullscreen_pro', '1' )) ? 'data-allowfullscreen="true"' : '';
      ?>

      <div class="dw-gallery--wrapper">
      	<div class="dw-gallery<?php echo $gallery_dots_nav_pro ?>">
      		<div class="fotorama" 
      			data-transitionduration="500"
      			data-width="100%"
            data-minwidth="320"
            data-minheight="480"
      			data-maxwidth="720"
        		data-hash="true" 
      			data-loop="true" 
      			data-keyboard="true"
      			data-click="false"
      			data-swipe="true"
      			data-navposition="bottom"
      			<?php echo $gallery_data_arrows; ?>
      			<?php echo $gallery_fullscreen; ?>
      			<?php
        			if (get_theme_mod( 'gallery_autoplay_pro')) {
                echo 'data-autoplay="'.get_theme_mod('gallery_auto_duration_pro', '3000').'"';
              }
              if (get_post_meta($post->ID, 'checkboxes_progression_thumb_gallery', true)) {
              } else {
                if (get_theme_mod( 'gallery_thumbnails_pro', '1' )) {
                  echo 'data-nav="thumbs" data-transition="crossfade"';
                } else {
            		  if (get_theme_mod( 'gallery_dots_nav_pro')) {
            		    echo 'data-nav="dots" data-transition="slide"';
            		  } else {
              		  echo 'data-nav="false"';
              		}
                }
              } ?>
      			data-shadows="false"
      			data-navwidth="100%">
      		<?php if (get_post_meta($post->ID, 'progression_media_embed', true)) { ?>
      			<a href="<?php echo get_post_meta( get_the_ID(), 'progression_media_embed', true ); ?>"></a>
      		<?php } ?>
<?php
			// Get all the thumbnails
			$args = array(
        'post_type' => 'attachment',
        'numberposts' => '99',
        'post_status' => null,
        'post_parent' => $post->ID,
        'post_mime_type' => 'image',
        'orderby' => 'menu_order',
        'order' => 'ASC'
			);
			$attachments = get_posts($args);
		
			if ($attachments) {
        foreach($attachments as $attachment) {
          $image = wp_get_attachment_image_src($attachment->ID, 'progression-gallery-single');
          $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-gallery-single-thumb');
?>
            <a href="<?php echo esc_attr($image[0]);?>" data-caption="<?php echo $attachment->post_excerpt; ?>"><img src="<?php echo esc_attr($thumbnail[0]);?>" width="<?php echo esc_attr($thumbnail[1]);?>" height="<?php echo esc_attr($thumbnail[2]);?>"alt="<?php echo $attachment->post_excerpt; ?>"></a>
<?php
    			}
    		} // end if($attachments)
?>
      		</div><!-- // .fotorama -->
      	</div><!-- // .dw--gallery -->
      </div><!-- // .dw--gallery--wrapper -->
<?php
      } // end if (get_post_meta($post->ID...
    } // end if(has_post_format( 'video' )
    
    // Queries below need these defined
    $current_post_type = get_post_type( $post );
    $post_type_cat_slug = 'portfolio-category';
    $this_terms = get_the_terms($post->ID , $post_type_cat_slug);
?>
	
    <div class="container">
  		<article id="post-<?php the_ID(); ?>" <?php post_class('dw-gallery--main'); ?>>
        <header class="dw-single--header dw-single--header__gallery">
          <?php the_title( '<h1 class="dw-single--title dw-gallery--title">', '</h1>' ); ?>
          <ul class="dw-post--meta dw-single--meta__top">
      			<li class="dw-single--meta--category">
      			  <?php
      			    $thispost_gallery_cats = '';
      			    if ( $this_terms && !is_wp_error( $this_terms ) ) {
        			    foreach ( $this_terms as $term ) { 
          			    $thispost_gallery_cats .= '<a href="'.get_term_link($term->slug, $post_type_cat_slug).'">'.$term->name.'</a>, ';
                  }
                }
                $thispost_gallery_cats = substr($thispost_gallery_cats, 0, -2);
                if ( strlen($thispost_gallery_cats) > 2 ) {
                  echo '<i class="fa fa-folder-open"></i>' . $thispost_gallery_cats;
                }
              ?>
      			</li>
      			<?php /*<li class="dw-single--meta--category"><i class="fa fa-folder-open"></i>
      			<?php
        			$this_format = get_post_format($post->ID);
        			$format_link = get_post_format_link($this_format);
        			echo '<a href="'.$format_link.'">'.ucwords($this_format).'</a>';
      			?>
      			</li> */ ?>
      		</ul>
    		</header>
    		
    		<div class="dw-single--content dw-gallery--content typography">
      	  <?php the_content(); ?>
      	  
      	  <?php edit_post_link( 'Edit this Post', '<p class="admin--edit">', '</p>', 'admin--edit--link' ); ?>
      	</div>
      		
      		
    		<?php
      		// Related galleries via the gallery type
        	
        	// Check the form checkbox to see if we can display related posts or not
        	// WHY DOES THIS NOT WORK!?
        	if (get_post_meta($post->ID, 'checkboxes_progression_disable_content', true)) {
        		global $post;
            $term_ids = array_values( wp_list_pluck( $this_terms,'term_id' ) );
            $args = array(
              'posts_per_page' => 6,
              'orderby' => 'rand',
              'post_type' => $current_post_type,
              'post__not_in' => array( $post->ID ),
            	'tax_query' => array(
      	        array(
    	            'taxonomy' => $post_type_cat_slug,
    	            'terms' => $term_ids,
          				'field' => 'id',
    	            'operator' => 'IN'
      	        )
        	    ),
            );
            $count = 1;
            $related_query = new WP_Query( $args );
      			$term_string = '';
      			foreach ( $this_terms as $term ) {
              $term_link = get_term_link( $term, 'gallery-category' );
              if( is_wp_error( $term_link ) )
  	            continue;
  	        	$term_string .= $term->name . ', ';
  	        }
  	        // Chop off the last comma and space
  	        $term_string = substr($term_string, 0, -2);
  	        
  	        // Define the grid system: two columns or three
  	        $found_posts = $related_query->found_posts;
  	        $grid_layout = 'card__duo';
  	        if ($found_posts == 3 or $found_posts >= 5) {
    	        $grid_layout = 'card__trio';
  	        }
  	        
  	        if( $related_query->have_posts() ) {
        ?>
        
        <div class="dw-related">
      		<h3 class="dw-related--title">More <?php if (strlen($term_string) > 2) { echo $term_string; } ?></h3>
      		<div class="card--grid <?php echo $grid_layout ?>">
        		<?php
      		    // The Loop
      		    while ( $related_query->have_posts() ) {
      		      $related_query->the_post();
        		?>
            <div id="num-<?php echo $count ?>" class="card dw-related--card<?php if( has_post_format( 'video' ) ) { ?> card__video<?php } ?>">
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
          		$count++;
          		} // end while
            ?>

          </div>
        </div><!-- .dw-related-galleries -->
        <?php
            } // end if( $related_query->have_posts() )
          } // end if get_theme_mod( 'gallery_related_pro2', '1' )
          wp_reset_query();
        ?>
  
      </article>
    </div>
  </section>

<?php
  // End the loop
  endwhile;
  
  get_footer();
?>
