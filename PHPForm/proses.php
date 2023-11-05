<?php

// Simpan email dan password yang valid dalam variabel
// $valid_email = "putrihendista1247@gmail.com";
// $valid_password = "01234567";

// Ambil data dari formulir
// $email = $_POST['email'];
// $password = $_POST['pass'];

// Lakukan validasi login
// if ($email == $valid_email && $password == $valid_password) {
//     // Login berhasil
//     header('Location: ../tugas14/dashboard.php');
// } else {
    // Login gagal
//     header ('location: login.php');
// }

// session_start(); // Mulai sesi

// include('../dml/koneksi.php');
// // Ambil data dari form
// $email = $_POST['email'];
// $password = $_POST['pass'];

// // Query untuk mencocokkan email dan password dengan data di database
// $sql = "SELECT * FROM users WHERE email = '$email'";
// $result = $conn->query($sql);

// if ($result->num_rows == 1) {
//     $row = $result->fetch_assoc();
//     if (password_verify($password, $row['password'])) {
//         // Login berhasil, simpan informasi pengguna dalam sesi
//         $_SESSION['username'] = $row['username'];
//         header('Location: ../tugas14/dashboard.php'); // Redirect ke halaman dashboard
//         exit();
//     }
// }

// $_SESSION['login_error'] = 'Email atau password salah'; // Pesan kesalahan
// header('Location: ../PHPForm/login.php'); // Redirect kembali ke halaman login jika login gagal
// exit();

// $conn->close();
// 

// user_repository.php
class UserRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticate($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }

        return null;
    }
}

// authentication.php
class Authentication {
    public function login($user) {
        session_start();
        $_SESSION['username'] = $user['username'];
    }

    public function logout() {
        session_start();
        session_destroy();
    }
}

// login.php
include('../dml/koneksi.php');
include('user_repository.php');
include('authentication.php');

$userRepository = new UserRepository($conn);
$auth = new Authentication();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    
    $user = $userRepository->authenticate($email, $password);

    if ($user) {
        $auth->login($user);
        header('Location: ../tugas14/dashboard.php');
    } else {
        $_SESSION['login_error'] = 'Email atau password salah';
        header('Location: login.php');
    }
}

$conn->close();
?>