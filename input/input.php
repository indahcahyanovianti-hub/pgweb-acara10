<?php
// Cek apakah data dikirim melalui metode POST dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $kecamatan = isset($_POST['kecamatan']) ? $_POST['kecamatan'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
    $luas = isset($_POST['luas']) ? $_POST['luas'] : '';
    $jumlah_penduduk = isset($_POST['jumlah_penduduk']) ? $_POST['jumlah_penduduk'] : '';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tabel_penduduk";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO data_kecamatan (kecamatan, longitude, latitude, luas, jumlah_penduduk)
    VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$jumlah_penduduk')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Pesan jika file input.php dibuka langsung tanpa lewat form
    echo "Akses ditolak! Silakan isi data melalui form terlebih dahulu.";
}
?>