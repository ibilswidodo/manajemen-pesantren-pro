<?php
add_action('admin_menu', function() {
    add_menu_page('Pesantren', 'Pesantren', 'manage_options', 'pes_dashboard', 'pes_render_dashboard', 'dashicons-mosque', 6);
    add_submenu_page('pes_dashboard', 'Dashboard', 'Dashboard Statistik', 'manage_options', 'pes_dashboard', 'pes_render_dashboard');
    add_submenu_page('pes_dashboard', 'Pengaturan', 'Pengaturan', 'manage_options', 'pes_settings', 'pes_render_settings');
});

function pes_render_dashboard() {
    $total = wp_count_posts('santri')->publish;
    $lunas = new WP_Query(array('post_type'=>'santri','meta_key'=>'_spp','meta_value'=>'Lunas'));
    $belum = new WP_Query(array('post_type'=>'santri','meta_key'=>'_spp','meta_value'=>'Belum'));
    ?>
    <div class="wrap">
        <h1>Dashboard Pesantren</h1>
        <div class="pes-dashboard">
            <div class="pes-card"><h3>Total Santri</h3><span class="num"><?php echo $total; ?></span></div>
            <div class="pes-card" style="border-top-color: #27ae60;"><h3>Sudah Lunas</h3><span class="num"><?php echo $lunas->found_posts; ?></span></div>
            <div class="pes-card" style="border-top-color: #e74c3c;"><h3>Belum Lunas</h3><span class="num"><?php echo $belum->found_posts; ?></span></div>
        </div>
    </div>
    <?php
}

function pes_render_settings() {
    ?>
    <div class="wrap">
        <h1>Setelan Umum</h1>
        <form method="post" action="options.php">
            <?php settings_fields('pes_opt'); do_settings_sections('pes_opt'); ?>
            <table class="form-table">
                <tr><th>Nama Pesantren</th><td><input type="text" name="pes_nama" value="<?php echo get_option('pes_nama'); ?>" class="regular-text"></td></tr>
                <tr><th>Warna Branding</th><td><input type="color" name="pes_warna" value="<?php echo get_option('pes_warna', '#0073aa'); ?>"></td></tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', function() {
    register_setting('pes_opt', 'pes_nama');
    register_setting('pes_opt', 'pes_warna');
});
