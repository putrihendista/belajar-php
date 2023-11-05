<?php
// include ('../dml/koneksi.php');

// // Ambil data dari formulir
// $nama = $_POST['name'];
// $email = $_POST['email'];
// $no_hp = $_POST['phone_number'];
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password untuk keamanan

// // Buat username dari nomor telepon
// $username = $no_hp;

// // Query untuk memasukkan data pengguna ke dalam tabel users
// $sql = "INSERT INTO users (username, name, email, phone_number, password, group_id) 
// VALUES ('$username', '$nama', '$email', '$no_hp', '$password', 3)";

// if ($conn->query($sql) === TRUE) {
//     echo "Register Sukses";
//     header('location: ../PHPForm/login.php');
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();

// user_registration.php
class UserRegistration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($name, $email, $phone, $password) {
        // Buat username dari nomor telepon
        $username = $phone;
        
        // Hash password untuk keamanan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk memasukkan data pengguna ke dalam tabel users
        $sql = "INSERT INTO users (username, name, email, phone_number, password, group_id) 
                VALUES (?, ?, ?, ?, ?, 3)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $name, $email, $phone, $hashedPassword);

        if ($stmt->execute()) {
            return true; // Pendaftaran berhasil
        } else {
            return false; // Pendaftaran gagal
        }
    }
}

// register.php
include ('../dml/koneksi.php');
include ('user_registration.php');

$registration = new UserRegistration($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $password = $_POST['password'];
    
    $result = $registration->registerUser($name, $email, $phone, $password);

    if ($result) {
        echo "Register Sukses";
        header('location: ../PHPForm/login.php');
    } else {
        echo "Error: Gagal melakukan pendaftaran";
    }
}

$conn->close();
?>