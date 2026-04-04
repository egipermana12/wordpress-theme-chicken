<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="w-full bg-white shadow-sm sticky top-0 z-50 relative">
        <div class="max-w-7xl mx-auto px-12 py-4 flex items-center justify-between">

            <!-- LOGO -->
            <div class="text-xl font-bold text-primary">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo home_url(); ?>" class="text-primary">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- MENU -->
            <nav id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white shadow-md md:static md:flex md:shadow-none md:w-auto md:bg-transparent">
                <div class="flex flex-col md:flex-row gap-4 md:gap-6 p-6 md:p-0 text-sm font-medium">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'fallback_cb' => false,
                    ]);
                    ?>
                    <a href="#" class="bg-primary text-white px-4 py-2 rounded-full text-sm block md:hidden w-1/2">
                        Kemitraan
                    </a>
                </div>
            </nav>

            <!-- icon -->
            <button id="menu-toggle" class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- CTA -->
            <a href="#" class="bg-primary text-white px-4 py-2 rounded-full text-sm hidden md:block">
                Kemitraan
            </a>

        </div>
    </header>