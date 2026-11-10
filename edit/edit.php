<?php
$id = $_POST['id'];
$nama_stasiun = $_POST['nama_stasiun'];
$jenis = $_POST['jenis'];
$status = $_POST['status'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$conn = new mysqli("localhost", "root", "", "geoportal_bogor");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$sql = "UPDATE stasiun_bogor 
        SET nama_stasiun='$nama_stasiun', jenis='$jenis', status='$status', latitude='$latitude', longitude='$longitude' 
        WHERE id=$id";

$conn->query($sql);
$conn->close();

header("Location: ../index.php");
exit;
?>