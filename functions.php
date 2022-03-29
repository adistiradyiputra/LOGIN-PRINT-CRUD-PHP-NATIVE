<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    //ambil data dari setiap elemet dalam form
    $nama = htmlspecialchars($data["nama"]);
    $warna = htmlspecialchars($data["warna"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $merk = htmlspecialchars($data["merk"]);

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO mobil 
        VALUES
    ('','$nama','$warna','$jenis','$tahun','$merk','$gambar') 
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah  tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
              alert('Pilih Gambar Terlebih Dahulu');
             </script>";
        return false;
    }

    // cek apakah yang di upload gambar atau bukan
    $ektensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ektensiGambar = explode('.', $namaFile);
    $ektensiGambar = strtolower(end($ektensiGambar));
    if (!in_array($ektensiGambar, $ektensiGambarValid)) {
        echo "<script>
              alert('Yang anda upload bukan gambar');
             </script>";
        return false;
    }

    // cek gambar jika ukurannya terlalu besar
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ektensiGambar;

    if ($ukuranFile > 1000000) {
        echo "<script>
              alert('Ukuran Gambar Terlalu Besar');
             </script>";
        return false;
    }

    // lolos pengecekan gambar diupload
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mobil where id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{

    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $warna = htmlspecialchars($data["warna"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $merk = htmlspecialchars($data["merk"]);
    $gambarLama = htmlspecialchars($data['gambarLama']);
    // cek apakah user memilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    //query update data atau menimpa data lama dengan inputan baru
    $query = " UPDATE mobil SET
              nama = '$nama',
              warna = '$warna',
              jenis = '$jenis',
              tahun = '$tahun',
              merk = '$merk',
              gambar = '$gambar'   
        WHERE id = $id
              ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mobil 
                    WHERE
              nama LIKE '%$keyword%' OR
              warna LIKE '%$keyword%' OR
              jenis LIKE '%$keyword%' OR
              tahun LIKE '%$keyword%' OR
              merk LIKE '%$keyword%'
              ";
    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    // mysqli_real_escape_string berfungsi untuk mencegah SQL injection secara sederhana
    // dan berfungsi jika anda memasukan password terdapat huruf besar kecil dan memasukan tanda petik,backslah dll
    // tetapi mysqli_real_escape_string jika dipakai ke aplikasi yang berskala besar akan memperlambat database
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE 
    username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
             alert('username yang anda masukan sudah ada!');
            </script>
             ";
        return false;
    }
    //cek konfirmasi password
    if ($password !== $password2) {
        echo "
        <script>
                alert('Konfirmasi Password tidak sesuai');
             </script> 
         ";
        return false;
    }
    //enkripsi password
    // PASSWORD_HASH berfungsi mengacak string jadi hash
    $password = password_hash($password, PASSWORD_DEFAULT);
    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
}
