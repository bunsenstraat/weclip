<?php get_header(); ?>

    <main id="main" class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="row-pad">
    
        <?php while(have_posts()) : the_post(); ?>
    
    
            <article class="article" id="<?php the_ID(); ?>" <?php post_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                <div class="article-meta">
                	<h1 itemprop="headline"><?php the_title(); ?></h1>	
                </div><!-- .entry-meta -->
                <div class="article-content" itemprop="text">
                    <?php the_content(); ?>
                </div>
                <div class="addthis_sharing_toolbox"></div>

            </article> <!-- .article -->

            
        <?php endwhile; ?>
        
		</div>
    </main>

<?php get_footer(); ?>