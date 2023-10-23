<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_produk = $_POST['product_code'];
    $nama_produk = $_POST['product_name'];
    $deskripsi = $_POST['description'];
    $harga = $_POST['price'];
    $kategori_id = $_POST['category_id'];
    $stok = $_POST['stock'];


    $query = "INSERT INTO products (product_code, product_name, description, price, category_id, stock) 
    VALUES ('$kode_produk', '$nama_produk', '$deskripsi', '$harga', '$kategori_id', '$stok')";

   if ($conn->query($query) === TRUE) {
        header('location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

?>