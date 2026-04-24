<?php
get_header();

$subtitle = get_post_meta(get_the_ID(), '_subtitle', true);
$features_raw = get_post_meta(get_the_ID(), '_features', true);
$features = array_filter(array_map('trim', explode("\n", (string) $features_raw)));
$cta_url = get_post_meta(get_the_ID(), '_url', true);
$back_url = home_url('/layanan/');
$image_url = has_post_thumbnail()
    ? get_the_post_thumbnail_url(get_the_ID(), 'full')
    : get_template_directory_uri() . '/assets/img/default.jpg';
?>

<section class="bg-gradient-to-b from-red-50 via-white to-white py-10 md:py-14 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <a href="<?= esc_url($back_url); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-primary mb-6 md:mb-10 hover:opacity-80 transition-opacity duration-200">
            <span aria-hidden="true">←</span>
            <span>Kembali ke layanan</span>
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.15fr)_380px] gap-8 md:gap-12 items-start">
            <div>
                <span class="inline-flex items-center rounded-full bg-primary/10 text-primary text-xs md:text-sm font-semibold uppercase tracking-[0.18em] px-4 py-2 mb-5">
                    Detail Layanan
                </span>

                <h1 class="text-3xl md:text-5xl leading-tight font-bold text-textPrimary mb-4 md:mb-5">
                    <?php the_title(); ?>
                </h1>

                <?php if ($subtitle) : ?>
                    <p class="text-base md:text-xl leading-relaxed text-textSecondary max-w-3xl mb-8 md:mb-10">
                        <?= esc_html($subtitle); ?>
                    </p>
                <?php endif; ?>

                <div class="relative rounded-[28px] overflow-hidden border border-red-100 bg-white shadow-[0_18px_50px_rgba(15,23,42,0.08)]">
                    <div class="absolute inset-0 bg-gradient-to-tr from-red-100/60 via-transparent to-orange-50/80 pointer-events-none"></div>
                    <img
                        src="<?= esc_url($image_url); ?>"
                        alt="<?= esc_attr(get_the_title()); ?>"
                        class="relative z-10 w-full h-[260px] md:h-[420px] object-cover md:object-contain p-4 md:p-8">
                </div>

                <?php if (get_the_content()) : ?>
                    <div class="prose prose-neutral max-w-none mt-8 md:mt-10 text-textSecondary">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="lg:sticky lg:top-28">
                <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6 md:p-8">
                    <h2 class="text-xl md:text-2xl font-bold text-textPrimary mb-3">
                        Yang Akan Kamu Dapatkan
                    </h2>
                    <p class="text-sm md:text-base text-textSecondary leading-relaxed mb-6">
                        Paket layanan ini dirancang supaya kamu bisa mulai lebih cepat dengan sistem yang lebih rapi.
                    </p>

                    <?php if (! empty($features)) : ?>
                        <ul class="space-y-4 mb-8">
                            <?php foreach ($features as $feature) : ?>
                                <li class="flex items-start gap-3">
                                    <span class="mt-0.5 shrink-0 w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                        <svg width="14" height="10" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M1 3.5L3.63158 6L9.33333 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span class="text-sm md:text-base leading-relaxed text-textSecondary">
                                        <?= esc_html($feature); ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <div class="rounded-2xl bg-gray-50 border border-dashed border-gray-200 px-5 py-6 text-sm text-textSecondary mb-8">
                            Detail fitur untuk layanan ini belum ditambahkan.
                        </div>
                    <?php endif; ?>

                    <div class="space-y-3">
                        <a
                            href="<?= esc_url($cta_url ?: '#'); ?>"
                            class="block w-full text-center bg-primary text-white px-5 py-3.5 rounded-xl font-semibold hover:opacity-90 transition-opacity duration-200">
                            <?= $cta_url ? 'Hubungi Sekarang' : 'CTA Belum Diatur'; ?>
                        </a>

                        <a
                            href="<?= esc_url($back_url); ?>"
                            class="block w-full text-center bg-gray-50 text-textPrimary border border-gray-200 px-5 py-3.5 rounded-xl font-semibold hover:border-primary hover:text-primary transition-colors duration-200">
                            Lihat Paket Lainnya
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
