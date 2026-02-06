<?php
/*
Plugin Name: Manajemen Pondok Pesantren Pro
Description: Sistem manajemen santri, keuangan, dan pengaturan tampilan pesantren.
Version: 1.0
Author: Alifbata Digital
*/

// Keamanan: Jika file ini dipanggil langsung di luar WordPress, hentikan!
if (!defined('ABSPATH')) exit;

// Mendefinisikan lokasi folder plugin
define('PESANTREN_PATH', plugin_dir_path(__FILE__));

// Memanggil file-file pendukung lainnya
require_once PESANTREN_PATH . 'post-types.php';
require_once PESANTREN_PATH . 'admin-settings.php';
require_once PESANTREN_PATH . 'frontend-display.php';
