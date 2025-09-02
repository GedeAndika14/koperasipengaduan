<?php
$host = "localhost";
$user = "root";     // ganti jika username MySQL berbeda
$pass = "";         // ganti jika ada password
$db   = "koperasi";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
