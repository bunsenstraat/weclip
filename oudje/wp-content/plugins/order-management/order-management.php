<?php
/*
Plugin Name: Order Management
Plugin URI: http://www.google.com/
Description: This Plugin is for Upload an image for the order delivery.
Version: 0.1.3
Author: Anand Nayi & Laxman Prajapati (anand.nayi@gmail.com & laxman92vp@gmail.com)
Author URI: http://www.google.com/
*/
// require_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
if (!defined("BASE_PATH")) define('BASE_PATH', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : substr($_SERVER['PATH_TRANSLATED'],0, -1*strlen($_SERVER['SCRIPT_NAME'])));
global $wpdb;
if(isset($_REQUEST['del_id'])){
$d_o_i = $_REQUEST['del_id'];
$wpdb->delete( 'form', array( 'oid' => $d_o_i ) , array( '%d' ) );
header("location:http://www.weclip.nl/wp-admin/admin.php?page=mt-top-level-handle");
}
add_action('admin_menu', 'mt_add_pages');
function mt_add_pages() {
add_menu_page(__('Order Management'), __('Order Management'), 'manage_options', 'mt-top-level-handle', 'mt_toplevel_page' );
}
global $wpdb;
$querystr = "SELECT * FROM form";
$pageposts = $wpdb->get_results($querystr, OBJECT);
function mt_toplevel_page() {
global $wpdb;
$querystr = "SELECT * FROM form";
$pageposts = $wpdb->get_results($querystr, OBJECT);
echo "<form action='' method='post' enctype='multipart/form-data'><table border='1'><tr>";
echo ""."<th>User_name</th>"."  "."<th>Order_id</th>"."  "."<th>Order_date</th>"."  "."<th>Category_type</th>"."  "."<th>Antal_name</th>"."  "."<th>Shadow</th>"."  "."<th>Reflect</th>"."  "."<th>Background</th>"."  "."<th>Collar</th>"."  "."<th>Dimention</th>"."  "."<th>Topic</th>"."  "."<th>Jpeg</th>"."  "."<th>Png</th>"."  "."<th>Psd</th>"."  "."<th>Tiff</th>"."  "."<th>Comment</th>"."  "."<th>Delivery</th><th> Image Uploading </th><th> Status </th><th> Uploading PDF</th><th> Delete Order</th></tr>";
for($i=0; $i<count($pageposts); $i++)
{
	$or_id = $pageposts[$i]->oid;
	$cust_id = "SELECT `cid`,`odate` FROM `order` WHERE `oid`=".$or_id;
	$pageposts1 = $wpdb->get_results($cust_id, ARRAY_A);
	$cs_id = $pageposts1[0][cid];
	$cust_name = "SELECT `user_nicename` FROM `wp_users` WHERE `id`=".$cs_id;
	$pageposts2 = $wpdb->get_results($cust_name, ARRAY_A);
	echo "<input type='hidden' name='id[".$i."]' value=".$pageposts[$i]->fid." />";
	echo "<input type='hidden' name='order[".$i."]' value='".$pageposts[$i]->oid."'>";
	echo "<td>".$pageposts2[0][user_nicename]."</td>";
	echo "<td>".$pageposts[$i]->oid."</td>";
	echo "<td>".$pageposts1[0][odate]."</td>";
	echo "<td>".$pageposts[$i]->ctype."</td>";
	echo "<td>".$pageposts[$i]->antal."</td>";
	echo "<td>".$pageposts[$i]->shadow."</td>";
	echo "<td>".$pageposts[$i]->reflect."</td>";
	echo "<td>".$pageposts[$i]->background."</td>";
	echo "<td>".$pageposts[$i]->collar."</td>";
	echo "<td>".$pageposts[$i]->dimension."</td>";
	echo "<td>".$pageposts[$i]->topic."</td>";
	echo "<td>".$pageposts[$i]->jpeg."</td>";
	echo "<td>".$pageposts[$i]->png."</td>";
	echo "<td>".$pageposts[$i]->psd."</td>";
	echo "<td>".$pageposts[$i]->tiff."</td>";
	echo "<td>".$pageposts[$i]->comment."</td>";
	echo "<td>".$pageposts[$i]->delivery."</td>";
	echo '<td><input type="file" name="file[]"></td>';
	echo "<td><select name='ostatus".$i."'>";
	if(!empty($pageposts[$i]->status)) { echo '<option value="">'.$pageposts[$i]->status.'</option>'; }
echo '<option value="Controle"> Controle </option> <option value="Actief"> Actief </option><option value="Gereed"> Gereed </option><option value="Verwerkt"> Verwerkt </option></select></td>';
echo '<td><input type="file" name="pdf[]"></td>';
echo '<td><a href="http://www.weclip.nl/wp-content/plugins/order-management/order-management.php?del_id='.$or_id.'">Delete</a></td></tr>';
}
echo "<input type='hidden' name='nof' value=".count($pageposts).">";
echo "<input type='submit' Value='Submit' name='upload'></table></form>";
}
if(isset($_REQUEST['upload'])){
	$timezone = new DateTimeZone("Asia/Kolkata" );
	$date = new DateTime();
	$date->setTimezone($timezone);
	$current_date_format = $date->format( 'd-m-Y' );
	$uploads = wp_upload_dir();
	$noofrow = count($pageposts);
	for($i=0; $i<$noofrow; $i++) {
		if(!empty($_FILES["file"]["name"][$i]))	{
			$image_name = $_FILES["file"]["name"][$i];
			$dotpos = strpos($image_name,".");
			$extension = substr($image_name, $dotpos, strlen($image_name));		
			$name = $_REQUEST["id"][$i].$extension;
			if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],$uploads['basedir'] ."/incoming/username/". $name)){
			$solution = array('img_solution'=>$name,'status'=>'Gereed','pdate'=>$current_date_format); 
			$id_a = array ('fid'=>$_REQUEST["id"][$i]);
			$wpdb->update( "form", $solution, $id_a);}
		}
		if(!empty($_FILES["pdf"]["name"][$i])) {
			$orderid = $_REQUEST["order"][$i];
			$path  =  $uploads['basedir']."/invoice/ordernumber/".$orderid;
			$base = $uploads['basedir']."/invoice/ordernumber/";
			mkdir($path, 0700,true);
			$image_name = $_FILES["pdf"]["name"][$i];
			$dotpos = strpos($image_name,".");
			$extension = substr($image_name, $dotpos, strlen($image_name));		
			$name = $_REQUEST["id"][$i].$extension;
			if(move_uploaded_file($_FILES["pdf"]["tmp_name"][$i],$base.$orderid."/".$name)){
			$solution = array('pdf'=>$name); 
			$id_a = array ('fid'=>$_REQUEST["id"][$i]);
			$wpdb->update( "form", $solution, $id_a);} 
		}
		if(!empty($_REQUEST["ostatus".$i]) && trim($_REQUEST["ostatus".$i]) != '') {
		
			$myrows = $wpdb->get_results( "SELECT f.status FROM `order` o, `form` f, `wp_users` u WHERE o.oid = f.oid AND o.cid = u.ID AND f.fid = $formid " );
			if ($myrows['status'] != $_REQUEST["ostatus".$i]) {

				$solution = array('status'=>$_REQUEST["ostatus".$i]); 
				$formid = $_REQUEST["id"][$i];	
				$id_a = array ('fid'=>$_REQUEST["id"][$i]);
				$wpdb->update( "form", $solution, $id_a);
				$myrows = $wpdb->get_results( "SELECT u.user_email,u.ID, o.oid, f.fid FROM `order` o, `form` f, `wp_users` u WHERE o.oid = f.oid AND o.cid = u.ID AND f.fid = $formid " );
				$user_first = get_user_meta( $myrows[0]->ID,'first_name', true ); 
				$user_last = get_user_meta( $myrows[0]->ID,'last_name', true ); 
				$status = $_REQUEST["ostatus".$i];
				$orderid = $_REQUEST["order"][$i];
				
				require_once(ABSPATH . WPINC . '/phpmailer/mailer.class.php');
				$mailer = new WECLIP_MAILER();
				eval('$footer = "'.$mailer->template('footer.tpl.html').'";');
				eval('$header = "'.$mailer->template('header.tpl.html').'";');

				eval('$message = "'.$mailer->template('order_status_change.tpl.html').'";');

				$mailer->send(
					array(
						'email' => $myrows[0]->user_email, 
						'name' => $user_first . ' ' . $user_last
					),
					'De status van uw bestelling',
					$message
				);
			} else {
				die('mmm');
			}
		}
	}
}