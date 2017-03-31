<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Theme_Luapp
 * @author Descubra
 * @since Theme Luapp 1.0
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	  <meta charset="<?php bloginfo( 'charset' ); ?>">
	  <meta name="viewport" content="width=device-width">
	  <link rel="profile" href="http://gmpg.org/xfn/11">
	  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/public/css/slick.css"/>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/public/css/hover.css"/>
	  <?php wp_head(); ?>
	    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
	</head>
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
				<div class="logo">
					<a href="<?php bloginfo('url'); ?>">
						<img src="<?php bloginfo('template_directory'); ?>/public/img/logo.png" alt="">
					</a>
				</div>

      </div>
      <div id="navbar" class="collapse navbar-collapse">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'main-navigation', 'menu' => 'Menu 1', 'menu_id' => 'menu-menu-1', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback',  'depth' => 2, 'walker' => new wp_bootstrap_navwalker()) ); ?>
	    </div><!--/.nav-collapse -->
  	</div>
  </nav>
<body>
