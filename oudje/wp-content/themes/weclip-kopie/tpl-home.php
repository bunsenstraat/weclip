<?php 
/*

Template Name: home

*/
session_start();
get_header();
unset($_SESSION['b']);
unset($_SESSION['c']);
unset($_SESSION['m']);
unset($_SESSION['pg2']);
?>

<div class="home_title">
	<div class="title_content">
		<h1 class="step_line">
			<span class="first-line">foto's</span>
			<span class="second-line">VRIJSTAAND</span>
			<span class="third-line">
				<img class="title_b_l" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
				<span class="tit_span">MAKEN</span>
				<img class="title_b_r" src="<?php bloginfo('template_directory'); ?>/images/tit_bor.png" />
			</span>
		</h1>
	</div>
</div>

<div class="home_content">
	<div class="page_content">

		<?php
			$i = 0;
			$category_ids = get_all_category_ids();
			foreach($category_ids as $cat_id)  
			{ if (!($cat_id == 7)) { ?>
				<div class="part" id="new<?php echo $i; ?>">
					<div class="cat_head">
						<img class="" src="<?php bloginfo('template_directory'); ?>/images/cat_head.png" />
					</div>
					<div class="cat_con">
						<?php $cat_name = get_cat_name($cat_id);	
			   			      $my_category_id = $cat_id->term_id; 
 		                           	      $custom_Img = categoryCustomFields_GetCategoryCustomField($cat_id, 'Img');	
						      $custom_Price = categoryCustomFields_GetCategoryCustomField($cat_id, 'Price');

						      $current_peer_arr = explode("@",$custom_Img[0]->field_value);
						      $cat_name;
						      $cat_price = $custom_Price[0]->field_value; 
						?>
						<div class="cat_img"><img src="<?php echo $current_peer_arr[0]; ?>"  alt="Categorie <?php echo $cat_name; ?>" /></div>
						<div class="cat_tit"><h2><?php echo $cat_name; ?></h2></div>
						<div class="cat_price"><h2 class="c_f">Vanaf</h2><h2 class="c_t"><?php echo '€'.$cat_price; ?></h2></div>
					</div>
					<div class="cat_btn">
						<img class="" src="<?php bloginfo('template_directory'); ?>/images/cat_btn.png" />
						<h2><a style="color: white;text-decoration: none;" href="<?php echo get_template_directory_uri();?>/order-action.php/?single_cat=<?php echo $cat_name;?>">BESTEL HIER</a></h2>
					</div>
				</div>
		<?php $i++;	}} ?>
	</div>
</div>
<div class="home_banner">
	<div class="banner_content">
		<div class="banner1">
			<img src="<?php bloginfo('template_directory'); ?>/images/banner_1.png" alt="Probeer WeClip vrijstaand maken gratis" width="450" class="banner_1_img" />
			<div class="banner_1_text">
				<span class="text_1">BENIEUWD NAAR ONZE KWALITEIT EN SERVICE?</span></br>
				<img class="banner_b_l" src="<?php bloginfo('template_directory'); ?>/images/banner_b.png" />	
				<img class="banner_b_s" src="<?php bloginfo('template_directory'); ?>/images/star.png" />	
				<img class="banner_b_r" src="<?php bloginfo('template_directory'); ?>/images/banner_b.png" /></br></br>			
				<a style="text-decoration: none;" href="<?php echo get_bloginfo('url'); ?>/bestellen/?pg1=1"><span class="text_2">PROBEER NU GRATIS</span></a>
			</div>
		</div>
		<div class="banner2">
			<img class="banner_2_img" width="450" src="<?php bloginfo('template_directory'); ?>/images/banner_2.png" alt="WeClip doet meer, vraag een offerte aan" />
				<div class="second_banner_text">
					<span class="text_1">WECLIP DOET MEER!<br/>ZIE ONZE AANVULLENDE DIENSTEN</span><br/><br/>
					<a style="text-decoration: none;" href="<?php echo get_permalink(39); ?>"><span class="text_2">VRAAG EEN OFFERTE AAN</span></a>
				</div>
		</div>
	</div>
</div>
<div class="step">
	<div class="step_content">
		<h2 class="basic"><a href="<?php get_bloginfo('url'); ?>/hoe-het-werkt/">HOE HET WERKT</a></h2>
        <img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/price_cut.png" alt="WeClip" />
		<div class="step_123">

			<div class="step_1">
				<img class="step_1_inner" src="<?php bloginfo('template_directory'); ?>/images/step_1.png" alt="Beeld met ongewenste achtergrond" />
				<div class="title">
                    <div class="step_p">1</div>
                    <div class="step_font">ONGEWENSTE<br/>ACHTERGROND?</div>
				</div>
			</div>

			<div class="step_2">
				<img class="step_2_inner" src="<?php bloginfo('template_directory'); ?>/images/step_2.png" />
				<div class="title">
                    <div class="step_p">2</div>
                    <h2 class="step_font"><span class="hors"> 24 </span><img class="watch" src="<?php bloginfo('template_directory'); ?>/images/watch.png" alt="24 uur" /><span class="hors"> UUR </span></h2>
				</div>
			</div>
			<div class="step_3">
				<img class="step_3_inner" src="<?php bloginfo('template_directory'); ?>/images/step_3.png" alt="Universele vrijstaande foto's" />
				<div class="title">
                    <div class="step_p">3</div>
                    <h2 class="step_font">UW FOTO'S<br/>UNIVERSEEL</h2>
				</div>
			</div>

		</div>
		<div class="step_btn">
				<h2 class="step_b_t"><a href="<?php echo get_bloginfo('url'); ?>/hoe-het-werkt/">BEKIJK UITGEBREIDE UITLEG</a></h2>
		</div>
	</div>
</div>
<div class="cut">
	<div class="cut_content">
		<div class="cut_one">
			<img class="cut_big" src="<?php bloginfo('template_directory'); ?>/images/cut_big.png" />
		</div>
		<div class="cut_second">
        <?php if (have_posts()) : while(have_posts()) : the_post(); 
		 the_content();
		 endwhile; endif; ?>
		</div>
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
