<?php
// contoh: menggunakan class Database
$db = new Database();

// ambil semua artikel (asumsi tabel 'artikel' ada)
$rows = $db->getAll('artikel');

// tampil
echo "<h3>Data Artikel</h3>";

// TAMBAHKAN TOMBOL INI ⬇⬇⬇
echo "<a href='/lab11_php_oop/artikel/tambah' 
        style='display:inline-block;margin:10px 0;padding:6px 12px;background:#3b82f6;color:#fff;text-decoration:none;border-radius:4px;'> 
        + Tambah Artikel
      </a>";

if (!$rows) {
    echo "<p>Belum ada data artikel.</p>";
} else {
    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<tr><th>#</th><th>Judul</th><th>Penulis</th><th>Tanggal</th><th>Aksi</th></tr>";
    $i = 1;
    foreach ($rows as $r) {
        echo "<tr>";
        echo "<td>{$i}</td>";
        echo "<td>" . htmlspecialchars($r['judul'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($r['penulis'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($r['tanggal'] ?? '') . "</td>";
        echo "<td>
                <a href='/lab11_php_oop/artikel/ubah?id=" . urlencode($r['id'] ?? '') . "'>Ubah</a> |
                <a href='/lab11_php_oop/artikel/hapus?id=" . urlencode($r['id'] ?? '') . "' onclick=\"return confirm('Hapus?')\">Hapus</a>
              </td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
}
?>
