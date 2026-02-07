<?php
/*
Plugin Name: PesantrenHub Pro
Description: Sistem Terintegrasi Manajemen Santri, Dashboard Statistik, & Form Pendaftaran Dinamis.
Version: 2.0
Author: Alifbata Digital
*/

if (!defined('ABSPATH')) exit;

define('PHUB_PATH', plugin_dir_path(__FILE__));

require_once PHUB_PATH . 'post-types.php';
require_once PHUB_PATH . 'admin-settings.php';
require_once PHUB_PATH . 'frontend-display.php';

// CSS UI Modern
add_action('admin_head', function() {
    echo '<style>
        .phub-dash { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 0; }
        .phub-card { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-bottom: 4px solid #2ecc71; }
        .phub-card h3 { font-size: 14px; color: #7f8c8d; margin: 0; text-transform: uppercase; }
        .phub-card .val { font-size: 32px; font-weight: 800; display: block; margin-top: 10px; color: #2c3e50; }
        .status-badge { padding: 5px 12px; border-radius: 50px; font-size: 11px; font-weight: bold; }
        .lunas { background: #e8f5e9; color: #2e7d32; }
        .belum { background: #ffebee; color: #c62828; }
    </style>';
});
