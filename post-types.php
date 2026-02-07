<?php
add_action('init', function() {
    register_post_type('santri', array(
        'labels' => array(
            'name' => 'Data Santri',
            'singular_name' => 'Santri',
            'add_new' => 'Tambahkan Data Santri',
            'add_new_item' => 'Input Santri Baru',
            'edit_item' => 'Edit Data Santri',
            'all_items' => 'Semua Santri'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-businesswoman',
        'supports' => array('title'), // Title digunakan untuk Nama Lengkap
    ));
});

add_action('add_meta_boxes', function() {
    add_meta_box('pes_detail', 'Profil & Identitas Santri', 'pes_render_meta', 'santri', 'normal', 'high');
});

function pes_render_meta($post) {
    $nis = get_post_meta($post->ID, '_nis', true);
    $jk = get_post_meta($post->ID, '_jk', true);
    $alamat = get_post_meta($post->ID, '_alamat', true);
    $spp = get_post_meta($post->ID, '_spp', true);
    wp_nonce_field('pes_save_nonce', 'pes_nonce');
    ?>
    <table class="form-table">
        <tr><th>NIS</th><td><input type="text" name="nis" value="<?php echo $nis; ?>" class="regular-text"></td></tr>
        <tr><th>Jenis Kelamin</th><td>
            <select name="jk">
                <option value="L" <?php selected($jk, 'L'); ?>>Laki-laki</option>
                <option value="P" <?php selected($jk, 'P'); ?>>Perempuan</option>
            </select>
        </td></tr>
        <tr><th>Alamat Domisili</th><td><textarea name="alamat" class="regular-text"><?php echo $alamat; ?></textarea></td></tr>
        <tr><th>Status Keuangan (Bulan Ini)</th><td>
            <select name="spp">
                <option value="Lunas" <?php selected($spp, 'Lunas'); ?>>Lunas</option>
                <option value="Belum" <?php selected($spp, 'Belum'); ?>>Belum Lunas</option>
            </select>
        </td></tr>
    </table>
    <?php
}

add_action('save_post', function($post_id) {
    if (!isset($_POST['pes_nonce']) || !wp_verify_nonce($_POST['pes_nonce'], 'pes_save_nonce')) return;
    update_post_meta($post_id, '_nis', sanitize_text_field($_POST['nis']));
    update_post_meta($post_id, '_jk', sanitize_text_field($_POST['jk']));
    update_post_meta($post_id, '_alamat', sanitize_textarea_field($_POST['alamat']));
    update_post_meta($post_id, '_spp', sanitize_text_field($_POST['spp']));
});
