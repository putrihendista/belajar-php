<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $kode_produk = $_POST['product_code'];
    $nama_produk = $_POST['product_name'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['description'];
    $harga = $_POST['price'];
    $stok = $_POST['stock'];

    $query = "UPDATE products SET product_code = '$kode_produk', product_name = '$nama_produk', description = '$deskripsi', 
    price = '$harga', category_id = '$kategori', stock = '$stok' WHERE id = $id";

    // if ($conn->query($query) === TRUE) {
    //     header('location: index.php');
    // } else {
    //     echo "Error: " . $conn->error;
    // }

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
        
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
?>