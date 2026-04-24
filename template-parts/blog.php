<?php
$query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => 'beritapilihan',
    'ignore_sticky_posts' => true,
]);
?>

<?php if ($query->have_posts()) { ?>
    <section class="py-16 md:py-20 bg-white overflow-hidden">
        <div class="max-w-6xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-10 md:mb-14">
                <p class="text-primary text-xs md:text-sm font-semibold uppercase mb-3">
                    Blog
                </p>
                <h2 class="text-xl md:text-3xl font-semibold text-textPrimary">
                    Artikel dan Berita Terbaru
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 items-stretch">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    $categories = get_the_category();
                    $category_name = 'Blog';

                    if (! empty($categories)) {
                        foreach ($categories as $category) {
                            if ($category->slug !== 'beritapilihan') {
                                $category_name = $category->name;
                                break;
                            }
                        }

                        if ($category_name === 'Blog') {
                            $category_name = $categories[0]->name;
                        }
                    }

                    $image = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'large')
                        : get_template_directory_uri().'/assets/img/default.jpg';

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
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php } ?>
