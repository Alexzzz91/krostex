<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta name="yandex-verification" content="d35a65319789b40c" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?= get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<!-- Just for debugging purposes. Don't actually copy these 2 lines!-->
	<!--if lt IE 9script(src='<?= get_template_directory_uri(); ?>/assets/ie8-responsive-file-warning.js')-->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
	<!--if lt IE 9script(src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')
	|       
	script(src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js')-->
	<!-- Custom styles for this template-->
	<?php wp_head(); ?>
	<style>
	.beton-lines {
		clip-path: url(#beton-mask);
	}
	</style>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#navbar">
	<?php 
		global $wp_customize;
	    /* Preloader */
            echo '<div class="preloader">';
            	echo '<svg width="100" height="100"><clipPath id="beton-mask"><path fill="#57B031" d="M56.6,29.8l-0.9,0.4c-2.1,1-4.1,1.7-6.1,2.3c-3.9,1.2-7.5,2.4-10.7,5.7c-4.9,5.1-5.3,12.4-5.3,12.7l0,0.6 l13.8,13.8V54.8c-1.2-1-2-2.5-2-4.1c0-2.9,2.4-5.3,5.3-5.3c2.9,0,5.3,2.4,5.3,5.3c0,1.7-0.8,3.1-1.9,4.1v9.8c2.6-1,5.3-2.5,7-4.2 c3.3-3.2,4.5-6.9,5.7-10.7c0.6-2,1.3-4,2.3-6.1l0.4-0.9L56.6,29.8z"></path></clipPath>';
            	echo '<g class="beton-lines"><g class="line-movement"><path fill="#545454" d="M43.5,45.7c0-7.2,3.4-13.6,3.4-13.6h-5.1c0,0-3.4,6.3-3.4,13.6S38.6,57,35.5,64h5.1 C43.7,57,43.5,52.9,43.5,45.7z"></path><path fill="#545454" d="M53.5,45.5c0-7.2,3.4-13.6,3.4-13.6h-5.1c0,0-3.4,6.3-3.4,13.6s0.3,11.3-2.9,18.3h5.1 C54.7,56.9,53.5,52.8,53.5,45.5z"></path><path fill="#545454" d="M63.5,45.5c0-7.2,3.4-13.6,3.4-13.6h-5.1c0,0-3.4,6.3-3.4,13.6s0.3,11.3-2.9,18.3h5.1 C64.7,56.9,63.5,52.8,63.5,45.5z"></path><path fill="#545454" d="M73.5,45.5c0-7.2,3.4-13.6,3.4-13.6h-5.1c0,0-3.4,6.3-3.4,13.6s0.3,11.3-2.9,18.3h5.1 C74.7,56.8,73.5,52.7,73.5,45.5z"></path><path fill="#545454" d="M83.5,45.5c0-7.2,3.4-13.6,3.4-13.6h-5.1c0,0-3.4,6.3-3.4,13.6s0.3,11.3-2.9,18.3h5.1 C84.7,56.8,83.5,52.7,83.5,45.5z"></path></g></g>';
            	echo '<g><path fill="#FFB91A" d="M54.1,65.3v-3.2c2.4-0.9,3.7-1.8,5.3-3.3c2.9-2.8,4-6.1,5.2-10c0.6-1.9,1.2-3.8,2.1-5.8L56.2,32.6 c-2,0.9-3.9,1.5-5.8,2.1c-3.8,1.2-7.1,2.3-10,5.2c-3.6,3.7-4.5,8.9-4.7,10.7l11.3,11.3l0,4.2L32.7,51.8l0-0.7 c0-0.3,0.5-8,5.6-13.3c3.4-3.5,7.2-4.7,11.2-6c2.1-0.7,4.2-1.4,6.4-2.4l1-0.5l13.4,13.4l-0.5,1c-1,2.2-1.7,4.3-2.4,6.4 c-1.3,4-2.5,7.8-6,11.2C59.6,62.7,56.8,64.3,54.1,65.3z"></path></g>';
            	echo '<path fill="none" stroke="#000000" stroke-width="3" stroke-miterlimit="10" d="M54.1,63.7"></path><circle fill="none" stroke="#FFB91A" stroke-width="1.5" stroke-miterlimit="10" cx="50.5" cy="50.8" r="2.5"></circle><line fill="none" stroke="#FFB91A" stroke-width="3" stroke-miterlimit="10" x1="50.5" y1="53.3" x2="50.5" y2="70.3"></line><line fill="none" stroke="#FFB91A" stroke-width="2" stroke-miterlimit="10" x1="43.1" y1="70.3" x2="58" y2="70.3"> </line></svg>';
					$alk_textPreloader = get_theme_mod('alk_textPreloader');
					if( !empty($alk_textPreloader) ):
						echo '<p>'.wp_kses_post($alk_textPreloader).'</p>';
					else:
						echo '<p>Пожалуйста подождите...</p>';
					endif;
            	echo '<div class="loader-section section-left"></div><div class="loader-section section-right"></div>';
            echo '</div>';
    ?>
            
    <div id="page" class="hfeed site">
		<div class="navbar-wrapper">
	        <div class="container">
	            <nav class="navbar navbar-inverse navbar-static-top">
	                <div class="container">
	                    <div class="navbar-header">
	                        <button type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
	                        </button>
	                        <?php if ( get_header_image() ) : ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								</a>
	                        <?php else: ?>
	                        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
	                		<?php endif; ?>
	                    </div>
	                    <div id="navbar" class="navbar-collapse collapse">
	        				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'navbar-collapse collapse', 'menu_id' => 'navbar', 'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>' ) ); ?>
	        				<?php wp_nav_menu( array( 'theme_location' => 'telefon', 'items_wrap' => '<ul class="nav navbar-nav navbar-right">%3$s</ul>' ) ); ?>
	                    </div>
	                </div>
	            </nav>
	        </div>
	    </div>
		<div id="main" class="site-main">
