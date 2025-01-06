<?php
$host = 'localhost';
$db = 'inventaris_db';
$user = 'root';
$pass = '';


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>