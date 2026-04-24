<?php get_header(); ?>

<section class="max-w-7xl mx-auto md:px-12 px-6 py-12">

    <!-- TITLE -->
<!--    <h1 class="text-3xl font-bold mb-4 text-center">
//    //<?php the_title(); ?>
    </h1>
,-->

    <!-- CONTENT (GUTENBERG) -->
    <div class="mb-10">
        <?php the_content(); ?>
    </div>

    <!-- LIST CARD -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16">

        <?php
        $query = new WP_Query([
            'post_type' => 'layanan',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);
        $featuresRaw = get_post_meta(get_the_ID(), '_features', true);
        $features = array_filter(array_map('trim', explode("\n", $featuresRaw)));
        $highlight = get_post_meta(get_the_ID(), '_highlight', true);
        $url = get_post_meta(get_the_ID(), '_url', true);
        $image = has_post_thumbnail()
            ? get_the_post_thumbnail_url(get_the_ID(), 'medium')
            : get_template_directory_uri().'/assets/img/default.jpg';

        get_template_part('template-parts/components/card', null, [
            'title' => get_the_title(),
            'subtitle' => $subtitle,
            'features' => $features,
            'highlight' => $highlight === '1',
            'url' => get_permalink(),
            'image' => $image,
        ]);

    }
    wp_reset_postdata();
}
?>

    </div>

      

</section>
<section class="md:mt-16 py-16 bg-gray-100 overflow-hidden">
        <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
        <p class="text-primary md:text-sm text-xs font-semibold mb-3">
            KEUNGGULAN KAMI
        </p>

           <h2 class="text-xl md:text-3xl font-semibold text-textPrimary mb-3">
                Kenapa Memilih Kami?
            </h2>
            <p class="text-textSecondary text-xs md:text-sm font-light mb-12">
                Kami berkomitmen untuk memberikan layanan terbaik dengan keunggulan yang membedakan kami dari kompetitor<br>
                Temukan alasan mengapa kami menjadi pilihan utama untuk kebutuhan bisnis Anda
            </p>
</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-10 lg:gap-12">

            <?php
            $query = new WP_Query([
                'post_type' => 'service',
                'posts_per_page' => -1,
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
<section class="py-16 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row mb-12 items-start md:items-end justify-start gap-4">
            <div class="w-full md:max-w-[400px]">
                <p class="text-primary md:text-sm text-xs font-semibold mb-3">
                    METODOLOGI PATNERSHIP
                </p>

                <h2 class="text-xl md:text-3xl font-semibold text-textPrimary mb-3">
                    Alur Kerjasama mudah, <br> dan Berkelanjutan
                </h2>
            </div>
            <div class="w-full border-b md:border-gray-600 md:block hidden"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            <?php
            $metodology_query = new WP_Query([
                'post_type' => 'metodology',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ]);

if ($metodology_query->have_posts()) {
    $metodology_number = 1;

    while ($metodology_query->have_posts()) {
        $metodology_query->the_post();

        $metodology_image = get_post_meta(get_the_ID(), '_metodology_image', true);
        $metodology_title = get_post_meta(get_the_ID(), '_metodology_judul', true);
        $metodology_description = get_post_meta(get_the_ID(), '_metodology_deskripsi', true);

        get_template_part('template-parts/components/card-metodology', null, [
            'number' => str_pad((string) $metodology_number, 2, '0', STR_PAD_LEFT),
            'image' => $metodology_image ?: get_template_directory_uri().'/assets/img/default.jpg',
            'title' => $metodology_title ?: get_the_title(),
            'description' => $metodology_description,
        ]);

        $metodology_number++;
    }

    wp_reset_postdata();
}
?>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/siapbisnis'); ?>
<?php get_footer(); ?>
