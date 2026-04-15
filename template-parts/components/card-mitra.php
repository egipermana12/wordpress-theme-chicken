<?php
$gambarmitra = $args['gambarmitra'] ?? '';
$testimoni = $args['testimoni'] ?? '';
$mitraname = $args['mitraname'] ?? '';
$mitracabang = $args['mitracabang'] ?? '';

?>

<div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full border border-gray-100">

    <div class="flex items-center gap-1 mb-5">
        <?php for ($i = 0; $i < 5; $i++) : ?>
            <svg width="18" height="18" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.1855 0.898919C13.5747 -0.298785 15.2691 -0.298788 15.6582 0.898916L18.1713 8.63317C18.3453 9.1688 18.8444 9.53144 19.4076 9.53144H27.5399C28.7992 9.53144 29.3229 11.1429 28.304 11.8832L21.7249 16.6632C21.2692 16.9942 21.0786 17.581 21.2526 18.1166L23.7656 25.8509C24.1548 27.0486 22.784 28.0446 21.7651 27.3043L15.186 22.5243C14.7304 22.1933 14.1134 22.1933 13.6578 22.5243L7.07861 27.3043C6.05978 28.0446 4.68896 27.0486 5.07811 25.8509L7.59112 18.1166C7.76516 17.581 7.5745 16.9942 7.11887 16.6632L0.539727 11.8832C-0.479101 11.1429 0.0445063 9.53144 1.30385 9.53144H9.43612C9.99931 9.53144 10.4985 9.1688 10.6725 8.63317L13.1855 0.898919Z" fill="#F3A939" />
            </svg>
        <?php endfor; ?>
    </div>

    <blockquote class="flex-1">
        <p class="text-textSecondary text-sm md:text-base leading-relaxed italic mb-6">
            "<?= esc_html($testimoni) ?>"
        </p>
    </blockquote>

    <div class="flex items-center gap-4 pt-6 border-t border-gray-50">
        <img src="<?= esc_url($gambarmitra) ?>"
            alt="<?= esc_attr($mitraname) ?>"
            class="w-11 h-11 rounded-full object-cover ring-2 ring-gray-100">
        <div class="flex flex-col">
            <span class="text-sm font-bold text-textPrimary leading-none mb-1"><?= esc_html($mitraname) ?></span>
            <span class="text-xs text-textSecondary font-medium"><?= esc_html($mitracabang) ?></span>
        </div>
    </div>
</div>