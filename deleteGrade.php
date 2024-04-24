<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Nilai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Delete Nilai Mahasiswa</h2>
    <form id="deleteForm">
        <div class="form-group">
            <label for="nim">NIM:</label>
            <input type="text" class="form-control" id="nim" name="nim">
        </div>
        <div class="form-group">
            <label for="kode_mk">Kode MK:</label>
            <input type="text" class="form-control" id="kode_mk" name="kode_mk">
        </div>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="getAllGrade.php" class="btn btn-secondary mt-3">Kembali ke Daftar Nilai</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#deleteForm").submit(function(e) {
        e.preventDefault();
        var nim = $("#nim").val();
        var kode_mk = $("#kode_mk").val();

        $.ajax({
            type: "DELETE",
            url: "http://localhost/UTS_PSAIT_493038_AndromedhaC/api.php?nim=" + nim + "&kode_mk=" + kode_mk,
            success: function(data) {
                alert("Data deleted successfully");
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
