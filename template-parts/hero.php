<section class="mx-auto px-12 py-16 flex flex-col md:flex-row items-center justify-between gap-10 md:max-width-[1200px] w-full">

    <div class="max-w-xl">
        <p class="text-[16px] font-semibold text-accent uppercase mb-[12px]">
            Bite Me Love Me
        </p>

        <h1 class="text-4xl md:text-[42px] lineheigh-[auto] font-semibold text-textPrimary leading-normal mb-[16px]">
            Mulai <span class="text-primary">Bisnis</span> Ayam Crispy <br />
            dengan <span class="text-primary">Modal Terjangkau</span>
        </h1>

        <p class="text-textSecondary text-[15px] leading-normal md:mb-[84px] mb-3">
            Bergabunglah dengan ratusan mitra yang telah sukses bersama Krinchise
            diberbagai kota di Indonesia dengan potensi omzet hingga 20jt / bulan
        </p>

        <div class="flex gap-4">
            <a href="#" class="btn-primary text-[15px] font-medium">Gabung Kemitraan</a>
            <a href="#" class="btn-secondary text-[15px] font-medium">Konsultasi Gratis</a>
        </div>
    </div>

    <div>
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