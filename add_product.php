<?php
include_once "components/connector.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {

        $name2 = $_POST['productName'];
        $name2 = filter_var($name2, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $productQuantity = $_POST['productQuantity'];
        $productQuantity = filter_var($productQuantity, FILTER_SANITIZE_STRING);
        
        // Generate a random alphanumeric code
        $randomCode = mt_rand(100000, 999999); // Generates a random 6-digit integer
        
        // File Upload
        $image = $_FILES['productImage']['name'];
        $image_folder = '../uploaded_img/' . $randomCode . '_' . $image;

        if (move_uploaded_file($_FILES['productImage']['tmp_name'], $image_folder)) {
            // File uploaded successfully
            $insert_product = $db->prepare("INSERT INTO `products` (productID   , productName, price, productImage, productQuantity) VALUES (?, ?, ?, ?, ?)");
            $insert_product->execute([$randomCode, $name2, $price, $image_folder, $productQuantity]);
            header("Location: admin.php");
            exit; // Make sure to exit after the header to prevent further execution
        } else {
            $message[] = 'Failed to move the uploaded file to the destination directory.';
        }
    }
}
?>
