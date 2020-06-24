<?php get_header(); ?>

    <header id="header" class="header patOrHor" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

		<div class="row titleRow">
            <div class="step_content">
                <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                <?php /* If this is a category archive */ if (is_category()) { ?>
                <h1 class="basic" itemprop="name"><?php single_cat_title(); ?></h1>
                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <h1 class="basic" itemprop="name">Berichten met label: <?php single_tag_title(); ?></h1>
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h1 class="basic" itemprop="name">Archief</h1>
                <?php } ?>
            </div>
		</div>    

    </header>


	<main id="body-column" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
   
		<?php if(have_posts()) : ?>
        
			<?php if (is_category(6))   { ?>
            
			<div class="postList clear">
 				<div class="row">
           
				<?php while(have_posts()) : the_post(); ?>
                	<div class="postLink"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<?php endwhile ?>

				</div>
            </div>
            
            <?php } else { ?>

		<section id="articles">
        	<div class="row">	

				<?php while(have_posts()) : the_post(); ?>
                <article class="article" id="<?php the_ID(); ?>" <?php post_class(); ?>  itemprop="blogPosts" itemscope itemtype="http://schema.org/BlogPosting">
                    <div class="article-thumbnail">
                        <?php 
                        if (has_post_thumbnail()) :?>
                        <?php the_post_thumbnail( 'big-thumb' ); ?>
                        <?php  else : ?>
                            <img src="<?php bloginfo('template_directory');?>/gfx/standard.jpg" alt="<?php the_title(); ?>" />
                        <?php endif; ?>
                    </div><!-- .thumbnail -->
                    <div class="article-content">
                        <h2 itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>	
                        <?php the_date( 'd F, Y', '<div class="entry-date">', '</div>', true ); ?>
                        <p class="article-excerpt" itemprop="description">
                            <?php echo get_excerpt(200); ?>...
                        </p>
                        <a class="more" href="<?php the_permalink(); ?>">Lees verder</a>
                        <?php
                            $posttags = get_the_tags();
                            if ($posttags) {
                              foreach($posttags as $tag) {
                                echo '<span class="tag">'.$tag->name . '</span>'; 
                              }
                            }
                        ?>
                    </div>
                </article> <!-- .article -->
				<?php endwhile ?>
            </div>
        </section>

		<?php } else : ?>
        
        <div class="row">

            <article class="col article">
            
                <h2>Geen berichten gevonden</h2>
                <p>Het lijkt erop dat er geen berichten bestaan binnen dit archief. Allicht kan zoeken helpen.</p>
                
                <?php get_search_form(); ?>
            
            </article> <!-- .post -->

		</div>
        
		<?php endif; ?>

        <div class="row">
            <div class="pagination"><?php // wp_pagenavi(); ?></div> 
        </div>


    </main> 

<?php get_footer(); ?>