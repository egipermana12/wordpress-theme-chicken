<section class="bg-gray-50 md:py-16 py-6">
    <div class="max-w-7xl mx-auto px-6 md:px-12 text-center">

        <div class="grid grid-cols-2 md:grid-cols-5 gap-y-10 md:gap-y-0">

            <!-- Item -->
            <div class="md:border-r md:border-gray-200">
                <h2 class="text-[32px] font-extrabold text-gray-300">
                    <?= esc_html(get_theme_mod('stat_1_number', '250+')); ?>
                </h2>
                <p class="text-[14px] font-medium text-gray-400 mt-1">
                    <?= esc_html(get_theme_mod('stat_1_label', 'Mitra Bergabung')); ?>
                </p>
            </div>

            <div class="md:border-r md:border-gray-200">
                <h2 class="text-[32px] font-extrabold text-gray-300">
                    <?= esc_html(get_theme_mod('stat_2_number', '12+')); ?>
                </h2>
                <p class="text-[14px] text-gray-400 mt-1">
                    <?= esc_html(get_theme_mod('stat_2_label', 'Kabupaten kota')); ?>
                </p>
            </div>

            <div class="md:border-r md:border-gray-200">
                <h2 class="text-[32px] font-extrabold text-gray-300">
                    <?= esc_html(get_theme_mod('stat_3_number', '50K+')); ?>
                </h2>
                <p class="text-[14px] text-gray-400 mt-1">
                    <?= esc_html(get_theme_mod('stat_3_label', 'Produk Terjual')); ?>
                </p>
            </div>

            <div class="md:border-r md:border-gray-200">
                <h2 class="text-[32px] font-extrabold text-gray-300">
                    <?= esc_html(get_theme_mod('stat_4_number', '8+')); ?>
                </h2>
                <p class="text-[14px] text-gray-400 mt-1">
                    <?= esc_html(get_theme_mod('stat_4_label', 'Tahun Pengalaman')); ?>
                </p>
            </div>

            <!-- Last item, no border -->
            <div class="col-span-2 md:col-span-1 mx-auto">
                <h2 class="text-[32px] font-extrabold text-gray-300">
                    <?= esc_html(get_theme_mod('stat_5_number', '200+')); ?>
                </h2>
                <p class="text-[14px] text-gray-400 mt-1">
                    <?= esc_html(get_theme_mod('stat_5_label', 'Tenaga Kerja')); ?>
                </p>
            </div>

        </div>
    </div>
</section>
