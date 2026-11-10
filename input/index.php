<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Input Stasiun</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .form-container { background: white; padding: 30px 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #2c3e50; margin-top: 0; margin-bottom: 25px; }
        label { font-weight: 600; font-size: 14px; display: block; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box; }
        input[type="submit"] { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .btn-kembali { display: block; text-align: center; margin-top: 15px; text-decoration: none; font-size: 14px; color: #718096; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Form Input Stasiun</h2>
        <form action="input.php" method="post">
            <label>Nama Stasiun</label>
            <input type="text" name="nama_stasiun" required>
            
            <label>Jenis</label>
            <input type="text" name="jenis" required>
            
            <label>Status</label>
            <input type="text" name="status" required>
            
            <label>Latitude</label>
            <input type="text" name="latitude" required>
            
            <label>Longitude</label>
            <input type="text" name="longitude" required>
            
            <input type="submit" value="Submit">
        </form>
        <a href="../index.php" class="btn-kembali">Batal & Kembali</a>
    </div>
</body>
</html>