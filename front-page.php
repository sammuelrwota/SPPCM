<?php
get_header();

$images   = get_stylesheet_directory_uri() . '/images/';
?>
<div class="page-accueil">
    <h1 class="titre-principal">
        Syndicat des professeures et professeurs de Maisonneuve
    </h1>

    <div class="banniere">
        <!-- IMAGE EN VEDETTE -->
        <img class="image-front" src="<?php echo esc_url($images . 'image_accueil.jpg'); ?>" alt="">

        <div class="infos-syndicat ombre">
            <p>Le syndicat des professeures et professeurs du Collège de Maisonneuve (SPPCM) a pour objectifs l’étude, la défense et la promotion des intérêts et des objectifs professionnels, syndicaux, économiques et sociaux de ses membres. Il vise également la promotion de la recherche et de la qualité du travail en éducation.</p>
            <p>Le SPPCM regroupe plus de 630 membres. Fondé le 7 mars 1968, il est affilié à la fédération nationale des enseignantes et enseignants du Québec (FNEEQ), elle-même membre (ou filiale) de la Confédération des syndicats nationaux (CSN).</p>
        </div>
    </div>

    <section class="accueil-infolettres">
        <h2>Infolettres</h2>

        <div class="infolettre">
            <?php
            $actualites = new WP_Query(array(
                'category_name'  => 'actualite',
                'posts_per_page' => 3,
            ));

            while ($actualites->have_posts()) {
                $actualites->the_post(); ?>
                <a href="<?php the_permalink(); ?>">
                    <div class="infolettre-single">
                        <div class="infos-infolettre">
                            <h3><?php the_title(); ?></h3>

                            <div class="infolettre-contenu">
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php }
            wp_reset_postdata(); ?>
        </div>
    </section>

    <section class="accueil-actualites">
        <h2>Actualités</h2>
        <div class="article">
            <?php
            $actualites = new WP_Query(array(
                'category_name'  => 'nouvelles',
                'posts_per_page' => 3,
            ));

            while ($actualites->have_posts()) {
                $actualites->the_post(); ?>
                <a href="<?php the_permalink(); ?>">
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
            <?php }
            wp_reset_postdata(); ?>
        </div>
    </section>
</div>

<?php
get_footer();
?>