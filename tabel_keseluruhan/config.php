<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bsimonitoring";
$conn = mysqli_connect($host, $user, $pass, $db);
if(mysqli_connect_error())
{
    echo "Koneksi database gagal";
}

?>