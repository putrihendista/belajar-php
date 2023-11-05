<?php
// product_update.php
class ProductUpdater {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateProduct($id, $productCode, $productName, $categoryId, $description, $price, $stock, $imagePaths) {
        $query = "UPDATE products SET product_code = ?, image = ?, product_name = ?, category_id = ?, description = ?, price = ?, stock = ?  WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssisiii", $productCode, $imagePaths, $productName, $categoryId, $description, $price, $stock, $id);

        if ($stmt->execute()) {
            return true; // Pembaruan berhasil
        } else {
            return false; // Pembaruan gagal
        }
    }
}
?>