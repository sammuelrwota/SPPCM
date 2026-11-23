<?php
get_header();

$images   = get_stylesheet_directory_uri() . '/images/';
?>
<div class="page-accueil">
    <h1 class="titre-principal" id="mobile-titre">
        Syndicat des professeures et professeurs de Maisonneuve
    </h1>

    <div class="banniere">
        <!-- IMAGE EN VEDETTE -->
        <img class="image-front ombre" src="<?php echo esc_url($images . 'image_accueil.jpg'); ?>" alt="">

        <div class="infos-syndicat ombre">
            <h1 class="titre-principal" id="desktop-titre">
                Syndicat des professeures et professeurs de Maisonneuve
            </h1>
            <p>Le syndicat des professeures et professeurs du Collège de Maisonneuve (SPPCM) a pour objectifs l’étude, la défense et la promotion des intérêts et des objectifs professionnels, syndicaux, économiques et sociaux de ses membres. Il vise également la promotion de la recherche et de la qualité du travail en éducation.</p>
            <p>Le SPPCM regroupe plus de 630 membres. Fondé le 7 mars 1968, il est affilié à la fédération nationale des enseignantes et enseignants du Québec (FNEEQ), elle-même membre (ou filiale) de la Confédération des syndicats nationaux (CSN).</p>
        </div>
    </div>

    <section class="accueil-infolettres">
        <h2>Infolettres</h2>

        <?php
        $actualites = new WP_Query(array(
            'category_name'  => 'actualite',
            'posts_per_page' => 3,
        ));

        while ($actualites->have_posts()) {
            $actualites->the_post(); ?>

            <div class="infolettre-single">
                <div class="infos-infolettre">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                    <div class="infolettre-contenu">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>

        <?php }
        wp_reset_postdata(); ?>

        <a class="bouton bouton-voir-tout" href="<?php echo esc_url(home_url('/infolettre-accueil/')); ?>">
            Toutes les infolettres
        </a>
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
                    <div class="actualite-single ombre">
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
        <a class="bouton bouton-voir-tout" href="<?php echo esc_url(get_category_link(get_category_by_slug('actualite'))); ?>">
            Toutes les actualités
        </a>
    </section>
    <section>
        <h2>Vie syndicale</h2>
        <div class="comite">
            <?php
            $comites = new WP_Query(array(
                'post_type'      => 'comite',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            while ($comites->have_posts()) {
                $comites->the_post();
                $nom_comite         = get_post_meta(get_the_ID(), 'nom_comite', true);
                $responsable_comite = get_post_meta(get_the_ID(), 'responsable_comite', true);
                $email_comite       = get_post_meta(get_the_ID(), 'email_comite', true);
                $point_1_comite        = get_post_meta(get_the_ID(), 'point_1_comite', true);
                $point_2_comite        = get_post_meta(get_the_ID(), 'point_2_comite', true);
                $point_3_comite        = get_post_meta(get_the_ID(), 'point_3_comite', true);
                $point_4_comite        = get_post_meta(get_the_ID(), 'point_4_comite', true);
                $point_5_comite        = get_post_meta(get_the_ID(), 'point_5_comite', true);
            ?>
                <article class="comite-single">
                    <?php if ($nom_comite !== '') : ?>
                        <h1><?php echo esc_html($nom_comite); ?></h1>
                    <?php endif; ?>

                    <?php if ($responsable_comite !== '') : ?>
                        <p><?php echo esc_html($responsable_comite); ?></p>
                    <?php endif; ?>

                    <?php if ($email_comite !== '') : ?>
                        <p><?php echo esc_html($email_comite); ?></p>
                    <?php endif; ?>

                    <?php if ($point_1_comite !== '') : ?>
                        <p class="comite-description">
                            <?php echo esc_html($point_1_comite); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($point_2_comite !== '') : ?>
                        <p class="comite-description">
                            <?php echo esc_html($point_2_comite); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($point_3_comite !== '') : ?>
                        <p class="comite-description">
                            <?php echo esc_html($point_3_comite); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($point_4_comite !== '') : ?>
                        <p class="comite-description">
                            <?php echo esc_html($point_4_comite); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($point_5_comite !== '') : ?>
                        <p class="comite-description">
                            <?php echo esc_html($point_5_comite); ?>
                        </p>
                    <?php endif; ?>
                </article>
            <?php }
            wp_reset_postdata(); ?>
        </div>
    </section>
</div>

<?php
get_footer();
?>