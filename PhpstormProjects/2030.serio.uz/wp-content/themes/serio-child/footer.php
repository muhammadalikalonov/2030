                </div> <!--.container-->
            </div> <!-- .site-content -->
        </div> <!-- id wrapper closed-->

        <?php
            //Pre footer settings
            //Global settings
            $page_pre_footer_box = pearl_get_option('page_pre_footer_box');
            $stm_pre_footer_global = pearl_get_option('page_pre_footer');
            //Page settings
            $id = get_the_ID();
            $stm_pre_footer_custom = get_post_meta($id, 'stm_pre_footer', true);
        ?>
        <?php if( $page_pre_footer_box == 'true' ): ?>
            <div class="pre_footer">
                <?php if( empty ($stm_pre_footer_custom) ): ?>
                   <?php pearl_sidebar(false, $stm_pre_footer_global); ?>
                <?php else: ?>
                    <?php pearl_sidebar(false, $stm_pre_footer_custom); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php get_template_part('partials/footer/player'); ?>

        <?php //Custom block Start
         if(!is_front_page()):?>
<!--          <h1>You can put any block here !!!</h1>-->
        <?php endif;
        //Custom block End ?>

        <div class="stm-footer">
			<?php get_template_part('partials/footer/main'); ?>
        </div>

        <?php
        get_template_part('partials/modals/main');
        get_template_part('partials/footer/ga');
        get_template_part('partials/footer/scroll_top');
        get_template_part('partials/modals/product_view');
        do_action('pearl_before_footer');
        wp_footer(); ?>

    </body>
</html>
