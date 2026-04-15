<?php

/**
 * CPT + Meta Box: service
 */

// Hindari direct access
if (!defined('ABSPATH')) exit;

/**
 * Register Custom Post Type: service
 */

function allow_svg_upload($mimes)
{
    if (! current_user_can('manage_options')) {
        return $mimes;
    }

    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

function fix_svg_display()
{
    echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'fix_svg_display');

function register_cpt_service()
{
    $labels = [
        'name'          => 'Service',
        'singular_name' => 'Service',
        'menu_name'     => 'Service',
        'add_new'       => 'Tambah Baru',
        'add_new_item'  => 'Tambah Service',
        'edit_item'     => 'Edit Service',
        'all_items'     => 'Semua Service',
    ];

    $args = [
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-screenoptions',
        'supports'      => ['thumbnail', 'page-attributes'],
        'show_in_rest'  => true,
    ];

    register_post_type('service', $args);
}
add_action('init', 'register_cpt_service');

/**
 * Add Meta Box
 */
function service_add_meta_box()
{
    add_meta_box(
        'service_meta_box',
        'Detail Service',
        'service_meta_box_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'service_add_meta_box');


/**
 * Meta Box UI
 */
function service_meta_box_callback($post)
{
    $icon         = get_post_meta($post->ID, '_icon', true);
    $color_bg     = get_post_meta($post->ID, '_color_bg_icon', true);
    $judul        = get_post_meta($post->ID, '_judul', true);
    $deskripsi    = get_post_meta($post->ID, '_deskripsi', true);
    $is_selected  = get_post_meta($post->ID, '_is_selected', true);


    wp_nonce_field('service_meta_nonce_action', 'service_meta_nonce');
?>
    <div class="service-meta-box">
        <p>
            <label><strong>Icon (SVG Upload)</strong></label><br>

            <input type="hidden" name="icon" id="icon" value="<?= esc_attr($icon); ?>">

            <button type="button" class="button" id="upload_icon_btn">
                Upload / Pilih SVG
            </button>

        <div id="icon_preview" style="margin-top:10px;">
            <?php if ($icon): ?>
                <img src="<?= esc_url($icon); ?>" style="max-width:80px;">
            <?php endif; ?>
        </div>
        </p>

        <p>
            <label><strong>Background Icon Color</strong></label><br>
            <input type="color" name="color_bg_icon" value="<?= esc_attr($color_bg ?: '#ffffff'); ?>">
        </p>

        <p>
            <label><strong>Judul</strong></label><br>
            <input type="text" name="judul" value="<?= esc_attr($judul); ?>" style="width:100%;">
        </p>

        <p>
            <label><strong>Deskripsi</strong></label><br>
            <textarea name="deskripsi" style="width:100%; min-height:100px;"><?= esc_textarea($deskripsi); ?></textarea>
        </p>

        <p>
            <label>
                <input type="checkbox" name="is_selected" value="1" <?= checked($is_selected, '1'); ?>>
                Tampilkan di Landing Page
            </label>
        </p>

    </div>

    <!-- 🔥 INI POINT 4 (WAJIB DI SINI) -->
    <script>
        jQuery(document).ready(function($) {
            let mediaUploader;

            $('#upload_icon_btn').click(function(e) {
                e.preventDefault();

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                mediaUploader = wp.media({
                    title: 'Pilih Icon SVG',
                    button: {
                        text: 'Gunakan Icon'
                    },
                    multiple: false
                });

                mediaUploader.on('select', function() {
                    let attachment = mediaUploader.state().get('selection').first().toJSON();

                    $('#icon').val(attachment.url);

                    $('#icon_preview').html(
                        '<img src="' + attachment.url + '" style="max-width:80px;">'
                    );
                });

                mediaUploader.open();
            });
        });
    </script>
<?php
}

function load_wp_media()
{
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'load_wp_media');

function service_save_meta_box($post_id)
{
    if (
        !isset($_POST['service_meta_nonce']) ||
        !wp_verify_nonce($_POST['service_meta_nonce'], 'service_meta_nonce_action')
    ) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $icon_url = esc_url_raw($_POST['icon'] ?? '');

    if ($icon_url && '.svg' === strtolower(substr(parse_url($icon_url, PHP_URL_PATH) ?? '', -4)) && ! current_user_can('manage_options')) {
        $icon_url = '';
    }

    update_post_meta($post_id, '_icon', $icon_url);
    update_post_meta($post_id, '_color_bg_icon', sanitize_hex_color($_POST['color_bg_icon'] ?? ''));

    update_post_meta($post_id, '_judul', sanitize_text_field($_POST['judul'] ?? ''));
    update_post_meta($post_id, '_deskripsi', sanitize_textarea_field($_POST['deskripsi'] ?? ''));

    update_post_meta($post_id, '_is_selected', isset($_POST['is_selected']) ? '1' : '0');
}
add_action('save_post_service', 'service_save_meta_box');
