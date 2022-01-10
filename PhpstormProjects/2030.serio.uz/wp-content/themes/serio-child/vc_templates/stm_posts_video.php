<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$offset = 0;
$unique_id = uniqid('button_');

$classes = array();
$classes[] = 'child-theme stm_posts_video stm_posts_video_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $unique_id;
pearl_add_element_style('posts_video', $style);

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'tax_query' => array(
        array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => 'post-format-video',
        )
    )
);

$q = new WP_Query($args);

$columns = count($q->posts) > 5;

if ($q->have_posts()) :
    $first_item_class = '';
    ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <div class="stm_post_video__wrapper">
            <div class="col_left">

                <?php while ($q->have_posts()) :
                $q->the_post();
                $post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
                if(empty($post_views)) {
                    $post_views = 0;
                }
                $author_name = get_the_author_meta('display_name');
                if ($q->current_post === 0) {
                    $image = pearl_get_VC_post_img_safe(get_the_ID(), '867x630', 'full');
                    $first_item_class = ' post_video__first';
                } else {
                    $image = pearl_get_VC_post_img_safe(get_the_ID(), '412x300', 'thumbnails');
                    $first_item_class = '';
                }

                //columns start
                if ($q->current_post === 1) :
                ?>
            </div>
            <div class="col_right">
                <?php if ($columns) : ?>
                <div class="post_video__columns">
                    <div>
                        <?php
                        endif;
                        endif;
                        ?>

                        <div class="post_video<?php echo esc_attr($first_item_class); ?>">
                            <div class="post_video__image">
                                <a href="<?php the_permalink(); ?>" <?php the_title_attribute(); ?> class="stc_h">
                                    <?php echo wp_kses_post($image); ?>
                                    <span class="stmicon-viral_play post_video__icon_play stc_h"><i data-fip-value="stmicon-play4" class="stmicon-play4"></i></span>
                                    <div class="title">
                                          <?php
                														$title = get_the_title();
                														$short_title = wp_trim_words( $title, 10, '...' );
                														echo $short_title;
                													?>
                                    </div>
                                </a>
                            </div>
                            <div class="post_video__content">
                                <!-- <div class="post_video__info">
                                    <?php if (!empty($category = get_the_category())): ?>
                                        <div class="post_video__category">
                                            <?php foreach($category as $single_category): ?>
                                                <a class="no_deco sbc" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                                                    <?php echo esc_attr($single_category->name); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="author">
                                        <?php esc_html_e( 'by', 'pearl' ); ?> <span class="name"><?php echo esc_html($author_name); ?></span>
                                    </div>
                                    <div class="date">
                                        <?php
                                        $posted = get_the_time('U');
                                        echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                                        ?>
                                    </div>
                                    <div class="views">
                                        <span class="stmicon-viral_eye stm_posts_video_single__icon"></span>
                                        <?php echo esc_attr($post_views); ?>
                                        <?php if($post_views == 1) : ?>
                                            <span class="views_text"><?php esc_html_e('view', 'pearl'); ?></span>
                                        <?php else: ?>
                                            <span class="views_text"><?php esc_html_e('views', 'pearl'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="comments">
                                        <span class="stmicon-viral_comments stm_posts_video_single__icon"></span> <?php echo comments_number(); ?>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <?php if ($q->current_post !== (count($q->posts) - 1) && $q->current_post > 0 && ($q->current_post ) % 3 === 0 && $columns) : ?>
                    </div>
                    <div>
                        <?php endif;
                        //columns end
                        if (count($q->posts) - 1 === $q->current_post && $q->current_post > 0 && $columns) : ?>
                    </div>
                </div>
            <?php
            endif;
            endwhile;
            wp_reset_postdata();
            ?>
            </div>
        </div>
    </div>
    <?php
endif;
