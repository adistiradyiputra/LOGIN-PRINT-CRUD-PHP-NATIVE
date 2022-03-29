<?php
session_start();
require 'functions.php';
// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE 
    username = '$username'");

    // cek username 
    // dan mysqli_num_rows berfungsi untuk menghintung ada berapa baris
    // yang dikembalikan oleh select * from user kalau ada username di dalam table nilai nya 1
    // kalo ga ketemu username didalam table yaitu nilainya 0    
    if (mysqli_num_rows($result) === 1) {
        //  cek password
        // password_verify fungsinya untuk mengecek sama atau tidak string dengan hasnya
        // jika sama bernilai true jika tidak false
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            // cek remember me
            if (isset($_POST["remember"])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php ");
            exit; // fungsi di samping untuk memberhentikan script di bawahnya
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>

<body>
    <h2>Halaman Login</h2>
    <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic;">
            Username / Password tidak ada
        </p>
    <?php endif; ?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <br>

            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <br>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Rembember me</label>
            </li>
            <br>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>

</html>