<?php
add_shortcode('cek_santri', function() {
    $warna = get_option('pes_warna', '#0073aa');
    $search = isset($_GET['nis']) ? sanitize_text_field($_GET['nis']) : '';
    
    $html = '<div class="pesantren-container">';
    $html .= '<form method="GET" style="margin-bottom:20px;">
                <input type="text" name="nis" placeholder="Cek berdasarkan NIS..." value="'.$search.'" style="padding:10px; width:250px; border:1px solid #ddd; border-radius:5px;">
                <button type="submit" style="padding:10px 20px; background:'.$warna.'; color:#fff; border:none; border-radius:5px; cursor:pointer;">Cari Data</button>
              </form>';

    $args = array('post_type' => 'santri', 'posts_per_page' => -1);
    if($search) {
        $args['meta_query'] = array(array('key' => '_nis', 'value' => $search, 'compare' => '='));
    }

    $query = new WP_Query($args);
    $html .= '<table class="pes-table"><thead><tr><th>Nama</th><th>NIS</th><th>JK</th><th>Alamat</th><th>SPP</th></tr></thead><tbody>';

    if($query->have_posts()) {
        while($query->have_posts()) {
            $query->the_post();
            $nis = get_post_meta(get_the_ID(), '_nis', true);
            $jk = get_post_meta(get_the_ID(), '_jk', true);
            $spp = get_post_meta(get_the_ID(), '_spp', true);
            $pill = ($spp == 'Lunas') ? 'lunas' : 'belum';

            $html .= '<tr>
                <td><strong>'.get_the_title().'</strong></td>
                <td>'.$nis.'</td>
                <td>'.$jk.'</td>
                <td>'.get_post_meta(get_the_ID(), '_alamat', true).'</td>
                <td><span class="status-pill '.$pill.'">'.$spp.'</span></td>
            </tr>';
        }
        wp_reset_postdata();
    } else {
        $html .= '<tr><td colspan="5">Data tidak ditemukan atau belum diinput.</td></tr>';
    }

    $html .= '</tbody></table></div>';
    return $html;
});
