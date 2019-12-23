<?php 
/*

Template Name: order

*/
session_start();

if(isset($_GET['pg1'])){
	$_SESSION['pg1'] = 1;
	header("Location: /bestellen/");
	exit;
}

$step = 0;
$set = false;
for ($i = 1; $i <= 5; $i++) {
	if (isset($_SESSION['pg'.$i])) {
		$set = true;
		$step = $i; break 1;
	}
}

if ($step == 0 && !$set) {
	$_SESSION['pg1'] = 1;
	$step = 1;
}

$headscripts = '
	jQuery(document).ready( function() {
		jQuery("a.confirm").click( function() {
			if ( confirm( \'Are you sure?\' ) ) {
				return true;
			} else {
				return false;
			}
		});
	});
	WECLIP.templateuri = \''.get_template_directory_uri().'\';
	WECLIP.order.step = '.$step.';
	WECLIP.order.session = {
		name: '.json_encode($_SESSION["name"],true).',
		a:\''.$_SESSION["b"].'\',
		b:\''.$_SESSION["b"].'\',
		m:\''.$_SESSION["m"].'\',
		c:\''.$_SESSION["c"].'\'
	};
';

// include scripts
wp_enqueue_script( 'ilctabs', get_template_directory_uri() . '/js/jquery-ilc-tabs.js', array( 'jquery', 'jquery-ui', 'jquery-tools' ) );
wp_enqueue_script( 'scrolltabs', get_template_directory_uri() . '/js/scrolltabs.js', array( 'jquery', 'jquery-ui', 'jquery-tools' ) );
wp_enqueue_script( 'wecliporder', get_template_directory_uri() . '/js/weclip_order.js', array( 'jquery', 'jquery-ui' ) );

if(isset($_SESSION['pg3'])) {
	// photo upload scripts
	wp_enqueue_style( 'plupload2', get_template_directory_uri() . '/js/jquery.ui.plupload/css/jquery.ui.plupload.css' );
	wp_enqueue_script( 'plupload2', get_template_directory_uri() . '/js/plupload.full.min.js', array( 'jquery', 'jquery-ui' ) );
	wp_enqueue_script( 'plupload2nl', get_template_directory_uri() . '/js/i18n/nl.js', array( 'jquery', 'jquery-ui' ) );
	wp_enqueue_script( 'pluploadjquery', get_template_directory_uri() . '/js/jquery.ui.plupload/jquery.ui.plupload.js', array( 'jquery', 'jquery-ui' ) );
}


if(isset($_SESSION['pg5'])) {
	if ( !is_user_logged_in() ) {

		$headscripts .= '
		WECLIP.order.formverify.step5 = function() {
			var fi_name = document.getElementById("fname").value;
					var su_name = document.getElementById("sname").value;
					var co_name = document.getElementById("compname").value;
					var st_name = document.getElementById("streetname").value;
					var zi_code = document.getElementById("postcode").value;
			var pl_name = document.getElementById("place").value;
					var tel_num = document.getElementById("telno").value;
					var eml_add = document.getElementById("email").value;
					var kvk_num = document.getElementById("kvkno").value;
					var pas_wrd = document.getElementById("password").value;
			var cpas_wr = document.getElementById("cpassword").value;


			if(fi_name==null || fi_name=="")
					{
						alert("Voer uw voornaam in.");
						document.getElementById("fname").focus();
						return false;
					}

			if(su_name==null || su_name=="")
					{
						alert("Voer uw achternaam in.");
						document.getElementById("sname").focus();
						return false;
					}

			if(co_name==null || co_name=="")
					{
						alert("Voer uw bedrijfsnaam in.");
						document.getElementById("compname").focus();
						return false;
					}
		
			if(st_name==null || st_name=="")
					{
						alert("Voer uw Adres in.");
						document.getElementById("streetname").focus();
						return false;
					}

			if(zi_code==null || zi_code=="")
					{
						alert("Voer uw postcode in.");
						document.getElementById("postcode").focus();
						return false;
					}

			if(zi_code.length < 6){
					alert(zi_code + " is te kort.");
				document.getElementById(\'postcode\').focus();
				return false;
				}

			if(pl_name==null || pl_name=="")
					{
						alert("Voer uw plaats in.");
						document.getElementById("place").focus();
						return false;
					}

			if(tel_num==null || tel_num=="")
					{
						alert("Voer uw telefoonnummer in.");
						document.getElementById("telno").focus();
						return false;
					}

			if(eml_add==null || eml_add=="")
					{
						alert("Voer een geldig e-mailadres in.");
						document.getElementById("email").focus();
						return false;
					}

			/*if(kvk_num==null || kvk_num=="")
					{
						alert("Voer uw kvk nummer in.");
						document.getElementById("kvkno").focus();
						return false;
					}*/

			var isANumber = isNaN(kvk_num) === false;	
			if(isNaN(kvk_num))
			{
				alert(\'Voer uw kvk nummer in.\');
				document.getElementById(\'kvkno\').focus();
				return false;
			}

			if(pas_wrd==null || pas_wrd=="")
					{
						alert("Geef een geldig wachtwoord op.");
						document.getElementById("password").focus();
						return false;
					}

			if(cpas_wr==null || cpas_wr=="") {
				alert("Geef een geldig wachtwoord op.");
				document.getElementById("cpassword").focus();
				return false;
			}

			if (cpas_wr !==pas_wrd) {
				alert("Wachtwoord wordt niet overeen.");
				document.getElementById("cpassword").focus();
				return false;
			}

			if(document.signup_form.vv1.checked == false) {
				alert(\'U dient akkoord te gaan met de voorwaarden van WeClip.\');
				return false;
			}  
	  
		}';
	} else {
		$headscripts .= '
			WECLIP.order.formverify.step5 = function() {
				if(document.signup_form.vv1.checked == false) {
					alert (\'U dient akkoord te gaan met de voorwaarden van WeClip.\');
					return false;
				}
			}';
	}
}

get_header();

// create order session
if (!isset($_SESSION['ordersession'])) {
	#$_SESSION['ordersession']
}
$i = 2;
?>
<div class="order_title">
	<div class="title_content">

		<h1 class="step_line1">
			<span class="first-line">Gemakkelijk</span>
			<span class="second-line">ONLINE BESTELLEN</span>
			<span class="third-line">
				<img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
				<span class="tit_span"><?php echo $_SESSION['steps']; ?></span>
				<img class="title_b_r" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
			</span>
		</h1>
	</div>
</div>
<div class="order_content">
<style style="text/css">
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
    <div id="progress">
    	<div id="progress-bg"></div>
    	<ul id="bar">
	      <li id="first" class="active1">STAP 1</li>
	      <li id="second">STAP 2</li>
	      <li id="third">STAP 3</li>
	      <li id="forth">STAP 4</li>
          <li id="five">STAP 5</li>
        </ul>
    </div>
	<div id="wizard">	
	<div class="items">
<?php if(isset($_SESSION['pg1'])){
unset($_SESSION['pg2']);
unset($_SESSION['pg3']);
unset($_SESSION['pg4']);
unset($_SESSION['pg5']);
unset($_SESSION['b']);
unset($_SESSION['c']);
unset($_SESSION['m']);
?>
<form action="<?php echo get_template_directory_uri();?>/order-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
			<div class="page" id="pg1">
				<h2>SELECTEER HIER UW PRODUCT <span> (Meerdere opties mogelijk) </span> </h2>
				<div class="page_1_step">
					<?php
						$abc = 0;
						$category_ids = get_all_category_ids();
						
						foreach($category_ids as $cat_id) 
						{ if (!($cat_id == 7)) { ?>
							<div class="part<?php echo $abc; ?>">
								<div class="cat_con">
									<?php $cat_name = get_cat_name($cat_id);	
						   			      $my_category_id = $cat_id->term_id; 
			 		                           	      $custom_Img = categoryCustomFields_GetCategoryCustomField($cat_id, 'Img');	
									      $custom_Price = categoryCustomFields_GetCategoryCustomField($cat_id, 'Price');

									      $current_peer_arr = explode("@",$custom_Img[0]->field_value);
									      $cat_name;
									      $cat_price = $custom_Price[0]->field_value; 
									?>
									<div class="cat_img"><img src="<?php echo $current_peer_arr[0]; ?>" /></div>
									<div class="cat_price"><h2 class="c_t"><?php echo '€'.$cat_price; ?></h2></div>									<img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/images/SFDFRS.png" />
									<div class="cat_tit"><h2><?php echo $cat_name; ?></h2></div>
									
								</div>
								<div class="cat_desc">
									<div class="cat_d"><?php echo category_description($cat_id); ?></div>
								</div>
								
								<div class="check_option">
								<?php 
									$abc++;								
								 ?>
								<td>   <input style="height: 2px !important;display:none;" id="box" class="box<?php echo $abc; ?>" name="<?php echo $cat_name; ?>" type="checkbox" value="<?php echo $cat_name; ?>" /><span id="<?php echo $cat_name; ?>"><a id="kies<?php echo $cat_name; ?>">KIES </a><?php echo $cat_name; ?></span></td>
								</div>
							</div>
<?php	} }?>
				<div class="step_1_bord_1"></div>
				</div>

				<div id="rem1"></div><div id="rem2"></div><div id="rem3"></div>
				<ul class="submit_btn_step_1">
					  <li class="clearfix">
					    <input type="submit" value="GA NAAR STAP 2" class="next right" name="b_pg1"  />
					  </li>
				</ul>
			</div> 
</form>
<?php } 
if(isset($_SESSION['pg2'])){
?>
<form action="<?php echo get_template_directory_uri();?>/order-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
			<div class="page" id="pg2">
				<?php   
$i = 0;
$j = 0;
$name = array();

if($_SESSION['b']!=null){$name[$i] = $_SESSION['b'];$i = $i +1;$_SESSION['cat1']=$_SESSION['b'];}
if($_SESSION['c']!=null){$name[$i] = $_SESSION['c'];$i = $i +1;$_SESSION['cat2']=$_SESSION['c'];}
if($_SESSION['m']!=null){$name[$i] = $_SESSION['m'];$i = $i +1;$_SESSION['cat3']=$_SESSION['m'];}

$_SESSION['nof']  = $i;
$_SESSION['name'] = $name;

while($j<$i){
$w = 3;

$shad = array();
$refl = array();
$back = array();
$kraa = array();
$afme = array();
$onde = array();

$jpeg = array();
$png = array();
$psd = array();
$tiff = array();


$shad = $_SESSION['schaduw'];
$refl = $_SESSION['reflectie'];
$back = $_SESSION['background'];
$kraa = $_SESSION['collar'];
$afme = $_SESSION['dimension'];
$onde = $_SESSION['topic'];

$jpeg = $_SESSION['jpg'];
$png = $_SESSION['png'];
$psd = $_SESSION['psd'];
$tiff = $_SESSION['tiff'];

?>
<input type="hidden" id="ann" value="anntal_<?php echo $name[$j]; ?>" name="category" />	
				<div class="page_2_step">
				<h2> <?php echo $name[$j]; ?> </h2>
				<div class="h_rule"></div>				
				<h3>OPTIES</h3>
				<div class="hor_rule"></div>
				<h3>HOEVEEL AFBEELDINGEN WILT U IN DEZE CATEGORIE VRIJSTAAND LATEN MAKEN?</h3>
				<input id="annta_<?php echo $name[$j]; ?>" type="text" name="aantal[]" style="width:200px;" placeholder="AANTAL_"  value="<?php echo$_SESSION['antal'][$j]; ?>"/>
				<input style="display:none;" type="checkbox" name="tryoutoffer" class="anntaaa1<?php echo $j; ?>" value="1">
				<span id="anntaaa<?php echo $j; ?>">ik wil gebruik maken van de probeerservice (<span style="color: #EB4819;">3 productbeelden gratis</span>)</span>
				<div class="hor_rule"></div>
				<h3>KIES UW EXTRA'S</h3>
				<div style="position:relative;float:left;width:40%;padding:0px;height: 145px;">				
				<ul>
					<li><input style="display:none;" class="stp_f1_<?php echo $j; ?>" type="checkbox" name="schaduw<? echo $j;?>" value="ja" <?php if($shad[$j]== "ja"){echo "checked"; } ?> /><span id="download_now_f_<?php echo $j; ?>" ><div id="stp_f_<?php echo $j; ?>">SCHADUW TOEVOEGEN</div><span class="price123_step "> €0.25 <img style="vertical-align: text-bottom;" class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></span>
					<div class="tooltip_f_<?php echo $j; ?>">
						<div class="ttol_tipse">
							<span class="tool_font">SCHADUW</span>
							<p>Een vrijstaand beeld lijkt vaak te zweven wat onnatuurlijk oogt. Wij kunnen een realistisch schaduw toevoegen om dit te voorkomen. Let op: Transparante schaduw is duurder, vraag naar de prijs. Meer info over <a href="<?php echo get_permalink(183); ?>" target="_blank">schaduw</a>.</p>
							<div class="tool_img">
								<div class="tool_img_one">								
									<img src="<?php bloginfo('template_directory'); ?>/images/schaduw.png" />
									<span class="img_span">GEEN SCHADUW</span>
								</div>
								<div class="tool_img_second">								
									<span class="img_span" style="padding-left: 0px;padding-top: 122px;">WEL SCHADUW</span>
								</div>
							</div>
						</div>	
					</div>
					<br /></li>
					<li><input style="display:none;" class="stp_s1_<?php echo $j; ?>" type="checkbox" name="reflectie<? echo $j;?>" value="ja" <?php if($refl[$j]== "ja"){echo "checked"; } ?>><span id="download_now_<?php echo $j; ?>" ><div id="stp_s_<?php echo $j; ?>">REFLECTIE TOEVOEGEN</div><span class="price123_step "> €0.25 <img style="vertical-align: text-bottom;" class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></span>		
				<div class="tooltip_<?php echo $j; ?>">
					<div class="ttol_tipse">
							<span class="tool_font">REFLECTIE</span>
							<p>Reflectie is een weerspiegeling van het product alsof het op een reflecterend oppervlak staat. Meer info over <a href="<?php echo get_permalink(192); ?>" target="_blank">reflectie</a>.</p>
							<div class="tool_img">
								<div class="tool_img_one">								
									<img src="<?php bloginfo('template_directory'); ?>/images/tool1.png" />
									<span class="img_span" style="padding-left: 2px;padding-top: 17px;">GEEN REFLECTIE</span>
								</div>
								<div class="tool_img_second">								
									<img src="<?php bloginfo('template_directory'); ?>/images/tool2.png" />
									<span class="img_span" style="padding-top: 15px;">WEL REFLECTIE</span>
								</div>
							</div>
						</div>	
					</div>
					<br /></li>
			 		<li><input style="display:none;" class="stp_t1_<?php echo $j; ?>" type="checkbox" name="achtergrond<? echo $j;?>" value="ja" <?php if($back[$j]== "ja"){echo "checked"; } ?>><span id="download_now_t_<?php echo $j; ?>" ><div id="stp_t_<?php echo $j; ?>">ACHTERGROND PLAATSEN</div><span class="price123_step"> €0.25 <img style="vertical-align: text-bottom;" class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></span>
					<div class="tooltip_t_<?php echo $j; ?>">
					<div class="ttol_tipse">
							<span class="tool_font">ACHTERGROND</span>
							<p>Normaal gesproken leveren wij de beelden transparant of tegen een witte achtergrond. Wij kunnen een andere achtergrond plaatsen, een kleur, verloop of afbeelding. Meer info over <a href="<?php echo get_permalink(230); ?>" target="_blank">achtergrond plaatsen</a>.</p>
							<div class="tool_img">
								<div class="tool_img_one">								
									<img src="<?php bloginfo('template_directory'); ?>/images/achtergrond.png" />
									<span class="img_span">GEEN ACHTERGROND</span>
								</div>
								<div class="tool_img_second">								
									<span class="img_span" style="padding-top: 123px;">WEL ACHTERGROND</span>
								</div>
							</div>
						</div>	
					</div>
					<br /></li>
				</ul>
				</div>
				<div style="position:relative;float:left;width:40%;padding:0px;height: 145px;">				
				<ul>
					<li><input style="display:none;" class="stp_fo1_<?php echo $j; ?>" type="checkbox" name="kraagje<? echo $j;?>" value="ja" <?php if($kraa[$j]== "ja"){echo "checked"; } ?>>
					<span id="download_now_fo_<?php echo $j; ?>"><div id="stp_fo_<?php echo $j; ?>">KRAAGJE TOEVOEGEN</div><span class="price123_step "> €0.50 <img style="vertical-align: text-bottom;" class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></span>
					<div class="tooltip_fo_<?php echo $j; ?>">
					<div class="ttol_tipse">
							<span class="tool_font">MONTAGE</span>
							<p>Beelden van kleding op een model of paspop missen vaak het kraagje. Indien u een belde van de achterkant heeft kunnen wij een kraagje terugplaatsen. Meer info over <a href="<?php echo get_permalink(225); ?>" target="_blank">MONTAGE</a>.</p>
							<div class="tool_img">
								<div class="tool_img_one">								
									<img src="<?php bloginfo('template_directory'); ?>/images/Kraagje.png" />
									<span class="img_span">GEEN KRAAGJE</span>
								</div>
								<div class="tool_img_second" >								
									<span class="img_span" style="padding-top: 123px;">WEL KRAAGJE</span>
								</div>
							</div>
						</div>	
					</div>
					<br /></li>
					<li><input style="display:none;" class="stp_fi1_<?php echo $j; ?>" type="checkbox" name="afmetingen<? echo $j;?>" value="ja" <?php if($afme[$j]== "ja"){echo "checked"; } ?>><span id="download_now_fi_<?php echo $j; ?>" ><div id="stp_fi_<?php echo $j; ?>">AFMETINGEN AANPASSEN</div><span class="price123_step "> €0.25 <img style="vertical-align: text-bottom;" class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></span>
					<div class="tooltip_fi_<?php echo $j; ?>">
					<div class="ttol_tipse">
							<span class="tool_font">AFMETINGEN</span>
							<p>Soms is het handig om de beelden kant en klaar op een bepaald formaat te ontvangen. Mij schalen of snijden u beeld bij naar een maat of verhouding.</p>
							<div class="tool_img">
								<div class="tool_img_one">								
									<img src="<?php bloginfo('template_directory'); ?>/images/afmeting.png" />
									<span class="img_span">GEEN AFMETINGEN</span>
								</div>
								<div class="tool_img_second">								
									<span class="img_span" style="padding-top: 123px;">WEL AFMETINGEN</span>
								</div>
							</div>
						</div>	
					</div>
					<br /></li>
					<li><input style="display:none;" class="stp_si1_<?php echo $j; ?>" type="checkbox" name="onderwerp<? echo $j;?>" value="ja" <?php if($onde[$j]== "ja"){echo "checked"; } ?>><span id="download_now_si_<?php echo $j; ?>" ><div id="stp_si_<?php echo $j; ?>">ONDERWERP RECHT ZETTEN</div><span class="price123_step "> €0.15 <img style="vertical-align: text-bottom;" class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></span>
					<div class="tooltip_si_<?php echo $j; ?>">
					<div class="ttol_tipse">
							<span class="tool_font">ONDERWERP</span>
							<p>Staan uw beelden scheef of zijn ze gekanteld gefotografeerd? Wij zetten ze recht voor u.	</p>
							<div class="tool_img">
								<div class="tool_img_one">								
									<img src="<?php bloginfo('template_directory'); ?>/images/recht-zetten.png" />
									<span class="img_span">GEEN ONDERWERP</span>
								</div>
								<div class="tool_img_second" style="padding-left: 8px;padding-top: 114px; margin-left: 0;
    width: 125px; ">								
									<span class="img_span">WEL ONDERWERP</span>
								</div>
							</div>
						</div>	
					</div>
					<br /></li>
				</ul>
				</div>



				<div class="hor_rule" style="margin-top:11em;"></div>
				<h4>KIES DE OUPUT VAN UW BESTAND</h4>
				<span style="padding-bottom:5px;"> u krijgt standaard 1 bestandsformaat naar keuze, elke extra bestandsformaat kost  </span><span style="color: #EB4819;"> € 0.10</span><br />
				<div class="field_div"><input style="display : none;" class="jpg1_<?php echo $j; ?>" type="checkbox" name="jpg<? echo $j;?>" value="ja" <?php if($jpeg[$j]== "ja"){echo "checked"; } ?>><span id="jpg<?php echo $j; ?>">JPEG</span></div>
				<div class="field_div"><input style="display : none;" class="png1_<?php echo $j; ?>"type="checkbox" name="png<? echo $j;?>" value="ja" <?php if($png[$j]== "ja"){echo "checked"; } ?>><span id="png<?php echo $j; ?>">PNG</span></div>
				<div class="field_div"><input style="display : none;" class="psd1_<?php echo $j; ?>"type="checkbox" name="psd<? echo $j;?>" value="ja" <?php if($psd[$j]== "ja"){echo "checked"; } ?>><span id="psd<?php echo $j; ?>">PSD</span></div>
				<div class="field_div"><input style="display : none;" class="tiff1_<?php echo $j; ?>"type="checkbox" name="tiff<? echo $j;?>" value="ja" <?php if($tiff[$j]== "ja"){echo "checked"; } ?>><span id="tiff<?php echo $j; ?>">TIFF</span></div>
				<div class="hor_rule" style="margin-top:4em;"></div>
				<h4>OVERIGE OPMERKINGEN</h4>
				
				<textarea rows="8" cols="90" name="cmt[]" placeholder="TYPE HIER UW TEKST_" ><?php echo $_SESSION['comment'][$j]; ?></textarea>
				</div>
<?php 
$j = $j + 1;
$w++;
} ?>													
				<ul>
				  <li class="clearfix">
				<input type="submit" value="GA TERUG NAAR STAP 1" class="prev" style="float:left" name="b_pg2_back" />
				   
				    <input type="submit" value="GA NAAR STAP 3" class="next right" name="b_pg2" />
				</li>

				  <br clear="all" />
				</ul>
			</div>
</form>
<?php }

	// PG3
	if(isset($_SESSION['pg3'])) {

$antal = $_SESSION['antal']; 
$schaduw = $_SESSION['schaduw'];
$reflectie = $_SESSION['reflectie'];
$achtergrond = $_SESSION['background'];
$kraagje = $_SESSION['collar'];
$afmetingen = $_SESSION['dimension'];
$onderwerp = $_SESSION['topic'];
$comment = $_SESSION['comment'];
?>
	<form action="<?php echo get_template_directory_uri();?>/order-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">

			<div class="page" id="pg3">
				<div class="page_3_step">
				<?php 
				if($_SESSION['nof']!=null){
				$nof = $_SESSION['nof'];
				$count = 0;				
				while($nof > $count) {
				?>
				<div style="position:relative;float:left;width:50%;">
				<h2> <?php $name1 = $_SESSION['name']; echo $name1[$count]; ?> </h2>
				<h2 style="padding-bottom: 0;font-size:14px;color: #1E293B;">Aantal :<span style="color: #EB4819;font-size: 16px;
    padding-left: 5px;"><?php echo $antal[$count]; ?></span></h2>
				<?php 
				
				if($schaduw[$count]=="nee"){  }else { 
					echo "<h2 style='padding-bottom: 0;font-size:14px;color: #1E293B;'> slagschaduw :<span style='color: #EB4819;font-size: 16px;
    padding-left: 5px;'> $schaduw[$count]</span></h2>";
				} 
				
				if($reflectie[$count]=="nee"){  }else { 
					echo "<h2 style='padding-bottom: 0;font-size:14px;color: #1E293B;'> reflectie :<span style='color: #EB4819;font-size: 16px;
    padding-left: 5px;'> $reflectie[$count]</span></h2>";
				}

				if($achtergrond[$count]=="nee"){  }else { 
					echo "<h2 style='padding-bottom: 0;font-size:14px;color: #1E293B;'> achtergrond :<span style='color: #EB4819;font-size: 16px;
    padding-left: 5px;'> $achtergrond[$count]</span></h2>";
				}

				if($kraagje[$count]=="nee"){  }else { 
					echo "<h2 style='padding-bottom: 0;font-size:14px;color: #1E293B;'> kraagje :<span style='color: #EB4819;font-size: 16px;
    padding-left: 5px;'> $kraagje[$count]</span></h2>";
				} 
	
				if($afmetingen[$count]=="nee"){  }else { 
					echo "<h2 style='padding-bottom: 0;font-size:14px;color: #1E293B;'> afmetingen :<span style='color: #EB4819;font-size: 16px;
    padding-left: 5px;'> $afmetingen[$count]</span></h2>";
				}

				if($onderwerp[$count]=="nee"){  }else { 
					echo "<h2 style='padding-bottom: 0;font-size:14px;color: #1E293B;'> onderwerp :<span style='color: #EB4819;font-size: 16px;
    padding-left: 5px;'> $onderwerp[$count]</span></h2>";
				} 

				if($comment[$count]=="nee"){  }else { 
					echo "<h2 style='padding-bottom: 0;font-size:14px;color: #1E293B;'> opmerkingen :<span style='color: #EB4819;font-size: 16px;
    padding-left: 5px;'> $comment[$count]</span></h2>"; } ?>

				
								
				</div>				
				<div class="h_rule" style="margin-top: 20px;"></div>
				<h3 style="padding-bottom: 0;">uploaden</h3>
				<div class="hor_rule"></div>
				<h3>hoe wilt u uploaden?</h3><br/>

<input style="display: none;" rel="upload" id="optb<?php echo $count; ?>" type="radio" name="trip<?php echo $count; ?>" value="oneway"<?php if ($_SESSION['ftp0'] == 'oneway') { print ' checked'; } ?>><h3 id="opb<?php echo $count; ?>" style=" float: left;
    margin-top: -13px;
    width: 920px;">Direct uploaden</h3>
			<div id="dateb<?php echo $count; ?>" style="<?php if ($_SESSION['ftp0'] != 'oneway') { print 'display:none;'; } ?> float: left;
    padding-bottom: 20px;
    padding-left: 0px;
    padding-top: 0;
    width: 920px;">
	
				<div id="photouploader<?php echo $count; ?>" style="clear:both;"><p>Uw browser heeft geen Flash, Silverlight, Gears of HTML5 support.</p></div>
<?php
	if (!empty($_SESSION['image'][$count])) {
	
		if ($_REQUEST['fc'] == $count && $_REQUEST['deletephoto']) {
			foreach ($_SESSION['image'][$count] as $n => $img) {
				if ($img == $_REQUEST['deletephoto']) {
					unset($_SESSION['image'][$count][$n]);
				}
			}
		}

		print '<h3>Reeds ge&uuml;ploade foto\'s</h3>
<script type="text/javascript">
WECLIP.order.photos['.$count.'] = '.count($_SESSION['image'][$count]).';
</script>
		<table>';
		foreach ($_SESSION['image'][$count] as $img) {
?>
<tr style="font-size:16px;font-family:verdana,arial;">
	<td><strong><?=$img;?></strong></td>
	<td style="padding-left:5px;">[<a href="javascript:void(0);" onclick="if (!confirm('Weet u zeker dat u deze foto wil verwijderen?',true)) { return false; } else { document.location.href = '/order/?fc=<?=$count;?>&deletephoto=<?=urlencode($img);?>'; }" style="color:red;">X</a>]</td>
</tr>
<?php
		}
		print '</table>';
	}
?>
				<input type="hidden" name="hide" value="i Am Hidden" />			
			</div>	
		<input style="display: none;" rel="ftp" id="opta<?php echo $count; ?>" type="radio" name="trip<?php echo $count; ?>" value="round"<?php if ($_SESSION['ftp0'] == 'round') { print ' checked'; } ?>><h3 id="opa<?php echo $count; ?>">Uploaden via FTP SERVER.</h3>
			<div id="datea<?php echo $count; ?>" style="<?php if ($_SESSION['ftp0'] != 'round') { print 'display:none;'; } ?> 
    padding-bottom: 20px;
    padding-left: 57px;
    padding-top: 0;
    width: 920px;">				
				<div id="id_input" style="background: -moz-linear-gradient(center top , #FFFFFF 0%, #EDEDED 100%) repeat scroll 0 0 transparent;
    border: 1px solid #E6E6E6;
    line-height: 30px;
    text-align: center;width: 300px;font-size: 14px;">U ontvangt een e-mail met instructies.</div>
			</div>
				<div class="h_rule" style="margin-top: 20px;"></div>
<?php 
					$count = $count + 1; 
				}
			} 
?>
				</div>
				<ul>
				  <li class="clearfix">
				    <input type="submit" value="GA TERUG NAAR STAP 2" class="prev" style="float:left" name="b_pg3_back" />
				    <input type="submit" value="GA NAAR STAP 4" class="next right" name="b_pg3" />
				  </li>

				  <br clear="all" />
				</ul>
			</div>
</form>
<?php 
		

	} // PG3
	
	
	// PG4
	if(isset($_SESSION['pg4'])){

		$name1 = $_SESSION['name'];
		$antal = $_SESSION['antal']; 
		$schaduw = $_SESSION['schaduw'];
		$reflectie = $_SESSION['reflectie'];
		$achtergrond = $_SESSION['background'];
		$kraagje = $_SESSION['collar'];
		$afmetingen = $_SESSION['dimension'];
		$onderwerp = $_SESSION['topic'];
		$comment = $_SESSION['comment'];
		$nof = $_SESSION['nof'];
		$cnt = 0;
?>
<form action="<?php echo get_template_directory_uri();?>/order-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
			<div class="page" id="pg4">
				<div class="page_4_step">
				<?php  while($nof > $cnt) {  ?>
				<div style="position:relative;float:left;width:33%;">
				<h2> <?php  echo $name1[$cnt]; ?> </h2>
				<h2 style="font-size:14px;color: #1E293B; padding-bottom: 0;">Aantal :<span style="color: #EB4819;
    font-size: 15px;
    padding-left: 4px;"><?php echo $antal[$cnt]; ?></span></h2>

				<?php 
				
				if($schaduw[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> slagschaduw :<span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $schaduw[$cnt] </span></h2>"; }

				if($reflectie[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> reflectie : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $reflectie[$cnt] </span></h2>"; }

				if($achtergrond[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> achtergrond : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $achtergrond[$cnt] </span></h2>"; }

				if($kraagje[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> kraagje : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $kraagje[$cnt] </span></h2>"; }

				if($afmetingen[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> afmetingen : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $afmetingen[$cnt] </span></h2>"; }
	
				if($onderwerp[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> onderwerp : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $onderwerp[$cnt] </span></h2>"; }

				if($comment[$cnt]=="nee"){ }else {
					echo "<h2 style='font-size:14px;color: #1E293B;'> opmerkingen :<span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $comment[$cnt] </span></h2>"; } 

?>
</div><!-- incline css div ends here  --->
<?php $cnt = $cnt + 1; } ?>
<?php $radd = $_SESSION['delivery']; ?>				
				<div class="h_rule" style="margin-top:20px;"></div>
				<h3>oplevering in 5 werkdagen</h3>
				<div class="hor_rule" style="margin-top:0px;margin-bottom: 22px;"></div>
				<div class="calender"></div>
				<div style="float: right;
    height: 125px;
    line-height: 25px;
    padding-left: 20px;
    position: relative;
    width: 81%;"><span style="    font-size: 13px;
    width: 313px;">weclip garandeert u standaart een snelle levering van 5 werkdagen op reguliere bestanden tot 1.000 stuks zonder extra kosten</span></div><br />
				<input style="display : none;" class="ra5" type="radio" name="dtype" value="5 Days" <?php if($radd == "5 Days") { echo "checked"; } ?> ><span id="day5" style=" font-size: 16px;width : 400px !important;" > oplevering in 5 dagen </span>
				<div class="h_rule" style="margin-top:36px;"></div>
				<h3>oplevering in 24 uur</h3>				
				<div class="hor_rule" style="margin-top:0px;"></div>				
				<div class="clock"></div>
				<div style="float: right;
    height: 125px;
    line-height: 25px;
    padding-left: 20px;
    position: relative;
    width: 82%;"><span style="font-size: 13px;
    width: 313px;" >Ook als u spoed heeft zijn wij de goedkoopste. Tegen een kleine meerprijs van €0.25 per beeld leveren wij bestanden in lage resolutie tot 300 stuks binnen 24 uur, grotere aantallen of formaten gaan in overleg.</span></div><br />
				<input style="display : none;" class="ra24" type="radio" name="dtype" value="24 Hrs" <?php if($radd == "24 Hrs"){ echo "checked"; } ?> ><span style=" font-size: 15px;width : 190px !important;" id="hr24">oplevering in 24 uur</span>
				<span style=" color: #EB4819;
    font-size: 15px;
    left: 252px;
    position: relative;
    top: 36px;" class="sec_in"> €0,25 extra </span> 
				<div style="margin-top: 81px;"  class="hor_rule"></div>
				</div>
				
				<ul>
				  <li class="clearfix">
				   <input type="submit" value="GA TERUG NAAR STAP 3" class="prev" style="float:left" name="b_pg4_back" />
				   <input type="submit" value="GA NAAR STAP 5" class="next right" name="b_pg4" /> 
				  </li>

				  <br clear="all" />
				</ul>
			</div>
</form>
<?php 
	}

	
	// PG5
	if(isset($_SESSION['pg5'])) {
		$name1 = $_SESSION['name'];
		$antal = $_SESSION['antal']; 
		$schaduw = $_SESSION['schaduw'];
		$reflectie = $_SESSION['reflectie'];
		$achtergrond = $_SESSION['background'];
		$kraagje = $_SESSION['collar'];
		$afmetingen = $_SESSION['dimension'];
		$onderwerp = $_SESSION['topic'];
		$comment = $_SESSION['comment'];
		$nof = $_SESSION['nof'];
		$cnt = 0;

?>
			<div class="page" id="pg5">
				<div class="page_5_step">
				<?php  while($nof > $cnt) {  ?>
				<div style="position:relative;float:left;width:33%;">
				<h2> <?php  echo $name1[$cnt];  ?> </h2>
				<h2 style="font-size:14px;color: #1E293B; padding-bottom: 0;">Aantal :<span style="color: #EB4819;
    font-size: 15px;
    padding-left: 4px;"><?php echo $antal[$cnt]; ?></span></h2>
				<?php 
				
				if($schaduw[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> slagschaduw :<span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $schaduw[$cnt] </span></h2>"; }

				if($reflectie[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> reflectie : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $reflectie[$cnt] </span></h2>"; }

				if($achtergrond[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> achtergrond : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $achtergrond[$cnt] </span></h2>"; }

				if($kraagje[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> kraagje : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $kraagje[$cnt] </span></h2>"; }

				if($afmetingen[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> afmetingen : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $afmetingen[$cnt] </span></h2>"; }
	
				if($onderwerp[$cnt]=="nee"){ } else {
					echo "<h2 style='font-size:14px;color: #1E293B; padding-bottom: 0;'> onderwerp : <span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $onderwerp[$cnt] </span></h2>"; }

				if($comment[$cnt]=="nee"){ }else {
					echo "<h2 style='font-size:14px;color: #1E293B;'> opmerkingen :<span style='color: #EB4819;font-size: 15px;padding-left: 4px;'> $comment[$cnt] </span></h2>"; } 

?>
</div>
<?php $cnt = $cnt + 1; } ?>				
				<div class="h_rule" style="margin-top:20px;"></div>

			<?php if ( is_user_logged_in() ) {
?>
<form action="<?php echo get_template_directory_uri();?>/order-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
<?php
				if ($_REQUEST['confirm']) {
?>
<script type="text/javascript">
$(function() {
	$('[name=vv1]').prop('checked',true);
	$('[name=vv2]').prop('checked',true);
	$('#signup_form').append($('<input type="hidden" name="b_pg5" value="1" />'));
	$('#signup_form').submit();
});
</script>
<?php
				}
			
			} else {?>
			
			<form action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" class="standard-form" method="post">
				<input type="hidden" name="redirect_to" value="/order/?confirm=1" />
				<input type="hidden" name="customize-login" value="1" />
				<h3>LOG HIER IN</h3>	
				<div class="hor_rule" style="margin:10px 0px 20px;"></div>				
				<div class="field">
				<h4>E-MAIL</h4>
				<input type="email" name="log" value="<?php echo htmlentities($_SESSION['emladdr'],ENT_COMPAT,'utf-8'); ?>">
				</div>
				<div class="field">
				<h4>PASSWORD</h4>
				<input type="password" name="pwd">
				</div>
				<div class="field">
				<input type="submit" value="AANMELDEN" class="next right" name="wp-submit" />
				</div>
				<br />
				
			</form>
			<div style="clear:both;">&nbsp;</div>
			<div class="hor_rule" style="margin:10px 0px 20px;"></div>
	
<form action="<?php echo get_template_directory_uri();?>/order-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
<div id="existinglogin-form" title="Inloggen" style="display:none;">
<p class="validateTips">Het e-mailadres dat u heeft ingevoerd is reeds geregistreerd. Vul uw wachtwoord in om aan te melden en uw aanvraag te verzenden of klik op anuleren om een ander e-mailadres in te vullen.</p>
<br />
<fieldset>
<label for="password">Wachtwoord</label>
<input type="password" name="pwd" id="existinglogin_pwd" value="" class="text ui-widget-content ui-corner-all" />
</fieldset>
</div>
				<h3>OF MAAK EEN ACCOUNT AAN</h3>	
				<div class="hor_rule" style="margin:10px 0px 20px;"></div>
				<div class="field">
				<h4>AANHEF</h4>
				<select name="gender" id="gender">
					<option value="male"<?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'male') { print ' selected'; } ?>>Dhr.</option>
					<option value="female"<?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'female') { print ' selected'; } ?>>Mevr.</option>
				</select>
				</div>
				<div class="field">
				<h4>VOORNAAM</h4>
				<input type="text" name="fname" placeholder="TYPE HIER_" id="fname" value="<?php echo $_SESSION['fname']; ?>">
				</div>
				<div class="field">
				<h4>ACHTERNAAM</h4>
				<input type="text" name="sname" placeholder="TYPE HIER_" id="sname" value="<?php echo $_SESSION['sname']; ?>">
				</div>
				<div class="hor_rule" style="margin-top:82px;"></div>
				<div class="field">
				<h4>BEDRIJFSNAAM</h4>
				<input type="text" name="compname" placeholder="TYPE HIER_" id="compname" value="<?php echo $_SESSION['compn']; ?>">
				</div>	
				<div class="field">
				<h4>adres</h4>
				<input type="text" name="streetname" placeholder="TYPE HIER_" id="streetname" value="<?php echo $_SESSION['stree']; ?>">
				</div>
				<div class="field">
				<h4>postcode</h4>
				<input type="text" name="postcode" placeholder="TYPE HIER_" id="postcode" value="<?php echo $_SESSION['postc']; ?>">
				</div>
				<div class="hor_rule" style="margin-top:85px;"></div>
				<div class="field">
				<h4>plaats</h4>
				<input type="text" name="place" placeholder="TYPE HIER_" id="place" value="<?php echo $_SESSION['place']; ?>">
				</div>
				<div class="field">
				<h4>TEL.NUMMER</h4>
				<input type="text" name="telno" placeholder="TYPE HIER_" id="telno" value="<?php echo $_SESSION['telno']; ?>">
				</div>
				<div class="field">
				<h4>EMAIL ADRES</h4>
				<input type="text" name="email" placeholder="TYPE HIER_" id="email" value="<?php echo htmlentities($_SESSION['emladdr'],ENT_COMPAT,'utf-8'); ?>">
				</div>
				<div class="hor_rule" style="margin-top:88px;"></div>
				<div class="field">
				<h4>KVK NUMMER</h4>
				<input type="text" name="kvkno" placeholder="TYPE HIER_" id="kvkno" value="<?php echo $_SESSION['kvkno']; ?>">
				</div>
				<div class="field">
				<h4>UW WACHTWOORD</h4>
				<input type="password" name="password" placeholder="TYPE HIER_" id="password">
				</div>
				<div class="field">
				<h4>HERHAAL WACHTWOORD</h4>
				<input type="password" name="cpassword" placeholder="TYPE HIER_" id="cpassword">
				</div>
				<div class="h_rule" style="margin-top:5px;"></div>
				
			<?php } ?>
				<h3> akkoord</h3>	
				<div class="hor_rule" style="margin:10px 0px 20px;"></div>
				<input  style=" display: none;" class="register_1" id="regi" name="vv1" type="checkbox" value="1" /><span id="register_12">ik ga akkoord met de voorwaarden</span><br />
				<input  style=" display: none;" class="register_2" id="regi" name="vv2" type="checkbox" value="1" checked /><span id="register_22">ik blijf graag op de hoogte van de voordelen van weclip </span>

				</div>
				<br />
				
				<p style=" margin-top: 150px;">
				   <input type="submit" value="GA TERUG NAAR STAP 4" class="prev" style="float:left" name="b_pg5_back" />
				  <input type="submit" value="PLAATS BESTELLING" class="next right" name="b_pg5" /> 	  
				</p>
			</div>
</form>
<?php
		if ($_REQUEST['existinglogin']) {
?>
<script type="text/javascript">
$(function() {
	$('html, body').animate({
		scrollTop:$(document).height()
	}, 'fast', 'swing', function() {
			$( "#existinglogin-form" ).dialog({
				autoOpen: true,
				height: 300,
				width: 350,
				modal: true,
				buttons: {
					"Aanmelden": function() {
						$('body').append($('<form id="existinglogin_loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" name="loginform"><input type="hidden" name="log" value="<?php echo htmlentities($_SESSION['emladdr'],ENT_COMPAT,'utf-8'); ?>" /><input type="hidden" name="wp-submit" value="1" /><input type="hidden" name="redirect_to" value="/order/?confirm=1" /><input type="hidden" name="customize-login" value="1" /><input type="hidden" name="pwd" value="'+$('#existinglogin_pwd').val()+'" /></form>'));
						$('#existinglogin_loginform').submit();
						
					},
					"Annuleren": function() {
						$( this ).dialog( "close" );
					}
				},
				close: function() {
					
				}
			});
		});
});
</script>
<?php
		}
		
	}
?>
	
		</div>
	</div>
<?php get_footer(); ?>
