<?php get_header(); ?>

<main class="md:max-w-[1200px] mx-auto px-6 py-12">

    <?php
    while (have_posts()) : the_post();
        the_title('<h1 class="text-3xl font-bold mb-4">', '</h1>');
        the_content();
    endwhile;
    ?>

</main>

<?php get_footer(); ?>