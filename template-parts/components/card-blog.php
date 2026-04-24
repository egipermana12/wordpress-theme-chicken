<?php
$title = $args['title'] ?? '';
$excerpt = $args['excerpt'] ?? '';
$url = $args['url'] ?? '#';
$image = $args['image'] ?? get_template_directory_uri() . '/assets/img/default.jpg';
$category = $args['category'] ?? 'Blog';
$date = $args['date'] ?? '';
?>

<article class="group bg-white rounded-2xl border border-gray-200 p-4 md:p-5 shadow-sm hover:shadow-md transition-all duration-300 h-full flex flex-col">
    <a href="<?= esc_url($url); ?>" class="block overflow-hidden rounded-xl bg-gray-100 aspect-[4/3] mb-5">
        <img
            src="<?= esc_url($image); ?>"
            alt="<?= esc_attr($title); ?>"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </a>

    <div class="flex flex-col flex-1">
        <p class="text-primary text-xs md:text-sm font-medium mb-3">
            <?= esc_html($category); ?>
        </p>

        <h3 class="text-xl md:text-[22px] leading-snug font-semibold text-textPrimary mb-3">
            <a href="<?= esc_url($url); ?>" class="hover:text-primary transition-colors duration-200">
                <?= esc_html($title); ?>
            </a>
        </h3>

        <p class="text-sm md:text-base leading-relaxed text-textSecondary mb-6 flex-1">
            <?= esc_html($excerpt); ?>
        </p>

        <?php if ($date) : ?>
            <p class="text-sm text-textPrimary">
                <?= esc_html($date); ?>
            </p>
        <?php endif; ?>
    </div>
</article>
