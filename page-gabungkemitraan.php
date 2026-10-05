<?php get_header(); ?>

<?php
$layanan_query = new WP_Query([
    'post_type' => 'layanan',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

$form_status = isset($_GET['form_status']) ? sanitize_text_field($_GET['form_status']) : '';
?>

<section class="bg-gradient-to-b from-red-50 via-white to-white py-10 md:py-14 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,0.9fr)_520px] gap-8 md:gap-12 items-start">
            <div>
                <p class="text-primary text-xs md:text-sm font-semibold uppercase mb-3">
                    Gabung Kemitraan
                </p>
                <h1 class="text-3xl md:text-5xl leading-tight font-bold text-textPrimary mb-4">
                    Mulai langkah pertama menjadi mitra bersama kami
                </h1>
                <p class="text-base md:text-lg text-textSecondary leading-relaxed mb-8">
                    Isi form berikut untuk membantu tim kami memahami kebutuhan Anda. Kami akan meninjau pengajuan dan menghubungi Anda untuk tahap selanjutnya.
                </p>

                <div class="prose prose-neutral max-w-none text-textSecondary mb-8">
                    <?php
                    while (have_posts()) :
                        the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <h2 class="text-lg font-semibold text-textPrimary mb-2">Proses Cepat</h2>
                        <p class="text-sm text-textSecondary leading-relaxed">Data pengajuan akan tersimpan ke dashboard agar tim kami bisa menindaklanjuti lebih cepat.</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <h2 class="text-lg font-semibold text-textPrimary mb-2">Pilihan Kemitraan Lengkap</h2>
                        <p class="text-sm text-textSecondary leading-relaxed">Pilih jenis kemitraan yang paling sesuai dengan kebutuhan dan budget Anda.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-[28px] p-6 md:p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-textPrimary mb-2">
                    Form Calon Mitra
                </h2>
                <p class="text-sm md:text-base text-textSecondary leading-relaxed mb-6">
                    Lengkapi data di bawah ini agar tim kami bisa memproses pengajuan Anda.
                </p>

                <?php if ($form_status === 'success') : ?>
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        Form berhasil dikirim dan data Anda sudah masuk ke sistem kami.
                    </div>
                <?php elseif (in_array($form_status, ['empty', 'invalid', 'error'], true)) : ?>
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <?php
                        if ($form_status === 'error') {
                            echo 'Terjadi kendala saat mengirim form. Silakan coba lagi.';
                        } else {
                            echo 'Mohon lengkapi semua field yang wajib diisi.';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo esc_url(krenchise_get_gabungkemitraan_url()); ?>" method="post" class="space-y-5">
                    <input type="hidden" name="krenchise_form_action" value="submit_kemitraan">
                    <?php wp_nonce_field('krenchise_submit_kemitraan', 'krenchise_kemitraan_nonce'); ?>

                    <div>
                        <label for="nama" class="block text-sm font-semibold text-textPrimary mb-2">Nama</label>
                        <input id="nama" name="nama" type="text" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-textPrimary focus:border-primary focus:outline-none" placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-textPrimary mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="4" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-textPrimary focus:border-primary focus:outline-none" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div>
                        <label for="nomor_hp" class="block text-sm font-semibold text-textPrimary mb-2">Nomor HP / WA</label>
                        <input id="nomor_hp" name="nomor_hp" type="text" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-textPrimary focus:border-primary focus:outline-none" placeholder="Masukkan nomor HP atau WhatsApp">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-textPrimary mb-2">Alamat Email</label>
                        <input id="email" name="email" type="email" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-textPrimary focus:border-primary focus:outline-none" placeholder="Masukkan alamat email aktif">
                    </div>

                    <div>
                        <label for="jenis_kemitraan" class="block text-sm font-semibold text-textPrimary mb-2">Jenis Kemitraan</label>
                        <select id="jenis_kemitraan" name="jenis_kemitraan" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-textPrimary focus:border-primary focus:outline-none">
                            <option value="">Pilih jenis kemitraan</option>
                            <?php
                            if ($layanan_query->have_posts()) {
                                while ($layanan_query->have_posts()) {
                                    $layanan_query->the_post();
                                    echo '<option value="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</option>';
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity duration-200">
                        Kirim Pengajuan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
