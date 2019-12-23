<?php 
/*
Template Name: Login
*/
?>
<?php
get_header();
?>

<div class="home_title">
	<div class="title_content">
		<div class="step_line">
			<span class="first-line">foto's</span>
			<span class="second-line">VRIJSTAAND</span>
			<span class="third-line">
				<img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
				<span class="tit_span">MAKEN</span>
				<img class="title_b_r" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
			</span>
		</div>
	</div>
</div>

<div class="login_content">
<?php
if($_REQUEST['success']=="true"){
	echo "<div class='login_success'><div class='container'><p class='basic orange'>Uw account is aangemaakt!<p></div></div>";
}
?>
	<div id="wizard" style="margin:0px auto 100px;">	
	<div class="items">
<form action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" name="loginform" id="loginform" class="standard-form">
			<div class="page" id="pg5">
				<div class="page_5_step">
                
                    <div class="step_content">
                        <h1 class="basic"><?php the_title(); ?></h1>
                        <img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/price_cut.png" />
                    </div>
                    <div class="step_content1">
                        <?php the_content(); ?>
                    </div>
				<?php if ( is_user_logged_in() ) { ?>
					<p class="with_login">Je bent al ingelogd.</p>
				<?php } else {?>			
				<div class="login_p">
					<h2>inloggen</h2>
                    <div class="h_rule"></div>
                    <h3> log hier in </h3>	
					<div class="hor_rule" style="margin: 8px 0px 20px;"></div>				
					<div class="field">
						<h4>Uw e-mail of gebruikersnaam</h4>
						<input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" >
					</div>
					<div class="field">
						<h4>Uw wachtwoord</h4>
						<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" >
					</div>
				<?php //do_action('login_form'); ?>
				<div class="field"> 
                    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Log In'); ?>" />
            <?php	if ( $interim_login ) { ?>
                    <input type="hidden" name="interim-login" value="1" />
            <?php	} else { ?>
                    <input type="hidden" name="redirect_to" value="<?=(($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '/account/');?>" /><?php /*echo esc_attr($redirect_to);*/ ?>
            <?php 	} ?>
            
                    <input type="hidden" name="customize-login" value="1" />
				</div>
                <p style="clear:left">Nog geen klant? Maak <a style="color:#EB4819;font-size:12pt;text-decoration:none;" href="<?php echo get_bloginfo('url'); ?>/user-registratie/"> hier een account</a> aan en probeer gratis onze dienst</p></div><?php } ?>
                <?php
                if($_REQUEST['fail']=="true"){
                    echo "<div class='login_fail'>Verkeerde login Details.</div>";
                }
                ?>	
				</div> <!-- Step 5 -->
			</div>
</form>
		</div> <!--- Items --->	
</div> <!-- wizard -->	
<div class="icon">
	<div class="icon_content">
		<div class="icon_one">
			<img class="icon_big" src="<?php bloginfo('template_directory'); ?>/images/icon_big.png" />
		</div>
		<div class="icon_second">
			<div class="icon_f_l">
				<li class="first"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/adidas.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/bruna.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/heineken.png" /></li>
				<li class="last"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/interbakery.png" /></li>
			</div>
			<div clas="icon_s_l">
				<li class="first"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/bacardi.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/nike.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/casio.png" /></li>
				<li class="last"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/zwitsal.png" /></li>
			</div>
		</div>
	</div>
</div>	

	
<?php get_footer(); ?>
