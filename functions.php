<?php

function krenchise_sanitize_text($value)
{
    return sanitize_text_field($value);
}

function krenchise_sanitize_textarea($value)
{
    return sanitize_textarea_field($value);
}

function krenchise_get_allowed_svg_tags()
{
    return [
        'svg' => [
            'class' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
            'aria-hidden' => true,
            'role' => true,
            'focusable' => true,
        ],
        'path' => [
            'd' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
        ],
        'g' => [
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
        ],
        'circle' => [
            'cx' => true,
            'cy' => true,
            'r' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
        ],
        'rect' => [
            'x' => true,
            'y' => true,
            'width' => true,
            'height' => true,
            'rx' => true,
            'ry' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
        ],
        'line' => [
            'x1' => true,
            'x2' => true,
            'y1' => true,
            'y2' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
        ],
        'polyline' => [
            'points' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
        ],
        'polygon' => [
            'points' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
        ],
    ];
}

function krenchise_sanitize_opportunity_icon($value)
{
    return wp_kses($value, krenchise_get_allowed_svg_tags());
}

function theme_asset_version($relative_path)
{
    $full_path = get_template_directory() . $relative_path;

    if (! file_exists($full_path)) {
        return wp_get_theme()->get('Version');
    }

    return filemtime($full_path);
}

function theme_assets()
{
    wp_enqueue_style(
        'main-style',
        get_template_directory_uri() . '/dist/css/style.css',
        [],
        theme_asset_version('/dist/css/style.css')
    );
}
add_action('wp_enqueue_scripts', 'theme_assets');

function theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // TAMBAHKAN INI
    add_theme_support('custom-logo', [
        'height' => 100,
        'width' => 300,
        'flex-height' => true,
        'flex-width' => true,
    ]);
}
add_action('after_setup_theme', 'theme_setup');

function theme_fonts()
{
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap',
        false
    );
}
add_action('wp_enqueue_scripts', 'theme_fonts');

function theme_menus()
{
    register_nav_menus([
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu', // TAMBAHKAN INI UNTUK FOOTER
    ]);
}
add_action('after_setup_theme', 'theme_menus');


