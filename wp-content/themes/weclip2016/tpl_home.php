<?php
/* 
Template Name: Homepage 
*/
get_header();

		$args = array (
            'taxonomy' => 'category', //empty string(''), false, 0 don't work, and return empty array
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => FALSE,
            'include' => array(2,3,4),
			'orderby' => 'term_id'
    );
		$i = 0;
		$categories = get_categories($args);
		


		//print_r($args);
		//print_r($categories);
		//exit();

?>
    <header id="header" class="header patOrHor" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

            <h1 class="step_line">
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
            </h1>
              

    </header>
	<section id="categories" class="section catOrder blueblock">
		<div class="row">
        <?php

		
		if($categories){
			
			foreach($categories as $cat) {
			$term = $cat->term_id;
			// vars
			
			$cat_name = $cat->cat_name;
			$cat_image = get_field('category_image', 'category_'.$cat->term_id);
			$cat_price = get_field('category_price', 'category_'.$term);	
			
			
						
				?>
            	<div class="col span_3-1" id="new<?php echo $i; ?>">
                    <div class="cat_img"><img src="<?php echo $cat_image['url'];?>"></div>
                    <div class="cat_tit"><h2><?php echo $cat_name; ?></h2></div>
                    <div class="cat_price"><span class="c_f">Vanaf</span><span class="c_t"><?php echo '€'.$cat_price; ?></span></div>
                    <a class="bestelButton patBlHor" href="<?php echo get_template_directory_uri();?>/order-action.php/?single_cat=<?php echo $cat_name;?>">BESTEL HIER</a>
				</div>

			<?php			} 
		}    
		
		?>
		
        </div>
    </section>
	<section id="highlights" class="section patOrHor">
		<div class="row">
        	<a href="<?php echo get_permalink('25'); ?>/?pg1=1" class="probeer patBlHor">
            	<div class="topLine">Benieuwd naar onze service?</div>
                <div class="star"></div>
                <div class="bottomLine">Probeer nu gratis</div>
            </a>
        	<a href="<?php echo get_permalink('39'); ?>" class="offerte patOrHor">
            	<div class="icon patBlHor"></div>
                <span class="topLine">WECLIP DOET MEER!<br />ZIE ONZE AANVULLENDE DIENSTEN</span>
                <span class="bottomLine">Vraag een offerte aan</span>
            </a>
        </div>
    </section>
	<section id="howItWorks" class="section">
		<div class="row titleRow">
        	<h2 class="basic">Hoe het werkt</h2>
        </div>
		<div class="row">
        	<div class="block span3">
            	<img src="<?php bloginfo('template_directory'); ?>/gfx/step-1.jpg" class="stepIMG" alt="Step 1" />
				<div class="ruit">
                	<div class="stepNumber"><span>1</span></div>                
                	<div class="stepTitle">Ongewenste achtergrond?</div>                
                </div>
            </div>
        	<div class="block span3">
            	<img src="<?php bloginfo('template_directory'); ?>/gfx/step-2.jpg" class="stepIMG" alt="Step 1" />
				<div class="ruit">
                	<div class="stepNumber"><span>2</span></div>                
                	<div class="stepTitle">24 <img class="watch" src="<?php bloginfo('template_directory'); ?>/gfx/watch.png" alt="24 uur"> uur</div>                
                </div>
            </div>
        	<div class="block span3">
            	<img src="<?php bloginfo('template_directory'); ?>/gfx/step-3.jpg" class="stepIMG" alt="Step 1" />
				<div class="ruit">
                	<div class="stepNumber"><span>3</span></div>                
                	<div class="stepTitle">Uw foto's universeel</div>                
                </div>
            </div>
            
            <a class="bestelButton patBlHor" href="<?php echo get_permalink('227'); ?>">Bekijk uitgebreide uitleg</a>
            
        </div>
    </section>

	<section id="about" class="section patOrHor" itemprop="mainContentOfPage">
		<div class="row">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="aboutIcon">
                <img class="cut_big" src="<?php bloginfo('template_directory'); ?>/gfx/cut_big.png">	
            </div>
            <div class="page-content" itemprop="text">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
		</div> <!-- .row -->
	</section> <!-- .article -->

	<section id="clients" class="section patOrHor" itemprop="mainContentOfPage">
		<div class="row">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="aboutIcon">
                <img class="cut_big" src="<?php bloginfo('template_directory'); ?>/gfx/icon_big.svg">	
            </div>
            <div class="page-content logos" itemprop="text">
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/adidas.png" /></div>
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/bruna.png" /></div>
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/heineken.png" /></div>
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/interbakery.png" /></div>
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/bacardi.png" /></div>
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/nike.png" /></div>
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/casio.png" /></div>
				<div><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/gfx/zwitsal.png" /></div>
            </div>
        <?php endwhile; endif; ?>
		</div> <!-- .row -->
	</section> <!-- .article -->
	

<?php get_footer(); ?>