<?php
/* 
Template Name: Overige diensten 
*/
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


    <header id="header" class="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
        <?php
        if (has_post_thumbnail()){
            the_post_thumbnail('header');
        }
        ?>

            <div class="step_line">
                <span class="first-line">
                    <?php 
                    if (get_field('streamer_line1')) {
                        echo get_field('streamer_line1');
                    }
                    else {
                        echo "foto's" ;
                    } ?>
                </span>
                 <span class="second-line">
                    <?php 
                    if (get_field('streamer_line2')) {
                        echo get_field('streamer_line2');
                    }
                    else {
                        echo "VRIJSTAAND" ;
                    } ?>
                </span>
                <span class="third-line">
                    <?php 
                    if (get_field('streamer_line3')) {
                        echo get_field('streamer_line3');
                    }
                    else {
                        echo "maken" ;
                    } ?>
                    </span>
                </span>
            </div>
              

    </header>


	<main  id="extra" class="content alternates" role="main" itemprop="mainContentOfPage">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="row titleRow">
        	 <h1 itemprop="headline" class="basic"><?php the_title(); ?></h1>
        </div>
		<div class="row contentRow">
        	 <?php the_content(); ?>
        </div>
        <section class="section odd patOrHor">
        	<img src="<?php bloginfo('template_directory'); ?>/gfx/camera.png" alt="Fotografie bij WeClip" class="icon" />
            <div class="row-pad" itemprop="text">
            	<h2 itemprop="headline">Fotografie</h2>
                <p>Weclip beschikt zelf over een elgen fotostudio in onze vestiging te Utrecht. Onze fotografen hebben ervaring met veel soorten productfotografie maar bijvoorbeeld ook met modelfotografie. Deze dienst sluit naadloos aan bij onze andere dienstverleing en zo kunnen tegen aantrekkelijke prijzen leveren.</p>
            </div>
        </section>
        <section class="section even">
        	<img src="<?php bloginfo('template_directory'); ?>/gfx/calc.png" alt="Offerte" class="icon" />
            <div class="row-pad" itemprop="text">
            	<h2 itemprop="headline">Offerte aanvragen</h2>
                
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
        </section>
		<?php endwhile; endif; ?>
	</main> <!-- .article -->
	

<?php get_footer(); ?>