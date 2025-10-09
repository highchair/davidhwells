<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="prefetch" href="https://maxcdn.bootstrapcdn.com">
    <link rel="prefetch" href="https://code.jquery.com">

    <meta name="viewport" content="width=device-width">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <?php wp_head(); ?>
  </head>


  <body <?php body_class(); ?>>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-4407345-1', 'auto');
      ga('send', 'pageview');
    </script>
    
    <div id="top"></div>
    <div class="skip-link screen-reader-text">
      <a href="#main" title="Skip to content">Skip to content</a>
    </div>

    <header class="mainhead">
      <div class="container">

        <div class="brand">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand--link">
            <span class="brand--logo"><?php bloginfo( 'name' ); ?></span>
            <span class="brand--tagline"><?php bloginfo( 'description', 'display' ); ?></span>
          </a>
        </div>

        <div class="mainhead--inner">
          <div class="social social__top">
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
            $primary_menu = wp_nav_menu( array(
              'theme_location' => 'primary',
              'menu_class' => 'mainnav--list',
              'fallback_cb' => false,
              'echo' => false,
              'container' => '', // sets the wrapper to null
              'items_wrap' => '%3$s', // removes the UL wrapper completely
              'depth' => 2,
            ) );
            
            echo '<nav class="mainnav mainnav__top"><ul class="mainnav--list">';
            echo $primary_menu;
            echo '<li><span class="mainnav--sub--trigger">More <span class="fa fa-caret-down" aria-hidden="true"></span></span><ul class="mainnav--sub">';
            echo $primary_menu;
            echo '</ul></li></ul></nav>';
          ?>
          
        </div>
        
      </div>
    </header>