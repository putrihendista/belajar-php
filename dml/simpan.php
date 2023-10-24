<?php
include 'koneksi.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['product_code']) && isset($_POST['product_name']) && 
isset($_POST['kategori']) && isset($_POST['price']) && isset($_POST['stock']) 
&& isset($_POST['deskripsi'])) {
    $kode_produk = $_POST['product_code'];
    $nama_produk = $_POST['product_name'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['price'];
    $stok = $_POST['stock'];


    $query = "INSERT INTO products (product_code, product_name, category_id, description, price, stock) 
    VALUES ('$kode_produk', '$nama_produk', '$kategori', '$deskripsi', '$harga', '$stok')";

   if ($conn->query($query) === TRUE) {
        header('location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

?>