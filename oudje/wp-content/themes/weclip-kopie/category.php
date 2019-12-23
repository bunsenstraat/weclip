<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>


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
<div class="page_post">

	<div class="step_content">
		<h1 class="basic title"><?php single_cat_title(); ?></h1>
        <img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/price_cut.png" />
    </div>

    <div itemscope itemtype="http://schema.org/ItemList" class="container wikilist">
        <ul>
         <?php
        while ( have_posts() ) : the_post(); ?>
            <li itemprop="itemListElement"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
         <?php endwhile; ?>
        </ul>
	</div> 
    <div class="blueblock graphblock">
        <div class="container">
            <?php echo category_description(); ?>
        </div>
    </div>
	   
    
 <?php get_footer(); ?>