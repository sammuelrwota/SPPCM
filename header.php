
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

        <!-- <a class="skip-link screen-reader-text" href="#primary">
           ...
        </a> -->

    <header id="masthead" class="site-header">

    <div class="entete">
        <button
        class="bouton-menu"
        type="button"
        aria-label="Ouvrir le menu"
        aria-expanded="false"
        aria-controls="liens-navigation"
      >
        <img
           src="<?php echo esc_url(get_stylesheet_directory_uri() . '/images/menu.png'); ?>"
           alt="" />
      </button>
        <div class="entete_logo">

        <?php if (has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
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

       
        <form
            class="recherche-entete"
            id="recherche-entete"
            role="search"
            method="get"
            action="<?php echo esc_url(home_url('/')); ?>"
        >
            <button
                class="bouton-recherche"
                type="button"
                aria-label="Ouvrir la recherche"
                aria-expanded="false"
                aria-controls="recherche-entete"
            >
                <img
                src="<?php echo esc_url(get_stylesheet_directory_uri() . '/images/recherche.png'); ?>"
                alt=""
            >
            </button>

            <label
                class="visuellement-masque"
                for="champ-recherche-entete"
            >
                Rechercher
            </label>

            <input
                id="champ-recherche-entete"
                name="s"
                type="search"
                placeholder="Recherche"
                value="<?php echo esc_attr(get_search_query()); ?>"
            >

            <button
                class="fermer-recherche-entete"
                type="button"
                aria-label="Fermer la recherche"
            >
                ×
            </button>
        </form>


    </div>

    </header>
