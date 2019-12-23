<?php
/**
 * The template for displaying 404 pages (Not Found).
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
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="step_content">
		<h1 class="basic">Niet gevonden</h1>
        <img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/price_cut.png" />
    </div>
    <div class="page_body">
    	<p>Wij kunnen de opgevraagde pagina niet vinden, onze excuses.</p>
    </div>
	<?php endwhile; // end of the loop. ?>
</div>


<?php get_footer(); ?>