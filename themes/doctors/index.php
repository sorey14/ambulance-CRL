<?php get_header(); ?>
    <div id="wrapper" class="sidebar-right">
        <div id="site-header">
            <?php tally_content_part_header(); ?>
            <div id="site-main-inner" class="site_content_width">
                <div class="owl-text">
                   <h1> Лисянська Центральна районна лікарня</h1>
                </div>
                <?php  if(is_front_page())?>
                <?php echo do_shortcode('[owl-carousel category="main-carousel"  items="1" singleItem="true" autoPlay="true" navigation="false" slideSpeed="150" pagination="false"]'); ?>
                <?php  ?>

             <?php tally_content_part_subHeader(); ?>
            </div>
        </div>
        
        <div id="site-main">
            <div id="site-main-inner" class="site_content_width">
                <div id="page-content">
                    <div id="page-content-inner">
                        <?php tally_content_loop_home(); ?>
                    </div>
                </div>
                <?php get_sidebar(); ?>
                <div class="clear"></div>
            </div>
        </div>
        
        <div id="site-footer">
            <div id="site-footer-inner">
                <?php tally_content_part_footerWidgets(); ?>
                <?php tally_content_part_footer(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>