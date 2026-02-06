<?php
// Membuat shortcode [cek_santri]
add_shortcode('cek_santri', function() {
    $nama = get_option('nama_pesantren', 'Pesantren Kami');
    return "<h3>Selamat Datang di Portal Santri $nama</h3><p>Data santri akan muncul di sini.</p>";
});
