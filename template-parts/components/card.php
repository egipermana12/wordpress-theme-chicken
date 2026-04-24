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
<div class="group bg-white rounded-2xl p-5 md:p-6 border border-gray-200 flex flex-col h-full transition-all duration-300
    <?php echo $highlight ? 'md:scale-105 shadow-xl ring-2 ring-primary relative z-10' : 'shadow-sm hover:shadow-md'; ?>">

    <?php if ($highlight): ?>
        <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-[10px] font-bold tracking-widest uppercase px-4 py-1 rounded-full shadow-md z-20">
            POPULAR
        </span>
    <?php endif; ?>

    <div class="flex flex-col flex-1">
        <div class="w-full overflow-hidden rounded-xl bg-gray-50 aspect-square mb-5">
            <img src="<?= esc_url($image); ?>"
                class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500"
                alt="<?= esc_attr($title); ?>">
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-900 text-sm md:text-base leading-tight mb-1">
                <?= esc_html($title); ?>
            </h3>
            <p class="text-xs md:text-sm text-gray-500 font-medium italic">
                <?= esc_html($subtitle); ?>
            </p>
        </div>

        <ul class="space-y-3 mb-8">
            <?php foreach ($features as $feature) : ?>
                <li class="flex items-start gap-3">
                    <span class="mt-0.5 shrink-0 bg-green-100 text-green-600 flex items-center justify-center w-5 h-5 rounded-full">
                        <svg width="10" height="8" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 3.5L3.63158 6L9.33333 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="text-sm text-gray-600 leading-tight italic">
                        <?= esc_html($feature); ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="mt-auto">
        <a href="<?= esc_url($url); ?>"
            class="block w-full text-center py-3 px-4 rounded-xl font-semibold transition-colors duration-200 
           <?php echo $highlight
                ? 'bg-primary text-white hover:bg-opacity-90 shadow-lg shadow-primary/20'
                : 'bg-gray-50 text-primary border border-primary/20 hover:bg-primary hover:text-white'; ?>">
            Lihat Detail
        </a>
    </div>
</div>