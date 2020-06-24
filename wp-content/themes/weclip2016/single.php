<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>

    <header id="header" class="header patOrHor" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
    	<div class="row-pad">
        	<h1 itemprop="headline" class="plain"><?php the_title(); ?></h1>
        </div>
    </header>


    <main id="main" class="content singleContent" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="row-pad">
    
    
            <article class="article" id="<?php the_ID(); ?>" <?php post_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                <div class="article-content" itemprop="text">
                    <?php the_content(); ?>
                </div>
                <div class="addthis_sharing_toolbox"></div>

            </article> <!-- .article -->

            
        
		</div>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>