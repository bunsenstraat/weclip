<?php get_header(); ?>

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

	<main class="content" role="main" itemprop="mainContentOfPage">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="row titleRow">
        	 <h1 itemprop="headline" class="basic"><?php the_title(); ?></h1>
        </div>
		<div class="row contentRow" itemprop="text">
			<?php the_content(); ?>
        </div>
		<?php endwhile; endif; ?>
	</main> <!-- .article -->

<?php get_footer(); ?>