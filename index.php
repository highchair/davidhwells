<?php
  // Default page template. Any page without its own more specific template uses this one. 
  // https://developer.wordpress.org/themes/basics/template-hierarchy/#The_Template_Hierarchy_In_Detail

  // Copy of Page.php
  // Assumes that the content is single in nature
  get_header();
?>
		<section id="main" class="content">
			<div class="container">
<?php while ( have_posts() ) : the_post(); ?>
        <article class="column--row column--page">

          <?php the_title( '<h1 class="dw-page--title">', '</h1>' ); ?>
          <?php
            if ( has_post_thumbnail() ) {
              echo '<div class="dw-single--featimage">' . the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ) . '</div>';
            }
          ?>
          
          <div id="post-<?php the_ID(); ?>" <?php post_class('dw-page--content typography'); ?>>
        	  <?php the_content(); ?>
        	  
        	  <?php edit_post_link( 'Edit this Post', '<p class="admin--edit">', '</p>', 'admin--edit--link' ); ?>
        	</div>
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
  endwhile;
  
  if ( is_active_sidebar( 'sidebar-page' ) ) {
      echo '<aside class="dw-sidebar dw-sidebar__page column--complementary">';
      dynamic_sidebar( 'sidebar-page' );
      echo '</aside>';
  }
?>
		  </div>
		</section>
<?php
  get_footer();
?>