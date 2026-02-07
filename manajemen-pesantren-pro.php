<?php
/*
Plugin Name: Manajemen Pondok Pesantren Pro (Full Version)
Description: Sistem Manajemen Terpadu: Statistik, Data Santri, & Keuangan.
Version: 1.0
Author: Alifbata Digital
*/

if (!defined('ABSPATH')) exit;

define('PESANTREN_PATH', plugin_dir_path(__FILE__));

require_once PESANTREN_PATH . 'post-types.php';
require_once PESANTREN_PATH . 'admin-settings.php';
require_once PESANTREN_PATH . 'frontend-display.php';

// CSS Dashboard Admin & Frontend
add_action('admin_head', 'pesantren_styles');
add_action('wp_head', 'pesantren_styles');

function pesantren_styles() {
    echo '<style>
        .pes-dashboard { display: flex; gap: 20px; margin-top: 20px; }
        .pes-card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex: 1; text-align: center; border-top: 4px solid #0073aa; }
        .pes-card h3 { margin: 0; font-size: 14px; color: #666; }
        .pes-card .num { font-size: 28px; font-weight: bold; color: #222; margin-top: 10px; display: block; }
        .status-pill { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; color: #fff; }
        .lunas { background: #27ae60; }
        .belum { background: #e74c3c; }
        .pes-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; }
        .pes-table th { background: #f8f9fa; padding: 15px; border-bottom: 2px solid #eee; text-align: left; }
        .pes-table td { padding: 15px; border-bottom: 1px solid #eee; }
    </style>';
}
