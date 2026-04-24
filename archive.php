<?php get_header(); ?>

<section class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row mb-12 items-start md:items-end justify-start gap-4">
        <div class="w-full md:max-w-[520px]">
            <p class="text-primary md:text-sm text-xs font-semibold mb-3 uppercase">
                Arsip Blog
            </p>

            <h1 class="text-base md:text-xl font-semibold text-textPrimary mb-3">
                <?= get_the_archive_title(); ?>
            </h1>

            <?php if (get_the_archive_description()) { ?>
                <div class="text-textSecondary text-sm md:text-base font-light leading-relaxed">
                    <?php echo wp_kses_post(wpautop(get_the_archive_description())); ?>
                </div>
            <?php } ?>
        </div>
        <div class="w-full border-b md:border-gray-600 md:block hidden"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_300px] gap-8 md:gap-10 items-start">
        <div>
            <?php if (have_posts()) { ?>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8">
                    <?php
                    while (have_posts()) {
                        the_post();

                        $image = has_post_thumbnail()
                            ? get_the_post_thumbnail_url(get_the_ID(), 'large')
                            : get_template_directory_uri().'/assets/img/default.jpg';

                        $categories = get_the_category();
                        $category_name = 'Blog';

                        if (! empty($categories)) {
                            $category_name = $categories[0]->name;
                        }

                        get_template_part('template-parts/components/card-blog', null, [
                            'title' => get_the_title(),
                            'excerpt' => wp_trim_words(get_the_excerpt(), 18, '...'),
                            'url' => get_permalink(),
                            'image' => $image,
                            'category' => $category_name,
                            'date' => get_the_date('j M Y'),
                        ]);
                    }
                ?>
                </div>

                <div class="mt-10">
                    <?php
                echo paginate_links([
                    'prev_text' => 'Sebelumnya',
                    'next_text' => 'Berikutnya',
                    'type' => 'list',
                ]);
                ?>
                </div>
            <?php } else { ?>
                <div class="bg-white border border-gray-200 rounded-2xl p-8 text-textSecondary">
                    Belum ada artikel yang tersedia pada arsip ini.
                </div>
            <?php } ?>
        </div>

        <?php get_template_part('template-parts/components/blog-sidebar'); ?>
    </div>
</section>

<?php get_footer(); ?>
