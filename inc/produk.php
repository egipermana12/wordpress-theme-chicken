<?php

/**
 * CPT + Meta Box: Produk
 */

if (! defined('ABSPATH')) exit;

function register_cpt_produk()
{
    $labels = [
        'name' => 'Produk',
        'singular_name' => 'Produk',
        'menu_name' => 'Produk',
        'add_new' => 'Tambah Baru',
        'add_new_item' => 'Tambah Produk',
        'edit_item' => 'Edit Produk',
        'all_items' => 'Semua Produk',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-products',
        'supports' => ['title', 'page-attributes'],
        'show_in_rest' => true,
        'query_var' => true,
        'rewrite' => [
            'slug' => 'produk',
            'with_front' => false,
        ],
    ];

    register_post_type('produk', $args);
}
add_action('init', 'register_cpt_produk');

function produk_add_meta_box()
{
    add_meta_box(
        'produk_meta_box',
        'Detail Produk',
        'produk_meta_box_callback',
        'produk',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'produk_add_meta_box');

function produk_meta_box_callback($post)
{
    $image = get_post_meta($post->ID, '_produk_image', true);
    $judul = get_post_meta($post->ID, '_produk_judul', true);
    $harga = get_post_meta($post->ID, '_produk_harga', true);
    $deskripsi = get_post_meta($post->ID, '_produk_deskripsi', true);

    wp_nonce_field('produk_meta_nonce_action', 'produk_meta_nonce');
    ?>
    <div class="produk-meta-box">
        <p>
            <label><strong>Gambar Produk</strong></label><br>
            <input type="hidden" name="produk_image" id="produk_image" value="<?= esc_attr($image); ?>">
            <button type="button" class="button" id="upload_produk_image_btn">
                Upload / Pilih Gambar
            </button>
        </p>

        <div id="produk_image_preview" style="margin:10px 0 16px;">
            <?php if ($image) : ?>
                <img src="<?= esc_url($image); ?>" alt="" style="max-width:120px; height:auto;">
            <?php endif; ?>
        </div>

        <p>
            <label><strong>Judul Produk</strong></label><br>
            <input type="text" name="produk_judul" value="<?= esc_attr($judul); ?>" style="width:100%;">
        </p>

        <p>
            <label><strong>Harga Produk</strong></label><br>
            <input type="text" name="produk_harga" value="<?= esc_attr($harga); ?>" style="width:100%;">
        </p>

        <p>
            <label><strong>Deskripsi Produk</strong></label><br>
            <textarea name="produk_deskripsi" style="width:100%; min-height:100px;"><?= esc_textarea($deskripsi); ?></textarea>
        </p>
    </div>

    <script>
        jQuery(document).ready(function($) {
            let mediaUploader;

            $('#upload_produk_image_btn').on('click', function(e) {
                e.preventDefault();

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                mediaUploader = wp.media({
                    title: 'Pilih Gambar Produk',
                    button: {
                        text: 'Gunakan Gambar'
                    },
                    multiple: false
                });

                mediaUploader.on('select', function() {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();

                    $('#produk_image').val(attachment.url);
                    $('#produk_image_preview').html(
                        '<img src="' + attachment.url + '" alt="" style="max-width:120px; height:auto;">'
                    );
                });

                mediaUploader.open();
            });
        });
    </script>
    <?php
}

function produk_load_media()
{
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'produk_load_media');

function produk_save_meta_box($post_id)
{
    if (
        ! isset($_POST['produk_meta_nonce']) ||
        ! wp_verify_nonce($_POST['produk_meta_nonce'], 'produk_meta_nonce_action')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (! current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_produk_image', esc_url_raw($_POST['produk_image'] ?? ''));
    update_post_meta($post_id, '_produk_judul', sanitize_text_field($_POST['produk_judul'] ?? ''));
    update_post_meta($post_id, '_produk_harga', sanitize_text_field($_POST['produk_harga'] ?? ''));
    update_post_meta($post_id, '_produk_deskripsi', sanitize_textarea_field($_POST['produk_deskripsi'] ?? ''));
}
add_action('save_post_produk', 'produk_save_meta_box');
