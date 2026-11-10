<?php
$nama_stasiun = $_POST['nama_stasiun'];
$jenis = $_POST['jenis'];
$status = $_POST['status'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$conn = new mysqli("localhost", "root", "", "geoportal_bogor");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$sql = "INSERT INTO stasiun_bogor (nama_stasiun, jenis, status, latitude, longitude) 
        VALUES ('$nama_stasiun', '$jenis', '$status', '$latitude', '$longitude')";

$conn->query($sql);
$conn->close();

header("Location: ../index.php");
exit;
?>