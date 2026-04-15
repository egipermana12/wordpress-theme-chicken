<?php

/**
 * CPT + Meta Box: Layanan
 */

// Hindari direct access
if (!defined('ABSPATH')) exit;

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
 * Meta Box UI
 */
function layanan_meta_box_callback($post)
{
    $subtitle    = get_post_meta($post->ID, '_subtitle', true);
    $features    = get_post_meta($post->ID, '_features', true);
    $url         = get_post_meta($post->ID, '_url', true);
    $highlight   = get_post_meta($post->ID, '_highlight', true);
    $is_selected = get_post_meta($post->ID, '_is_selected', true);

    wp_nonce_field('layanan_meta_nonce_action', 'layanan_meta_nonce');
?>
    <div class="layanan-meta-box">
        <p>
            <label>Subtitle</label><br>
            <input type="text" name="subtitle" value="<?= esc_attr($subtitle); ?>" style="width:100%;">
        </p>

        <p>
            <label>Features</label><br>
            <textarea name="features" style="width:100%;"><?= esc_textarea($features); ?></textarea>
        </p>

        <p>
            <label>URL</label><br>
            <input type="text" name="url" value="<?= esc_attr($url); ?>" style="width:100%;">
        </p>

        <p>
            <label>
                <input type="checkbox" name="highlight" value="1" <?= checked($highlight, '1'); ?>>
                Highlight Card
            </label>
        </p>

        <p>
            <label>
                <input type="checkbox" name="is_selected" value="1" <?= checked($is_selected, '1'); ?>>
                Tampilkan di Landing Page
            </label>
        </p>
    </div>
<?php
}


/**
 * Save Meta
 */
function layanan_save_meta_box($post_id)
{
    if (
        !isset($_POST['layanan_meta_nonce']) ||
        !wp_verify_nonce($_POST['layanan_meta_nonce'], 'layanan_meta_nonce_action')
    ) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_subtitle', sanitize_text_field($_POST['subtitle'] ?? ''));
    update_post_meta($post_id, '_features', sanitize_textarea_field($_POST['features'] ?? ''));
    update_post_meta($post_id, '_url', esc_url_raw($_POST['url'] ?? ''));

    update_post_meta($post_id, '_highlight', isset($_POST['highlight']) ? '1' : '0');
    update_post_meta($post_id, '_is_selected', isset($_POST['is_selected']) ? '1' : '0');
}
add_action('save_post', 'layanan_save_meta_box');
