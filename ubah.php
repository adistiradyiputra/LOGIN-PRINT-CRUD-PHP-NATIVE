<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
// ambil data di URL
$id = $_GET["id"];

//query data mobil berdasarkan id
$mbl = query("SELECT * FROM mobil WHERE id = $id")[0];

//cek apakah tombol submit sudah pernah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script> 
                alert('Data Behasil Diubah');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
        <script> 
            alert('Data Gagal Diubah!');
            document.location.href = 'index.php';
        </script>
            ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>

<body>
    <h1>Update Data Mobil</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mbl["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mbl["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required value="<?= $mbl["nama"]; ?>">
            </li>
            <br>
            <li>
                <label for="warna">Warna:</label>
                <input type="text" name="warna" id="warna" value="<?= $mbl["warna"]; ?>">
            </li>
            <br>
            <li>
                <label for="jenis">Jenis:</label>
                <input type="text" name="jenis" id="jenis" value="<?= $mbl["jenis"]; ?>">
            </li>
            <br>
            <li>
                <label for="tahun">Tahun:</label>
                <input type="text" name="tahun" id="tahun" value="<?= $mbl["tahun"]; ?>">
            </li>
            <br>
            <li>
                <label for="merk">Merk:</label>
                <input type="text" name="merk" id="merk" value="<?= $mbl["merk"]; ?>">
            </li>
            <br>
            <li>
                <label for="gambar">Gambar:</label> <br>
                <img src="img/<?= $mbl['gambar']; ?>" width="150"><br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <br>
            <li>
                <button type="submit" name="submit">Update Data</button>
            </li>
        </ul>
    </form>

</body>

</html>