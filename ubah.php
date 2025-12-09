<?php
$db = new Database();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "<p>Parameter ID tidak valid.</p>";
    return;
}

$existing = $db->get('artikel', "id={$id}");
if (!$existing) {
    echo "<p>Data tidak ditemukan.</p>";
    return;
}

if ($_POST) {
    $data = [
        'judul' => $_POST['judul'] ?? '',
        'penulis' => $_POST['penulis'] ?? '',
        'tanggal' => $_POST['tanggal'] ?? date('Y-m-d'),
        'isi' => $_POST['isi'] ?? ''
    ];
    $ok = $db->update('artikel', $data, "id={$id}");
    if ($ok) {
        echo "<div style='color:green'>Data berhasil diupdate.</div>";
        // ambil ulang data
        $existing = $db->get('artikel', "id={$id}");
    } else {
        echo "<div style='color:red'>Gagal update data.</div>";
    }
}

// tampilkan form dengan data awal
?>
<h3>Ubah Artikel</h3>
<form method="post">
    <label>Judul</label><br>
    <input type="text" name="judul" value="<?= htmlspecialchars($existing['judul'] ?? '') ?>"><br><br>

    <label>Penulis</label><br>
    <input type="text" name="penulis" value="<?= htmlspecialchars($existing['penulis'] ?? '') ?>"><br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="<?= htmlspecialchars($existing['tanggal'] ?? date('Y-m-d')) ?>"><br><br>

    <label>Isi</label><br>
    <textarea name="isi" cols="50" rows="6"><?= htmlspecialchars($existing['isi'] ?? '') ?></textarea><br><br>

    <input type="submit" value="Update">
</form>
