<?php
$image = $args['image'] ?? get_template_directory_uri() . '/assets/img/default.jpg';
$title = $args['title'] ?? '';
$price = $args['price'] ?? '';
$description = $args['description'] ?? '';
$url = $args['url'] ?? '#';
?>

<article class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 p-4 flex flex-col h-full">
    <a href="<?= esc_url($url); ?>" class="block w-full overflow-hidden rounded-xl bg-gray-50 aspect-square mb-5">
        <img
            src="<?= esc_url($image); ?>"
            alt="<?= esc_attr($title); ?>"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </a>

    <div class="flex flex-col flex-1">
        <div class="flex items-start justify-between gap-3 mb-3">
            <h3 class="font-semibold text-textPrimary text-base md:text-lg leading-tight">
                <a href="<?= esc_url($url); ?>" class="hover:text-primary transition-colors duration-200">
                    <?= esc_html($title); ?>
                </a>
            </h3>

            <?php if ($price) : ?>
                <span class="shrink-0 text-primary text-sm md:text-base font-bold">
                    <?= esc_html($price); ?>
                </span>
            <?php endif; ?>
        </div>

        <?php if ($description) : ?>
            <p class="text-xs md:text-sm text-textSecondary leading-relaxed">
                <?= esc_html($description); ?>
            </p>
        <?php endif; ?>

        <div class="mt-5 pt-5 border-t border-gray-100">
            <a href="<?= esc_url($url); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:gap-3 transition-all duration-200">
                <span>Lihat Detail</span>
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</article>
