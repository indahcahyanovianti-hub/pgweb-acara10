<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Stasiun</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .form-container { background: white; padding: 30px 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #2c3e50; margin-top: 0; margin-bottom: 25px; }
        label { font-weight: 600; font-size: 14px; display: block; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box; }
        input[type="submit"] { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .btn-kembali { display: block; text-align: center; margin-top: 15px; text-decoration: none; font-size: 14px; color: #718096; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>✏️ Edit Data Stasiun</h2>
        <?php
        $conn = new mysqli("localhost", "root", "", "geoportal_bogor");
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM stasiun_bogor WHERE id = $id");

        if ($result->num_rows > 0) {
            echo "<form action='edit.php' method='post'>";
            while($row = $result->fetch_assoc()) {
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<label>Nama Stasiun</label><input type='text' name='nama_stasiun' value='" . $row['nama_stasiun'] . "' required>";
                echo "<label>Jenis</label><input type='text' name='jenis' value='" . $row['jenis'] . "' required>";
                echo "<label>Status</label><input type='text' name='status' value='" . $row['status'] . "' required>";
                echo "<label>Latitude</label><input type='text' name='latitude' value='" . $row['latitude'] . "' required>";
                echo "<label>Longitude</label><input type='text' name='longitude' value='" . $row['longitude'] . "' required>";
                echo "<input type='submit' value='Simpan Perubahan'>";
            }
            echo "</form>";
        }
        $conn->close();
        ?>
        <a href="../index.php" class="btn-kembali">Batal & Kembali</a>
    </div>
</body>
</html>