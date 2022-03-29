<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';
$mobil = query("SELECT * FROM mobil ");

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Mobil</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Daftar Mobil</h1>
    <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Warna</th>
                <th>Jenis</th>
                <th>Tahun</th>
                <th>Merk</th>
            </tr>';

$i = 1;
foreach ($mobil as $row) {
    $html .= '<tr>
                   <td>' . $i++ . '</td>
                   <td><img src="img/' . $row["gambar"] . '" width="50"></td>
                   <td>' . $row["nama"] . '</td>
                   <td>' . $row["warna"] . '</td>
                   <td>' . $row["jenis"] . '</td>
                   <td>' . $row["tahun"] . '</td>
                   <td>' . $row["merk"] . '</td>
               </tr>';
}

$html .=  '</table>            
</body>
</html>  ';
$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mobil.pdf', 'I');
