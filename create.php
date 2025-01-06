<?php
include 'config.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = validateInput($_POST['nama_barang']);
    $kategori = validateInput($_POST['kategori']);
    $jumlah = validateInput($_POST['jumlah']);

    $stmt = $conn->prepare("INSERT INTO inventaris (nama_barang, kategori, jumlah) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama_barang, $kategori, $jumlah);
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Inventaris</h1>
    <form method="POST">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required>
        <label>Kategori:</label>
        <input type="text" name="kategori" required>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>
        <button type="submit">Tambah Inventaris</button> <a href="index.php">Kembali</a>
    </form>
    