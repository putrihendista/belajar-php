<?php
include ('../dml/koneksi.php');

// Ambil data dari formulir
$nama = $_POST['name'];
$email = $_POST['email'];
$no_hp = $_POST['phone_number'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password untuk keamanan

// Buat username dari nomor telepon
$username = $no_hp;

// Query untuk memasukkan data pengguna ke dalam tabel users
$sql = "INSERT INTO users (username, name, email, phone_number, password, group_id) 
VALUES ('$username', '$nama', '$email', '$no_hp', '$password', 3)";

if ($conn->query($sql) === TRUE) {
    echo "Register Sukses";
    header('location: ../PHPForm/login.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>