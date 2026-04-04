<section class="py-16 bg-white">
    <div class="md:max-width-[1200px] w-full mx-auto px-12 flex flex-col md:flex-row items-center justify-between ">

        <!-- LEFT CONTENT -->
        <div>

            <!-- LABEL -->
            <p class="text-primary text-sm font-semibold mb-2">
                Peluang Bisnis
            </p>

            <!-- TITLE -->
            <h2 class="text-3xl md:text-[30px] font-semibold text-textPrimary mb-8">
                <?php echo get_theme_mod('opportunity_title', 'Kenapa Bisnis Ayam Crispy ?'); ?>
            </h2>

            <!-- LIST -->
            <div class="space-y-6">

                <!-- ITEM -->
                <div class="flex items-start gap-4">
                    <div class="bg-red-100 w-[45px] h-[45px] flex items-center justify-center text-white p-3 rounded-md">
                        <?php echo get_theme_mod('opportunity_item_1_icon', ''); ?>
                    </div>
                    <div>
                        <h3 class="font-semibold text-[16px] text-textPrimary">
                            <?php echo get_theme_mod('opportunity_item_1_title', 'Pasar Sangat Besar'); ?>
                        </h3>
                        <p class="text-[14px] text-textSecondary">
                            <?php echo get_theme_mod('opportunity_item_1_description', 'Makanan favorit semua kalangan dan usia serta diterima disetiap wilayah'); ?>
                        </p>
                    </div>
                </div>

                <!-- ITEM -->
                <div class="flex items-start gap-4">
                    <div class="bg-red-100 w-[45px] h-[45px] flex items-center justify-center text-white p-3 rounded-md">
                        <?php echo get_theme_mod('opportunity_item_2_icon', ''); ?>
                    </div>
                    <div>
                        <h3 class="font-semibold text-[16px] text-textPrimary">
                            <?php echo get_theme_mod('opportunity_item_2_title', 'Modal Relatif Kecil'); ?>
                        </h3>
                        <p class="text-[14px] text-textSecondary">
                            <?php echo get_theme_mod('opportunity_item_2_description', 'Bisa mulai dari booth kecil depan rumah atau ruko'); ?>
                        </p>
                    </div>
                </div>

                <!-- ITEM -->
                <div class="flex items-start gap-4">
                    <div class="bg-red-100 w-[45px] h-[45px] flex items-center justify-center text-white p-3 rounded-md">
                        <?php echo get_theme_mod('opportunity_item_3_icon', ''); ?>
                    </div>
                    <div>
                        <h3 class="font-semibold text-[16px] text-textPrimary">
                            <?php echo get_theme_mod('opportunity_item_3_title', 'Modal Relatif Kecil'); ?>
                        </h3>
                        <p class="text-[14px] text-textSecondary">
                            <?php echo get_theme_mod('opportunity_item_3_description', 'Bisa mulai dari booth kecil depan rumah atau ruko'); ?>
                        </p>
                    </div>
                </div>

                <!-- ITEM -->
                <div class="flex items-start gap-4">
                    <div class="bg-red-100 w-[45px] h-[45px] flex items-center justify-center text-white p-3 rounded-md">
                        <?php echo get_theme_mod('opportunity_item_4_icon', ''); ?>
                    </div>
                    <div>
                        <h3 class="font-semibold text-[16px] text-textPrimary">
                            <?php echo get_theme_mod('opportunity_item_4_title', 'Margin Keuntungan Tinggi'); ?>
                        </h3>
                        <p class="text-[14px] text-textSecondary">
                            <?php echo get_theme_mod('opportunity_item_4_description', 'Nikmati keuntungan yang bersaing dengan jenis bisnis populer lainnya'); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- RIGHT IMAGE -->
        <div class="flex justify-center md:justify-end">
            <?php $image = get_theme_mod('opportunity_image'); ?>

            <?php if ($image): ?>
                <img
                    src="<?php echo esc_url($image); ?>"
                    class="w-[350px] md:w-[319px]" />
            <?php endif; ?>
        </div>

    </div>
</section>