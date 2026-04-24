<?php get_header(); ?>

<section class="max-w-7xl mx-auto md:px-12 px-6 py-12">
    <div class="mb-10">
        <?php the_content(); ?>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-10 lg:gap-12">
        <?php
        $produk_query = new WP_Query([
            'post_type' => 'produk',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

        if ($produk_query->have_posts()) {
            while ($produk_query->have_posts()) {
                $produk_query->the_post();

                $image = get_post_meta(get_the_ID(), '_produk_image', true);
                $title = get_post_meta(get_the_ID(), '_produk_judul', true);
                $price = get_post_meta(get_the_ID(), '_produk_harga', true);
                $description = get_post_meta(get_the_ID(), '_produk_deskripsi', true);

                get_template_part('template-parts/components/card-produk', null, [
                    'image' => $image ?: get_template_directory_uri() . '/assets/img/default.jpg',
                    'title' => $title ?: get_the_title(),
                    'price' => $price,
                    'description' => $description,
                    'url' => get_permalink(),
                ]);
            }

            wp_reset_postdata();
        }
        ?>
    </div>
</section>
<?php get_footer(); ?>
