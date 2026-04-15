<section class="max-w-7xl mx-auto md:px-12 px-6 md:py-16 py-6 flex flex-col md:flex-row items-center justify-between gap-10 w-full">

    <div class="max-w-xl">
        <p class="text-sm md:text-base font-semibold text-accent uppercase mb-2">
            Bite Me Love Me
        </p>

        <h1 class="text-3xl md:text-[42px] md:leading-tight leading-10 font-semibold text-textPrimary  md:mb-6 mb-3">
            Mulai <span class="text-primary">Bisnis</span> Ayam Crispy <br />
            dengan <span class="text-primary">Modal Terjangkau</span>
        </h1>

        <p class="text-textSecondary md:text-base text-sm leading-normal md:mb-12 mb-6">
            Bergabunglah dengan ratusan mitra yang telah sukses bersama Krinchise
            diberbagai kota di Indonesia dengan potensi omzet hingga 20jt / bulan
        </p>

        <div class="flex gap-4 md:flex-row flex-col">
            <a href="#" class="btn-primary text-sm text-center font-medium md:py-3 md:px-8 px-6 py-2">Gabung Kemitraan</a>
            <a href="#" class="btn-secondary text-sm text-center font-medium md:py-3 md:px-8 px-6 py-2">Konsultasi Gratis</a>
        </div>
    </div>

    <div class="hidden md:block">
        <?php
        if (has_post_thumbnail()) :
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        ?>
            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="Hero Image"
                class="w-[390px] md:w-[400px] object-contain" />
        <?php endif; ?>
    </div>

</section>