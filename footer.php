
<?php
/**
 * Footer du thème enfant SPPCM
 */
?>

<footer id="colophon" class="site-footer">

    <div class="footer-container">

        <div class="footer-branding">
            <?php the_custom_logo(); ?>
        </div>

        <nav class="footer-navigation"
             aria-label="Navigation du pied de page">

            <?php
            if (has_nav_menu('menu-1')) {
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'container'      => false,
                    'menu_class'     => 'footer-menu',
                ));
            }
            ?>

        </nav>

        <div class="footer-copyright">
            <p>
                &copy; <?php echo esc_html(date('Y')); ?>
                SPPCM. Tous droits réservés.
            </p>
        </div>

    </div>

</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
