<?php
// Menambahkan Sub-Menu Pengaturan di bawah Menu Santri
add_action('admin_menu', function() {
    add_submenu_page(
        'edit.php?post_type=santri', // Induknya adalah menu Santri
        'Pengaturan Pesantren',
        'Pengaturan',
        'manage_options',
        'pesantren-settings',
        'pesantren_render_settings'
    );
});

// Tampilan Halaman Pengaturan
function pesantren_render_settings() {
    ?>
    <div class="wrap">
        <h1>Pengaturan Tampilan Pesantren</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('pesantren_options_group');
            do_settings_sections('pesantren_options_group');
            ?>
            <table class="form-table">
                <tr>
                    <th>Nama Pondok Pesantren</th>
                    <td><input type="text" name="nama_pesantren" value="<?php echo esc_attr(get_option('nama_pesantren')); ?>" class="regular-text"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Mendaftarkan opsi ke database WordPress
add_action('admin_init', function() {
    register_setting('pesantren_options_group', 'nama_pesantren');
});
