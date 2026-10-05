<?php

if (! defined('ABSPATH')) exit;

function krenchise_get_pengajuan_status_options()
{
    return [
        'pengajuan' => 'Pengajuan',
        'pemantauan' => 'Pemantauan',
        'di_acc' => 'Di ACC',
        'ditolak' => 'Ditolak',
    ];
}

function register_cpt_gabungkemitraan()
{
    $labels = [
        'name' => 'Gabung Kemitraan',
        'singular_name' => 'Gabung Kemitraan',
        'menu_name' => 'Gabung Kemitraan',
        'add_new' => 'Tambah Baru',
        'add_new_item' => 'Tambah Pengajuan',
        'edit_item' => 'Edit Pengajuan',
        'all_items' => 'Semua Pengajuan',
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-id-alt',
        'supports' => ['title', 'page-attributes'],
        'show_in_rest' => true,
    ];

    register_post_type('gabungkemitraan', $args);
}
add_action('init', 'register_cpt_gabungkemitraan');

function krenchise_get_gabungkemitraan_url()
{
    $possible_slugs = ['gabungkemitraan', 'gabung-kemitraan'];

    foreach ($possible_slugs as $slug) {
        $page = get_page_by_path($slug);

        if ($page instanceof WP_Post) {
            return get_permalink($page);
        }
    }

    return home_url('/gabung-kemitraan/');
}

