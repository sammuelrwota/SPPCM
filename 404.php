<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Underscores
 */
get_header(); // Inclut l'en-tête du thème
?>

<div class="error-404">
    <h1 class="error-404_titre">Oups ! Page non trouvée</h1>
    <p class="error-404_message">Désolé, il semble que la page que vous cherchez n'existe pas ou a été déplacée.</p>
    <p class="error-404_suggestion">Veuillez utiliser des termes de recherche différents ou retourner à l'accueil pour continuer votre navigation.</p>
    
    <div class="error-404_options">
        <a href="<?php echo home_url(); ?>" class="error-404_link error-404_link--home">Retour à l'accueil</a>
        <?php get_search_form(); // Ajoute un formulaire de recherche ?>
    </div>
</div>

<?php
get_footer(); // Inclut le pied de page du thème
?>