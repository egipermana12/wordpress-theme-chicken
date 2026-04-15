<footer class="bg-textPrimary text-secondary mt-20">
    <div class="md:max-w-[1200px] mx-auto px-6 py-12 grid md:grid-cols-2 gap-10">

        <!-- LOGO / BRAND -->
        <div>
            <h2 class="text-[16px] font-semibold text-secondary mb-4">Krenchise</h2>
            <p class="text-secondary font-extralight leading-relaxed text-[13px] opacity-70 md:max-w-[353px]">
                <?php echo esc_html(get_theme_mod('footer_description')); ?>
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-6 md:gap-16 justify-end">

            <!-- SITEMAP -->
            <div class="">
                <h3 class="font-semibold mb-4">Sitemap</h3>

                <nav class="flex flex-col gap-2 text-sm">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'fallback_cb' => false,
                    ]);
                    ?>
                </nav>
            </div>

            <!-- CTA / INFO -->
            <div class="md:max-w-[268px]">
                <h3 class="font-semibold mb-4">Kontak</h3>
                <p class="text-secondary font-extralight leading-relaxed text-[13px] opacity-70 mb-1">
                    <?php echo esc_html(get_theme_mod('footer_address')); ?>
                </p>
                <p class="text-secondary font-extralight leading-relaxed text-[13px] opacity-70">
                    <?php echo esc_html(get_theme_mod('footer_phone')); ?>
                </p>
                <p class="text-secondary font-extralight leading-relaxed text-[13px] opacity-70">
                    <?php echo esc_html(get_theme_mod('footer_email')); ?>
                </p>
            </div>
        </div>

    </div>

    <!-- COPYRIGHT -->
    <!-- <div class="border-t text-center text-sm py-4 text-textSecondary">
        © <?php echo date('Y'); ?> Krenchise. All rights reserved.
    </div> -->
</footer>


<?php wp_footer(); ?>

<script id="hamburger-js">
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
</script>
</body>

</html>
