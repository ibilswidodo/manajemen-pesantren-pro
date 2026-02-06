<?php
// 1. Mendaftarkan Menu Santri (Custom Post Type)
function pesantren_setup_post_type() {
    $labels = array(
        'name'               => 'Santri',
        'singular_name'      => 'Santri',
        'menu_name'          => 'Santri',
        'add_new'            => 'Tambah Santri',
        'add_new_item'       => 'Tambah Santri Baru',
        'edit_item'          => 'Edit Data Santri',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_menu'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-id-alt', // Ikon kartu ID (lebih stabil)
        'supports'           => array('title', 'thumbnail'), // Menggunakan Judul untuk Nama Santri
        'has_archive'        => true,
    );
    register_post_type('santri', $args);
}
add_action('init', 'pesantren_setup_post_type');

// 2. Membuat Kotak Input (Meta Box) untuk NIS dan Alamat
function pesantren_add_meta_boxes() {
    add_meta_box(
        'detail_santri_box',      // ID kotak
        'Detail Identitas Santri', // Judul kotak
        'pesantren_render_metabox', // Fungsi pemanggil isi
        'santri',                  // Muncul di menu Santri
        'normal',                  // Posisi di tengah
        'high'                     // Prioritas atas
    );
}
add_action('add_meta_boxes', 'pesantren_add_meta_boxes');

// 3. Menampilkan Form Input di dalam Kotak
function pesantren_render_metabox($post) {
    // Ambil data yang sudah tersimpan sebelumnya (jika ada)
    $nis = get_post_meta($post->ID, '_santri_nis', true);
    $alamat = get_post_meta($post->ID, '_santri_alamat', true);

    // Keamanan WordPress
    wp_nonce_field('pesantren_save_data', 'pesantren_meta_nonce');

    echo '<table class="form-table">';
    echo '<tr><th><label for="santri_nis">NIS (Nomor Induk)</label></th>';
    echo '<td><input type="text" id="santri_nis" name="santri_nis" value="'.esc_attr($nis).'" class="regular-text"></td></tr>';
    
    echo '<tr><th><label for="santri_alamat">Alamat Lengkap</label></th>';
    echo '<td><textarea id="santri_alamat" name="santri_alamat" class="regular-text" rows="3">'.esc_textarea($alamat).'</textarea></td></tr>';
    echo '</table>';
}

// 4. Menyimpan Data saat Tombol "Publish/Update" Diklik
function pesantren_save_santri_data($post_id) {
    // Cek keamanan nonce
    if (!isset($_POST['pesantren_meta_nonce']) || !wp_verify_nonce($_POST['pesantren_meta_nonce'], 'pesantren_save_data')) {
        return;
    }

    // Jika sistem sedang auto-save, jangan simpan
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Simpan NIS
    if (isset($_POST['santri_nis'])) {
        update_post_meta($post_id, '_santri_nis', sanitize_text_field($_POST['santri_nis']));
    }

    // Simpan Alamat
    if (isset($_POST['santri_alamat'])) {
        update_post_meta($post_id, '_santri_alamat', sanitize_textarea_field($_POST['santri_alamat']));
    }
}
add_action('save_post', 'pesantren_save_santri_data');
