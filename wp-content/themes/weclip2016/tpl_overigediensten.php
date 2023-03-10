<?php
/* 
Template Name: Overige diensten 
*/
get_header();
?>


    <header id="header" class="header patOrHor" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
        <?php
		/*
        if (has_post_thumbnail()){
            the_post_thumbnail('header');
        }
		*/
        ?>

		<div class="row titleRow">
        	 <h1 itemprop="headline" class="basic"><?php the_title(); ?></h1>
        </div>

    </header>


	<main id="extra" class="content " role="main" itemprop="mainContentOfPage">
		<?php if(have_posts()) : while(have_posts()) : the_post();
		$hoofdicoon = get_field('hoofdicoon');
		?>
        <div class="iconWrap">
            <div class="ruit ruitOutline">
                <img src="<?php echo $hoofdicoon['url']; ?>" alt="<?php echo $hoofdicoon['alt'] ?>" />
            </div>
        </div>
		<div class="row-pad contentRow">
        	 <?php the_content(); ?>
        </div>
        
        <div class="alternates">
            
		<?php
        if( have_rows('diensten') ):
            while ( have_rows('diensten') ) : the_row();
            $dienst_titel = get_sub_field('dienst_titel');
            $dienst_tekst = get_sub_field('dienst_tekst');
            $dienst_icoon = get_sub_field('dienst_icoon');
            ?>
            <section class="section">
                <div class="ruit ruitOutline">
                    <img src="<?php echo $dienst_icoon['url']; ?>" alt="<?php echo $dienst_icoon['alt'] ?>" />
                </div>
                <div class="row-pad" itemprop="text">
                    <h2 itemprop="headline"><?php echo $dienst_titel; ?></h2>
                    <p><?php echo $dienst_tekst; ?></p>
                </div>   
            </section>                 

        <?php  endwhile;  endif;   ?>
        
            <section class="section">
                <div class="ruit ruitOutline">
                    <img src="<?php $offerte_icoon = get_field('offerte_icoon'); echo $offerte_icoon['url']; ?>" alt="<?php echo $offerte_icoon['alt'] ?>" />
 
                </div>
                <div class="row-pad" itemprop="text">
                    <h2 itemprop="headline"><?php the_field('offerte_titel'); ?></h2>
                    <?php the_field('offerte'); ?>
                </div>   
            </section>

        </div>
                 
		<?php endwhile; endif; ?>
	</main> <!-- .article -->
	

<?php get_footer(); ?>