<?php 
/*
Template Name: order history
*/
?>
<?php get_header(); ?>

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
    
<div id="wizard" style="margin:0px auto ;">	
	<div class="items">
		<form action="<?php echo get_template_directory_uri();?>/user-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
			<div class="page" id="pg5">

				<?php if ( is_user_logged_in() ) { ?>
				<div class="order-history">
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
				<h3> UW BESTELLINGEN</h3>
				<div class="order_data">
					<ul>
						<li style="margin-left: 18px;margin-right: 15px;">DATUM</li>
						<li>ORDER NR</li>
						<li>FACTUUR</li>
						<li style="text-align: center;width: 47px;">TYPE</li>
						<li>AANTAL</li>
						<li>SCHADUW</li>
						<li>REFLECTIE</li>
						<li>STATUS</li>
						<li>UW BESTANDEN</li>
					</ul>
					<div class="h_rule123"></div>
					<div class="order_d">
						
						<?php   
							$user_id = get_current_user_id( ); 
$myrows = $wpdb->get_results( "SELECT a.oid,a.odate,a.basic,a.complex,a.medium,b.antal,b.ctype,b.pdate,b.img_solution,b.shadow,b.reflect,b.status
        FROM `order` a, `form` b
        WHERE a.oid = b.oid and a.cid = $user_id" );
							
							for($i=0; $i<count($myrows); $i++){
$myrows1 = $wpdb->get_results("select * from form");
$timezone = new DateTimeZone("Asia/Kolkata" );
$date = new DateTime();
$date->setTimezone($timezone );
$current_date_format = $date->format( 'Y-m-d H:i:s' );

$like_date_use = $myrows[$i]->pdate;			
$current_date_format;				

$diff = abs(strtotime($current_date_format) - strtotime($like_date_use)); 

$years   = floor($diff / (365*60*60*24)); 
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
  
$days_123 =  $days .'-'. $months .'-' . $years;
$close = "close";


$order_ID = $myrows[$i]->oid;
$ctype = $myrows[$i]->ctype;
$form_ar = $wpdb->get_results( "SELECT f.fid, f.oid, f.ctype, o.oid FROM `order` o, `form` f WHERE f.oid = o.oid AND o.oid = $order_ID And f.ctype = '$ctype'");
$fid = $form_ar[0]->fid;

$uploads = wp_upload_dir();

$download_link1="http://www.weclip.nl/down/?file=";
								echo "<ul><li class='o_date'>" . $myrows[$i]->odate . "</li>";
								echo "<li class='o_id'>" . $myrows[$i]->oid . "</li>";
								echo "<li class='o_facture'>";
								if($year==0 && $months==0 && $days <= 14) {
								echo "<a href=";
								echo $download_link1.get_bloginfo('url');
								echo "/wp-content/uploads/invoice/ordernumber/";
								echo $myrows[$i]->oid . "/" . $fid . ".pdf";
								echo "> <img style='height: 30px;width: 30px;' src=";
								echo bloginfo('template_directory');
								echo "/images/pdf.jpg";
								echo " /></a>"; }
								echo "</li>";
								echo "<li class='o_type'>" . $myrows[$i]->ctype . "</li>";
								echo "<li class='o_aantal'>" . $myrows[$i]->antal . "</li>";
								echo "<li class='o_schaduw'>" . $myrows[$i]->shadow . "</li>";
								echo "<li class='o_reflaction'>" . $myrows[$i]->reflect . "</li>";
								echo "<li class='o_statush'>";
								if($myrows[$i]->status == null || $myrows[$i]->status == '') {
								echo 'Controle'; }else { echo $myrows[$i]->status; }
        $download_link="http://www.weclip.nl/down/?file=";
								echo "</li>";
								if($year==0 && $months==0 && $days <= 14){
								echo "<a href='".$download_link.get_bloginfo('url')."/wp-content/uploads/incoming/username/".$myrows[$i]->img_solution."' download='".$myrows[$i]->img_solution."' title='".$myrows[$i]->img_solution."'><li style='background-color: #EA4819 !important;color: white;' class='o_download'>DOWNLOAD</li></a></ul>"; 
								}
else if($year==0 && $months==0 && $days >= 14) {
	echo "<li style='background-color: #6A6A6A !important;color: white;' class='o_download'>DOWNLOAD</li></ul>"; 
}
								else {
									echo "<li class='o_download' style='background: none !important;color: white;'></li></ul>";
								}				
							}
						?>
						 
					</div>										
				</div>	
				<?php } else { ?>
				 	<div style="height: 50px;padding-top: 34px;"> <?php
						echo "Om uw account te gebruiken moet u eerst"; ?>
						<a href="<?php echo get_bloginfo('url'); ?>/inloggen/">inloggen</a></div> 
				<?php } ?>
			</div>
		</form>
	</div>
</div>
</div>
<?php get_footer(); ?>