function gabungkemitraan_add_meta_box()
{
    add_meta_box(
        'gabungkemitraan_meta_box',
        'Detail Calon Mitra',
        'gabungkemitraan_meta_box_callback',
        'gabungkemitraan',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'gabungkemitraan_add_meta_box');

function krenchise_get_layanan_options()
{
    $options = [];

    $layanan_query = new WP_Query([
        'post_type' => 'layanan',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'fields' => 'ids',
    ]);

    if ($layanan_query->have_posts()) {
        foreach ($layanan_query->posts as $layanan_id) {
            $options[] = get_the_title($layanan_id);
        }
    }

    wp_reset_postdata();

    return $options;
}

function gabungkemitraan_meta_box_callback($post)
{
    $nama = get_post_meta($post->ID, '_nama', true);
    $alamat = get_post_meta($post->ID, '_alamat', true);
    $nomor_hp = get_post_meta($post->ID, '_nomor_hp', true);
    $email = get_post_meta($post->ID, '_email', true);
    $jenis_kemitraan = get_post_meta($post->ID, '_jenis_kemitraan', true);
    $status_pengajuan = get_post_meta($post->ID, '_status_pengajuan', true) ?: 'pengajuan';
    $layanan_options = krenchise_get_layanan_options();
    $status_options = krenchise_get_pengajuan_status_options();

    wp_nonce_field('gabungkemitraan_meta_nonce_action', 'gabungkemitraan_meta_nonce');
    ?>
    <div class="gabungkemitraan-meta-box">
        <p>
            <label><strong>Nama</strong></label><br>
            <input type="text" name="nama" value="<?= esc_attr($nama); ?>" style="width:100%;">
        </p>

        <p>
            <label><strong>Alamat</strong></label><br>
            <textarea name="alamat" style="width:100%; min-height:100px;"><?= esc_textarea($alamat); ?></textarea>
        </p>

        <p>
            <label><strong>Nomor HP / WA</strong></label><br>
            <input type="text" name="nomor_hp" value="<?= esc_attr($nomor_hp); ?>" style="width:100%;">
        </p>

        <p>
            <label><strong>Email</strong></label><br>
            <input type="email" name="email" value="<?= esc_attr($email); ?>" style="width:100%;">
        </p>

        <p>
            <label><strong>Jenis Kemitraan</strong></label><br>
            <select name="jenis_kemitraan" style="width:100%;">
                <option value="">Pilih jenis kemitraan</option>
                <?php foreach ($layanan_options as $layanan_option) : ?>
                    <option value="<?= esc_attr($layanan_option); ?>" <?= selected($jenis_kemitraan, $layanan_option); ?>>
                        <?= esc_html($layanan_option); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label><strong>Status Pengajuan</strong></label><br>
            <select name="status_pengajuan" style="width:100%;">
                <?php foreach ($status_options as $status_key => $status_label) : ?>
                    <option value="<?= esc_attr($status_key); ?>" <?= selected($status_pengajuan, $status_key); ?>>
                        <?= esc_html($status_label); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
    </div>
    <?php
}

function gabungkemitraan_save_meta_box($post_id)
{
    if (
        ! isset($_POST['gabungkemitraan_meta_nonce']) ||
        ! wp_verify_nonce($_POST['gabungkemitraan_meta_nonce'], 'gabungkemitraan_meta_nonce_action')
    ) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (! current_user_can('edit_post', $post_id)) return;

    $nama = sanitize_text_field($_POST['nama'] ?? '');
    $alamat = sanitize_textarea_field($_POST['alamat'] ?? '');
    $nomor_hp = sanitize_text_field($_POST['nomor_hp'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $jenis_kemitraan = sanitize_text_field($_POST['jenis_kemitraan'] ?? '');
    $status_options = krenchise_get_pengajuan_status_options();
    $status_pengajuan = sanitize_text_field($_POST['status_pengajuan'] ?? 'pengajuan');

    if (! array_key_exists($status_pengajuan, $status_options)) {
        $status_pengajuan = 'pengajuan';
    }

    update_post_meta($post_id, '_nama', $nama);
    update_post_meta($post_id, '_alamat', $alamat);
    update_post_meta($post_id, '_nomor_hp', $nomor_hp);
    update_post_meta($post_id, '_email', $email);
    update_post_meta($post_id, '_jenis_kemitraan', $jenis_kemitraan);
    update_post_meta($post_id, '_status_pengajuan', $status_pengajuan);
}
add_action('save_post_gabungkemitraan', 'gabungkemitraan_save_meta_box');

function gabungkemitraan_set_admin_columns($columns)
{
    return [
        'cb' => $columns['cb'],
        'title' => 'Nama',
        'nomor_hp' => 'Nomor HP / WA',
        'email' => 'Email',
        'jenis_kemitraan' => 'Jenis Kemitraan',
        'status_pengajuan' => 'Status',
        'alamat' => 'Alamat',
        'date' => 'Tanggal',
    ];
}
add_filter('manage_gabungkemitraan_posts_columns', 'gabungkemitraan_set_admin_columns');

function gabungkemitraan_render_admin_columns($column, $post_id)
{
    if ($column === 'jenis_kemitraan') {
        $jenis_kemitraan = get_post_meta($post_id, '_jenis_kemitraan', true);
        echo esc_html($jenis_kemitraan ?: '-');
    }

    if ($column === 'nomor_hp') {
        $nomor_hp = get_post_meta($post_id, '_nomor_hp', true);
        echo esc_html($nomor_hp ?: '-');
    }

    if ($column === 'email') {
        $email = get_post_meta($post_id, '_email', true);

        if (! $email) {
            echo '-';
            return;
        }

        echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
    }

    if ($column === 'status_pengajuan') {
        $status_pengajuan = get_post_meta($post_id, '_status_pengajuan', true) ?: 'pengajuan';
        $status_options = krenchise_get_pengajuan_status_options();
        echo esc_html($status_options[$status_pengajuan] ?? 'Pengajuan');
    }

    if ($column === 'alamat') {
        $alamat = get_post_meta($post_id, '_alamat', true);

        if (! $alamat) {
            echo '-';
            return;
        }

        echo esc_html(wp_trim_words($alamat, 12, '...'));
    }
}
add_action('manage_gabungkemitraan_posts_custom_column', 'gabungkemitraan_render_admin_columns', 10, 2);

function gabungkemitraan_make_admin_columns_sortable($columns)
{
    $columns['title'] = 'title';
    $columns['nomor_hp'] = 'nomor_hp';
    $columns['email'] = 'email';
    $columns['jenis_kemitraan'] = 'jenis_kemitraan';
    $columns['status_pengajuan'] = 'status_pengajuan';
    $columns['date'] = 'date';

    return $columns;
}
add_filter('manage_edit-gabungkemitraan_sortable_columns', 'gabungkemitraan_make_admin_columns_sortable');

function gabungkemitraan_admin_orderby($query)
{
    if (! is_admin() || ! $query->is_main_query()) {
        return;
    }

    if ($query->get('post_type') !== 'gabungkemitraan') {
        return;
    }

    if (! $query->get('orderby')) {
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }

    if ($query->get('orderby') === 'jenis_kemitraan') {
        $query->set('meta_key', '_jenis_kemitraan');
        $query->set('orderby', 'meta_value');
    }

    if ($query->get('orderby') === 'nomor_hp') {
        $query->set('meta_key', '_nomor_hp');
        $query->set('orderby', 'meta_value');
    }

    if ($query->get('orderby') === 'email') {
        $query->set('meta_key', '_email');
        $query->set('orderby', 'meta_value');
    }

    if ($query->get('orderby') === 'status_pengajuan') {
        $query->set('meta_key', '_status_pengajuan');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'gabungkemitraan_admin_orderby');

function krenchise_handle_kemitraan_form()
{
    if (
        ! isset($_POST['krenchise_form_action']) ||
        $_POST['krenchise_form_action'] !== 'submit_kemitraan'
    ) {
        return;
    }

    if (
        ! isset($_POST['krenchise_kemitraan_nonce']) ||
        ! wp_verify_nonce($_POST['krenchise_kemitraan_nonce'], 'krenchise_submit_kemitraan')
    ) {
        wp_safe_redirect(add_query_arg('form_status', 'invalid', krenchise_get_gabungkemitraan_url()));
        exit;
    }

    $nama = sanitize_text_field($_POST['nama'] ?? '');
    $alamat = sanitize_textarea_field($_POST['alamat'] ?? '');
    $nomor_hp = sanitize_text_field($_POST['nomor_hp'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $jenis_kemitraan = sanitize_text_field($_POST['jenis_kemitraan'] ?? '');

    if ($nama === '' || $alamat === '' || $nomor_hp === '' || $email === '' || $jenis_kemitraan === '') {
        wp_safe_redirect(add_query_arg('form_status', 'empty', krenchise_get_gabungkemitraan_url()));
        exit;
    }

    $post_id = wp_insert_post([
        'post_type' => 'gabungkemitraan',
        'post_status' => 'publish',
        'post_title' => $nama,
        'meta_input' => [
            '_nama' => $nama,
            '_alamat' => $alamat,
            '_nomor_hp' => $nomor_hp,
            '_email' => $email,
            '_jenis_kemitraan' => $jenis_kemitraan,
            '_status_pengajuan' => 'pengajuan',
        ],
    ], true);

    wp_safe_redirect(add_query_arg('form_status', is_wp_error($post_id) ? 'error' : 'success', krenchise_get_gabungkemitraan_url()));
    exit;
}
add_action('init', 'krenchise_handle_kemitraan_form');
