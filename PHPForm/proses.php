<?php

// Simpan email dan password yang valid dalam variabel
$valid_email = "putrihendista1247@gmail.com";
$valid_password = "01234567";

// Ambil data dari formulir
$email = $_POST['email'];
$password = $_POST['pass'];

// Lakukan validasi login
if ($email == $valid_email && $password == $valid_password) {
    // Login berhasil
    header('Location: ../tugas14/dashboard.php');
} else {
    // Login gagal
    header ('location: login.php');
}
?> 
