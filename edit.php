<?php
// edit.php
include 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM inventaris WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $kondisi = $_POST['kondisi'];
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];

    $stmt = $pdo->prepare("UPDATE inventaris SET kode_barang = ?, nama = ?, jumlah = ?, kondisi = ?, lokasi = ?, keterangan = ? WHERE id = ?");
    $stmt->execute([$kode_barang, $nama, $jumlah, $kondisi, $lokasi, $keterangan, $id]);

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
        <input type="text" name="kode_barang" placeholder="Kode Barang" value="<?php echo htmlspecialchars($item['kode_barang']); ?>" required>
        <input type="text" name="nama" placeholder="Nama Barang" value="<?php echo htmlspecialchars($item['nama']); ?>" required>
        <input type="number" name="jumlah" placeholder="Jumlah" value="<?php echo htmlspecialchars($item['jumlah']); ?>" required>
        <input type="text" name="kondisi" placeholder="Kondisi" value="<?php echo htmlspecialchars($item['kondisi']); ?>" required>
        <input type="text" name="lokasi" placeholder="Lokasi" value="<?php echo htmlspecialchars($item['lokasi']); ?>" required>
        <textarea name="keterangan" placeholder="Keterangan" required><?php echo htmlspecialchars($item['keterangan']); ?></textarea>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>