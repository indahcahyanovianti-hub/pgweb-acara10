<?php
$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "geoportal_bogor");

if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$sql = "DELETE FROM stasiun_bogor WHERE id = $id";
$conn->query($sql);
$conn->close();

header("Location: index.php");
exit;
?>