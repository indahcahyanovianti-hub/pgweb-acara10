<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kecamatan</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f7f6; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 { 
            text-align: center; 
            color: #2c3e50; 
            margin-top: 0;
            margin-bottom: 25px;
        }
        label { 
            font-weight: 600; 
            color: #4a5568; 
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] { 
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #cbd5e0; 
            border-radius: 5px; 
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus {
            border-color: #3182ce;
            outline: none;
        }
        input[type="submit"] { 
            width: 100%;
            padding: 12px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer; 
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        input[type="submit"]:hover { 
            background-color: #0056b3; 
        }
        .btn-kembali {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #718096;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-kembali:hover { color: #2d3748; text-decoration: underline; }
    </style>
</head>
<body>
    
    <div class="form-container">
        <h2> Edit Data Kecamatan</h2>

        <?php
        $conn = new mysqli("localhost", "root", "", "tabel_penduduk");
        if ($conn->connect_error) { die("Koneksi gagal: " . $conn->connect_error); }

        $id = $_GET['id'];
        $sql = "SELECT * FROM data_kecamatan WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<form action='edit.php' onsubmit='return validateForm(event)' method='post'>";
            while($row = $result->fetch_assoc()) {
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                
                echo "<label>Kecamatan</label>";
                echo "<input type='text' name='kecamatan' value='" . $row['kecamatan'] . "' required>";
                
                echo "<label>Longitude</label>";
                echo "<input type='text' name='longitude' value='" . $row['longitude'] . "' required>";
                
                echo "<label>Latitude</label>";
                echo "<input type='text' name='latitude' value='" . $row['latitude'] . "' required>";
                
                echo "<label>Luas (km²)</label>";
                echo "<input type='text' id='luas' name='luas' value='" . $row['luas'] . "' required>";
                
                echo "<label>Jumlah Penduduk</label>";
                echo "<input type='text' name='jumlah_penduduk' value='" . $row['jumlah_penduduk'] . "' required>";
                
                echo "<input type='submit' value='Simpan Perubahan'>";
            }
            echo "</form>";
        } else {
            echo "<p style='text-align:center; color:red;'>Data tidak ditemukan.</p>";
        }
        $conn->close();
        ?>

        <a href="../index.php" class="btn-kembali">Batal & Kembali</a>
        <p id="informasi" style="color: #e53e3e; text-align: center; font-size: 13px; margin-top: 10px;"></p>
    </div>

    <script>
    function validateForm(event) {
        let luas = document.getElementById("luas").value;
        if (isNaN(luas) || luas < 1) {
            document.getElementById("informasi").innerHTML = "Luas harus berupa angka & tidak boleh negatif!";
            event.preventDefault();
            return false;
        }
        return true;
    }
    </script>
</body>
</html>