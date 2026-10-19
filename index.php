
<?php
/**
 * Template principal du thème enfant SPPCM
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>

        <?php if (is_home() && !is_front_page()) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php single_post_title(); ?>
                </h1>
            </header>

        <?php endif; ?>

        <?php
        while (have_posts()) :
            the_post();

            get_template_part(
                'template-parts/content',
                get_post_type()
            );

        endwhile;
        ?>

        <?php the_posts_navigation(); ?>

    <?php else : ?>

        <?php
        get_template_part(
            'template-parts/content',
            'none'
        );
        ?>

    <?php endif; ?>

</main>

<?php
get_footer();
