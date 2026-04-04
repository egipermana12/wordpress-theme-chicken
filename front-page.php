<?php get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>

<?php get_template_part('template-parts/stats'); ?>

<?php get_template_part('template-parts/opportunity'); ?>

<?php get_template_part('template-parts/layanan'); ?>

<main class="max-w-4xl mx-auto px-6 py-10">
    <?php
    while (have_posts()) : the_post();
        the_content(); // Gutenberg hanya untuk content
    endwhile;
    ?>

</main>

<?php get_footer(); ?>