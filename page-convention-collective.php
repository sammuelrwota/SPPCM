<?php
get_header();
?>

<main class="convention_collective">

    <h1>
        Convention collective
    </h1>

    <section class="convention-collective_section">
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