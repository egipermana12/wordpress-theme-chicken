<?php get_header(); ?>

<div class="max-w-4xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-4">
        <?php the_title(); ?>
    </h1>

    <?php if (has_post_thumbnail()) : ?>
        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
            class="w-full rounded-lg mb-6">
    <?php endif; ?>

    <p class="mb-4 text-gray-600">
        <?= get_post_meta(get_the_ID(), '_subtitle', true); ?>
    </p>

    <ul class="list-disc pl-5 space-y-2">
        <?php
        $featuresRaw = get_post_meta(get_the_ID(), '_features', true);
        $features = explode("\n", $featuresRaw);

        foreach ($features as $feature) :
        ?>
            <li><?= esc_html($feature); ?></li>
        <?php endforeach; ?>
    </ul>

</div>

<?php get_footer(); ?>