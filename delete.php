<?php
// Tangkap ID dari URL
$id = $_GET['id'];

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tabel_penduduk");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Perintah hapus data HANYA yang ID-nya cocok
$sql = "DELETE FROM data_kecamatan WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Kalau sukses, balik ke halaman utama
    header("Location: index.php");
    exit;
} else {
    echo "Error menghapus data: " . $conn->error;
}

$conn->close();
?>