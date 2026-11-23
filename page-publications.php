<?php
get_header();
?>

<main class="avantages_sociaux">

    <div class="avantages_sociaux_bloc1">
        <h1>
            Avantages sociaux
        </h1>
    </div>
    
    <section class="avantages_sociaux_section">
         <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </section>

</main>

<?php
get_footer();
?>