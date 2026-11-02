<?php
get_header();
?>
<div class="page-accueil">
    <h1 class="titre-principal">
        Syndicat des professeures et professeurs de Maisonneuve
    </h1>

    <!-- IMAGE EN VEDETTE -->
    <img class="image-front" src="http://localhost/refonte_sppcm/wordpress/wp-content/uploads/2023/11/Wd9mu_tT1dFpJX.jpg" alt="">

    <div class="infos-syndicat ombre">
        <p>Le syndicat des professeures et professeurs du Collège de Maisonneuve (SPPCM) a pour objectifs l’étude, la défense et la promotion des intérêts et des objectifs professionnels, syndicaux, économiques et sociaux de ses membres. Il vise également la promotion de la recherche et de la qualité du travail en éducation.</p>
        <p>Le SPPCM regroupe plus de 630 membres. Fondé le 7 mars 1968, il est affilié à la fédération nationale des enseignantes et enseignants du Québec (FNEEQ), elle-même membre (ou filiale) de la Confédération des syndicats nationaux (CSN).</p>
    </div>

    <section class="accueil-infolettres">
        <h3>Infolettres</h3>
    </section>

    <section class="accueil-actualites">
        <h3>Actualités</h3>
        <div class="article">
            <?php
            for ($i = 0; $i < 3; $i++) { ?>
                <?php the_post(); ?>
                <a href=<?php the_permalink() ?>>
                    <div class="actualite-single">
                        <?php


                        if (get_the_post_thumbnail() != null):
                        ?>
                            <div class="image-article">
                                <?php echo the_post_thumbnail($size = 'thumbnail') ?>
                            </div>
                        <?php endif; ?>
                        <div class="infos-article">
                            <h3><?php the_title(); ?></h3>

                            <div class="article-contenu">
                                <p><?php echo get_the_date(); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </section>
</div>

<?php
get_footer();
?>