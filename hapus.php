<?php

if (!isset($_SESSION['login'])) {
    echo "<script>alert('Harus login dulu'); window.location='/lab11_php_oop/auth/login';</script>";
    exit;
}

if (!isset($_GET['id']) || $_GET['id'] == '') {
    echo "<script>alert('ID artikel tidak ditemukan!'); window.location='/lab11_php_oop/artikel/index';</script>";
    exit;
}

$id = intval($_GET['id']); 

$db = new Database();
$hapus = $db->delete("artikel", "id=$id");

if ($hapus) {
    echo "<script>alert('Artikel berhasil dihapus!'); window.location='/lab11_php_oop/artikel/index';</script>";
} else {
    echo "<script>alert('Gagal menghapus artikel.'); window.location='/lab11_php_oop/artikel/index';</script>";
}
?>
