<?php
$db = new Database();
$form = new Form("", "Simpan Data");

if ($_POST) {
    $data = [
        'judul' => $_POST['judul'] ?? '',
        'penulis' => $_POST['penulis'] ?? '',
        'tanggal' => $_POST['tanggal'] ?? date('Y-m-d'),
        'isi' => $_POST['isi'] ?? ''
    ];

    $insertId = $db->insert('artikel', $data);
    if ($insertId) {
        echo "<div style='color:green'>Data berhasil disimpan. ID: {$insertId}</div>";
    } else {
        echo "<div style='color:red'>Gagal menyimpan data.</div>";
    }
}

// tampilkan form manual sederhana
?>
<h3>Tambah Artikel</h3>
<form method="post">
    <label>Judul</label><br>
    <input type="text" name="judul"><br><br>

    <label>Penulis</label><br>
    <input type="text" name="penulis"><br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>"><br><br>

    <label>Isi</label><br>
    <textarea name="isi" cols="50" rows="6"></textarea><br><br>

    <input type="submit" value="Simpan">
</form>
