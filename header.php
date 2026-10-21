
<?php
/**
 * Header du thème enfant SPPCM
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Geologica:wght,CRSV@100..900,0&display=swap" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <a class="skip-link screen-reader-text" href="#primary">
        Aller au contenu
    </a>

    <header id="masthead" class="site-header">

    
<div class="site-branding">

    <?php if (has_custom_logo()) : ?>

        <?php the_custom_logo(); ?>

    <?php else : ?>

        <p>Aucun logo configuré dans WordPress.</p>

    <?php endif; ?>

</div>


        <nav id="site-navigation" class="main-navigation"
             aria-label="Navigation principale">

            <button class="menu-toggle"
                    aria-controls="primary-menu"
                    aria-expanded="false">
                Menu
            </button>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'container'      => false,
            ));
            ?>

        </nav>

    </header>
