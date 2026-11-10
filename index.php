<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS - Stasiun Bogor</title>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://ppete2.github.io/Leaflet.PolylineMeasure/Leaflet.PolylineMeasure.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 20px; background-color: #f9fbfd; color: #333; }
        h2 { text-align: center; margin-bottom: 20px; color: #2c3e50; }
        #map { height: 450px; width: 100%; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; z-index: 1;}
        .btn-tambah { display: inline-block; padding: 10px 15px; margin-bottom: 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn-tambah:hover { background-color: #218838; }
        table { border-collapse: collapse; width: 100%; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { background-color: #2c3e50; color: white; text-align: center; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .aksi a { text-decoration: none; font-weight: bold; padding: 5px 10px; border-radius: 4px; }
        .edit { color: #007bff; background: #e6f2ff; }
        .hapus { color: #dc3545; background: #fce4e4; }
    </style>
</head>
<body>
    <h2>Web GIS Sebaran Stasiun Kereta Api Bogor</h2>
    <div id="map"></div>
    <a href="input/index.php" class="btn-tambah">+ Input Data Baru</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Stasiun</th>
            <th>Jenis</th>
            <th>Status</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Aksi</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "geoportal_bogor");
        if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

        $result =$conn->query("SELECT * FROM stasiun_bogor");
        $data_peta = [];

        if ($result->num_rows > 0) {$no = 1;
            while($row =$result->fetch_assoc()) {
                $data_peta[] =$row;
                echo "<tr>
                        <td style='text-align: center;'>" . $no++ . "</td>
                        <td>{$row['nama_stasiun']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['latitude']}</td>
                        <td>{$row['longitude']}</td>
                        <td class='aksi' style='text-align: center;'>
                            <a href='#' class='edit' onclick='konfirmasiAksi(event, \"edit/index.php?id={$row['id']}\", \"Mau ngedit data stasiun ini?\")'>Edit</a> | 
                            <a href='#' class='hapus' onclick='konfirmasiAksi(event, \"delete.php?id={$row['id']}\", \"Yakin mau hapus stasiun permanen?\")'>Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7' style='text-align: center;'>Tidak ada data</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://ppete2.github.io/Leaflet.PolylineMeasure/Leaflet.PolylineMeasure.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function konfirmasiAksi(event, url, pesan) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi', text: pesan, icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut!', cancelButtonText: 'Batal'
            }).then((result) => { if (result.isConfirmed) window.location.href = url; });
        }

        // Center peta disesuaikan ke wilayah sebaran 6 stasiun Bogor
        var map = L.map('map').setView([-6.45, 106.91], 11);
        var basemap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', { maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] }).addTo(map);

        var dataLokasi = <?php echo json_encode($data_peta); ?>;
        var markerGroup = L.layerGroup().addTo(map);

        dataLokasi.forEach(function(lokasi) {
            var lat = parseFloat(lokasi.latitude);
            var lng = parseFloat(lokasi.longitude);
            if(!isNaN(lat) && !isNaN(lng)) {
                L.marker([lat, lng])
                 .bindPopup("<b>" + lokasi.nama_stasiun + "</b><br>Jenis: " + lokasi.jenis + "<br>Status: " + lokasi.status)
                 .addTo(markerGroup);
            }
        });

        L.control.scale({position: 'bottomleft', metric: true}).addTo(map);
        if (typeof L.control.polylineMeasure === 'function') {
            L.control.polylineMeasure({position:'topleft', unit:'kilometres'}).addTo(map);
        }
    </script>
</body>
</html>