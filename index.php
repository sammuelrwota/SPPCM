
<?php
/**
 * Template principal du thème enfant SPPCM
 */

get_header();
?>

<section class="section_general">

    <h1>
        Syndicats des professeures et professeurs de Maisonneuve
    </h1>

    <div class="blocs">

        <div class="bloc_gauche">
            <p>
                Le syndicat des professeures et professeurs du Collège de
                Maisonneuve (SPPCM) a pour objectifs l'étude, la défense
                et la promotion des intérêts et des objectifs professionnels,
                syndicaux, économiques et sociaux de ses membres.
                Il vise également la promotion de la recherche et de
                la qualité du travail en éducation.
            </p>

            <p>
                Le SPPCM regroupe plus de 630 membres. Fondé le 7 mars
                1968, il est affilié à la fédération nationale des
                enseignantes et enseignants du Québec (FNEEQ),
                elle-même membre (ou filiale) de la Confédération
                des syndicats nationaux (CSN).
            </p>
        </div>

        <div class="bloc_droite">
            <!-- <img
                src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/oiseau.jpg'); ?>"
                alt="Oiseau"
            > -->
        </div>

    </div>

</section>
<main id="primary" class="site-main">

    <div class="main_contenu">
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
</div>

</main>

<?php
get_footer();
