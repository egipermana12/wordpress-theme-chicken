
<?php get_header(); ?>

<section class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row mb-12 items-start md:items-end justify-start gap-4">
        <div class="w-full md:max-w-[400px]">
            <p class="text-primary md:text-sm text-xs font-semibold mb-3">
                BLOG
            </p>

            <h2 class="text-base md:text-xl font-semibold text-textPrimary">
                Temukan Tips dan Trik, <br> serta Berita Seputar Dunia Bisnis
            </h2>
        </div>
        <div class="w-full border-b md:border-gray-600 md:block hidden"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_300px] gap-8 md:gap-10 items-start">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
            <?php
            $blog_query = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 8,
                'orderby' => 'date',
                'order' => 'DESC',
            ]);

            if ($blog_query->have_posts()) {
                while ($blog_query->have_posts()) {
                    $blog_query->the_post();

                    $image = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'large')
                        : get_template_directory_uri() . '/assets/img/default.jpg';

                    get_template_part('template-parts/components/card-blog', null, [
                        'title' => get_the_title(),
                        'excerpt' => wp_trim_words(get_the_excerpt(), 18, '...'),
                        'url' => get_permalink(),
                        'image' => $image,
                        'date' => get_the_date('j M Y'),
                    ]);
                }
                wp_reset_postdata();
            }
            ?>
        </div>

        <?php get_template_part('template-parts/components/blog-sidebar'); ?>
    </div>

</section>
<?php get_footer(); ?>
