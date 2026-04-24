<?php
get_header();
?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php
        $image = has_post_thumbnail()
            ? get_the_post_thumbnail_url(get_the_ID(), 'full')
            : get_template_directory_uri() . '/assets/img/default.jpg';
        $categories = get_the_category();
        $category_name = ! empty($categories) ? $categories[0]->name : 'Blog';
        $back_url = home_url('/blog/');
        ?>

        <section class="bg-gradient-to-b from-red-50 via-white to-white py-10 md:py-14 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 md:px-12">
                <a href="<?= esc_url($back_url); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-primary mb-6 md:mb-8 hover:opacity-80 transition-opacity duration-200">
                    <span aria-hidden="true">&larr;</span>
                    <span>Kembali ke blog</span>
                </a>

                <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_300px] gap-8 md:gap-10 items-start">
                    <article class="min-w-0">
                        <div class="mb-6 md:mb-8">
                            <p class="text-primary text-xs md:text-sm font-semibold uppercase mb-3">
                                <?= esc_html($category_name); ?>
                            </p>

                            <h1 class="text-3xl md:text-5xl leading-tight font-bold text-textPrimary mb-4">
                                <?php the_title(); ?>
                            </h1>

                            <p class="text-sm md:text-base text-textSecondary">
                                <?= esc_html(get_the_date('j F Y')); ?>
                            </p>
                        </div>

                        <div class="rounded-[28px] overflow-hidden border border-red-100 bg-white shadow-[0_18px_50px_rgba(15,23,42,0.08)] mb-8">
                            <img
                                src="<?= esc_url($image); ?>"
                                alt="<?= esc_attr(get_the_title()); ?>"
                                class="w-full h-[260px] md:h-[460px] object-cover">
                        </div>

                        <div class="prose prose-neutral max-w-none text-textSecondary prose-headings:text-textPrimary prose-a:text-primary">
                            <?php the_content(); ?>
                        </div>
                    </article>

                    <div class="lg:sticky lg:top-28">
                        <?php get_template_part('template-parts/components/blog-sidebar'); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
