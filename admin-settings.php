<?php
add_action('admin_menu', function() {
    // Menu Utama
    add_menu_page('PesantrenHub', 'PesantrenHub', 'manage_options', 'pes_dashboard', 'phub_dashboard', 'dashicons-mosque', 2);
    
    // Sub Menu
    add_submenu_page('pes_dashboard', 'Dashboard', 'Dashboard', 'manage_options', 'pes_dashboard', 'phub_dashboard');
    add_submenu_page('pes_dashboard', 'Pendaftaran', 'Form Pendaftaran', 'manage_options', 'phub_reg_builder', 'phub_reg_builder_page');
    add_submenu_page('pes_dashboard', 'Pengaturan', 'Pengaturan Web', 'manage_options', 'phub_settings', 'phub_settings_page');
});

function phub_dashboard() {
    $total = wp_count_posts('santri')->publish;
    ?>
    <div class="wrap">
        <h1>Dashboard PesantrenHub</h1>
        <div class="phub-dash">
            <div class="phub-card"><h3>Total Santri</h3><span class="val"><?php echo $total; ?></span></div>
            <div class="phub-card" style="border-color:#3498db"><h3>Santri Baru (Pending)</h3><span class="val">0</span></div>
        </div>
    </div>
    <?php
}

function phub_reg_builder_page() {
    ?>
    <div class="wrap">
        <h1>Form Builder Pendaftaran</h1>
        <form method="post" action="options.php">
            <?php settings_fields('phub_reg_opt'); do_settings_sections('phub_reg_opt'); ?>
            <p>Pilih kolom yang ingin diaktifkan di form pendaftaran online:</p>
            <table class="form-table">
                <?php 
                $fields = array(
                    'reg_show_nis'   => 'Nomor Induk (NIS)',
                    'reg_show_wali'  => 'Nama Wali',
                    'reg_show_kelas' => 'Pilihan Kelas',
                    'reg_show_file'  => 'Upload Kartu Keluarga (PDF/JPG)',
                );
                foreach($fields as $key => $label) : ?>
                <tr>
                    <th><?php echo $label; ?></th>
                    <td><input type="checkbox" name="<?php echo $key; ?>" value="1" <?php checked(1, get_option($key), true); ?>> Aktifkan</td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php submit_button('Simpan Konfigurasi Form'); ?>
        </form>
    </div>
    <?php
}

function phub_settings_page() {
    ?>
    <div class="wrap">
        <h1>Pengaturan Umum</h1>
        <form method="post" action="options.php">
            <?php settings_fields('phub_gen_opt'); do_settings_sections('phub_gen_opt'); ?>
            <table class="form-table">
                <tr><th>Nama Pondok</th><td><input type="text" name="phub_nama" value="<?php echo get_option('phub_nama'); ?>" class="regular-text"></td></tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', function() {
    register_setting('phub_reg_opt', 'reg_show_nis');
    register_setting('phub_reg_opt', 'reg_show_wali');
    register_setting('phub_reg_opt', 'reg_show_kelas');
    register_setting('phub_reg_opt', 'reg_show_file');
    register_setting('phub_gen_opt', 'phub_nama');
});
