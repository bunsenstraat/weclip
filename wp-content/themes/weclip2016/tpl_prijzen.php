<?php
/* 
Template Name: Prijzen 
*/
get_header();

session_start();
get_header(); 
unset($_SESSION['b']);
unset($_SESSION['c']);
unset($_SESSION['m']);
unset($_SESSION['pg2']);

?>
    <header id="header" class="header patOrHor" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
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


	<main class="content prices" role="main" itemprop="mainContentOfPage">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="row titleRow">
        	 <h1 itemprop="headline" class="basic orange"><?php the_title(); ?></h1>
        </div>


<div class="prices_content blueblock">
    <div class="row-pad">
    	<p>Bij WeClip kunt u beelden vrijstaand laten maken tegen de laagste prijzen. Wij hanteren slechts drie prijscategorieën, hieronder vind u per categorie de prijs en enkele voorbeelden.</p>
    </div>
    <div class="row">
			<form action="<?php echo get_template_directory_uri();?>/order-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
						<?php
							$abc = 0;
							$category_ids = get_all_category_ids();
							foreach($category_ids as $cat_id) 
							{ if (!($cat_id == 7)) { ?>
								<div class="block span3 catid<?php echo $cat_id ?>" id="id-<?php echo $cat_id ?>" >
									<div class="cat_con1">
										<?php $cat_name = get_cat_name($cat_id);	
							   			      $my_category_id = $cat_id->term_id; 
			 		        	              $custom_Img = categoryCustomFields_GetCategoryCustomField($cat_id, 'Img');
										      $custom_Price = categoryCustomFields_GetCategoryCustomField($cat_id, 'Price');
										      $current_peer_arr = explode("@",$custom_Img[0]->field_value);
										      $cat_name;
										      $cat_price = $custom_Price[0]->field_value; 
										?>
                                        <div class="ruit">
                                            <div class="catPrice"><span><?php echo '€'.$cat_price; ?></span></div>                                            <div class="catTitle"><?php echo $cat_name; ?></div>                
                                        </div>

										<div class="cat_img"><img src="<?php echo $current_peer_arr[0]; ?>" /></div>
										<div class="cat_desc">
										<div class="cat_d"><?php echo category_description($cat_id); ?></div>
										<ul>
						  					<li class="clearfix" id="ord">
						    						<a href="<?php echo get_template_directory_uri();?>/order-action.php/?single_cat=<?php echo $cat_name;?>">PROBEER NU GRATIS</a>
						  					</li>
										</ul>
										<div class="more_photo">
											<p>Zie enkele voorbeelden van productfoto's hieronder</p>
										</div>
                                        <div class="examples">
                                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-1.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-2.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-3.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-4.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-5.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                                        </div>

									</div>
									</div>
									<?php $abc++; ?>
								</div>
							<?php	} } ?>
			</form>
</div>

<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script type="text/javascript">