//custom footer
function theme_customizer($wp_customize)
{

    // SECTION
    $wp_customize->add_section('footer_section', [
        'title' => 'Footer Settings',
        'priority' => 30,
    ]);

    // DESKRIPSI
    $wp_customize->add_setting('footer_description', [
        'default' => 'Solusi bisnis ayam crispy modern dengan modal terjangkau.',
        'sanitize_callback' => 'krenchise_sanitize_textarea',
    ]);

    $wp_customize->add_control('footer_description', [
        'label' => 'Footer Description',
        'section' => 'footer_section',
        'type' => 'textarea',
    ]);

    // EMAIL
    $wp_customize->add_setting('footer_email', [
        'default' => 'info@krenchise.com',
        'sanitize_callback' => 'sanitize_email',
    ]);

    $wp_customize->add_control('footer_email', [
        'label' => 'Email Kontak',
        'section' => 'footer_section',
        'type' => 'text',
    ]);

    //NOMOR TELEPON
    $wp_customize->add_setting('footer_phone', [
        'default' => '+62823-2541-2546',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('footer_phone', [
        'label' => 'Nomor Telepon',
        'section' => 'footer_section',
        'type' => 'text',
    ]);

    //ALAMAT
    $wp_customize->add_setting('footer_address', [
        'default' => 'Jl. Baleendah Timur I No. 24, Baleendah Kec. Baleendah Kabupaten Bandung Jawa Barat',
        'sanitize_callback' => 'krenchise_sanitize_textarea',
    ]);

    $wp_customize->add_control('footer_address', [
        'label' => 'Alamat',
        'section' => 'footer_section',
        'type' => 'textarea',
    ]);
}
add_action('customize_register', 'theme_customizer');

//custom stats
function theme_stats_customizer($wp_customize)
{

    // SECTION
    $wp_customize->add_section('stats_section', [
        'title' => 'Stats Settings',
        'priority' => 30,
    ]);

    // STAT 1
    $wp_customize->add_setting('stat_1_number', [
        'default' => '250+',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_1_number', [
        'label' => 'Stat 1 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_1_label', [
        'default' => 'Mitra Bergabung',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_1_label', [
        'label' => 'Stat 1 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 2
    $wp_customize->add_setting('stat_2_number', [
        'default' => '12+',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_2_number', [
        'label' => 'Stat 2 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_2_label', [
        'default' => 'Kabupaten Kota',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_2_label', [
        'label' => 'Stat 2 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 3
    $wp_customize->add_setting('stat_3_number', [
        'default' => '50K+',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_3_number', [
        'label' => 'Stat 3 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_3_label', [
        'default' => 'Produk Terjual',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_3_label', [
        'label' => 'Stat 3 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 4
    $wp_customize->add_setting('stat_4_number', [
        'default' => '8+',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_4_number', [
        'label' => 'Stat 4 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_4_label', [
        'default' => 'Tahun Pengalaman',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_4_label', [
        'label' => 'Stat 4 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 5
    $wp_customize->add_setting('stat_5_number', [
        'default' => '200+',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_5_number', [
        'label' => 'Stat 5 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_5_label', [
        'default' => 'Tenaga Kerja',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('stat_5_label', [
        'label' => 'Stat 5 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);
}
add_action('customize_register', 'theme_stats_customizer');


//custom oppurtunity
function theme_opportunity_customizer($wp_customize)
{

    // SECTION
    $wp_customize->add_section('opportunity_section', [
        'title' => 'Opportunity Settings',
        'priority' => 30,
    ]);

    // TITLE
    $wp_customize->add_setting('opportunity_title', [
        'default' => 'Kenapa Bisnis Ayam Crispy ?',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('opportunity_title', [
        'label' => 'Opportunity Title',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    // ITEM 1
    $wp_customize->add_setting('opportunity_item_1_title', [
        'default' => 'Pasar Sangat Besar',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('opportunity_item_1_title', [
        'label' => 'Opportunity Item 1 Title',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    //item 1 icon
    $wp_customize->add_setting('opportunity_item_1_icon', [
        'default' => '🍗',
    ]);

    $wp_customize->add_control('opportunity_item_1_icon', [
        'label' => 'Opportunity Item 1 Icon',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    // ITEM 1 DESCRIPTION
    $wp_customize->add_setting('opportunity_item_1_description', [
        'default' => 'Makanan favorit semua kalangan dan usia serta diterima disetiap wilayah',
        'sanitize_callback' => 'krenchise_sanitize_textarea',
    ]);

    $wp_customize->add_control('opportunity_item_1_description', [
        'label' => 'Opportunity Item 1 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    // ITEM 2
    $wp_customize->add_setting('opportunity_item_2_title', [
        'default' => 'Modal Relatif Kecil',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('opportunity_item_2_title', [
        'label' => 'Opportunity Item 2 Title',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    //item 2 icon
    $wp_customize->add_setting('opportunity_item_2_icon', [
        'default' => '💸',
    ]);

    $wp_customize->add_control('opportunity_item_2_icon', [
        'label' => 'Opportunity Item 2 Icon',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    // ITEM 2 DESCRIPTION
    $wp_customize->add_setting('opportunity_item_2_description', [
        'default' => 'Bisa mulai dari booth kecil depan rumah atau ruko',
        'sanitize_callback' => 'krenchise_sanitize_textarea',
    ]);

    $wp_customize->add_control('opportunity_item_2_description', [
        'label' => 'Opportunity Item 2 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    // ITEM 3
    $wp_customize->add_setting('opportunity_item_3_title', [
        'default' => 'Operasional Mudah',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('opportunity_item_3_title', [
        'label' => 'Opportunity Item 3 Title',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    //item 3 icon
    $wp_customize->add_setting('opportunity_item_3_icon', [
        'default' => '⚙️',
    ]);

    $wp_customize->add_control('opportunity_item_3_icon', [
        'label' => 'Opportunity Item 3 Icon',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    // ITEM 3 DESCRIPTION
    $wp_customize->add_setting('opportunity_item_3_description', [
        'default' => 'Tidak butuh chef profesional karena proses pembuatan sangat mudah',
        'sanitize_callback' => 'krenchise_sanitize_textarea',
    ]);

    $wp_customize->add_control('opportunity_item_3_description', [
        'label' => 'Opportunity Item 3 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    // ITEM 4
    $wp_customize->add_setting('opportunity_item_4_title', [
        'default' => 'Margin Keuntungan Tinggi',
        'sanitize_callback' => 'krenchise_sanitize_text',
    ]);

    $wp_customize->add_control('opportunity_item_4_title', [
        'label' => 'Opportunity Item 4 Title',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    //item 4 icon
    $wp_customize->add_setting('opportunity_item_4_icon', [
        'default' => '📈',
    ]);

    $wp_customize->add_control('opportunity_item_4_icon', [
        'label' => 'Opportunity Item 4 Icon',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    // ITEM 4 DESCRIPTION
    $wp_customize->add_setting('opportunity_item_4_description', [
        'default' => 'Margin keuntungan bisa mencapai 50% tergantung lokasi dan strategi pemasaran',
        'sanitize_callback' => 'krenchise_sanitize_textarea',
    ]);

    $wp_customize->add_control('opportunity_item_4_description', [
        'label' => 'Opportunity Item 4 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    //untuk image
    $wp_customize->add_setting('opportunity_image', [
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'opportunity_image',
        [
            'label' => 'Opportunity Image',
            'section' => 'opportunity_section', // atau buat section baru
        ]
    ));
}
add_action('customize_register', 'theme_opportunity_customizer');


require_once get_template_directory() . '/inc/layanan.php';
require_once get_template_directory() . '/inc/service.php';
require_once get_template_directory() . '/inc/katamitra.php';
