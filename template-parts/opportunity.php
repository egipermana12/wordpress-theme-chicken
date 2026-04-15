<section class="md:py-16 py-6 bg-white">
    <div class="max-w-7xl w-full mx-auto px-6 md:px-12 flex flex-col md:flex-row items-center justify-between ">

        <!-- LEFT CONTENT -->
        <div>

            <!-- LABEL -->
            <p class="text-primary md:text-sm text-xs font-semibold mb-2">
                PELUANG BISNIS
            </p>

            <!-- TITLE -->
            <h2 class="text-xl md:text-3xl font-semibold text-textPrimary mb-8">
                <?php echo esc_html(get_theme_mod('opportunity_title', 'Kenapa Bisnis Ayam Crispy ?')); ?>
            </h2>

            <!-- LIST -->

            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-y-8 gap-x-6">
                    <?php
                    // Rekomendasi: Gunakan loop agar kode lebih rapi
                    for ($i = 1; $i <= 4; $i++) :
                        $title = get_theme_mod("opportunity_item_{$i}_title");
                        $desc  = get_theme_mod("opportunity_item_{$i}_description");
                        $icon  = get_theme_mod("opportunity_item_{$i}_icon");

                        if (! $title && ! $desc && ! $icon) continue;
                    ?>
                        <div class="flex flex-col sm:flex-row md:flex-row items-center sm:items-start md:items-start text-center sm:text-left md:text-left gap-4 group">
                            <div class="shrink-0 bg-red-50  w-14 h-14 flex items-center justify-center rounded-2xl transition-colors duration-300 shadow-sm">
                                <?php if ($icon) : echo wp_kses($icon, krenchise_get_allowed_svg_tags());
                                else : ?>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>

                            <div>
                                <h3 class="font-semibold md:text-base text-sm text-textPrimary">
                                    <?php echo esc_html($title ?: 'Keunggulan Bisnis'); ?>
                                </h3>
                                <p class="md:text-sm text-xs text-textSecondary">
                                    <?php echo esc_html($desc ?: 'Deskripsi keuntungan bergabung bersama kemitraan kami.'); ?>
                                </p>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>


        </div>

        <!-- RIGHT IMAGE -->
        <div class="flex-1 w-[300px] md:w-[319px] flex justify-center lg:justify-end relative">
            <div class="absolute inset-0 bg-red-50 rounded-full filter blur-3xl opacity-50 -z-10 scale-75"></div>

            <?php $image = get_theme_mod('opportunity_image'); ?>
            <?php if ($image): ?>
                <img src="<?php echo esc_url($image); ?>"
                    class="w-[300px] md:w-[319px] h-auto object-contain drop-shadow-2xl animate-float"
                    alt="Ilustrasi Peluang Bisnis"
                    style="max-width: 420px;">
            <?php endif; ?>
        </div>
    </div>
</section>
