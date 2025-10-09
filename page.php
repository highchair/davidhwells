<?php
  get_header();
?>

    <section id="main" class="content">
			<div class="container">
        <div class="column--row column--default">
          <div class="column--main">
  <?php while ( have_posts() ) : the_post(); ?>
            <header class="dw-archive--header">
      				<?php
      					the_title( '<h1 class="dw-page--title">', '</h1>' );
      					if ( has_post_thumbnail() ) {
                  echo '<div class="dw-page--featimage">' . the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ) . '</div>';
                }
      				?>
      			</header>
            <article id="post-<?php the_ID(); ?>" <?php post_class('dw-page--content typography'); ?>>
          	  <?php the_content(); ?>
          	  
          	  <?php edit_post_link( 'Edit this Post', '<p class="admin--edit">', '</p>', 'admin--edit--link' ); ?>
          	</article>
<?php
    // If comments are open or we have at least one comment, load up the comment template.
  	if ( comments_open() || get_comments_number() ) :
  		echo '<div class="dw-comments">';
  		comments_template();
  		echo '</div>';
  	endif;
?>

  		    </div><!-- end .column--main -->
<?php
  endwhile;
  
  if ( is_active_sidebar( 'sidebar-page' ) ) {
      echo '<aside class="dw-sidebar dw-sidebar__page column--complementary">';
      dynamic_sidebar( 'sidebar-page' );
      echo '</aside>';
  }
?>

		    </div><!-- end .column--row -->
		  </div>
		</section>
<?php
  get_footer();
?>
