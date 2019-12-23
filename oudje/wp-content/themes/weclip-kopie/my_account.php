<?php 
/*
Template Name: my account
*/
?>
<?php
get_header();
$user_id = get_current_user_id();
$a = get_userdata($user_id);
?>

<div class="home_title">
	<div class="title_content">

		<h1 class="step_line">
			<span class="first-line">foto's</span>
			<span class="second-line">VRIJSTAAND</span>
			<span class="third-line">
				<img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
				<span class="tit_span">MAKEN</span>
				<img class="title_b_r" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
			</span>
		</h1>
	</div>
</div>
<div class="order_content"><!--  Think for  it-->
<script type="text/javascript">		
</script>

<style>
#wizard li {
  margin-top:0 !important;
  list-style-type:none !important;
  list-style-image:none !important;
}
input[type="checkbox"]{
display:inline-block;
width:19px;
height:19px;
margin:-1px 4px 0 0;
vertical-align:middle;
/*background:url(check_radio_sheet.png) left top no-repeat;*/
cursor:pointer;
}
</style>
    
	<div id="wizard" style="margin:0px auto 100px;">	
	<div class="items">
<form action="<?php echo get_template_directory_uri();?>/user-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
			<div class="page" id="pg5">

				<?php if ( is_user_logged_in() ) { ?>
				<div class="page_5_step">
				<div class="step_content">
				<h2 class="how_title" style="color:#1F2A3D;margin:25px auto 20px;">UW ACCOUNT <br/>
				<img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/step_line.png" /><br/>
				<img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/cat.png" />
				</h2>
				</div>
				<div class="personal">
					<a href="<?php echo get_bloginfo('url') ?>/account">UW GEGEVENS</a>
				</div>
				<div class="new_order">
					<a href="<?php echo get_bloginfo('url') ?>/bestellen?pg1=1">PLAATS NIEUWE BESTELLING</a>
				</div>
				<div class="order_history">
					<a href="<?php echo get_bloginfo('url') ?>/order-geschiedenis">ZIE UW BESTELLINGEN</a>
				</div>
				<div class="h_rule"></div>
				<h3> uw gegevens</h3>	
				<div class="hor_rule" style="margin:10px 0px;"></div>				
				
				<div class="field">
				<h4>VOORNAAM</h4>
				<input type="text" name="fname" value="<?php $v = get_user_meta($user_id,'first_name'); echo $v[0];  ?>">
				</div>
				<div class="field">
				<h4>ACHTERNAAM</h4>
				<input type="text" name="sname" value="<?php $v = get_user_meta($user_id,'last_name'); echo $v[0]; ?>">
				</div>
				<div class="field">
				<h4>BEDRIJFSNAAM</h4>
				<input type="text" name="compname" value="<?php $v = get_user_meta($user_id,'_company'); echo $v[0];  ?>">
				</div>	
				<div class="hor_rule" style="margin-top:82px;"></div>
				<div class="field">
				<h4>straat en huisnummer</h4>
				<input type="text" name="streetname" value="<?php $v = get_user_meta($user_id,'_street');echo $v[0];  ?>">
				</div>
				<div class="field">
				<h4>postcode</h4>
				<input type="text" name="postcode" value="<?php $v = get_user_meta($user_id,'_postcode');echo $v[0]; ?>">
				</div>
				<div class="field">
				<h4>plaats</h4>
				<input type="text" name="place" value="<?php $v = get_user_meta($user_id,'_place'); echo $v[0];  ?>">
				</div>
				<div class="hor_rule" style="margin-top:85px;"></div>
				<div class="field">
				<h4>TEL.NUMMER</h4>
				<input type="text" name="telno" value="<?php $v = get_user_meta($user_id,'_cno'); echo $v[0];  ?>">
				</div>
				<div class="field">
				<h4>EMAIL ADRES</h4>
				<input type="text" name="email" value="<?php echo $a->user_email; ?>" readonly>
				</div>
				<div class="field">
				<h4>KVK NUMMER</h4>
				<input type="text" name="kvkno" value="<?php $v = get_user_meta($user_id,'_kvkno');echo $v[0]; ?>">
				</div>
				<div class="hor_rule" style="margin-top:88px;"></div>
				<div class="field">
				<h4>UW WACHTWOORD</h4>
				<input type="password" name="password">
				</div>
				<div class="field">
				<h4>HERHAAL WACHTWOORD</h4>
				<input type="password" name="cpassword">
				</div>
				<div class="field save-profile">			   
				<input type="submit" value="PAS UW GEGEVENS AAN" class="next" style="float:left" name="b_uu" /> 	  
				</div>
				<?php } else { ?>
				 <div style="height: 50px;padding-top: 34px;"> <?php
				echo "Om uw account te gebruiken moet u eerst"; ?>
				<a href="<?php echo get_bloginfo('url'); ?>/inloggen/">inloggen</a></div> <?php
}?>
					
					
			</div>
</form>
	
		</div>	
</div> <!-- Wizard  -->	

<?php get_footer(); ?>
