<?php
/* 
Template Name: Prijzen 
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


	<main class="content prices" role="main" itemprop="mainContentOfPage">
		<div class="prices_content blueblock">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    
        <div class="row-pad">
            <p>Bij WeClip kunt u beelden vrijstaand laten maken tegen de laagste prijzen. Wij hanteren slechts drie prijscategorieën, hieronder vind u per categorie de prijs en enkele voorbeelden.</p>
        </div>
        
        <section id="categories" class="section catPrices">
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
                    <div class="col span_3-1-pad patOrHor" id="new<?php echo $i; ?>">
                        <div class="ruit">
                            <h2><?php echo '€'.$cat_price; ?></h2>
                            <div class="underline"><?php echo $cat_name; ?></div>
                        </div>                
                        <div class="cat_img"><img src="<?php echo $cat_image['url'];?>" alt="<?php echo $cat_image['alt'];?>"></div>
                        <div class="cat_desc"><?php echo category_description($term); ?></div>
                        <a class="bestelButton patBlHor" href="<?php echo get_template_directory_uri();?>/order-action.php/?single_cat=<?php echo $cat_name;?>">BESTEL HIER</a>
                    
                        <div class="more_photo">
                            <p>Hieronder enkele voorbeelden <span class="dicht">Klik om ze te zien</span></p>
                        </div>
                        <div class="examples">
                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-1.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-2.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-3.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-4.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                            <img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/gfx/cat_<?php echo $cat_name ?>-5.png" alt="Voorbeeld vrijstaand beeld categorie basic" />
                        </div>
                    </div>
                    
    
                <?php			} 
            }    
            
            ?>
            
            </div>
        </section>
       
      </div>  
    
    

<div class="otherServices">
	<div class="row">
		<div class="step_content">
			<h2 class="basic"><?php the_field('overige_diensten_titel'); ?></h2>
            <div class="uitleg row-pad"><?php the_field('overige_diensten_uitleg'); ?></div>
		</div>

		<div class="priceTable">
        	<div class="tableRow heading">
                <div class="description">DIENST</div>
                <div class="price">PRIJS</div>
            </div>
			<?php
            if( have_rows('overige_diensten') ):
                while ( have_rows('overige_diensten') ) : the_row();
                $titel_dienst = get_sub_field('titel_dienst');
                $korte_titel = get_sub_field('korte_titel');
                $omschrijving_dienst = get_sub_field('omschrijving_dienst');
                $afbeelding_dienst = get_sub_field('afbeelding_dienst');
                $prijs_dienst = get_sub_field('prijs_dienst');
                $prijs_link = get_sub_field('link');
                ?>
                <div class="tableRow body">
                    <div class="description"><span class="ttWrap"><?php echo $titel_dienst; ?> <img class="tticon" src="<?php bloginfo('template_directory'); ?>/gfx/tooltip.svg" />

                        <div class="tooltipContent">
                            <h3><?php echo $korte_titel; ?></h3>
      <p><?php echo $omschrijving_dienst; ?> <?php if($prijs_link) { echo '<a href="'. $prijs_link .'">Lees meer</a>';} ?></p>
                            <div class="tool_img">
                                <img src="<?php echo $afbeelding_dienst['url']; ?>" alt="<?php echo $afbeelding_dienst['alt'] ?>" />
                                <!-- <span class="img_span">GEEN</span>
                                <span class="img_span">WEL</span> -->
                            </div><!-- end tool_img -->
                        </div><!-- end schaduw_tooltip -->
                    </span>
                    </div><!-- end description -->
                    <div class="price">&euro; <?php echo $prijs_dienst; ?></div>
                </div>
                
            <?php
                endwhile;
            
            else :
            
                // no rows found
            
            endif;
            
            ?>
            </div>            
        </div>
    </div>
    

		<?php endwhile; endif; ?>
	</main> <!-- .article -->
	

<?php get_footer(); ?>