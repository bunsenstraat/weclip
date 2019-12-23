<!DOCTYPE html>
<html>
    <head>
        <title><?php wp_title(''); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" media="screen" />
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/gfx/favicon.ico">
        <link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/favicon-apple-touch-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/favicon-apple-touch-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/favicon-apple-touch-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/favicon-apple-touch-ipad-retina.png">
        <script src="https://use.typekit.net/tcu4hyh.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-45484227-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-45484227-1');
        </script>

        <?php wp_head(); ?>
    </head>
    <body <?php body_class('wclp'); ?>  itemscope="itemscope" itemtype="http://schema.org/WebPage">
        <div id="top" class="row">
            <div id="logo" class="col">
                <a href="<?php echo home_url('/');?>"><img src="<?php bloginfo('template_directory'); ?>/gfx/weclip-logo.svg" alt="WeClip - Foto's vrijstaand maken" /></a>
            </div>
            <div id="main-menu" class="col">
                <div class="toggler expander" alt="Expand"></div>
                <nav id="primary" class="menu" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" style="display:none">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container' => ''  ) ); ?>
                </nav>
            </div>
        </div><!-- end row -->
