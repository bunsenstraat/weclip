
    <footer id="footer">
        <div class="row topFoot">
        	<div class="footTitle"></div><div class="footRuler"></div> 
        </div>
        <div class="row bottomFoot">
            <div class="contactBlock email">
                <span><a href="mailto:info@weclip.nl">info@weclip.nl</a></span>
            </div>
            <div class="contactBlock tel">
                <span>030 7857 045</span>
            </div>
            <div class="contactBlock menu">
                <div id="site-navigation" class="main-navigation" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'footer2', 'menu_class' => 'nav-menu' ) ); ?>
                </div><!-- #site-navigation -->
            </div>

        </div>

    </footer>

<?php wp_footer(); ?>
</body>
</html>