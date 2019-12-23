<?php
/**
 * The Template for displaying all single posts.
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
	<?php
	 if ( in_category(7)) { // Wiki ?>

	<div class="step_content">
		<p class="basic title">Wiki</p>
        <img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/price_cut.png" />
    </div>

    <div itemscope itemtype="http://schema.org/ItemList" class="container wikilist">
        <ul>
        <?php
        $IDOutsideLoop = $post->ID;
        while( have_posts() ) {
                the_post();
                foreach( ( get_the_category() ) as $category )
                        $my_query = new WP_Query('category_name=' . $category->category_nicename . '&orderby=title&order=asc&showposts=100');
                if( $my_query ) {
                        while ( $my_query->have_posts() ) {
                                $my_query->the_post(); ?>
                                <li itemprop="itemListElement" <?php print ( is_single() && $IDOutsideLoop == $post->ID ) ? ' class="active"' : ''; ?>>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                </li>
        <?php
                        }
                }
        }
        ?>
        </ul>
    </div><!-- end itemlist -->

    <div class="half-gfx-top">
        <img class="camera" src="<?php bloginfo('template_directory'); ?>/images/graphic-wiki.png" />
    </div>

    <div class="blueblock graphblock">
	<?php while ( have_posts() ) : the_post(); ?>

        <div class="container">
          <h1><?php the_title() ?></h1>
          <?php the_content() ?>
        </div>

	<?php endwhile; // end of the loop. ?>
    </div>

	<?php } else {  the_post(); ?>


	<div class="step_content">
		<h1 class="basic"><?php the_title() ?></h1>
        <img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/price_cut.png" />
    </div>
    <div class="page_body">
    	<?php the_content() ?>
    </div>
	<?php } ?>
</div>

<?php get_footer(); ?>

