<div class="site-info">
    <div class="site-name">
        <?php if (has_custom_logo()) : ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
        <?php else : ?>
            <?php if (get_bloginfo('name') && get_theme_mod('display_title_and_tagline', true)) : ?>
                <?php if (is_front_page() && !is_paged()) : ?>
                    <?php bloginfo('name'); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div><!-- .site-name -->

    <?php
    if (function_exists('the_privacy_policy_link')) {
        the_privacy_policy_link('<div class="privacy-policy">', '</div>');
    }
    ?>

    <div class="powered-by">
        <?php
        printf(
            /* translators: %s: WordPress. */
            esc_html__('Proudly powered by %s.', 'twentytwentyone'),
            '<a href="' . esc_url(__('https://wordpress.org/', 'twentytwentyone')) . '">WordPress</a>'
        );
        ?>
    </div><!-- .powered-by -->

</div><!-- .site-info -->