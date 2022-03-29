<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
//cek apakah tombol submit sudah pernah ditekan atau belum
if (isset($_POST["submit"])) {
    // die; fungsi untuk menghentikan di baris baru
    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script> 
                alert('Data Behasil Ditambah');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
        <script> 
            alert('Data Gagal Ditambah');
            document.location.href = 'index.php';
        </script>
            ";
    }


    //-----------------------------------------------------------------------
    // var_dump(mysqli_affected_rows($conn)); jika 1 benar dan Jika -1 salah
    // if (mysqli_affected_rows($conn) > 0) {
    //     echo "berhasil";
    // } else {
    //     echo "gagal!";
    //     echo "<br>";
    //     echo mysqli_error($conn);
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Tambah Data Mobil</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required autocomplete="off">
            </li>
            <br>
            <li>
                <label for="warna">Warna:</label>
                <input type="text" name="warna" id="warna">
            </li>
            <br>
            <li>
                <label for="jenis">Jenis:</label>
                <input type="text" name="jenis" id="jenis">
            </li>
            <br>
            <li>
                <label for="tahun">Tahun:</label>
                <input type="text" name="tahun" id="tahun">
            </li>
            <br>
            <li>
                <label for="merk">Merk:</label>
                <input type="text" name="merk" id="merk">
            </li>
            <br>
            <li>
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <br>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>

</body>

</html>