<?php
// Mencegah akses langsung
if (!defined('ABSPATH')) exit;

// Membuat shortcode [cek_santri]
add_shortcode('cek_santri', function() {
    // Ambil warna utama dari pengaturan (default biru jika belum diatur)
    $warna_tema = get_option('pes_warna', '#0073aa');
    $nama_pondok = get_option('nama_pesantren', 'Pesantren Kami');

    // Ambil data semua santri
    $query = new WP_Query(array(
        'post_type'      => 'santri',
        'posts_per_page' => -1, // Tampilkan semua
        'orderby'        => 'title',
        'order'          => 'ASC'
    ));

    // Mulai membangun tampilan HTML
    $html = '<div class="wrapper-santri" style="font-family: Arial, sans-serif;">';
    $html .= '<h2 style="color:' . $warna_tema . '; border-bottom: 2px solid ' . $warna_tema . '; padding-bottom: 10px;">Daftar Santri ' . esc_html($nama_pondok) . '</h2>';
    
    if ($query->have_posts()) {
        $html .= '<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">';
        $html .= '<tr style="background-color:' . $warna_tema . '; color: white;">';
        $html .= '<th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Nama Santri</th>';
        $html .= '<th style="padding: 10px; border: 1px solid #ddd; text-align: left;">NIS</th>';
        $html .= '<th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Alamat</th>';
        $html .= '</tr>';

        while ($query->have_posts()) {
            $query->the_post();
            $id_santri = get_the_ID();
            $nis = get_post_meta($id_santri, '_santri_nis', true);
            $alamat = get_post_meta($id_santri, '_santri_alamat', true);

            $html .= '<tr>';
            $html .= '<td style="padding: 10px; border: 1px solid #ddd;">' . get_the_title() . '</td>';
            $html .= '<td style="padding: 10px; border: 1px solid #ddd;">' . esc_html($nis) . '</td>';
            $html .= '<td style="padding: 10px; border: 1px solid #ddd;">' . esc_html($alamat) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        wp_reset_postdata();
    } else {
        $html .= '<p style="padding: 20px; background: #f9f9f9;">Belum ada data santri yang terdaftar.</p>';
    }

    $html .= '</div>';

    return $html;
});
