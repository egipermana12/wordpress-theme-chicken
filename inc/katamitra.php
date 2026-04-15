<?php

/**
 * CPT + Meta Box: Mitra Testimoni
 */

if (!defined('ABSPATH')) exit;

/**
 * =========================
 * 1. REGISTER CPT
 * =========================
 */
function register_cpt_mitra()
{
    $labels = [
        'name'          => 'Mitra',
        'singular_name' => 'Mitra',
        'menu_name'     => 'Mitra',
        'add_new'       => 'Tambah Mitra',
        'add_new_item'  => 'Tambah Mitra',
        'edit_item'     => 'Edit Mitra',
        'all_items'     => 'Semua Mitra',
    ];

    $args = [
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-groups',
        'supports'      => ['title', 'page-attributes'],
        'show_in_rest'  => true,
    ];

    register_post_type('mitra', $args);
}
add_action('init', 'register_cpt_mitra');


/**
 * =========================
 * 2. META BOX
 * =========================
 */
function mitra_add_meta_box()
{
    add_meta_box(
        'mitra_meta_box',
        'Detail Mitra',
        'mitra_meta_box_callback',
        'mitra', // ✅ HARUS mitra
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mitra_add_meta_box');


/**
 * =========================
 * 3. UI META BOX
 * =========================
 */
function mitra_meta_box_callback($post)
{
    $gambarmitra = get_post_meta($post->ID, '_gambarmitra', true);
    $testimoni   = get_post_meta($post->ID, '_testimoni', true);
    $mitraname   = get_post_meta($post->ID, '_mitraname', true);
    $mitracabang = get_post_meta($post->ID, '_mitracabang', true);
    $is_selected = get_post_meta($post->ID, '_is_selected', true);

    wp_nonce_field('mitra_meta_nonce_action', 'mitra_meta_nonce');
?>

    <div class="mitra-meta-box">

        <!-- GAMBAR -->
        <p>
            <label><strong>Gambar Mitra</strong></label><br>

            <input type="hidden" name="gambarmitra" id="gambarmitra" value="<?= esc_attr($gambarmitra); ?>">

            <button type="button" class="button" id="upload_gambar_btn">
                Upload / Pilih Gambar
            </button>

        <div id="gambar_preview" style="margin-top:10px;">
            <?php if ($gambarmitra): ?>
                <img src="<?= esc_url($gambarmitra); ?>" style="max-width:120px;">
            <?php endif; ?>
        </div>
        </p>

        <!-- NAMA -->
        <p>
            <label><strong>Nama Mitra</strong></label><br>
            <input type="text" name="mitraname" value="<?= esc_attr($mitraname); ?>" style="width:100%;">
        </p>

        <!-- CABANG -->
        <p>
            <label><strong>Cabang</strong></label><br>
            <input type="text" name="mitracabang" value="<?= esc_attr($mitracabang); ?>" style="width:100%;">
        </p>

        <!-- TESTIMONI -->
        <p>
            <label><strong>Testimoni</strong></label><br>
            <textarea name="testimoni" style="width:100%; min-height:100px;"><?= esc_textarea($testimoni); ?></textarea>
        </p>

        <!-- CHECKBOX -->
        <p>
            <label>
                <input type="checkbox" name="is_selected" value="1" <?= checked($is_selected, '1'); ?>>
                Tampilkan di Landing Page
            </label>
        </p>

    </div>

    <script>
        jQuery(document).ready(function($) {
            let mediaUploader;

            $('#upload_gambar_btn').click(function(e) {
                e.preventDefault();

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                mediaUploader = wp.media({
                    title: 'Pilih Gambar',
                    button: {
                        text: 'Gunakan Gambar'
                    },
                    multiple: false
                });

                mediaUploader.on('select', function() {
                    let attachment = mediaUploader.state().get('selection').first().toJSON();

                    $('#gambarmitra').val(attachment.url);

                    $('#gambar_preview').html(
                        '<img src="' + attachment.url + '" style="max-width:120px;">'
                    );
                });

                mediaUploader.open();
            });
        });
    </script>

<?php
}


/**
 * =========================
 * 4. LOAD MEDIA UPLOADER
 * =========================
 */
function mitra_load_media()
{
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'mitra_load_media');


/**
 * =========================
 * 5. SAVE DATA
 * =========================
 */
function mitra_save_meta_box($post_id)
{
    if (
        !isset($_POST['mitra_meta_nonce']) ||
        !wp_verify_nonce($_POST['mitra_meta_nonce'], 'mitra_meta_nonce_action')
    ) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_gambarmitra', esc_url_raw($_POST['gambarmitra'] ?? ''));
    update_post_meta($post_id, '_mitraname', sanitize_text_field($_POST['mitraname'] ?? ''));
    update_post_meta($post_id, '_mitracabang', sanitize_text_field($_POST['mitracabang'] ?? ''));
    update_post_meta($post_id, '_testimoni', sanitize_textarea_field($_POST['testimoni'] ?? ''));
    update_post_meta($post_id, '_is_selected', isset($_POST['is_selected']) ? '1' : '0');
}
add_action('save_post_mitra', 'mitra_save_meta_box');
