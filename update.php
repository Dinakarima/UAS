<?php
include 'config.php';
include 'functions.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data inventaris berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM inventaris WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Data tidak ditemukan!");
}

// Proses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = validateInput($_POST['nama_barang']);
    $kategori = validateInput($_POST['kategori']);
    $jumlah = validateInput($_POST['jumlah']);

    // Update data inventaris
    $stmt = $conn->prepare("UPDATE inventaris SET nama_barang = ?, kategori = ?, jumlah = ? WHERE id = ?");
    $stmt->bind_param("ssii", $nama_barang, $kategori, $jumlah, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Inventaris</h1>
    <form method="POST">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required>
        <label>Kategori:</label>
        <input type="text" name="kategori" value="<?php echo $row['kategori']; ?>" required>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
        <button type="submit">Update Inventaris</button> <a href="index.php">Kembali</a>
    </form>
</body>
</html>