<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Praktikum 11 - PHP OOP LANJUTAN</title>

    <link rel="stylesheet" href="/lab11_php_oop/template/style.css">
</head>

<body>

<div class="layout">
    
    <?php include __DIR__ . "/sidebar.php"; ?>

    <main class="content">
