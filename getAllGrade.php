<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Daftar Nilai Mahasiswa</h2>
    <a href="inputGrade.php" class="btn btn-primary mb-3">Add Nilai</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>SKS</th>
                <th>Nilai</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="nilaiMahasiswa">
            <?php
            // Mengambil data dari API
            $api_url = "http://localhost/UTS_PSAIT_493038_AndromedhaC/api.php";
            $data = file_get_contents($api_url);
            $nilai_mahasiswa = json_decode($data, true);

            if (!empty($nilai_mahasiswa) && is_array($nilai_mahasiswa)) {
                foreach ($nilai_mahasiswa as $nilai) {
                    echo "<tr>";
                    echo "<td>" . $nilai['nim'] . "</td>";
                    echo "<td>" . $nilai['nama'] . "</td>";
                    echo "<td>" . $nilai['alamat'] . "</td>";
                    echo "<td>" . $nilai['tanggal_lahir'] . "</td>";
                    echo "<td>" . $nilai['kode_mk'] . "</td>";
                    echo "<td>" . $nilai['nama_mk'] . "</td>";
                    echo "<td>" . $nilai['sks'] . "</td>";
                    echo "<td>" . $nilai['nilai'] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-warning' onclick='editData(\"" . $nilai['nim'] . "\", \"" . $nilai['kode_mk'] . "\", \"" . $nilai['nilai'] . "\")'>Edit</button> ";
                    echo "<button class='btn btn-danger' onclick='deleteData(\"" . $nilai['nim'] . "\", \"" . $nilai['kode_mk'] . "\")'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Data not found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function editData(nim, kode_mk, nilai) {
    // Redirect to updateGrade.php
    window.location.href = "updateGrade.php?nim=" + nim + "&kode_mk=" + kode_mk + "&nilai=" + nilai;
}

function deleteData(nim, kode_mk) {
    if (confirm("Are you sure you want to delete this data?")) {
        // Redirect to deleteGrade.php
        window.location.href = "deleteGrade.php?nim=" + nim + "&kode_mk=" + kode_mk;
    }
}
</script>

</body>
</html>
