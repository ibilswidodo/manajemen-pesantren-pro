<?php
add_action('init', function() {
    register_post_type('santri', array(
        'labels' => array(
            'name' => 'Data Santri',
            'singular_name' => 'Santri',
            'add_new' => 'Tambahkan Santri Baru',
            'all_items' => 'Seluruh Data Santri'
        ),
        'public' => true,
        'show_in_menu' => 'pes_dashboard', // Masuk ke menu utama PesantrenHub
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title'),
    ));
});

add_action('add_meta_boxes', function() {
    add_meta_box('phub_meta', 'Informasi Detail Santri', 'phub_render_meta', 'santri', 'normal', 'high');
});

function phub_render_meta($post) {
    $nis   = get_post_meta($post->ID, '_nis', true);
    $wali  = get_post_meta($post->ID, '_wali', true);
    $kelas = get_post_meta($post->ID, '_kelas', true);
    $spp   = get_post_meta($post->ID, '_spp', true);
    wp_nonce_field('phub_save', 'phub_nonce');
    ?>
    <table class="form-table">
        <tr><th>NIS</th><td><input type="text" name="nis" value="<?php echo $nis; ?>" class="regular-text"></td></tr>
        <tr><th>Nama Wali</th><td><input type="text" name="wali" value="<?php echo $wali; ?>" class="regular-text"></td></tr>
        <tr><th>Kelas/Komplek</th><td><input type="text" name="kelas" value="<?php echo $kelas; ?>" class="regular-text"></td></tr>
        <tr><th>Status SPP</th><td>
            <select name="spp">
                <option value="Lunas" <?php selected($spp, 'Lunas'); ?>>Lunas</option>
                <option value="Belum" <?php selected($spp, 'Belum'); ?>>Belum Lunas</option>
            </select>
        </td></tr>
    </table>
    <?php
}

add_action('save_post', function($post_id) {
    if (!isset($_POST['phub_nonce']) || !wp_verify_nonce($_POST['phub_nonce'], 'phub_save')) return;
    update_post_meta($post_id, '_nis', sanitize_text_field($_POST['nis']));
    update_post_meta($post_id, '_wali', sanitize_text_field($_POST['wali']));
    update_post_meta($post_id, '_kelas', sanitize_text_field($_POST['kelas']));
    update_post_meta($post_id, '_spp', sanitize_text_field($_POST['spp']));
});
