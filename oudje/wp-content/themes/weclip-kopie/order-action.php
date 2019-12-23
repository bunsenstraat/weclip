<?php

require_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
$current_id = get_current_user_id( );
global $current_user;
get_currentuserinfo();
$u_log = $current_user->user_login;
$u_el = $current_user->user_email;
$u_fn = $current_user->user_firstname;
$u_ln = $current_user->user_lastname;
$u_dn = $current_user->display_name;
$u_id = $current_user->ID;

require_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
session_start();
global $wpdb;


if(isset($_REQUEST['init_order'])){
$_SESSION['steps']="NOG 4 STAPPEN TE GAAN";
header("location:".get_site_url()."/bestellen//?pg1=1");
}

if(isset($_REQUEST['single_cat'])){
$category = $_REQUEST['single_cat'];
if($category=="BASIC"){ $_SESSION['b'] = $category; }
if($category=="COMPLEX"){ $_SESSION['c'] = $category; }
if($category=="MEDIUM"){ $_SESSION['m'] = $category; }
$_SESSION['pg2']=1;
unset($_SESSION['pg1']);
$_SESSION['steps']="NOG 3 STAPPEN TE GAAN";

header("location:".get_site_url()."/bestellen/");
}


if(isset($_REQUEST['b_pg1'])){
unset($_SESSION['antal']);

unset($_SESSION['schaduw']);
unset($_SESSION['reflectie']);
unset($_SESSION['background']);
unset($_SESSION['collar']);
unset($_SESSION['dimension']);
unset($_SESSION['topic']);

unset($_SESSION['jpg']);
unset($_SESSION['png']);
unset($_SESSION['psd']);
unset($_SESSION['tiff']);

unset($_SESSION['comment']);

unset($_SESSION['delivery']);
unset($_SESSION['dtype']);

unset($_SESSION['fname']);
unset($_SESSION['sname']);
unset($_SESSION['compn']);
unset($_SESSION['stree']);
unset($_SESSION['postc']);
unset($_SESSION['place']);
unset($_SESSION['telno']);
unset($_SESSION['kvkno']);
unset($_SESSION['tryoutoffer']);

$i = 0;

if(isset($_REQUEST['BASIC'])){ $i = $i + 1;$_SESSION['b'] = $_REQUEST['BASIC'];}
if(isset($_REQUEST['COMPLEX'])){$i = $i + 1;$_SESSION['c'] = $_REQUEST['COMPLEX'];}
if(isset($_REQUEST['MEDIUM'])){$i = $i + 1;$_SESSION['m'] = $_REQUEST['MEDIUM'];}

unset($_SESSION['pg1']);
$_SESSION['pg2']=1;
$_SESSION['steps']="NOG 3 STAPPEN TE GAAN";
header("location:".get_site_url()."/bestellen/");
}
if(isset($_REQUEST['b_pg2'])){
unset($_SESSION['pg2']);
$_SESSION['pg3']=1;
$_SESSION['tryoutoffer'] = ($_POST['tryoutoffer'] == 1) ? 1 : 0;

$nof = $_SESSION['nof'];
$antal = array();
for($i=0; $i<$nof; $i++){ $antal[$i] = $_POST['aantal'][$i];}
$_SESSION['antal'] = $antal;
$schaduw = array();

for($i=0; $i<$nof; $i++){ 

if($_POST['schaduw'.$i]!=null){ $schaduw[$i] = $_POST['schaduw'.$i]; }
else { $schaduw[$i] = "nee"; }

}
$_SESSION['schaduw'] = $schaduw;

$reflectie = array();

for($i=0; $i<$nof; $i++){

if($_POST['reflectie'.$i]!=null){ $reflectie[$i] = $_POST['reflectie'.$i]; }
else { $reflectie[$i] = "nee"; }

}
$_SESSION['reflectie'] = $reflectie;

$achtergrond = array();

for($i=0; $i<$nof; $i++){ 


if($_POST['achtergrond'.$i]!=null){ $achtergrond[$i] = $_POST['achtergrond'.$i]; }
else { $achtergrond[$i] = "nee"; }

}
$_SESSION['background'] = $achtergrond;

$kraagje = array();

for($i=0; $i<$nof; $i++){ 


if($_POST['kraagje'.$i]!=null){ $kraagje[$i] = $_POST['kraagje'.$i]; }
else { $kraagje[$i] = "nee"; }

}
$_SESSION['collar']= $kraagje;

$afmetingen = array();

for($i=0; $i<$nof; $i++){

if($_POST['afmetingen'.$i]!=null){ $afmetingen[$i] = $_POST['afmetingen'.$i]; }
else {  $afmetingen[$i] = "nee"; }

}
$_SESSION['dimension']= $afmetingen;

$onderwerp = array();

for($i=0; $i<$nof; $i++){ 

if($_POST['onderwerp'.$i]!=null){  $onderwerp[$i] = $_POST['onderwerp'.$i]; }
else {  $onderwerp[$i] = "nee"; }

}
$_SESSION['topic']= $onderwerp;

$jpg = array();
for($i=0; $i<$nof; $i++){ 
if($_POST['jpg'.$i]!=null){ $jpeg[$i] = $_POST['jpg'.$i]; }
else {  $jpeg[$i] = "nee"; }
}
$_SESSION['jpg']= $jpeg;

$png = array();
for($i=0; $i<$nof; $i++){ 
if($_POST['png'.$i]!=null){ $png[$i] = $_POST['png'.$i]; }
else {  $png[$i] = "nee"; }
}
$_SESSION['png']= $png;

$psd = array();
for($i=0; $i<$nof; $i++){ 
if($_POST['psd'.$i]!=null){ $psd[$i] = $_POST['psd'.$i]; }
else {  $psd[$i] = "nee"; }
}
$_SESSION['psd']= $psd;

$tiff = array();
for($i=0; $i<$nof; $i++){ 
if($_POST['tiff'.$i]!=null){ $tiff[$i] = $_POST['tiff'.$i]; }
else {  $tiff[$i] = "nee"; }
}
$_SESSION['tiff']= $tiff;

$comment = array();

for($i=0; $i<$nof; $i++){ 
if($_POST['cmt'][$i]!=null){ $comment[$i] = $_POST['cmt'][$i]; }
else { $comment[$i] = "nee"; }
}
$_SESSION['comment'] = $comment;

$_SESSION['steps']="NOG 2 STAPPEN TE GAAN";
header("location:".get_site_url()."/bestellen/");
}
if(isset($_REQUEST['b_pg2_back'])){
unset($_SESSION['pg2']);
$_SESSION['steps']="NOG 4 STAPPEN TE GAAN";
header("location:".get_site_url()."/bestellen//?pg1=1");
}
if(isset($_REQUEST['b_pg3'])){
unset($_SESSION['pg3']);
$_SESSION['pg4']=1;
$nof = $_SESSION['nof'];
$_SESSION['ftp0'] = $_REQUEST['trip0'];
$_SESSION['ftp1'] = $_REQUEST['trip1'];
$_SESSION['ftp2'] = $_REQUEST['trip2'];

/*
$image = array();
$uploads = wp_upload_dir();

if($nof==1){
if(!empty($_POST['ftp_id'][0])){
$image[0] = $_POST['ftp_id'][0];
}
else{	
	for($i=0; $i<$nof; $i++){	
	for($j=0;$j<count($_FILES["file"]["name"][0]);$j++){	
	$image[$j] = $_FILES["file"]["name"][$j];
	$image_temp = $_FILES["file"]["tmp_name"][$j];
	if(move_uploaded_file($_FILES["file"]["tmp_name"][0][$j],$uploads['basedir']."/incoming/bestellen/number/" . $_FILES["file"]["name"][0][$j])){}
 }
}
}
}
/* More Than One Form   * /
else{
if(!empty($_POST['ftp_id'][0])){
for($i=0; $i<$nof; $i++){ $image[$i] = $_POST['ftp_id'][$i]; }
}
else{
	$mulimg = array();
	for($i=0; $i<$nof; $i++){
	for($j=0;$j<count($_FILES["file"]["name"][$i]);$j++) {
	$image[$i][$j] = $_FILES["file"]["name"][$i][$j];
        $mulimg[$i] = $image[$i][$j];
	$image_temp[$i] = $_FILES["file"]["tmp_name"][$i][$j];
	
	if(move_uploaded_file($_FILES["file"]["tmp_name"][$i][$j],
$uploads['basedir']."/incoming/bestellen/number/" . $_FILES["file"]["name"][$i][$j])){}
} 
$_SESSION['imgses'] = $mulimg;
}
}
}
for($i=0; $i<$nof; $i++){ $ftp[$i] = $_POST['ftp_id'][$i];}

$_SESSION['image'] = $image;*/

$_SESSION['steps']="NOG 1 STAP TE GAAN";
header("location:".get_site_url()."/bestellen/");
}
if(isset($_REQUEST['b_pg3_back'])){
unset($_SESSION['pg3']);
unset($_SESSION['delivery']);
unset($_SESSION['dtype']);
$_SESSION['pg2']=1;
$_SESSION['steps']="NOG 3 STAPPEN TE GAAN";
header("location:".get_site_url()."/bestellen/");
}
if(isset($_REQUEST['b_pg4'])){

unset($_SESSION['pg4']);
$_SESSION['delivery'] = $_REQUEST['dtype'];
$_SESSION['pg5']=1;
$_SESSION['steps']="DE LAATSTE STAP";
header("location:".get_site_url()."/bestellen/");
}
if(isset($_REQUEST['b_pg4_back'])){
unset($_SESSION['pg4']);
$_SESSION['pg3']=1;
$_SESSION['dtype'] = $_REQUEST['dtype'];
unset($_SESSION['delivery']);
$_SESSION['steps']="NOG 2 STAPPEN TE GAAN";
header("location:".get_site_url()."/bestellen/");
}
if(isset($_REQUEST['b_pg5'])){

if ( is_user_logged_in() ) {

	
	
	global $current_user;
	get_currentuserinfo(); 
	
	$user_id = get_current_user_id();
	$a = get_userdata($user_id);
	#print_r($a->data->user_email);exit;
	#$ftp = $current_user->user_email;
	$customerid = $current_user->data->ID;
	
	$v = get_user_meta($customerid);
	
	// MAILCHIMP SUBSCRIBE
	if (isset($_REQUEST['vv2']) && $_REQUEST['vv2'] == 1) {
		require_once(ABSPATH . WPINC . '/mailchimp.class.php');
		$mailchimp = new MAILCHIMP_CLASS();
		$mailchimp->subscribe(
			$a->data->user_email,
			(($v['first_name'][0]) ? $v['first_name'][0] : 'Voornaam'),
			(($v['last_name'][0]) ? $v['last_name'][0] : 'Achternaam'),
			$v['_company'][0],
			'male' // gender not stored in user data
		);
	}
	

} else {

	if ( !$_REQUEST['fname'] || !$_REQUEST['sname'] || !$_REQUEST['streetname'] ) {
		echo "<script>
			window.location.href = 'http://www.weclip.nl/bestellen//';
		</script>";exit;
	}
	$_SESSION['gender'] = $_REQUEST['gender'];
	$_SESSION['fname'] = $_REQUEST['fname'];
	$_SESSION['sname'] = $_REQUEST['sname'];
	$_SESSION['compn'] = $_REQUEST['compname'];
	$_SESSION['stree'] = $_REQUEST['streetname'];
	$_SESSION['postc'] = $_REQUEST['postcode'];
	$_SESSION['place'] = $_REQUEST['place'];
	$_SESSION['telno'] = $_REQUEST['telno'];
	$_SESSION['kvkno'] = $_REQUEST['kvkno'];
	$_SESSION['emladdr'] = $_REQUEST['email'];
	$email = $_REQUEST['email'];

	if ( email_exists($email) ){

		echo "<script>
			window.location.href = 'http://www.weclip.nl/bestellen//?existinglogin=".urlencode($email)."';
		</script>";exit;
		}
	else{ unset($_SESSION['pg5']); }

	$user = array('user_login'=>$_REQUEST['email'],'first_name'=>$_REQUEST['fname'],'last_name'=>$_REQUEST['sname'],'user_email'=>$_REQUEST['email'],'user_pass'=>$_REQUEST['password']);
	$user_id = wp_insert_user($user);
	add_user_meta( $user_id, '_company',$_REQUEST['compname']);
	add_user_meta( $user_id, '_street',$_REQUEST['streetname']);
	add_user_meta( $user_id, '_postcode',$_REQUEST['postcode']);
	add_user_meta( $user_id, '_place',$_REQUEST['place']);
	add_user_meta( $user_id, '_cno',$_REQUEST['telno']);
	add_user_meta( $user_id, '_kvkno',$_REQUEST['kvkno']);
	$customer = array('fname'=>$_REQUEST['fname'],'sname'=>$_REQUEST['sname'],'compname'=>$_REQUEST['compname'],'streetname'=>$_REQUEST['streetname'],'postcode'=>$_REQUEST['postcode'],'place'=>$_REQUEST['place'],'telno'=>$_REQUEST['telno'],'email'=>$_REQUEST['email'],'kvkno'=>$_REQUEST['kvkno'],'password'=>$_REQUEST['password']);
	$wpdb->insert( 'customer',$customer);
	$cid = $wpdb->get_row('SELECT max(cid) FROM customer',ARRAY_N);
	$customerid = $cid[0];


	// MAILCHIMP SUBSCRIBE
	if (isset($_REQUEST['vv2']) && $_REQUEST['vv2'] == 1) {
		require_once(ABSPATH . WPINC . '/mailchimp.class.php');
		$mailchimp = new MAILCHIMP_CLASS();
		$mailchimp->subscribe($_REQUEST['email'],$_REQUEST['fname'],$_REQUEST['sname'],$_REQUEST['compname'],$_REQUEST['gender']);
	}
	
}

date_default_timezone_set('Asia/Calcutta');
$date = date('d-m-Y');
if($_SESSION['b']!=null){ $b=1; }else{ $b=0; }
if($_SESSION['m']!=null){ $m=1; }else{ $m=0; }
if($_SESSION['c']!=null){ $c=1; }else{ $c=0; }
$nof = $_SESSION['nof'];

$usernm = $_REQUEST['fname'];
$usersm = $_REQUEST['sname'];
$userps = $_REQUEST['password'];
$userem = $_REQUEST['email'];

if ( is_user_logged_in() ) { 
$order = array('cid'=>$current_id,'odate'=>$date,'basic'=>$b,'complex'=>$c,'medium'=>$m,'nof'=>$nof);
$wpdb->insert( 'order',$order);
} 
else 
{
$order = array('cid'=>$user_id,'odate'=>$date,'basic'=>$b,'complex'=>$c,'medium'=>$m,'nof'=>$nof);
$wpdb->insert( 'order',$order);
}
$oid = $wpdb->get_row('SELECT max(oid) FROM `order`',ARRAY_N);
$orderid = $oid[0];
$ctype=$_SESSION['name'];
$antal = $_SESSION['antal']; 
$schaduw = $_SESSION['schaduw'];
$reflectie = $_SESSION['reflectie'];
$background = $_SESSION['background'];
$collar = $_SESSION['collar'];
$dimension = $_SESSION['dimension'];
$topic = $_SESSION['topic'];
$jpg = $_SESSION['jpg'];
$png = $_SESSION['png'];
$psd = $_SESSION['psd'];
$tiff = $_SESSION['tiff'];
$comment = $_SESSION['comment'];
$image = $_SESSION['image'];

$ftp_seledt = $_SESSION['ftp'];

$tryoutoffer = ($_SESSION['tryoutoffer'] == 1) ? 'Ja' : 'Nee';


$uploads = wp_upload_dir();
$path  =  $uploads['basedir']."/incoming/bestellen/number/".$orderid;
$base = $uploads['basedir']."/incoming/bestellen/number/";
$base2 = $uploads['basedir']."/incoming/ordernumber/";
mkdir($path, 0700,true);

for($i=0; $i<$nof; $i++) { 
	$ftp = '';
	if ( is_user_logged_in() &&  $_SESSION['ftp'.$i]=="round") {
		global $current_user;
		get_currentuserinfo(); 
		$ftp = $current_user->user_email;
		}
	else if( !is_user_logged_in() && $_SESSION['ftp'.$i]=="round" ){
			$ftp = $_REQUEST['email'];
		}


	$form = array('oid'=>$orderid,'ctype'=>$ctype[$i],'antal'=>$antal[$i],'shadow'=>$schaduw[$i],'reflect'=>$reflectie[$i],'background'=>$background[$i],'collar'=>$collar[$i],'dimension'=>$dimension[$i],'topic'=>$topic[$i],'jpeg'=>$jpg[$i],'png'=>$png[$i],'psd'=>$psd[$i],'tiff'=>$tiff[$i],'comment'=>$comment[$i],'image'=>$path,'ftp'=>$ftp,'delivery'=>$_SESSION['delivery']);
	$wpdb->insert('form',$form);

	for($j=0; $j<count($image[$i]); $j++) {
		$img = $image[$i][$j];
		settype($img,"string");
		if(strpos($img,'.') != false) {
			$dotpos = strpos($img,".");
			$extension = substr($img, $dotpos, strlen($img));
			$image_name = $ctype[$i].$j.$extension;

			rename($base2.$img,$path.'/'. $ctype[$i] . '-' . $img);
			//."/".$image_name); 
		}
	}


	/* Strart Send order mail */

	require_once(ABSPATH . WPINC . '/phpmailer/mailer.class.php');
	$mailer = new WECLIP_MAILER();
	eval('$footer = "'.$mailer->template('footer.tpl.html').'";');
	eval('$header = "'.$mailer->template('header.tpl.html').'";');

	$bese_url = get_site_url();

	$a = $ftp;
	settype($a,"string");

	if ( is_user_logged_in() ) {
		
		$firstname = $u_fn;
		$lastname = $u_ln;
		$companyname = $u_nm;
		$email = $u_el;

	} else {

		$firstname = $usernm;
		$lastname = $usersm;
		$companyname = $usernm;
		$email = $userem;

	}

	if(strpos($a, '@') != false) {

		eval('$message = "'.$mailer->template('order_confirmation_user_ftp.tpl.html').'";');
		$mailer->send(
			array('email' => $email, 'name' => $companyname),
			'Uw bestelling bij WeClip',
			$message
		);
		
		$deliverytype = $ftp;

	} else {

		eval('$message = "'.$mailer->template('order_confirmation_user_upload.tpl.html').'";');
		$mailer->send(
			array('email' => $email, 'name' => $companyname),
			'Uw bestelling bij WeClip',
			$message
		);

		$deliverytype = '/wp-content/uploads/incoming/bestellen/number/' . $orderid;

	}

	eval('$message = "'.$mailer->template('order_confirmation_admin.tpl.html').'";');
	$mailer->send(
		array(
			'email' => get_option('admin_email'), 
			'name' => 'WeClip.nl'
		),
		'YO, nieuwe bestelling via weclip.nl',
		$message
	);
	
}

unset($_SESSION['pg5']);
unset($_SESSION['fname']);
unset($_SESSION['sname']);
unset($_SESSION['compn']);
unset($_SESSION['stree']);
unset($_SESSION['postc']);
unset($_SESSION['place']);
unset($_SESSION['telno']);
unset($_SESSION['kvkno']);
unset($_SESSION['image']);
/*	End Send order mail 	*/
header("location:".get_site_url()."/thank-you/");
} 
if(isset($_REQUEST['b_pg5_back'])){
unset($_SESSION['pg5']);
unset($_SESSION['fname']);
unset($_SESSION['sname']);
unset($_SESSION['compn']);
unset($_SESSION['stree']);
unset($_SESSION['postc']);
unset($_SESSION['place']);
unset($_SESSION['telno']);
unset($_SESSION['kvkno']);
$_SESSION['pg4']=1;
$_SESSION['steps']="NOG 1 STAPPEN TE GAAN";
header("location:".get_site_url()."/bestellen/");
}

