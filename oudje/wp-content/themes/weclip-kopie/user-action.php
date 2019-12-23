<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
global $wpdb;

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);
 
if(isset($_REQUEST['ar'])) {

	/*echo "hello";
	echo "<pre>"; print_r($_REQUEST['ar']); echo "</pre>";*/
	$regdata = $_REQUEST['ar'];

	$fin_d = explode(',', $regdata);

	$_SESSION['VOORNAAM'] = $fin_d[0];
	$_SESSION['ACHTERNAAM'] =  $fin_d[1];
	$_SESSION['BEDRIJF'] = $fin_d[2];
	$_SESSION['stree'] = $fin_d[3];
	$_SESSION['postc'] = $fin_d[4];
	$_SESSION['place'] =  $fin_d[5];
	$_SESSION['telno'] = $fin_d[6];
	$reg_email = $fin_d[7];
	$_SESSION['kvkno'] = $fin_d[8];
	$fin_d[9];
	$fin_d[10];

	$EMAIL = $reg_email;
	if ( EMAIL_exists($EMAIL) ){

		echo "<script>
			var a = confirm('Dit e-mailadres bestaat al. Log in met uw account of geef een ander e-mailadres op.');
			if(a==true) {  window.location.href = 'http://www.weclip.nl/user-registratie/';  } else { window.location.href = 'http://www.weclip.nl/user-registratie/'; }
		</script>";
	exit();
		}
		
	$user = array('user_login'=>$fin_d[7],'first_name'=>$fin_d[0],'last_name'=>$fin_d[1],'user_email'=>$fin_d[7],'user_pass'=>$fin_d[9]);
	$user_id = wp_insert_user($user);
	if (!is_numeric($user_id)) {
		print '<h2>Fouten</h2><pre>';
		print_r($user_id);
		exit;
	}
	
	$cust_fn = $fin_d[0];
	$cust_sn =  $fin_d[1];
	add_user_meta( $user_id, '_company',$fin_d[2]);
	add_user_meta( $user_id, '_street',$fin_d[3]);
	add_user_meta( $user_id, '_postcode',$fin_d[4]);
	add_user_meta( $user_id, '_place',$fin_d[5]);
	add_user_meta( $user_id, '_cno',$fin_d[6]);
	add_user_meta( $user_id, '_kvkno',$fin_d[8]);
	
	// MAILCHIMP SUBSCRIBE
	if (isset($_REQUEST['vv2']) && $_REQUEST['vv2'] == 1) {
		require_once(ABSPATH . WPINC . '/mailchimp.class.php');
		$mailchimp = new MAILCHIMP_CLASS();
		$mailchimp->subscribe($_REQUEST['email'],$_REQUEST['fname'],$_REQUEST['sname'],$_REQUEST['compname'],$_REQUEST['gender']);
	}

	/* Start E-mail */

	$EMAIL1 = get_option('admin_EMAIL');
	$EMAIL2 = $reg_email;
	$login_url = get_bloginfo('url') . "/inloggen/";

	require_once(ABSPATH . WPINC . '/phpmailer/mailer.class.php');
	$mailer = new WECLIP_MAILER();
	eval('$footer = "'.$mailer->template('footer.tpl.html').'";');
	eval('$header = "'.$mailer->template('header.tpl.html').'";');

	eval('$message = "'.$mailer->template('user_registration.tpl.html').'";');
	$mailer->send(
		array(
			'email' => $fin_d[7], 
			'name' => $fin_d[0] . ' ' . $fin_d[1]
		),
		'Uw registratie bij WeClip',
		$message
	);
	
	eval('$message = "'.$mailer->template('user_registration_admin.tpl.html').'";');
	$mailer->send(
		array(
			'email' => get_option('admin_email'), 
			'name' => 'WeClip.nl'
		),
		'AIGHT, een nieuwe klant van WeClip',
		$message
	);

	/* End E-mail */
	unset($_SESSION['VOORNAAM']);
	unset($_SESSION['ACHTERNAAM']);
	unset($_SESSION['BEDRIJF']);
	unset($_SESSION['stree']);
	unset($_SESSION['postc']);
	unset($_SESSION['place']);
	unset($_SESSION['telno']);
	unset($_SESSION['kvkno']);

	header("location:".get_site_url()."/inloggen/?success=true");

}

