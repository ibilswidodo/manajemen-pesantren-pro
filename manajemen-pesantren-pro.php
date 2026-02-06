<?php
/*
Plugin Name: Manajemen Pondok Pesantren Pro
Description: Sistem terpadu manajemen santri, keuangan SPP, dan portal cek santri.
Version: 1.0
Author: Kolaborasi Gemini & Anda
*/

if (!defined('ABSPATH')) exit;

define('PESANTREN_PATH', plugin_dir_path(__FILE__));

require_once PESANTREN_PATH . 'post-types.php';
require_once PESANTREN_PATH . 'admin-settings.php';
require_once PESANTREN_PATH . 'frontend-display.php';

// Tambahkan CSS khusus untuk tampilan tabel agar lebih cantik
add_action('wp_head', function() {
    echo '<style>
        .pesantren-container { margin: 20px 0; font-family: sans-serif; }
        .pesantren-table { width: 100%; border-collapse: collapse; }
        .pesantren-table th, .pesantren-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .status-lunas { color: white; background: #27ae60; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        .status-belum { color: white; background: #e74c3c; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        .search-box { margin-bottom: 20px; padding: 15px; background: #f4f4f4; border-radius: 8px; }
        .search-box input { padding: 8px; width: 200px; border: 1px solid #ccc; border-radius: 4px; }
        .search-box button { padding: 8px 15px; background: #0073aa; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>';
});
