<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Nilai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Update Nilai Mahasiswa</h2>
    <form id="updateForm">
        <div class="form-group">
            <label for="nim">NIM:</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo isset($_GET['nim']) ? $_GET['nim'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="kode_mk">Kode MK:</label>
            <input type="text" class="form-control" id="kode_mk" name="kode_mk" value="<?php echo isset($_GET['kode_mk']) ? $_GET['kode_mk'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="nilai">Nilai:</label>
            <input type="text" class="form-control" id="nilai" name="nilai" value="<?php echo isset($_GET['nilai']) ? $_GET['nilai'] : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="getAllGrade.php" class="btn btn-secondary mt-3">Kembali ke Daftar Nilai</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#updateForm").submit(function(e) {
        e.preventDefault();
        var nim = $("#nim").val();

        var kode_mk = $("#kode_mk").val();
        var nilai = $("#nilai").val();

        $.ajax({
            type: "PUT",
            url: "http://localhost/UTS_PSAIT_493038_AndromedhaC/api.php",
            contentType: "application/json",
            data: JSON.stringify({ nim: nim, kode_mk: kode_mk, nilai: nilai }),
            success: function(data) {
                alert("Data updated successfully");
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });
});
</script>

</body>
</html>
