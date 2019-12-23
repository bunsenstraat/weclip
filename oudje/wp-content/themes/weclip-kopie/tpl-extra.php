<?php 
/*
Template Name: extra
*/
?>
<?php 
session_start();

get_header(); 
?>

<script type="text/javascript">
function validme()
                    {
			var email = document.getElementById("email").value;
			var atpos=email.indexOf("@");
			var dotpos=email.lastIndexOf(".");
                        var naam = document.getElementById("naam").value;
                        
                        var telephone = document.getElementById("telephone").value;
                        var diensten_f = document.getElementById("e_services_f").value;
			var anntel = document.getElementById("anntel").value;
                        
			var check_1 = document.extra_form.e_services1.checked;
			var check_2 = document.extra_form.e_services2.checked;
			var check_3 = document.extra_form.e_services3.checked;
			var check_4 = document.extra_form.e_services4.checked;
			var check_5 = document.extra_form.e_services5.checked;
			var check_6 = document.extra_form.e_services6.checked;
			var check_7 = document.extra_form.e_services7.checked;
                        
			var toelichting1 = document.getElementById("e_description").value;

			var node_list = document.getElementsByTagName('input');

                        if(naam==null || naam=="")
                        {
                            alert("Voer uw naam in.");
                            document.getElementById("naam").focus();
                            return false;
                        }    
                        if(email==null || email=="")
                        {
                            alert("Voer een geldig e-mailadres in.");
                            document.getElementById("email").focus();
                            return false;
                        }
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
			{
			    alert('Voer een geldig e-mailadres in.');
			    document.getElementById("email").focus();
			    return false;
			}
                        if(telephone==null || telephone=="")
                        {
                            alert("Voer uw telefoonnummer in.");
                            document.getElementById("telephone").focus();
                            return false;
                        }
			if (check_1 == false && check_2 == false && check_3 == false && check_4 == false && check_5 == false && check_6 == false && check_7 == false)
			{
			    if (diensten_f ==null || diensten_f=="") {
			    alert ('Kies een dienst waar u interesse in heeft. ');
			    document.getElementById("e_services_f").focus();
			    return false;}
			}
			
			if(toelichting1==null || toelichting1=="")
                        {
                            alert("Geef een toelichting bij uw offerte.");
                            document.getElementById("e_description").focus();
                            return false;
                        }
                    return true;
}
</script>

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
	
<div class="extra_content">
	<div class="step_content">
		<h1 class="basic"><?php the_title() ?></h1>
        <img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/price_cut.png" />
    </div>
    <div class="step_content1">
        <p>Weclip doet meer dan vrijstaand maken. Wij hebben veel ervaring op alle terreinen van beeldbewerking. Naast de standaard opties zoals te vinden onder prijzen kunnen wij bijvoorbeeld de kwaliteit van uw beelden verbeteren, hinderlijke elementen vervangen, kleuren vervangen of corrigeren en nog veel meer.</p>
    </div>
</div>
<div class="half-gfx-top">
<img class="camera" src="<?php bloginfo('template_directory'); ?>/images/camera.png" />
</div>
<div class="blueblock graphblock">
	<div class="container">
		<h1>FOTOGRAFIE</h1>
		<p>Weclip beschikt zelfs over een elgen fotostudio in onze vestiging in Utrecht met een oppervlakte van 400m2. Dit is een volwaardige studio waar we producten, maar ook modellen of grote objecten optimaal kunnen fotograferen.</p>
	</div>
</div>
<div class="calc">
<img class="calculator" src="<?php bloginfo('template_directory'); ?>/images/calc.png" />
</div>
<div class="extra_form">
	<div class="second_part2">
		<h1>OFFERTE</h1>
		<p>Voor deze aanvullende dlensten kunnen wij advies en een prljs op maat geven. Vraag hier uw offerte aan.</p>
	</div>
	<div class="second_part3">
		<form action="<?php echo get_template_directory_uri();?>/extra-action.php" name="extra_form" id="extra_form" class="standard-form" method="post" enctype="multipart/form-data" onsubmit="return validme();">

			<div class="field">
				<h4>NAAM *</h4>
				<input type="text" name="e_name" id="naam" value="<?php echo $_SESSION['e_name']; ?>">
			</div>
			<div class="field">
				<h4>BEDRIJFSNAAM</h4>
				<input type="text" name="e_company" id="bedrijfsnaam" value="<?php echo $_SESSION['e_company']; ?>">
			</div>
			<div class="field">
				<h4>E-MAILADRES *</h4>
				<input type="text" name="e_email" id="email" value="<?php echo $_SESSION['e_email']; ?>">
			</div>
			<div class="field">
				<h4>TELEFOONNUMMER *</h4>
				<input type="text" name="e_telephone" id="telephone" value="<?php echo $_SESSION['e_telephone']; ?>">
			</div>
			<div class="field">
				<h4>DIENSTEN *</h4>
				<ul>
					<li><input type="checkbox" name="e_services1" value="KWALITEIT" <?php if($_SESSION['e_services1']== "KWALITEIT"){echo "checked"; } ?> ><span>KWALITEIT VERBETEREN</span></li>
					<li><input type="checkbox" name="e_services2" value="RETOUCHEREN" <?php if($_SESSION['e_services2']== "RETOUCHEREN"){echo "checked"; } ?> ><span>RETOUCHEREN</span></li>
					<li><input type="checkbox" name="e_services3" value="VERVANGER" <?php if($_SESSION['e_services3']== "VERVANGER"){echo "checked"; } ?> ><span>KLEUR VERVANGER</span></li>
					<li><input type="checkbox" name="e_services4" value="CORRIGEREN" <?php if($_SESSION['e_services4']== "CORRIGEREN"){echo "checked"; } ?> ><span>KLEUR CORRIGEREN</span></li>
					<li><input type="checkbox" name="e_services5" value="FOTOGRAFIE1" <?php if($_SESSION['e_services5']== "FOTOGRAFIE1"){echo "checked"; } ?> ><span>FOTOGRAFIE</span></li>
					<li><input type="checkbox" name="e_services6" value="FOTOGRAFIE2" <?php if($_SESSION['e_services6']== "FOTOGRAFIE2"){echo "checked"; } ?> ><span>360' FOTOGRAFIE</span></li>
					<li><input type="checkbox" name="e_services7" value="ANDERS" <?php if($_SESSION['e_services7']== "ANDERS"){ echo "checked"; } ?> ><span>ANDERS NL: </span></li>
					<li><input type="text" name="e_services" style="width: 295px;margin-top: 7px;" id="e_services_f" value="<?php echo $_SESSION['e_services']; ?>"></li>
				</ul>
			</div>
			<div class="field">
				<h4>AANTAL</h4>
				<input type="text" name="e_aantel" id="anntel" value="<?php echo $_SESSION['e_aantel']; ?>">
			</div>
			<div class="field">
				<h4>BESTANDEN (TER BEOORDELING)</h4>
				<input type="file" name="file" id="file" style="float: right;height: 33px;margin-bottom: 12px;text-align: left;width: 448px;">
			</div>
			<div class="field">
				<h4>TOELICHTING *</h4>
				<textarea id="e_description" aria-required="true" rows="8" cols="45" name="e_description"><?php echo $_SESSION['e_description']; ?></textarea>
			</div>
			<div class="field">
				<input type="submit" value="VERSTUREN" class="next right" name="submit" style="float: right" onClick="return validme();" />
			</div>
			
		</form>
	</div>
</div>
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
