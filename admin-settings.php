<?php
add_action('admin_menu', function() {
    add_submenu_page('edit.php?post_type=santri', 'Setelan', 'Setelan', 'manage_options', 'pes_settings', 'pes_render_settings');
});

function pes_render_settings() {
    ?>
    <div class="wrap">
        <h1>Setelan Pesantren</h1>
        <form method="post" action="options.php">
            <?php settings_fields('pes_opt'); do_settings_sections('pes_opt'); ?>
            <table class="form-table">
                <tr><th>Nama Pondok</th><td><input type="text" name="pes_nama" value="<?php echo esc_attr(get_option('pes_nama')); ?>" class="regular-text"></td></tr>
                <tr><th>Warna Tema</th><td><input type="color" name="pes_warna" value="<?php echo esc_attr(get_option('pes_warna', '#0073aa')); ?>"></td></tr>
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
