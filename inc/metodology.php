<?php

/**
 * CPT + Meta Box: Metodology
 */

if (! defined('ABSPATH')) exit;

function register_cpt_metodology()
{
    $labels = [
        'name' => 'Metodology',
        'singular_name' => 'Metodology',
        'menu_name' => 'Metodology',
        'add_new' => 'Tambah Baru',
        'add_new_item' => 'Tambah Metodology',
        'edit_item' => 'Edit Metodology',
        'all_items' => 'Semua Metodology',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title', 'page-attributes'],
        'show_in_rest' => true,
    ];

    register_post_type('metodology', $args);
}
add_action('init', 'register_cpt_metodology');

function metodology_add_meta_box()
{
    add_meta_box(
        'metodology_meta_box',
        'Detail Metodology',
        'metodology_meta_box_callback',
        'metodology',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'metodology_add_meta_box');

function metodology_meta_box_callback($post)
{
    $image = get_post_meta($post->ID, '_metodology_image', true);
    $judul = get_post_meta($post->ID, '_metodology_judul', true);
    $deskripsi = get_post_meta($post->ID, '_metodology_deskripsi', true);

    wp_nonce_field('metodology_meta_nonce_action', 'metodology_meta_nonce');
    ?>
    <div class="metodology-meta-box">
        <p>
            <label><strong>Gambar Metodology</strong></label><br>
            <input type="hidden" name="metodology_image" id="metodology_image" value="<?= esc_attr($image); ?>">
            <button type="button" class="button" id="upload_metodology_image_btn">
                Upload / Pilih Gambar
            </button>
        </p>

        <div id="metodology_image_preview" style="margin:10px 0 16px;">
            <?php if ($image) : ?>
                <img src="<?= esc_url($image); ?>" alt="" style="max-width:120px; height:auto;">
            <?php endif; ?>
        </div>

        <p>
            <label><strong>Judul Metodology</strong></label><br>
            <input type="text" name="metodology_judul" value="<?= esc_attr($judul); ?>" style="width:100%;">
        </p>

        <p>
            <label><strong>Deskripsi Metodology</strong></label><br>
            <textarea name="metodology_deskripsi" style="width:100%; min-height:100px;"><?= esc_textarea($deskripsi); ?></textarea>
        </p>
    </div>

    <script>
        jQuery(document).ready(function($) {
            let mediaUploader;

            $('#upload_metodology_image_btn').on('click', function(e) {
                e.preventDefault();

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                mediaUploader = wp.media({
                    title: 'Pilih Gambar Metodology',
                    button: {
                        text: 'Gunakan Gambar'
                    },
                    multiple: false
                });

                mediaUploader.on('select', function() {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();

                    $('#metodology_image').val(attachment.url);
                    $('#metodology_image_preview').html(
                        '<img src="' + attachment.url + '" alt="" style="max-width:120px; height:auto;">'
                    );
                });

                mediaUploader.open();
            });
        });
    </script>
    <?php
}

function metodology_load_media()
{
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'metodology_load_media');

function metodology_save_meta_box($post_id)
{
    if (
        ! isset($_POST['metodology_meta_nonce']) ||
        ! wp_verify_nonce($_POST['metodology_meta_nonce'], 'metodology_meta_nonce_action')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (! current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_metodology_image', esc_url_raw($_POST['metodology_image'] ?? ''));
    update_post_meta($post_id, '_metodology_judul', sanitize_text_field($_POST['metodology_judul'] ?? ''));
    update_post_meta($post_id, '_metodology_deskripsi', sanitize_textarea_field($_POST['metodology_deskripsi'] ?? ''));
}
add_action('save_post_metodology', 'metodology_save_meta_box');
