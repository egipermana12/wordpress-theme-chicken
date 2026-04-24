<section class="py-16 md:mt-16 bg-gray-100 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">

        <div class="text-center mb-6 md:mb-14">
            <p class="text-primary text-xs md:text-sm font-semibold uppercase mb-3">
                CERITA MITRA
            </p>
            <h2 class="text-xl md:text-3xl font-semibold text-textPrimary">
                Apa kata mitra kami
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 items-stretch">

            <?php
            $query = new WP_Query([
                'post_type' => 'mitra',
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

                    $gambarmitra = get_post_meta(get_the_ID(), '_gambarmitra', true);
                    $testimoni = get_post_meta(get_the_ID(), '_testimoni', true);
                    $mitraname = get_post_meta(get_the_ID(), '_mitraname', true);
                    $mitracabang = get_post_meta(get_the_ID(), '_mitracabang', true);

                    get_template_part('template-parts/components/card-mitra', null, [
                        'gambarmitra' => $gambarmitra,
                        'testimoni' => $testimoni,
                        'mitraname' => $mitraname,
                        'mitracabang' => $mitracabang,
                    ]);

                }
                wp_reset_postdata();
            }
            ?>

        </div>
    </div>
</section>