if(isset($_REQUEST['b_ur'])) {

	$_SESSION['VOORNAAM'] = $fin_d[0] = $_REQUEST['VOORNAAM'];
	$_SESSION['ACHTERNAAM'] = $fin_d[1] = $_REQUEST['ACHTERNAAM'];
	$_SESSION['BEDRIJF'] = $fin_d[2] = $_REQUEST['BEDRIJF'];
	$_SESSION['stree'] = $fin_d[3] = $_REQUEST['streetname'];
	$_SESSION['postc'] = $fin_d[4] = $_REQUEST['postcode'];
	$_SESSION['place'] = $fin_d[5] = $_REQUEST['place'];
	$_SESSION['telno'] = $fin_d[6] = $_REQUEST['telno'];
	$reg_email = $fin_d[7];
	$_SESSION['kvkno'] = $fin_d[8] = $_REQUEST['kvkno'];

	$EMAIL = $_REQUEST['EMAIL'];
	if ( EMAIL_exists($EMAIL) ){

		echo "<script>
			var a = confirm('Dit e-mailadres bestaat al. Log in met uw account of geef een ander e-mailadres op.');
			if(a==true) {  window.location.href = 'http://www.weclip.nl/user-registratie/';  } else { window.location.href = 'http://www.weclip.nl/user-registratie/'; }
		</script>";
	exit();
		}		

	$user = array('user_login'=>$_REQUEST['EMAIL'],'first_name'=>$_REQUEST['VOORNAAM'],'last_name'=>$_REQUEST['ACHTERNAAM'],'user_email'=>$_REQUEST['EMAIL'],'user_pass'=>$_REQUEST['password']);
	$user_id = wp_insert_user($user);
	if (!is_numeric($user_id)) {
		print '<h2>Fouten</h2><pre>';
		print_r($user_id);
		exit;
	}
	
	$cust_fn = $_REQUEST['VOORNAAM'];
	$cust_sn = $_REQUEST['ACHTERNAAM'];
	add_user_meta( $user_id, '_company',$_REQUEST['BEDRIJF']);
	add_user_meta( $user_id, '_street',$_REQUEST['streetname']);
	add_user_meta( $user_id, '_postcode',$_REQUEST['postcode']);
	add_user_meta( $user_id, '_place',$_REQUEST['place']);
	add_user_meta( $user_id, '_cno',$_REQUEST['telno']);
	add_user_meta( $user_id, '_kvkno',$_REQUEST['kvkno']);
	
	// MAILCHIMP SUBSCRIBE
	if (isset($_REQUEST['vv2']) && $_REQUEST['vv2'] == 1) {
		require_once(ABSPATH . WPINC . '/mailchimp.class.php');
		$mailchimp = new MAILCHIMP_CLASS();
		$mailchimp->subscribe($_REQUEST['EMAIL'],$_REQUEST['VOORNAAM'],$_REQUEST['ACHTERNAAM'],$_REQUEST['BEDRIJF'],$_REQUEST['gender']);
	}

	/* Start E-mail */

	$EMAIL1 = get_option('admin_EMAIL');
	$From1 = $EMAIL1;
	
	$login_url = get_bloginfo('url') . "/inloggen/";

	require_once(ABSPATH . WPINC . '/phpmailer/mailer.class.php');
	$mailer = new WECLIP_MAILER();
	eval('$footer = "'.$mailer->template('footer.tpl.html').'";');
	eval('$header = "'.$mailer->template('header.tpl.html').'";');

	eval('$message = "'.$mailer->template('user_registration.tpl.html').'";');
	$mailer->send(
		array(
			'email' => $fin_d[7], 
			'name' => $fin_d[0] . ' ' . $fin_d[1]
		),
		'Uw registratie bij WeClip',
		$message
	);

	eval('$message = "'.$mailer->template('user_registration_admin.tpl.html').'";');
	$mailer->send(
		array(
			'email' => get_option('admin_email'), 
			'name' => 'WeClip.nl'
		),
		'AIGHT, een nieuwe klant van WeClip',
		$message
	);

	/* End E-mail */
	unset($_SESSION['VOORNAAM']);
	unset($_SESSION['ACHTERNAAM']);
	unset($_SESSION['BEDRIJF']);
	unset($_SESSION['stree']);
	unset($_SESSION['postc']);
	unset($_SESSION['place']);
	unset($_SESSION['telno']);
	unset($_SESSION['kvkno']);

	header("location:".get_site_url()."/inloggen");

}
if(isset($_REQUEST['b_uu'])){
	$user_id = get_current_user_id();
	if($_REQUEST['password']!=null){
		$user = array('ID'=>$user_id,'first_name'=>$_REQUEST['fname'],'last_name'=>$_REQUEST['sname'],'user_email'=>$_REQUEST['email'],'user_pass'=>$_REQUEST['password']);
	}
	else{
		$user = array('ID'=>$user_id,'first_name'=>$_REQUEST['fname'],'last_name'=>$_REQUEST['sname'],'user_email'=>$_REQUEST['email']);
	}
	wp_update_user($user);
	update_user_meta( $user_id, '_company',$_REQUEST['compname']);
	update_user_meta( $user_id, '_street',$_REQUEST['streetname']);
	update_user_meta( $user_id, '_postcode',$_REQUEST['postcode']);
	update_user_meta( $user_id, '_place',$_REQUEST['place']);
	update_user_meta( $user_id, '_cno',$_REQUEST['telno']);
	update_user_meta( $user_id, '_kvkno',$_REQUEST['kvkno']);
	header("location:".get_site_url()."/account");
}
