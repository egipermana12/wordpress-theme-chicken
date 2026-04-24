<?php
$categories = get_categories([
    'hide_empty' => true,
    'orderby' => 'count',
    'order' => 'DESC',
]);

$archives = wp_get_archives([
    'type' => 'monthly',
    'limit' => 6,
    'echo' => 0,
]);
?>

<aside class="space-y-6">
    <div class="bg-white border border-gray-200 rounded-2xl p-5 md:p-6 shadow-sm">
        <h3 class="text-lg md:text-xl font-semibold text-textPrimary mb-4">
            Kategori
        </h3>

        <?php if (! empty($categories)) : ?>
            <ul class="space-y-3">
                <?php foreach ($categories as $category) : ?>
                    <li>
                        <a
                            href="<?= esc_url(get_category_link($category->term_id)); ?>"
                            class="flex items-center justify-between gap-3 text-sm md:text-base text-textSecondary hover:text-primary transition-colors duration-200">
                            <span><?= esc_html($category->name); ?></span>
                            <span class="inline-flex items-center justify-center min-w-8 h-8 px-2 rounded-full bg-gray-100 text-xs font-semibold text-textPrimary">
                                <?= esc_html((string) $category->count); ?>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="text-sm text-textSecondary">
                Belum ada kategori yang tersedia.
            </p>
        <?php endif; ?>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-5 md:p-6 shadow-sm">
        <h3 class="text-lg md:text-xl font-semibold text-textPrimary mb-4">
            Arsip Blog
        </h3>

        <?php if ($archives) : ?>
            <div class="blog-sidebar-archives text-sm md:text-base text-textSecondary leading-relaxed">
                <ul class="space-y-3">
                    <?= wp_kses($archives, [
                        'li' => [],
                        'a' => [
                            'href' => [],
                        ],
                    ]); ?>
                </ul>
            </div>
        <?php else : ?>
            <p class="text-sm text-textSecondary">
                Arsip blog belum tersedia.
            </p>
        <?php endif; ?>
    </div>
</aside>
