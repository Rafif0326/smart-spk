<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "smart_spk";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}