$(document).ready(function() 
{
	$("#schaduw").tooltip({  position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
	$("#reflectie").tooltip({ position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
	$("#achtergrond").tooltip({ position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
	$("#kraagje").tooltip({ position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
	$("#afmetingen").tooltip({ position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
	$("#bestandsformaten").tooltip({ position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
	$("#onderwerp").tooltip({ position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
	$("#spoedservice").tooltip({ position: "bottom right", effect: 'toggle', delay:300, predelay:300, offset:[-34, 13]});
});

</script>

<div class="other_services">
	<div class="services">
		<div class="step_content">
			<h2 class="how_title1" style="color: #1E293B;">OVERIGE TARIEVEN</h2>
			<img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/cat.png" />
		</div>
		<div class="other_table">
		<div class="price_price">
			<ul>
				<li class="listing heading">
                    <div class="description">DIENST</div>
					<div class="price">PRIJS</div>
				</li>
                <li class="listing head">
                    <div class="description">REALISTISCHE SCHADUW TOEVOEGEN <span id="schaduw"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="schaduw_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">SCHADUW</span>
                            <p>Een vrijstaand beeld lijkt vaak te zweven wat onnatuurlijk oogt. Wij kunnen een realistisch schaduw toevoegen om dit te voorkomen. Let op: Transparante schaduw is duurder, vraag naar de prijs.</p>
                            <div class="tool_img">
                            	<img src="<?php bloginfo('template_directory'); ?>/images/schaduw.png" />
                                <span class="img_span">GEEN SCHADUW</span>
                                <span class="img_span">WEL SCHADUW</span>
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,25</div>
                </li>

				<li class="listing">
                    <div class="description">REFLECTIE TOEVOEGEN <span id="reflectie"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="reflectie_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">REFLECTIE</span>
							<p>Reflectie is een weerspiegeling van het product alsof het op een reflecterend oppervlak staat.</p>
                            <div class="tool_img">
                                <img src="<?php bloginfo('template_directory'); ?>/images/tool1.png" />
                                <img src="<?php bloginfo('template_directory'); ?>/images/tool2.png" />
                                <span class="img_span">GEEN REFLECTIE</span>
                                <span class="img_span">WEL REFLECTIE</span>
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,25</div>
                </li>
				
				<li class="listing">
                    <div class="description">ACHTERGROND PLAATSEN (KLEUR OF VERLOOP) <span id="achtergrond"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="achtergrond_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">ACHTERGROND</span>
							<p>Normaal gesproken leveren wij de beelden transparant of tegen een witte achtergrond. Wij kunnen een andere achtergrond plaatsen, een kleur, verloop of afbeelding.</p>
                            <div class="tool_img">
                                <img src="<?php bloginfo('template_directory'); ?>/images/achtergrond.png" />
                                <span class="img_span">Geen achtergrond</span>
								<span class="img_span">Wel achtergrond</span>
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,25</div>
                </li>

				<li class="listing">
                    <div class="description">KRAAG TOEVOEGEN <span id="kraagje"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="kraagje_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">KRAAG</span>
							<p>Beelden van kleding op een model of paspop missen vaak het kraagje. Indien u een belde van de achterkant heeft kunnen wij een kraagje terugplaatsen.</p>
							<div class="tool_img">
                                <img src="<?php bloginfo('template_directory'); ?>/images/Kraagje.png" />
                                <span class="img_span">Geen kraag</span>
                                <span class="img_span">Wel kraag</span>
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,50</div>
                </li>

				<li class="listing">
                    <div class="description">AFMETINGEN AANPASSEN <span id="afmetingen"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="afmetingen_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">KRAAG</span>
							<p>Soms is het handig om de beelden kant en klaar op een bepaald formaat te ontvangen. Mij schalen of snijden u beeld bij naar een maat of verhouding.</p>
							<div class="tool_img">
                                <img src="<?php bloginfo('template_directory'); ?>/images/afmeting.png" />
                                <span class="img_span">Normaal</span>
                                <span class="img_span">Aangepast</span>
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,25</div>
                </li>

				<li class="listing">
                    <div class="description">EXTRA BESTANDSFORMAAT AANLEVEREN (PSD, GIF, ENZ.) <span id="bestandsformaten"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="afmetingen_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">Bestandsformaten</span>
							<p>Standaard leveren wij uw beelden in een bestandsformaat naar keuze. U kunt ook extra formaten aanvragen.</p>
							<div class="tool_img">
								<img src="<?php bloginfo('template_directory'); ?>/images/price-bestandsformaten.png" />
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,10</div>
                </li>
				
				<li class="listing">
                    <div class="description">ONDERWERP RECHT ZETTEN <span id="onderwerp"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="afmetingen_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">Recht zetten</span>
							<p>Staan uw beelden scheef of zijn ze gekanteld gefotografeerd? Wij zetten ze recht voor u.	</p>
							<div class="tool_img">
                                <img src="<?php bloginfo('template_directory'); ?>/images/recht-zetten.png" />
                                <span class="img_span">scheef</span>
                                <span class="img_span">recht</span>
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,15</div>
                </li>

				<li class="listing">
                    <div class="description">24 uur service <span id="spoedservice"><img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/price_price.png" /></span></div>
                    <div class="spoedservice_tooltip tooltip">
                        <div class="ttol_tipse">
                            <span class="tool_font">24 uur service</span>
							<p>Wij verwerken uw beelden binnen 5 dagen. Heeft u de beelden  sneller nodig kunt u gebruik maken van onze 24 uur service (tot 400 beelden, afhankelijk van de categorie).</p>
							<div class="tool_img">
									<img src="<?php bloginfo('template_directory'); ?>/images/price-spoed.png" />
                            </div><!-- end tool_img -->
                        </div><!-- end ttol_tipse -->	
                    </div><!-- end schaduw_tooltip -->
					<div class="price">€0,25</div>
                </li>

			</ul>
		</div>
		</div>	
	</div>
</div>



		<?php endwhile; endif; ?>
	</main> <!-- .article -->
	

<?php get_footer(); ?>