<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Data Kecamatan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { font-weight: bold; }
        input[type="text"] { margin-bottom: 10px; padding: 5px; width: 300px; display: block; }
        input[type="submit"] { padding: 8px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h2>Form Input Data Kecamatan Baru</h2>
    
    <!-- Akan mengirim data ke file input.php yang ada di folder yang sama -->
    <form action="input.php" onsubmit="return validateForm(event)" method="post">
        <label for="kecamatan">Kecamatan:</label>
        <input type="text" id="kecamatan" name="kecamatan" required>

        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" required>

        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" required>

        <label for="luas">Luas (km²):</label>
        <input type="text" id="luas" name="luas" required>

        <label for="jumlah_penduduk">Jumlah Penduduk:</label>
        <input type="text" id="jumlah_penduduk" name="jumlah_penduduk" required>

        <input type="submit" value="Simpan Data">
    </form>

    <p id="informasi" style="color: red;"></p>

    <script>
    function validateForm(event) {
        let luas = document.getElementById("luas").value;
        if (isNaN(luas) || luas < 1) {
            document.getElementById("informasi").innerHTML = "Data luas harus angka dan tidak boleh bernilai negatif!";
            event.preventDefault(); // Mencegah form terkirim
            return false;
        }
        return true;
    }
    </script>
</body>
</html>