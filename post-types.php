<?php
// Fungsi untuk membuat Menu Santri
function pesantren_setup_post_type() {
    $args = array(
        'public'    => true,
        'label'     => 'Santri',
        'menu_icon' => 'dashicons-mosque', // Ikon Masjid
        'supports'  => array('title', 'editor', 'thumbnail'), // Judul, Isi, Foto
        'has_archive' => true,
    );
    register_post_type('santri', $args);
}
add_action('init', 'pesantren_setup_post_type');
