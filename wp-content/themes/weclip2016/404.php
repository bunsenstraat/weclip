

<?php get_header(); ?>

    <header id="header" class="header patOrHor" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
        <?php
        if (has_post_thumbnail()){
            the_post_thumbnail('header');
        }
        ?>

            <div class="step_line">
                <span class="first-line">
                    foto's
                </span>
                 <span class="second-line">
                    VRIJSTAAND
                </span>
                <span class="third-line">
                    maken
                    </span>
                </span>
            </div>
              

    </header>

	<main class="content" role="main" itemprop="mainContentOfPage">
		<div class="row titleRow">
        	 <h1 itemprop="headline" class="basic">Verclipt! We konden de pagina niet vinden</h1>
        </div>
		<div class="row contentRow" itemprop="text">
			Gebruik ons menu om de pagina te vinden die u zocht
        </div>
	</main> <!-- .article -->



<?php get_footer(); ?>