<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $kode_produk = $_POST['product_code'];
    $nama_produk = $_POST['product_name'];
    $deskripsi = $_POST['description'];
    $harga = $_POST['price'];
    $kategori_id = $_POST['category_id'];
    $stok = $_POST['stock'];

    $query = "UPDATE products SET product_code = '$kode_produk', product_name = '$nama_produk', description = '$deskripsi', 
    price = '$harga', category_id = '$kategori_id', stock = '$stok' WHERE id = $id";

    if ($conn->query($query) === TRUE) {
        header('location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>