<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!--
		/**
		 * @license
		 * MyFonts Webfont Build ID 3554565, 2018-04-09T05:20:41-0400
		 *
		 * The fonts listed in this notice are subject to the End User License
		 * Agreement(s) entered into by the website owner. All other parties are
		 * explicitly restricted from using the Licensed Webfonts(s).
		 *
		 * You may obtain a valid license at the URLs below.
		 *
		 * Webfont: HelveticaNeueLTStd-Bd by Linotype
		 * URL: https://www.myfonts.com/fonts/linotype/neue-helvetica/helvetica-75-bold/
		 *
		 * Webfont: HelveticaNeueLTStd-Md by Linotype
		 * URL: https://www.myfonts.com/fonts/linotype/neue-helvetica/helvetica-65-medium/
		 *
		 *
		 * License: https://www.myfonts.com/viewlicense?type=web&buildid=3554565
		 * Licensed pageviews: 250,000
		 * Webfonts copyright: Copyright &#x00A9; 1988, 1990, 1993, 2002 Adobe Systems
		 * Incorporated.  All Rights Reserved. &#x00A9; 1981, 2002 Heidelberger Druckmaschinen
		 * AG. All rights reserved.
		 *
		 * © 2018 MyFonts Inc
		*/

		-->
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/library/css/MyFontsWebfontsKit.css">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // icon stuff ?>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#f7d180">
        <meta name="msapplication-TileColor" content="#f7d180">
        <meta name="theme-color" content="#f7d180">

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="fixed-header" class="cf">

					<nav class="t4a-main-menu" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
    					         'menu_class' => 'nav top-nav cf',               // adding custom nav class
											 'walker' => new t4a_Walker(),
    					         'theme_location' => 'main-nav',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>

					</nav>

									<?php /*
                    <nav class="t4a-newsletter-link" role="navigation">
                        <a href="#">Newsletter Signup</a>
                    </nav>
									*/ ?>

										<nav class="t4a-sub-menu" role="navigation">
												<?php wp_nav_menu(array(
													'container' => false,                           // remove nav container
													'container_class' => 'menu cf',                 // class of container (should you choose to use it)
													'menu' => __( 'Submenu Header', 'bonestheme' ),  // nav name
								 					'menu_class' => 'nav top-nav cf',               // adding custom nav class
								 					'theme_location' => 'sub-nav',                 // where it's located in the theme
													'before' => '',                                 // before the menu
							 						'after' => '',                                  // after the menu
											 		'link_before' => '',                            // before each link
											 		'link_after' => '',                             // after each link
											 		'depth' => 0,                                   // limit the depth of the nav
													'fallback_cb' => ''                             // fallback function (if there is one)
												)); ?>
					          </nav>
                </div>

                <div id="responsive-header" class="offcanvas cf">

                    <nav class="t4a-responsive-menu t4a-main-menu" role="navigation">
                        <?php wp_nav_menu(array(
													'container' => false,                           // remove nav container
													'container_class' => 'menu cf',                 // class of container (should you choose to use it)
													'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
													'menu_class' => 'nav top-nav cf',               // adding custom nav class
													'theme_location' => 'main-nav',                 // where it's located in the theme
													'before' => '',                                 // before the menu
													'after' => '',                                  // after the menu
													'link_before' => '',                            // before each link
													'link_after' => '',                             // after each link
													'depth' => 0,                                   // limit the depth of the nav
													'fallback_cb' => ''                             // fallback function (if there is one)
												)); ?>
                    </nav>
                </div>

                <div id="offcanvas-toggle">
                    <div class="offcanvas-hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="offcanvas-toggle-label">menu</div>
                </div>

          </header>
