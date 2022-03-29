<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
$mobil = query("SELECT * FROM mobil ");
// jika tombol cari ditekan maka akan menimpa variable $mobil
if (isset($_POST["cari"])) {
    $mobil = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 118px;
            left: 300px;
            z-index: -1;
            display: none;
        }
    </style>
    <script src="js/jquery.js"></script>
    <script src="js/page.js"></script>
</head>

<body>
    <a href="logout.php">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a>
    <h1>Sorum Mobil</h1>
    <a href="tambah.php">Add</a>
    <br><br>
    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="masukan keyword pencarian" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
        <img src="img/loader.gif" class="loader">
    </form>
    <br>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Warna</th>
                <th>Jenis</th>
                <th>Tahun</th>
                <th>Merk</th>

            </tr>
            <?php $i = 1; ?>
            <?php foreach ($mobil as $row) : ?>
                <tr>
                    <td><?= $i;  ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="
                    return confirm('YAKIN INGIN DIHAPUS?');">Hapus</a>
                    </td>
                    <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["warna"]; ?></td>
                    <td><?= $row["jenis"]; ?></td>
                    <td><?= $row["tahun"]; ?></td>
                    <td><?= $row["merk"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>