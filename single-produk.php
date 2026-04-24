<?php
get_header();
?>

<?php if (have_posts()) { ?>
    <?php
    while (have_posts()) {
        the_post();

        $image = get_post_meta(get_the_ID(), '_produk_image', true);
        $title = get_post_meta(get_the_ID(), '_produk_judul', true);
        $price = get_post_meta(get_the_ID(), '_produk_harga', true);
        $description = get_post_meta(get_the_ID(), '_produk_deskripsi', true);
        $produk_title = $title ?: get_the_title();
        $image_url = $image ?: get_template_directory_uri().'/assets/img/default.jpg';
        $back_url = home_url('/produk/');
        ?>

        <section class="bg-gradient-to-b from-red-50 via-white to-white py-10 md:py-16 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 md:px-12">
                <a href="<?= esc_url($back_url); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-primary mb-8 hover:opacity-80 transition-opacity duration-200">
                    <span aria-hidden="true">&larr;</span>
                    <span>Kembali ke produk</span>
                </a>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
                    <div class="relative rounded-[28px] overflow-hidden border border-red-100 bg-white shadow-[0_18px_50px_rgba(15,23,42,0.08)]">
                        <div class="absolute inset-0 bg-gradient-to-tr from-red-100/60 via-transparent to-orange-50/80 pointer-events-none"></div>
                        <img
                            src="<?= esc_url($image_url); ?>"
                            alt="<?= esc_attr($produk_title); ?>"
                            class="relative z-10 w-full h-[300px] md:h-[520px] object-cover">
                    </div>

                    <div>
                        <span class="inline-flex items-center rounded-full bg-primary/10 text-primary text-xs md:text-sm font-semibold uppercase tracking-[0.18em] px-4 py-2 mb-5">
                            Detail Produk
                        </span>

                        <h1 class="text-3xl md:text-5xl leading-tight font-bold text-textPrimary mb-4">
                            <?= esc_html($produk_title); ?>
                        </h1>

                        <?php if ($price) { ?>
                            <p class="text-2xl md:text-3xl font-bold text-primary mb-6">
                                <?= esc_html($price); ?>
                            </p>
                        <?php } ?>

                        <?php if ($description) { ?>
                            <p class="text-base md:text-lg leading-relaxed text-textSecondary mb-8">
                                <?= esc_html($description); ?>
                            </p>
                        <?php } ?>

                        <?php if (get_the_content()) { ?>
                            <div class="prose prose-neutral max-w-none text-textSecondary mb-8">
                                <?php the_content(); ?>
                            </div>
                        <?php } ?>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="<?= esc_url($back_url); ?>" class="inline-flex justify-center items-center bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity duration-200">
                                Lihat Produk Lainnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } else { ?>
    <section class="max-w-7xl mx-auto px-6 md:px-12 py-16">
        <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center">
            <h1 class="text-2xl md:text-3xl font-bold text-textPrimary mb-3">
                Detail produk tidak ditemukan
            </h1>
            <p class="text-textSecondary mb-6">
                Silakan refresh permalink WordPress atau kembali ke halaman produk.
            </p>
            <a href="<?= esc_url(home_url('/produk/')); ?>" class="inline-flex justify-center items-center bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity duration-200">
                Kembali ke Produk
            </a>
        </div>
    </section>
<?php } ?>

<?php get_footer(); ?>
