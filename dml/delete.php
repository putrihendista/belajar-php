<?php
// include 'koneksi.php';

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $query = "DELETE FROM products WHERE id = $id";
//     if ($conn->query($query) === TRUE) {
//         header("Location: index.php");
//         exit();
//     } else {
//         echo "Error: " . $conn->error;
//     }
// }

// $conn->close();

// delete_product.php
include 'koneksi.php';
include 'product_deleter.php';

$productDeleter = new ProductDeleter($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $result = $productDeleter->deleteProduct($id);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Gagal menghapus produk";
    }

    $conn->close();
}
?>