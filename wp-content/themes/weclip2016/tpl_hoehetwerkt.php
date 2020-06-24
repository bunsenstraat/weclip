<?php
/* 
Template Name: Hoe het werkt 
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


	<main class="content" role="main" itemprop="mainContentOfPage">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <div class="alternates">
        
			<?php
            if( have_rows('stappen') ):
                while ( have_rows('stappen') ) : the_row();
                $afbeelding = get_sub_field('afbeelding');
                $titel = get_sub_field('titel');
                $tekst = get_sub_field('tekst');
                ?>

                <section class="section patOrHor">
                    <img src="<?php echo $afbeelding['url']; ?>" alt="<?php echo $afbeelding['alt'] ?>" class="icon" />
                    <div class="row-pad" itemprop="text">
                        <h2 itemprop="headline"><?php echo $titel; ?></h2>
                        <p><?php echo $tekst; ?></p>
                    </div>
        		</section>
                
            <?php endwhile; endif; ?>        
        
        </div>
		<?php endwhile; endif; ?>
	</main> <!-- .article -->
	

<?php get_footer(); ?>