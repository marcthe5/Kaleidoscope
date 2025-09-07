<link rel="icon" href="NEWLOGO.png" type="image/png">

<?php
session_start();
require_once 'components/connector.php'; // Include database connection
include('user_authentication.php');

// Check for updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'update':
                updateCart();
                break;
            case 'remove':
                removeProduct();
                break;
        }
    }
}

function updateCart() {
    if (isset($_POST['productID'], $_POST['quantity'])) {
        $productID = $_POST['productID'];
        $quantity = (int)$_POST['quantity'];

        // Validate quantity (you can add additional validation as needed)
        if ($quantity > 0) {
            $_SESSION['cart'][$productID] = $quantity;
        }
    }
}

function removeProduct() {
    if (isset($_POST['productID'])) {
        $productID = $_POST['productID'];

        // Remove the product from the cart
        unset($_SESSION['cart'][$productID]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="NEWLOGO.png" type="image/png">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaleidoscope | Cart</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and Popper.js scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="NEWLOGO.png" type="image/png">
</head>

<body>

<header class="fixed-top">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar bg-body-tertiary" style="background-color: #F1F1F1;">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img src="NEWLOGO.png" height="50" alt="Kaleidoscope" loading="lazy" />
        </a>

        <!-- Left links -->
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 nav ">
          <!-- Your existing navigation links -->
          <li><a href="customer.php" class="selection "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-house" viewBox="0 0 20 16">
                <path
                  d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
              </svg>Home</a></li>
          <li><a href="cart.php" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-cart" viewBox="0 0 20 16">
                <path
                  d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg>View Cart</a></li>
          <li><a href="user_purchased.php" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-bag" viewBox="0 0 20 16">
                <path
                  d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
              </svg>My Purchase</a></li>


        </ul>
        <!-- Left links -->
      </div>
      
          <!-- Profile dropdown -->
          <li class="nav-item dropdown" style="list-style-type: none;">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 11 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg></i> <?php echo $firstname; ?>
            </a>
            <ul class="dropdown-menu " aria-labelledby="navbarDropdown" style="transform:translateX(-6vw);">
              <!-- You can customize the content of the dropdown menu here -->
              <li><a class="dropdown-item" href="user_logout.php?logout">Logout</a></li>
            </ul>
          </li>
        </ul>

        <!-- Right elements -->
        <div class="d-flex align-items-center">
          <!-- Icon -->
          <a class="text-reset me-3" href="#">
            <i class="fas fa-shopping-cart"></i>
          </a>
        </div>
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
 
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Delivery Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add a form to collect the address -->
                    <form action='checkout.php' method='post'>
                        <div class="mb-3">
                            <label for="address" class="form-label">Delivery Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                       <div>
                       <label for="payment" class="form-label">Payment Method</label>
                       <select class="form-select" aria-label="Default select example" id="payment" name="payment">
                    <option selected disabled class="bg-dark text-white">COD</option>
                    <option value="1">Cash on Delivery</option>
                    <option selected disabled class="bg-dark text-white">Bank</option>
                    <option value="2">BDO</option>
                    <option value="3">Metrobank</option>
                    </select>
                        </div>
                        <input type='hidden' name='action' value='checkout'>
                        <button type="submit" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#checkoutSuccess">Proceed to Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="transform: translateY(25%); position:relative;" class="cart container mt-5">
    <table class='table'>
        <thead class="table-dark ">
            <tr>
                <th scope='col'>Product</th>
                <th scope='col'>Price</th>
                <th scope='col'>Quantity</th>
                <th scope='col'>Total</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
$totalPrice = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productID => $quantity) {
        $result = $db->query("SELECT * FROM products WHERE productID = $productID");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $price = $row['price'];
            $stock = $row['productQuantity']; // Retrieve product quantity from the database
            $total = $price * $quantity;
            $totalPrice += $total;

            echo "<tr>";                
            echo "<td><img src='{$row['productImage']}' alt='{$row['productName']}' style='max-width: 50px; max-height: 50px;'> {$row['productName']}</td>";
            echo "<td> ₱". number_format($price) . "</td>";
            echo "<td>
                    <form id='form_$productID' action='cart.php' method='post'>
                        <input type='hidden' name='productID' value='$productID'>
                        <input type='hidden' name='action' value='update'>";
                        // Set the maximum value for the quantity input field based on available stock
                        echo "<input type='number' class='mx-2' name='quantity' value='$quantity' min='1' max='$stock' style='width:55px;'>";
                        echo "<input type='submit' class='btn btn-secondary btn-sm ' value='Update' onclick='return checkStock($productID)'>";
                    echo "</form>";
                    echo "<div id='warning_$productID' style='display:none;color:red;'>Limit order</div>";
            echo "</td>";
            $total = number_format($total);
            echo "<td>₱$total</td>";
            echo "<td>
                    <form action='cart.php' method='post'>
                        <input type='hidden' name='productID' value='$productID'>
                        <input type='hidden' name='action' value='remove'>
                        <input type='submit' class='btn btn-danger btn-sm' value='Remove'>
                    </form>
                  </td>";
            echo "</tr>";
        }
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>Your cart is empty.</td></tr>";
}
?>

<script>
function checkStock(productID) {
    var quantityInput = document.querySelector("#form_" + productID + " input[name='quantity']");
    var stock = parseInt(quantityInput.getAttribute('max'));
    var quantity = parseInt(quantityInput.value);
    var warningDiv = document.getElementById('warning_' + productID);

    if (quantity > stock) {
        warningDiv.style.display = 'block';
        return false; // Prevent form submission
    } else {
        warningDiv.style.display = 'none';
        return true; // Allow form submission
    }
}
</script>

        </tbody>
    </table>

    <h5 class='text-end'>Total: ₱<?php echo number_format($totalPrice); ?></h5>

    <!-- Checkout Button -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutModal" <?php if (empty($_SESSION['cart'])) echo 'disabled'; ?> style="transform:translateX(80vw);">Checkout</button>
</div>

<style>
    .modal-backdrop {
        z-index: -1;
    }
    #checkoutModal {
        margin-top: auto;
        margin-bottom: 10%;
    }
</style>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutSuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout Successful!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Thank you for your purchase! Your order has been successfully placed.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function addToCart() {
        let modal = document.getElementById("checkoutModal");
        modal.style.display = "block";
    }
</script>
</body>
</html>
