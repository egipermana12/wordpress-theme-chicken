<section class="py-2 md:mt-72 bg-white overflow-hidden">
    <div class="max-w-7xl w-full mx-auto px-6 md:px-12 text-center">

        <p class="text-primary text-xs md:text-sm font-semibold uppercase mb-3">
            KEUNGGULAN KAMI
        </p>

        <h2 class="text-xl md:text-3xl font-semibold text-textPrimary mb-4 md:mb-12 max-w-2xl mx-auto leading-tight">
            Kenapa memilih kami?
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-10 lg:gap-12">

            <?php
            $query = new WP_Query([
                'post_type' => 'service',
                'posts_per_page' => -1,
                'meta_query' => [
                    [
                        'key' => '_is_selected',
                        'value' => '1',
                    ],
                ],
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ]);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $icon = get_post_meta(get_the_ID(), '_icon', true);
                    $color_bg = get_post_meta(get_the_ID(), '_color_bg_icon', true);
                    $judul = get_post_meta(get_the_ID(), '_judul', true);
                    $deskripsi = get_post_meta(get_the_ID(), '_deskripsi', true);

                    get_template_part('template-parts/components/card-service', null, [
                        'icon' => $icon,
                        'color_bg' => $color_bg,
                        'judul' => $judul,
                        'deskripsi' => $deskripsi,
                    ]);

                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</section>
