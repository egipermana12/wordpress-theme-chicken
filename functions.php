<?php

function theme_assets()
{
    wp_enqueue_style(
        'main-style',
        get_template_directory_uri() . '/dist/css/style.css',
        [],
        filemtime(get_template_directory() . '/dist/css/style.css')
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
    ]);

    $wp_customize->add_control('footer_description', [
        'label' => 'Footer Description',
        'section' => 'footer_section',
        'type' => 'textarea',
    ]);

    // EMAIL
    $wp_customize->add_setting('footer_email', [
        'default' => 'info@krenchise.com',
    ]);

    $wp_customize->add_control('footer_email', [
        'label' => 'Email Kontak',
        'section' => 'footer_section',
        'type' => 'text',
    ]);

    //NOMOR TELEPON
    $wp_customize->add_setting('footer_phone', [
        'default' => '+62823-2541-2546',
    ]);

    $wp_customize->add_control('footer_phone', [
        'label' => 'Nomor Telepon',
        'section' => 'footer_section',
        'type' => 'text',
    ]);

    //ALAMAT
    $wp_customize->add_setting('footer_address', [
        'default' => 'Jl. Baleendah Timur I No. 24, Baleendah Kec. Baleendah Kabupaten Bandung Jawa Barat',
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
    ]);

    $wp_customize->add_control('stat_1_number', [
        'label' => 'Stat 1 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_1_label', [
        'default' => 'Mitra Bergabung',
    ]);

    $wp_customize->add_control('stat_1_label', [
        'label' => 'Stat 1 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 2
    $wp_customize->add_setting('stat_2_number', [
        'default' => '12+',
    ]);

    $wp_customize->add_control('stat_2_number', [
        'label' => 'Stat 2 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_2_label', [
        'default' => 'Kabupaten Kota',
    ]);

    $wp_customize->add_control('stat_2_label', [
        'label' => 'Stat 2 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 3
    $wp_customize->add_setting('stat_3_number', [
        'default' => '50K+',
    ]);

    $wp_customize->add_control('stat_3_number', [
        'label' => 'Stat 3 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_3_label', [
        'default' => 'Produk Terjual',
    ]);

    $wp_customize->add_control('stat_3_label', [
        'label' => 'Stat 3 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 4
    $wp_customize->add_setting('stat_4_number', [
        'default' => '8+',
    ]);

    $wp_customize->add_control('stat_4_number', [
        'label' => 'Stat 4 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_4_label', [
        'default' => 'Tahun Pengalaman',
    ]);

    $wp_customize->add_control('stat_4_label', [
        'label' => 'Stat 4 Label',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    // STAT 5
    $wp_customize->add_setting('stat_5_number', [
        'default' => '200+',
    ]);

    $wp_customize->add_control('stat_5_number', [
        'label' => 'Stat 5 Number',
        'section' => 'stats_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('stat_5_label', [
        'default' => 'Tenaga Kerja',
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
    ]);

    $wp_customize->add_control('opportunity_title', [
        'label' => 'Opportunity Title',
        'section' => 'opportunity_section',
        'type' => 'text',
    ]);

    // ITEM 1
    $wp_customize->add_setting('opportunity_item_1_title', [
        'default' => 'Pasar Sangat Besar',
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
    ]);

    $wp_customize->add_control('opportunity_item_1_description', [
        'label' => 'Opportunity Item 1 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    // ITEM 2
    $wp_customize->add_setting('opportunity_item_2_title', [
        'default' => 'Modal Relatif Kecil',
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
    ]);

    $wp_customize->add_control('opportunity_item_2_description', [
        'label' => 'Opportunity Item 2 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    // ITEM 3
    $wp_customize->add_setting('opportunity_item_3_title', [
        'default' => 'Operasional Mudah',
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
    ]);

    $wp_customize->add_control('opportunity_item_3_description', [
        'label' => 'Opportunity Item 3 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    // ITEM 4
    $wp_customize->add_setting('opportunity_item_4_title', [
        'default' => 'Margin Keuntungan Tinggi',
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
    ]);

    $wp_customize->add_control('opportunity_item_4_description', [
        'label' => 'Opportunity Item 4 Description',
        'section' => 'opportunity_section',
        'type' => 'textarea',
    ]);

    //untuk image
    $wp_customize->add_setting('opportunity_image');

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


/**
 * Register Custom Post Type: Layanan
 */

function register_cpt_layanan()
{
    $labels = [
        'name'          => 'Layanan',
        'singular_name' => 'Layanan',
        'menu_name'     => 'Layanan',
        'add_new'       => 'Tambah Baru',
        'add_new_item'  => 'Tambah Layanan',
        'edit_item'     => 'Edit Layanan',
        'all_items'     => 'Semua Layanan',
    ];

    $args = [
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-screenoptions',
        'supports'      => ['title', 'thumbnail', 'page-attributes'],
        'show_in_rest'  => true,
    ];

    register_post_type('layanan', $args);
}
add_action('init', 'register_cpt_layanan');


/**
 * Add Meta Box
 */
function layanan_add_meta_box()
{
    add_meta_box(
        'layanan_meta_box',
        'Detail Layanan',
        'layanan_meta_box_callback',
        'layanan',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'layanan_add_meta_box');

/**
 * Meta Box UI di dashboard
 */
function layanan_meta_box_callback($post)
{
    // Ambil data lama
    $subtitle    = get_post_meta($post->ID, '_subtitle', true);
    $features    = get_post_meta($post->ID, '_features', true);
    $url         = get_post_meta($post->ID, '_url', true);
    $highlight   = get_post_meta($post->ID, '_highlight', true);
    $is_selected = get_post_meta($post->ID, '_is_selected', true);

    wp_nonce_field('layanan_meta_nonce_action', 'layanan_meta_nonce');
?>

    <style>
        .layanan-meta-box .field {
            margin-bottom: 16px;
        }

        .layanan-meta-box label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .layanan-meta-box input[type="text"],
        .layanan-meta-box textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccd0d4;
            border-radius: 6px;
            font-size: 14px;
        }

        /* 🔥 FIX CHECKBOX */
        .layanan-meta-box input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
        }

        .layanan-meta-box .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .layanan-meta-box textarea {
            min-height: 100px;
            resize: vertical;
        }
    </style>

    <div class="layanan-meta-box">

        <div class="field">
            <label>Subtitle</label>
            <input type="text" name="subtitle" value="<?= esc_attr($subtitle); ?>">
        </div>

        <div class="field">
            <label>Features</label>
            <textarea name="features"><?= esc_textarea($features); ?></textarea>
        </div>

        <div class="field">
            <label>URL</label>
            <input type="text" name="url" value="<?= esc_attr($url); ?>">
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="highlight" value="1" <?= checked($highlight, '1'); ?>>
            <span>Highlight Card</span>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="is_selected" value="1" <?= checked($is_selected, '1'); ?>>
            <span>Tampilkan di Landing Page</span>
        </div>

    </div>

<?php
}


/**
 * Save Meta Box Data layanan
 */
function layanan_save_meta_box($post_id)
{
    // Validasi nonce
    if (
        !isset($_POST['layanan_meta_nonce']) ||
        !wp_verify_nonce($_POST['layanan_meta_nonce'], 'layanan_meta_nonce_action')
    ) {
        return;
    }

    // Skip autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Permission check
    if (!current_user_can('edit_post', $post_id)) return;

    // Sanitize & save
    update_post_meta($post_id, '_subtitle', sanitize_text_field($_POST['subtitle'] ?? ''));
    update_post_meta($post_id, '_features', sanitize_textarea_field($_POST['features'] ?? ''));
    update_post_meta($post_id, '_url', esc_url_raw($_POST['url'] ?? ''));

    update_post_meta($post_id, '_highlight', isset($_POST['highlight']) ? '1' : '0');
    update_post_meta($post_id, '_is_selected', isset($_POST['is_selected']) ? '1' : '0');
}
add_action('save_post', 'layanan_save_meta_box');
