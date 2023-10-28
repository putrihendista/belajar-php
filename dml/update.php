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

    // Periksa apakah file gambar telah diunggah
if (!empty($_FILES['image']['name'][0])) {
    $imagePaths = [];
    $targetDir = "../Files/"; // Direktori tempat menyimpan gambar
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

    foreach ($_FILES['image']['name'] as $key => $imageName) {
        $tempImageName = $_FILES['image']['name'][$key];
        $tempImageTmp = $_FILES['image']['tmp_name'][$key];
        $imageFileType = strtolower(pathinfo($tempImageName, PATHINFO_EXTENSION));
        $targetFile = $targetDir . $kode_produk . '_' . uniqid() . '.' . $imageFileType;

        if (in_array($imageFileType, $allowedExtensions)) {
            if (move_uploaded_file($tempImageTmp, $targetFile)) {
                $imagePaths[] = $targetFile;
            }
        }
    }
    $imagePaths = json_encode($imagePaths);
} else {
    // Gambar tidak diunggah, gunakan gambar yang sudah ada
    $existingImages = $_POST['existing_images'];
    $imagePaths = json_encode($existingImages);
}

$query = "UPDATE products SET product_code = '$kode_produk', product_name = '$nama_produk',
    category_id = '$kategori', price = '$harga', stock = '$stok', description = '$deskripsi',
    image = '$imagePaths' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
        
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
?>