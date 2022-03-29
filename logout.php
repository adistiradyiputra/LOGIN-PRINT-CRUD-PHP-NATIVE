<?php
session_start();
$_SESSION = [];
// memusnahkan session
session_destroy();
// membuang semua variabel session
session_unset();
setcookie('id', '', -3600);
setcookie('key', '', -3600);
header("Location: login.php");
exit;
