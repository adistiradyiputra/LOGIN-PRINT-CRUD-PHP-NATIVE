<?php
usleep(500000);
// usleep(500000); 
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM mobil 
            WHERE
        nama LIKE '%$keyword%' OR
        warna LIKE '%$keyword%' OR
        jenis LIKE '%$keyword%' OR
        tahun LIKE '%$keyword%' OR
        merk LIKE '%$keyword%' ";

$mobil = query($query);
?>
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