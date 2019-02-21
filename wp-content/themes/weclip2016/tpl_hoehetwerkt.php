<?php
/* 
Template Name: Hoe het werkt 
*/
get_header();
?>
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


	<main class="content alternates" role="main" itemprop="mainContentOfPage">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="row titleRow">
        	 <h1 itemprop="headline" class="basic"><?php the_title(); ?></h1>
        </div>
        <section class="section odd patOrHor">
        	<img src="<?php bloginfo('template_directory'); ?>/gfx/how_1.png" alt="Complexiteit bepalen" class="icon" />
            <div class="row-pad" itemprop="text">
            	<h2 itemprop="headline">1 - BEPAAL DE COMPLEXITEIT VAN UW BESTANDEN</h2>
                <p>Onze tarieven zijn gebaseerd op de complexiteit van uw bestanden. Zo is een blik soep makkelijk vrijstaand te maken en een fiets zeer moeilijk. Wij hebben onder prijzen enkele voorbeelden staan en mocht u nog twijfelen kunt u ons altijd raadplegen.</p>
            </div>
        </section>
        <section class="section even">
        	<img src="<?php bloginfo('template_directory'); ?>/gfx/how_2.png" alt="Opties kiezen" class="icon" />
            <div class="row-pad" itemprop="text">
            	<h2 itemprop="headline">2 - KIES DE OPTIES</h2>
                <p>Onze tarieven zijn gebaseerd op de complexiteit van uw bestanden. Zo is een blik soep makkelijk vrijstaand te maken en een fiets zeer moeilijk. Wij hebben onder prijzen enkele voorbeelden staan en mocht u nog twijfelen kunt u ons altijd raadplegen.</p>
            </div>
        </section>
        <section class="section odd patOrHor">
        	<img src="<?php bloginfo('template_directory'); ?>/gfx/how_3.png" alt="Bestanden uploaden" class="icon" />
            <div class="row-pad" itemprop="text">
            	<h2 itemprop="headline">3 - UPLOAD UW BESTANDEN</h2>
                <p>U kunt gemakkelijk uw bestanden met enkele of grote aantallen tegelijk uploaden via ons systeem. Werkt u liever via ftp, wetransfer of dropbox? Geen probleem, wij sturen u inloggegevens en u kunt bestanden zelf uploaden. U kunt ook de gewenste service kiezen, regulier of spoed.</p>
            </div>
        </section>
        <section class="section even">
        	<img src="<?php bloginfo('template_directory'); ?>/gfx/how_5.png" alt="Vrijstaand maken" class="icon" />
            <div class="row-pad" itemprop="text">
            	<h2 itemprop="headline">4 - VRIJSTAAND MAKEN</h2>
                <p>U gaat verder met uw zaken terwijl onze specialisten als de wiedeweerga uw bestanden vrijstaand maken.</p>
            </div>
        </section>
        <section class="section odd patOrHor">
        	<img src="<?php bloginfo('template_directory'); ?>/gfx/how_6.png" alt="Downloaden" class="icon" />
            <div class="row-pad" itemprop="text">
            	<h2 itemprop="headline">5 - Downloaden</h2>
                <p>Afhankelijk van de gekozen service krijgt u 24 uur of 5 dagen later van ons een mailtje met een downloadlink. De factuur volgt later!</p>
            </div>
        </section>
		<?php endwhile; endif; ?>
	</main> <!-- .article -->
	

<?php get_footer(); ?>