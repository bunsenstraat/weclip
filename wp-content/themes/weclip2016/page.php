<?php get_header(); ?>

    <header id="header" class="header patOrHor" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
        <?php /*
        if (has_post_thumbnail()){
            the_post_thumbnail('header');
        } */
        ?>
		<div class="row titleRow">
        	 <h1 itemprop="headline" class="basic"><?php the_title(); ?></h1>
        </div>
              

    </header>

	<main class="content" role="main" itemprop="mainContentOfPage">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="row contentRow" itemprop="text">
			<?php the_content(); ?>
        </div>
		<?php endwhile; endif; ?>
	</main> <!-- .article -->

<?php get_footer(); ?>