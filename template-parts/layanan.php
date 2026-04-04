<section class="py-16 bg-primary md:max-h-[625px] mb-24">
    <div class="md:max-width-[1200px] w-full mx-auto px-12 text-center relative">
        <!-- LABEL -->
        <p class="text-accent text-sm font-semibold mb-3">
            LAYANAN PILIHAN
        </p>

        <!-- TITLE -->
        <h2 class="text-3xl md:text-[30px] font-semibold text-white mb-4">
            Solusi Memulai Bisnis Anda
        </h2>

        <p class="text-white/80 text-[16px] font-light max-w-xl mx-auto mb-12">
            Temukan layanan sesuai dengan kebutuhan dan budget bisnis Anda bersama kami
        </p>

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
            <?php
            $query = new WP_Query([
                'post_type' => 'layanan',
                'posts_per_page' => -1,
                'meta_query' => [
                    [
                        'key' => '_is_selected',
                        'value' => '1',
                    ]
                ],
                'orderby'        => 'menu_order', // 🔥 urut berdasarkan order
                'order'          => 'ASC',
            ]);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();

                    $subtitle    = get_post_meta(get_the_ID(), '_subtitle', true);
                    $featuresRaw = get_post_meta(get_the_ID(), '_features', true);
                    $features    = array_filter(array_map('trim', explode("\n", $featuresRaw)));
                    $highlight   = get_post_meta(get_the_ID(), '_highlight', true);
                    $url         = get_post_meta(get_the_ID(), '_url', true);

                    // ✅ ambil image
                    $image = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'medium')
                        : get_template_directory_uri() . '/assets/img/default.jpg';

                    get_template_part('template-parts/components/card', null, [
                        'title'     => get_the_title(),
                        'subtitle'  => $subtitle,
                        'features'  => $features,
                        'highlight' => $highlight === '1',
                        'url'       => get_permalink(),
                        'image'     => $image // 🔥 kirim ke component
                    ]);

                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>


    </div>
</section>