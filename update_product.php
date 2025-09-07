<?php
include_once "components/connector.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "update_product") {
    // Retrieve form data
    $productID = $_POST["productID"];
    $updateProductName = $_POST["updateProductName"];
    $updateProductPrice = $_POST["updateProductPrice"];
    $updateProductQuantity = $_POST["updateProductQuantity"];

  // File Upload
        $image = $_FILES['updateProductImage']['name'];
        $image_folder = '../uploaded_img/' . $image;

        if (move_uploaded_file($_FILES['updateProductImage']['tmp_name'], $image_folder)) {
            // Update the database with the new image path
            $updateImageQuery = "UPDATE products SET productImage = '$image_folder' WHERE productID = $productID";
            mysqli_query($db, $updateImageQuery);
        } else {
            //echo "Error moving uploaded file";
        }
    }

    // Update the product information in the database
    $updateQuery = "UPDATE products SET 
                    productName = '$updateProductName', 
                    price = $updateProductPrice, 
                    productQuantity = $updateProductQuantity 
                    WHERE productID = $productID";

    if (mysqli_query($db, $updateQuery)) {
        echo "<script> window.onload = function() {
            updateModal();
         }; </script>";
    } else {
        echo "Error updating product: " . mysqli_error($db);
    }


// Close the database connection
mysqli_close($db);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Successful</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and Popper.js scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- THE MODAL (SUCCESS) -->
<div id="myModal" class="modal" tabindex="-2" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
 <div class="modal-dialog">

<!-- Modal content -->
<div class="modal-content" style="width: 100%;">
   <div class="modal-header text-center" >
      <h4 class="modal-title text-center" id="exampleModalLongTitle">Kaleidoscope</h4>

    </div>
    <div class="modal-body text-success text-center">
      <h3>Product succesfully update!</h3>
    </div>
</div>
</div>

</div>

<script>
    
    function updateModal() {
    let modal = document.getElementById("myModal");
    modal.style.display = "block";
    let timeout = setTimeout(modal, 900);
    setTimeout(() => {  location.replace("admin.php"); }, 900);
}

    </script>
</body>
</html>