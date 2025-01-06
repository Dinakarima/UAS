<?php
// Menyertakan file konfigurasi untuk koneksi database
include 'config.php';

// Inisialisasi variabel untuk pencarian
$search = '';

// Memeriksa apakah ada parameter 'search' yang dikirim melalui URL
if (isset($_GET['search'])) {
    $search = $_GET['search']; // Menyimpan kata kunci pencarian dari parameter URL
    
    // Menyiapkan query untuk mencari data berdasarkan nama_barang menggunakan LIKE
    $stmt = $conn->prepare("SELECT * FROM inventaris WHERE nama_barang LIKE ?");
    $searchParam = "%" . $search . "%"; // Format wildcard untuk LIKE
    $stmt->bind_param("s", $searchParam); // Menghindari SQL Injection dengan bind_param
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil query
} else {
    // Jika tidak ada pencarian, ambil semua data dari tabel inventaris
    $result = $conn->query("SELECT * FROM inventaris");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Inventaris Perusahaan</title>
    <!-- Menyertakan file CSS eksternal untuk gaya -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Judul Halaman -->
    <h1>Data Inventaris Perusahaan</h1>
    <!-- Tautan ke halaman untuk menambahkan data inventaris -->
    <a href="create.php">Tambah Inventaris</a>
    
    <!-- Formulir Pencarian -->
    <form method="GET" action="">
        <!-- Input untuk kata kunci pencarian -->
        <input type="text-search" id="searchInput" name="search" placeholder="Cari nama barang..." value="<?php echo htmlspecialchars($search); ?>">
        <!-- Tombol untuk mengirim pencarian -->
        <button type="submit">Search</button>
    </form>
    
    <!-- Tabel untuk menampilkan data inventaris -->
    <table border="1">
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <!-- Looping data dari hasil query -->
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <!-- Menampilkan data sesuai kolom dari database -->
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['kategori']; ?></td>
            <td><?php echo $row['jumlah']; ?></td>
            <td>
                <!-- Tautan untuk mengedit data, menggunakan ID sebagai parameter -->
                <a href="update.php?id=<?php echo $row['id']; ?>">
                    <button class="edit">Edit</button>
                </a>
                <!-- Tautan untuk menghapus data, dilengkapi konfirmasi -->
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <button class="delete">Hapus</button>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
