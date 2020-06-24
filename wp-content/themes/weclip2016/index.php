<?php get_header(); ?>



		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

		<div class="article" id="<?php the_ID(); ?>">
		
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="content">
				<?php the_content(); ?>
			</div>
		
		</div> <!-- .article -->

		<?php endwhile; else : ?>

		<div class="article">
		
			<h2>Oeps, pagina niet gevonden</h2>
			
			<p>Het lijkt erop dat de pagina niet meer bestaat. Allicht kan zoeken helpen.</p>
			
			<?php include(TEMPLATEPATH.'/searchform.php'); ?>
		
		</div> <!-- .article -->

		<?php endif; ?>
	
		<div class="navigation clear">
			<div class="left"><?php next_posts_link('&laquo; Oudere berichten') ?></div>
			<div class="right"><?php previous_posts_link('Nieuwere berichten &raquo;') ?></div>
		</div>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>