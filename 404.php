<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Underscores
 */

get_header();
?>


<style>
    <?php include 'CSS/style.css'; ?>
</style>

<main id="primary" class="site-main">

    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Page introuvable', 'underscores'); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e("La page que vous essayez de voir n'a pas été trouvée. Utilisez des termes de recherche différents ou retournez à l'acceuil pour continuer votre navigation.", 'underscores'); ?></p>

            <?php
            get_search_form();
            ?>
    </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
