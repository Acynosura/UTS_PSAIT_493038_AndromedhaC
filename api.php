<?php
include 'koneksi.php';

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        // Menampilkan semua nilai mahasiswa
        if (!empty($_GET["nim"])) {
            $nim = $_GET["nim"];
            get_nilai_mahasiswa($nim);
        } else {
            get_semua_nilai();
        }
        break;
    case 'POST':
        // Memasukkan nilai baru untuk mahasiswa tertentu
        insert_nilai();
        break;
    case 'PUT':
        // Mengupdate nilai mahasiswa tertentu
        update_nilai();
        break;
    case 'DELETE':
        // Menghapus nilai mahasiswa tertentu
        $nim = $_GET["nim"];
        $kode_mk = $_GET["kode_mk"];
        delete_nilai($nim, $kode_mk);
        break;
    default:
        // Metode HTTP tidak didukung
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_semua_nilai() {
    global $conn;
    $sql = "SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai
            FROM mahasiswa
            INNER JOIN perkuliahan ON mahasiswa.nim = perkuliahan.nim
            INNER JOIN matakuliah ON perkuliahan.kode_mk = matakuliah.kode_mk";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $response = array();
        while($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        echo json_encode(array("message" => "Data not found"));
    }
    $conn->close();
}

function get_nilai_mahasiswa($nim) {
    global $conn;
    $sql = "SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai
            FROM mahasiswa
            INNER JOIN perkuliahan ON mahasiswa.nim = perkuliahan.nim
            INNER JOIN matakuliah ON perkuliahan.kode_mk = matakuliah.kode_mk
            WHERE mahasiswa.nim = '$nim'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $response = array();
        while($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        echo json_encode(array("message" => "Data not found"));
    }
    $conn->close();
}

function insert_nilai() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    $nim = $data['nim'];
    $kode_mk = $data['kode_mk'];
    $nilai = $data['nilai'];

    $sql = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', $nilai)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Data inserted successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}

function update_nilai() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    $nim = $data['nim'];
    $kode_mk = $data['kode_mk'];
    $nilai = $data['nilai'];

    $sql = "UPDATE perkuliahan SET nilai = $nilai WHERE nim = '$nim' AND kode_mk = '$kode_mk'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Data updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating record: " . $conn->error));
    }

    $conn->close();
}

function delete_nilai($nim, $kode_mk) {
    global $conn;
    $sql = "DELETE FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Data deleted successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error deleting record: " . $conn->error));
    }

    $conn->close();
}
?>
