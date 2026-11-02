<?php

/**
 * Charge les styles du thème enfant SPPCM.
 */
function underscores_child_assets() {

    // CSS du parent avec un identifiant distinct
    wp_enqueue_style(
        'underscores-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        '1.0.0'
    );

    // CSS du thème enfant
    wp_enqueue_style(
        'underscores-child-style',
        get_stylesheet_uri(),
        array('underscores-parent-style'),
        '1.0.0'
    );

    // CSS compilé depuis Sass
    $css_file = get_stylesheet_directory() . '/css/main.css';

    wp_enqueue_style(
        'underscores-child-main',
        get_stylesheet_directory_uri() . '/css/main.css',
        array('underscores-child-style'),
        file_exists($css_file) ? filemtime($css_file) : '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'underscores_child_assets');



/**
 * Enregistre et charge le script JS principal du thème enfant en tant que module ES natif.
 *
 * Utilise wp_enqueue_script_module() (disponible depuis WordPress 6.5), qui permet
 * d'utiliser directement la syntaxe import/export dans main.js sans bundler (webpack, etc.).
 */
function underscores_child_scripts() {

    wp_enqueue_script_module(
        'underscores-child-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        array(),                // Dépendances de modules (autres modules requis avant celui-ci, si besoin).
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'underscores_child_scripts' );


/**
 * [ALTERNATIVE — désactivée] Enregistre et charge main.js via l'API classique wp_enqueue_script().
 *
 * À utiliser pour les équipes qui écrivent leur JS en procédural plutôt qu'en orienté objet
 * (voir l'alternative correspondante dans main.js).
 *
 * Si le projet grandit et que d'autres fichiers JS s'ajoutent, ceux-ci peuvent être enregistrés
 * séparément et déclarés comme dépendances dans le tableau ci-dessous pour garantir leur ordre
 * de chargement avant main.js.
 */
/*
function underscores_child_scripts() {

    wp_enqueue_script(
        'main',
        get_stylesheet_directory_uri() . '/js/main.js',
        array(),
        '1.0.0',
        array( 'strategy' => 'defer' )
    );
}
add_action( 'wp_enqueue_scripts', 'underscores_child_scripts' );
*/


/* ============================================================
 * PIED DE PAGE (issue #36)
 * ============================================================ */

/**
 * Emplacements de menus du pied de page.
 * Le comité les remplit dans Apparence > Menus.
 */
function sppcm_footer_menus() {
    register_nav_menus( array(
        'footer-liens-rapides' => 'Pied de page — Liens rapides',
        'footer-documentation' => 'Pied de page — Documentation',
        'footer-a-propos'      => 'Pied de page — À propos',
    ) );
}
add_action( 'after_setup_theme', 'sppcm_footer_menus' );


/**
 * Réglages du pied de page modifiables sans code.
 * Apparence > Personnaliser > Pied de page.
 */
function sppcm_footer_customizer( $wp_customize ) {

    $wp_customize->add_section( 'sppcm_pied_de_page', array(
        'title'    => 'Pied de page',
        'priority' => 160,
    ) );

    $champs = array(
        'sppcm_facebook' => array( 'Lien Facebook',        '',                       'url' ),
        'sppcm_courriel' => array( 'Adresse électronique', '',                       'email' ),
        'sppcm_csn'      => array( 'Lien CSN',             'https://www.csn.qc.ca/', 'url' ),
        'sppcm_fneeq'    => array( 'Lien Fneeq',           'https://fneeq.qc.ca/',   'url' ),
    );

    foreach ( $champs as $id => $champ ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $champ[1],
            'sanitize_callback' => ( 'email' === $champ[2] ) ? 'sanitize_email' : 'esc_url_raw',
        ) );
        $wp_customize->add_control( $id, array(
            'label'       => $champ[0],
            'description' => 'Laisser vide pour cacher l\'icône.',
            'section'     => 'sppcm_pied_de_page',
            'type'        => $champ[2],
        ) );
    }

    $wp_customize->add_setting( 'sppcm_copyright', array(
        'default'           => 'SPPCM - Le Syndicat des professeures et professeurs du Collège Maisonneuve. Tous droits réservés.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'sppcm_copyright', array(
        'label'       => 'Texte du droit d\'auteur',
        'description' => 'L\'année s\'ajoute automatiquement.',
        'section'     => 'sppcm_pied_de_page',
        'type'        => 'textarea',
    ) );
}
add_action( 'customize_register', 'sppcm_footer_customizer' );
