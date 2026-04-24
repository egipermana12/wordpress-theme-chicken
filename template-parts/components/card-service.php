<?php
$icon = $args['icon'] ?? '';
$color_bg = $args['color_bg'] ?? '#DA3636';
$judul = $args['judul'] ?? '';
$deskripsi = $args['deskripsi'] ?? '';
?>

<div class="flex flex-col text-left cursor-pointer hover:shadow-lg md:border-none border border-gray-300 shadow-sm transition-shadow duration-300 p-6 rounded-lg">
    <div style="background-color: <?= esc_attr($color_bg); ?>;" class="w-12 h-12 rounded-full flex items-center justify-center mb-4">
        <span class="text-white md:text-xl text-sm">
            <?php
            if ($icon) {
                echo '<img src="'.esc_url($icon).'" alt="icon">';
            }
?>
        </span>
    </div>
    <h3 class="font-semibold md:text-lg text-base mb-2"><?= esc_html($judul) ?></h3>
    <p class="text-sm md:text-base italic leading-relaxed text-textSecondary"><?= esc_html($deskripsi) ?></p>
</div>
