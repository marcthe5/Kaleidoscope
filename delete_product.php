<?php
require_once 'components/connector.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_product') {
    $productID = $_POST['productID'];

    // Use prepared statement to prevent SQL injection
    $selectStmt = $db->prepare("SELECT productName, price, productImage, productQuantity FROM products WHERE productID = ?");
    $selectStmt->bind_param("i", $productID);

    // Execute the SELECT statement
    $selectStmt->execute();
    $selectStmt->bind_result($productName, $price, $productImage, $productQuantity);
    $selectStmt->fetch();
    $selectStmt->close();

    // Now, you have the product details. You can proceed with the deletion.
    $deleteStmt = $db->prepare("DELETE FROM products WHERE productID = ?");
    $deleteStmt->bind_param("i", $productID);

    if ($deleteStmt->execute()) {
        // Set the time zone to Asia/Manila
        date_default_timezone_set('Asia/Manila');
        
        // Get the current date and time
        $deletedDate = date('Y-m-d');
        $deletedTime = date('H:i:s');
        
        // Insert the deleted product details into the record table
        $insertRecordStmt = $db->prepare("INSERT INTO records (productID, productName, productPrice, productImage, productQuantity, removed_date, removed_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertRecordStmt->bind_param("isssiss", $productID, $productName, $price, $productImage, $productQuantity, $deletedDate, $deletedTime);
        $insertRecordStmt->execute();
        $insertRecordStmt->close();

        echo "<script> window.onload = function() {
            deleteModal();
         }; </script>";

        // Return a JSON response indicating success
       // echo json_encode(['status' => 'success']);
    } else {
        // Failed to delete
        //echo json_encode(['status' => 'error', 'message' => 'Failed to delete product']);
    }

    // Close the statement
    $deleteStmt->close();
} else {
    // Invalid request
   // echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Successful</title>
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
      <h3>Product deleted successfully!</h3>
    </div>
</div>
</div>

</div>

<script>
    
function deleteModal() {
   // Get the modal
   let modal = document.getElementById("myModal");

   modal.style.display = "block";
  
   let timeout = setTimeout(modal, 900);
   setTimeout(() => { location.replace("admin.php"); }, 900);
}
</script>
</body>
</html>
