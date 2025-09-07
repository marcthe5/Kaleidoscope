<?php
session_start();
include('components/connector.php');
include('user_authentication.php');

// Ensure the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    // Redirect back to cart page with an error message
    header('Location: cart.php?error=emptycart');
    exit();
}

// Retrieve user information from the session
$userID = $_SESSION['userID'];
$firstname = $_SESSION['firstname'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];

date_default_timezone_set('Asia/Manila');
$placed_on = date('Y-m-d H:i:s');
$order_status = 'Pending'; // Set the default order status to 'pending'

// Collect address and payment method from the form
$address = $_POST['address'];
$paymentMethodId = $_POST['payment'];

// Get payment method name based on the ID
switch ($paymentMethodId) {
    case '1':
        $paymentMethod = 'Cash on Delivery';
        break;
    case '2':
        $paymentMethod = 'BDO';
        break;
    case '3':
        $paymentMethod = 'Metrobank';
        break;
    default:
        $paymentMethod = 'Unknown';
        // Handle the case where the payment method is unknown
}

// Process each product in the cart
foreach ($_SESSION['cart'] as $productID => $quantity) {
    $result = mysqli_query($db, "SELECT * FROM products WHERE productID = $productID");

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $productName = $row['productName'];
            $price = $row['price'];
            $total = $price * $quantity;
            $productImage = $row['productImage']; 

            // Save purchase history to the database, including user information, address, and payment method
            $query = "INSERT INTO purchase_history (user_id, firstname, email, username, address, productImage, products, quantity, total_price, payment_method, placed_on, order_status) VALUES ($userID, '$firstname', '$email', '$username', '$address','$productImage', '$productName', $quantity, $total, '$paymentMethod', '$placed_on', '$order_status')";

            if (mysqli_query($db, $query)) {
                // Successfully inserted into purchase_history

                // Decrement the product quantity in the products table
                $updateQuantityQuery = "UPDATE products SET productQuantity = productQuantity - $quantity WHERE productID = $productID";

                if (!mysqli_query($db, $updateQuantityQuery)) {
                    // Handle query execution error
                    echo "Error updating product quantity: " . mysqli_error($db);
                }
            } else {
                // Handle query execution error
                echo "Error inserting into purchase_history: " . mysqli_error($db);
            }
        }
    }
}

// Clear the cart
$_SESSION['cart'] = [];

// Close the database connection
mysqli_close($db);

// Show the checkout success modal and then redirect
echo "<script> window.onload = function() {
    checkoutModal();
 }; </script>";
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

<!-- Checkout Successful Modal -->
<div class="modal fade" id="checkoutSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thank You for Your Purchase!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your order has been successfully placed. Thank you for shopping with us!</p>
            </div>
        </div>
    </div>
</div>

<!-- THE MODAL (SUCCESS) -->
<div id="myModal" class="modal" tabindex="-2" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
 <div class="modal-dialog">

<!-- Modal content -->
<div class="modal-content" style="width: 100%;">
   <div class="modal-header text-center" >
      <h4 class="modal-title text-center" id="exampleModalLongTitle">Thank You for Your Purchase!</h4>

    </div>
    <div class="modal-body text-success text-center">
      <h3>Your order has been successfully placed. Thank you for shopping with us!</h3>
    </div>
</div>
</div>

</div>

<script>
    function checkoutModal() {
        let modal = document.getElementById("myModal");
        modal.style.display = "block";
        setTimeout(() => { location.replace("cart.php"); }, 1500);
    }
</script>
</body>
</html>
