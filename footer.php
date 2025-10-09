  <footer class="mainfoot">
		<div class="container">
			<div class="social social__bottom">
				<?php
  				$menu_locations = get_nav_menu_locations();
          $social_menu = get_term( $menu_locations['social'], 'nav_menu' );
          $social_menu_items = wp_get_nav_menu_items($social_menu->term_id);
          $social_menu_render = '';

          foreach ( $social_menu_items as $item ) {
            $link = $item->url;
            $title = $item->title;
            $attr = $item->attr_title;
            $class = $item->classes[0];
            
            $social_menu_render .= '<li><a href="'.$link.'" class="social--link tooltip--bottom" data-tooltip="'.$attr.'" target="_blank"><span class="fa '.$class.'" aria-hidden="true"></span><span class="visually-hidden">'.$title.'</span></a></li>';
          }

          echo '<ul class="social--list">';
          echo $social_menu_render;
          echo '</ul>';
				?>
			</div>
			
			<?php 
  			// Use the same menu that we built in the header
  			$primary_menu = wp_nav_menu( array(
				  'theme_location' => 'primary',
				  'menu_class' => 'mainnav--list',
				  'fallback_cb' => false,
				  'echo' => false,
				  'container' => '', // sets the wrapper to null
				  'items_wrap' => '%3$s', // removes the UL wrapper completely
				  'depth' => 1,
				) );
    				
  			echo '<nav class="mainnav mainnav__bottom"><ul class="mainnav--list">';
				echo $primary_menu;
				echo '</ul></nav>';
  		?>
			
			<p class="mainfoot--copyright">
				<span>All photos copyright &copy;<?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. </span> 
				<span>No images may be reproduced without </span> 
				<span>written consent of the artist</span>
			</p>
		</div>
	</footer>
  <?php wp_footer(); ?>
  </body>
</html>