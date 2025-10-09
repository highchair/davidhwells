<?php

  // Custom Home page

  get_header();

	if (get_post_meta($post->ID, 'progression_home_category_slug', true)) {
	
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else if ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		$postIds = get_post_meta($post->ID, 'progression_home_category_slug', true); // get custom field value
		$arrayIds = explode(',', $postIds); // explode value into an array of ids
		if(count($arrayIds) <= 1) // if array contains one element or less, there's spaces after comma's, or you only entered one id
		{
			if( strpos($arrayIds[0], ',') !== false )// if the first array value has commas, there were spaces after ids entered
			{
			$arrayIds = array(); // reset array
			$arrayIds = explode(', ', $postIds); // explode ids with space after comma's
			}
		}

		$col_count_progression2 = get_post_meta($post->ID, 'column_count_home_pro', true); // get custom field value
		$blog_posts_per_page = get_post_meta($post->ID, 'progression_home_posts_page', true); // get custom field value

		// Set up the array of posts
		$blogloop = new WP_Query(array(
			'post_type' =>  'portfolio',
			'posts_per_page'=> 10, 
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'gallery-category',
					'terms' => $arrayIds,
					'field' => 'slug'
				))
		));

	} else {

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else if ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		$postIds = get_post_meta($post->ID, 'progression_home_category_slug', true); // get custom field value
		$arrayIds = explode(',', $postIds); // explode value into an array of ids
		if(count($arrayIds) <= 1) // if array contains one element or less, there's spaces after comma's, or you only entered one id
		{
			if( strpos($arrayIds[0], ',') !== false )// if the first array value has commas, there were spaces after ids entered
			{
				$arrayIds = array(); // reset array
				$arrayIds = explode(', ', $postIds); // explode ids with space after comma's
			}
		}

		$blog_posts_per_page = get_theme_mod('pagination_home_pro', '11'); // get custom field value

		// Set up the array of posts
		$blogloop = new WP_Query(array(
			'post_type' => 'portfolio',
			'posts_per_page'=> $blog_posts_per_page, 
			'paged' => $paged
		));

	} // end if
?>

		<section id="main" class="content">
			<div class="container">
				<article class="content--main">
					<div class="card--grid card__duo">
<?php
	$counter = 1;
	
	// Loop over the array of posts that we set up
	while( $blogloop->have_posts()) {
		$blogloop->the_post();
		
		if ($counter == 3) {
			echo '</div><!-- end card__duo -->';
			echo '<div class="card--grid card__trio">';
		}
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
		$counter++;
	} // end of the loop.
?>

					</div><!-- end card__trio -->
				</article>
			</div>
		</section>

<?php get_footer(); ?>