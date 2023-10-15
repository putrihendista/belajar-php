<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['product_name'];
    $deskripsi = $_POST['description'];
    $harga = $_POST['price'];
    $kategori_id = $_POST['category_id'];
    $stok = $_POST['stock'];


    $query = "INSERT INTO products (product_name, description, price, category_id, stock) 
    VALUES ('$nama_produk', '$deskripsi', '$harga', '$kategori_id', '$stok')";

   if ($conn->query($query) === TRUE) {
        header('location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

?>