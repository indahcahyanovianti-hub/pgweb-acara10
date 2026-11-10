<?php
$id = $_POST['id'];
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tabel_penduduk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk memperbarui data
$sql = "UPDATE data_kecamatan SET 
        kecamatan='$kecamatan', 
        longitude=$longitude, 
        latitude=$latitude, 
        luas=$luas, 
        jumlah_penduduk=$jumlah_penduduk 
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record edited successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
// Mengarahkan kembali ke halaman utama (naik 1 level folder karena saat ini ada di folder edit)
header("Location: ../index.php");
exit;
?>