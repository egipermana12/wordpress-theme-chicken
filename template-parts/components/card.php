<?php
$title = $args['title'] ?? '';
$subtitle = $args['subtitle'] ?? '';
$features = $args['features'] ?? [];
$highlight = $args['highlight'] ?? false;
$url = $args['url'] ?? '#';
$image = $args['image'] ?? get_template_directory_uri() . '/assets/img/default.jpg';
?>

<!-- CARDS -->

<!-- CARD 1 -->
<div class="bg-white rounded-2xl p-6 text-left scale-normal border border-gray-200 flex flex-col h-full
    <?php echo $highlight ? 'scale-105 shadow-lg relative' : 'shadow-sm'; ?>">
    <div class="flex-1">
        <div class="w-full overflow-hidden rounded-lg bg-gray-100 aspect-square mb-4">
            <img src="<?= esc_url($image); ?>" class="w-full h-full object-contain" alt="safs">
        </div>
        <h3 class="font-semibold text-[16px]"> <?= esc_html($title); ?></h3>
        <h3 class="font-semibold text-base mb-6"> <?= esc_html($subtitle); ?> </h3>

        <ul class="space-y-3 text-sm text-textSecondary mb-6">
            <?php foreach ($features as $feature) : ?>
                <li class="flex flex-row items-center"><span class="bg-green-500 text-white mr-2 flex items-center justify-center w-5 h-5 rounded-full"><svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 3.5L3.63158 6L9.33333 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <p><?= esc_html($feature); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>


    </div>
    <a href="<?= esc_url($url); ?>" class="block text-center py-2 rounded-full mb-auto <?php echo $highlight ? 'bg-primary text-white hover:bg-red-700' : 'border bg-red-50 hover:bg-red-200 border-primary text-primary '; ?>">
        Lihat Detail
    </a>
</div>