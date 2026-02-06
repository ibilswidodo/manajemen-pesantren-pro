<?php
add_action('init', function() {
    register_post_type('santri', array(
        'labels' => array('name' => 'Santri', 'singular_name' => 'Santri', 'add_new' => 'Tambah Santri'),
        'public' => true,
        'menu_icon' => 'dashicons-id-alt',
        'supports' => array('title'),
    ));
});

add_action('add_meta_boxes', function() {
    add_meta_box('detail_santri', 'Data Lengkap Santri', 'pesantren_render_metabox', 'santri', 'normal', 'high');
});

function pesantren_render_metabox($post) {
    $nis = get_post_meta($post->ID, '_santri_nis', true);
    $alamat = get_post_meta($post->ID, '_santri_alamat', true);
    $status_spp = get_post_meta($post->ID, '_santri_spp', true);
    wp_nonce_field('pesantren_save', 'pesantren_nonce');
    ?>
    <table class="form-table">
        <tr>
            <th>NIS</th>
            <td><input type="text" name="santri_nis" value="<?php echo esc_attr($nis); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><textarea name="santri_alamat" class="regular-text"><?php echo esc_textarea($alamat); ?></textarea></td>
        </tr>
        <tr>
            <th>Status SPP</th>
            <td>
                <select name="santri_spp">
                    <option value="Belum Lunas" <?php selected($status_spp, 'Belum Lunas'); ?>>Belum Lunas</option>
                    <option value="Lunas" <?php selected($status_spp, 'Lunas'); ?>>Lunas</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post', function($post_id) {
    if (!isset($_POST['pesantren_nonce']) || !wp_verify_nonce($_POST['pesantren_nonce'], 'pesantren_save')) return;
    update_post_meta($post_id, '_santri_nis', sanitize_text_field($_POST['santri_nis']));
    update_post_meta($post_id, '_santri_alamat', sanitize_textarea_field($_POST['santri_alamat']));
    update_post_meta($post_id, '_santri_spp', sanitize_text_field($_POST['santri_spp']));
});
