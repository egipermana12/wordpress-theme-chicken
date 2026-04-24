<?php
$number = $args['number'] ?? '';
$image = $args['image'] ?? get_template_directory_uri() . '/assets/img/default.jpg';
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
?>

<article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full border border-gray-100 p-4">
    <div class="flex flex-col flex-1">
        <div class="w-full overflow-hidden rounded-xl bg-gray-50 aspect-square mb-5">
            <img
                src="<?= esc_url($image); ?>"
                class="w-full h-full object-cover"
                alt="<?= esc_attr($title); ?>">
        </div>
        <div>
            <h3 class="font-semibold text-gray-900 text-sm md:text-base leading-tight mb-2">
                <?= esc_html($number); ?>.<br>
                <?= esc_html($title); ?>
            </h3>
            <p class="text-xs md:text-sm text-gray-500 font-light leading-relaxed">
                <?= esc_html($description); ?>
            </p>
        </div>
    </div>
</article>
