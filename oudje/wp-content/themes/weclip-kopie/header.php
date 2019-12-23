<?php
global $headscripts;



wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js' );
wp_enqueue_script( 'jquery-tools', get_template_directory_uri() . '/js/jquery.tools.min.js' );
wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/css/ui-lightness/jquery-ui-1.10.3.custom.css' );

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> style="margin-top:0 !important;">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />
<script type="text/javascript" src="//use.typekit.net/tcu4hyh.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
<?php if ($headscripts) { print '<script type="text/javascript">
'.$headscripts.'
</script>'; } ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45484227-1', 'weclip.nl');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div id="masthead" class="site-header" role="banner">
		<div class="header">
			<div style="float:left;">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="WeClip - Foto's vrijstaand maken" /></a></h1>
			</div>

			<div id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
				<li class="log_in"><?php
					if ( is_user_logged_in() ) { ?>
					    <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Afmelden" class="hunderline">UITLOGGEN</a>
					<?php } else { ?>
					    <a href="<?php echo get_bloginfo('url'); ?>/inloggen/" title="inloggen" class="hunderline">INLOGGEN</a>
					<?php }
					?>
				</li>
				<li class="log_in"><?php
					if ( is_user_logged_in() ) { ?>
					    <a href="<?php echo get_bloginfo('url'); ?>/account" title="Account" class="hunderline">Account</a>
					<?php } else { } ?>
				</li>
				<li>
				<img style="margin-left:40px;" src="<?php bloginfo('template_directory'); ?>/images/face_twite.png" width="44" height="44" alt="Planets" usemap="#planetmap">

<map name="planetmap">
  <area shape="polygon" coords="0,0,43,43,2,43" href="https://twitter.com/WeClip_" alt="Twitter">
  <area shape="polygon" coords="0,0,43,0,43,43" href="https://www.facebook.com/WeClipCompany" alt="Facebook">
</map> 
				</li>
			</div><!-- #site-navigation -->

			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
			<?php endif; ?>
		</div>
	</div><!-- #masthead -->

	<div id="main" class="wrapper">
