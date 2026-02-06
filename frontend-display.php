<?php
add_shortcode('cek_santri', function() {
    $warna = get_option('pes_warna', '#0073aa');
    $nama_pondok = get_option('pes_nama', 'Pesantren Kami');
    $search_query = isset($_GET['nis_search']) ? sanitize_text_field($_GET['nis_search']) : '';

    $html = '<div class="pesantren-container">';
    $html .= '<h2 style="color:'.$warna.'">Portal Informasi Santri '.$nama_pondok.'</h2>';

    // Form Pencarian
    $html .= '<div class="search-box">
        <form method="GET">
            <input type="text" name="nis_search" placeholder="Masukkan NIS..." value="'.$search_query.'">
            <button type="submit">Cari Santri</button>
            <a href="'.strtok($_SERVER["REQUEST_URI"], '?').'" style="font-size:12px; margin-left:10px;">Reset</a>
        </form>
    </div>';

    // Query Data
    $args = array('post_type' => 'santri', 'posts_per_page' => -1);
    if (!empty($search_query)) {
        $args['meta_query'] = array(array('key' => '_santri_nis', 'value' => $search_query, 'compare' => '='));
    }

    $query = new WP_Query($args);
    
    $html .= '<table class="pesantren-table">
        <thead><tr style="background:'.$warna.'; color:#fff;">
            <th>Nama Santri</th><th>NIS</th><th>Alamat</th><th>Status SPP</th>
        </tr></thead><tbody>';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $nis = get_post_meta(get_the_ID(), '_santri_nis', true);
            $alamat = get_post_meta(get_the_ID(), '_santri_alamat', true);
            $spp = get_post_meta(get_the_ID(), '_santri_spp', true);
            $class = ($spp == 'Lunas') ? 'status-lunas' : 'status-belum';

            $html .= '<tr>
                <td>'.get_the_title().'</td>
                <td>'.$nis.'</td>
                <td>'.$alamat.'</td>
                <td><span class="'.$class.'">'.$spp.'</span></td>
            </tr>';
        }
        wp_reset_postdata();
    } else {
        $html .= '<tr><td colspan="4">Data tidak ditemukan.</td></tr>';
    }

    $html .= '</tbody></table></div>';
    return $html;
});
