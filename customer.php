<!DOCTYPE html>
<html>
<?php
require_once 'components/connector.php'; // Include database connection
include('user_authentication.php');

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['action'] === 'add' && isset($_POST['productID'])) {
      $productID = $_POST['productID'];
      $_SESSION['cart'][$productID] = isset($_SESSION['cart'][$productID]) ? $_SESSION['cart'][$productID] + 1 : 1;
  } elseif ($_POST['action'] === 'update' && isset($_POST['productID'])) {
      $productID = $_POST['productID'];
      $quantity = $_POST['quantity'];
      $_SESSION['cart'][$productID] = $quantity;
  } elseif ($_POST['action'] === 'remove' && isset($_POST['productID'])) {
      $productID = $_POST['productID'];
      unset($_SESSION['cart'][$productID]);
  }
}
?>
<style>
 body {
      background-color: none;
      margin: 0;
      overflow-x: hidden;
    }

    .background-left,
    .background-right {
      position: fixed;
      top: 0;
      bottom: 0;
      width: 5%;
      background-size: auto 100%;
      z-index: 999;
    }

    .background-left {
      left: 0;
      background: url('https://i.pinimg.com/originals/bb/7e/cf/bb7ecfb0192564c38332c7a4b610bedf.png') repeat-y left;
    }

    .background-right {
      right: 0;
      background: url('https://i.pinimg.com/originals/bb/7e/cf/bb7ecfb0192564c38332c7a4b610bedf.png') repeat-y right;
    }
  </style>

    <meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="icon" href="NEWLOGO.png" type="image/png">

<link rel="stylesheet" type="text/css" href="style.css">

<script type="text/javascript">
 







  /** MODALS **/
  function logout() {
    let modal = document.getElementById("modalRedirect");
    modal.style.display = "block";
    setTimeout(() => { location.replace("login.html"); }, 1000);


  }
  function signup() {
    let modal = document.getElementById("modalRedirect");
    modal.style.display = "block";
    setTimeout(() => { location.replace("login.html"); }, 1000);

  }
  function addToCart() {

    let modal = document.getElementById("modalAddToCart");
    modal.style.display = "block";

  }
  function hideModal() {
    let modal = document.getElementById("modalAddToCart");
    modal.style.display = "none";

  }
  setInterval(hideModal, 1200);

</script>

<head>
  <title>Kaleidoscope | Home</title>
</head>
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
    </div>
  </nav>
  
</header>


<body>

  <main>
    <div class="position-relative overflow-hidden p-3 p-md-5  text-center bg-white">
      <div class="col-md-5 p-lg-5 mx-auto my-5">

        <br>

        <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicators/dots -->
    <div class="carousel-indicators">
        <?php
        // Fetch all products from the database
        $productResult = $db->query("SELECT * FROM products");

        // Check if the query was successful
        if ($productResult) {
            $numProducts = $productResult->num_rows;
            for ($i = 0; $i < $numProducts; $i++) {
                $activeClass = $i === 0 ? 'active' : '';
                echo "<button type='button' data-bs-target='#demo' data-bs-slide-to='$i' class='$activeClass'></button>";
            }
        }
        ?>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner bg-tangerine slide-show">
        <?php
        // Reset the data pointer back to the beginning
        $productResult->data_seek(0);

        // Display each product in the carousel
        echo "<span><a class='btn btn-outline-secondary text-light  bttn-shop' href='#products'><svg
            xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-cart'
            viewBox='0 0 20 16'>
            <path
              d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z' />
          </svg>Shop</a></span>";
        while ($product = $productResult->fetch_assoc()) {
            $activeClass = empty($activeClass) ? 'active' : ''; // Add active class to the first item

            
            echo "<div class='carousel-item $activeClass' style='z-index: -999;'>";
            echo "<img src='{$product['productImage']}' alt='{$product['productName']}' class='d-block w-90 customer-prod-img'>";
            // Add other details or buttons as needed
            echo "</div>";
        } 

        // Close the database connection
        $productResult->close();
        ?>
    </div>
    </div>
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark"></span>
    </button>
</div>
      <p style="transform: translateY(-10.5vw);"><small>No amount of whiskey is too risky. No amount of sober is something you can’t get over.</p></small>
      <h3 class="display-5" style="transform: translateY(-11.5vw);"><strong>UNLOCK THE TASTE OF LUXURY</h3></strong>
          <hr class="hr" style="transform: translateY(-10vw);">
    </div>
    </div>
    
<div>
    <img src="NEWLOGO2.png" id="products" class="img-fluid shadow-2-strong mx-auto d-block" alt="BANNER" width="60%" style="transform: translateY(-13vw);">;
      </div>
      
<div style="transform: translateY(-13vw);">
<div class="background-left"></div> <!-- Left Background -->
<div class="background-right"></div> <!-- Right Background -->
<div class="container">
    <div class="row justify-content-center">
        <?php
        $result = $db->query("SELECT * FROM products");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fix_price = number_format($row['price']);
                $fix_prodQuantity = number_format($row['productQuantity']);

                // Check if the product is out of stock
                $isOutOfStock = $row['productQuantity'] <= 0;

                echo "<div class='col-md-4 mb-4 text-center'>";
                echo "<div class='card border-0 bg-white' style='box-shadow: 1px 1px 3px 1px gray;'>";
                echo "<img src='{$row['productImage']}' alt='{$row['productName']}' class='card-img-top mx-auto' style='max-height: 150px; object-fit: contain;'>";
                echo "<div class='card-body'>";
                echo "<a href='' class='text-reset'>";
                echo "<h5 class='card-title mb-3'>{$row['productName']}</h5>";
                echo "</a>";
                echo "<p class='mb-3'>₱ $fix_price</p>";

                // Display different content based on the stock status
                if ($isOutOfStock) {
                    echo "<p class='text-danger'>Out of Stock</p>";
                } else {
                    echo "<p class='text-success'>$fix_prodQuantity in Stock</p>";
                    echo "<form action='#products' method='post' id='myForm'>";
                    echo "<input type='hidden' name='productID' value='{$row['productID']}'>";
                    echo "<input type='hidden' name='action' value='add'>";
                    $buttonDisabledAttribute = $isOutOfStock ? 'disabled' : '';
                    echo "<input type='submit' class='btn btn-dark' id='addToCartBtn' onclick='addToCart()' data-mdb-ripple-init value='Add to Cart' $buttonDisabledAttribute>";
                    echo "</form>";
                }

                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>No products available.</p>";
        }
        ?>
    </div>
</div>

<!-- notification for addtocart quantities -->

      <!-- THE MODAL (ADDED TO CART) -->
      <div id="modalAddToCart" class="modal text-center " tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <!-- Modal content -->
        <div class="modal-content text-center" style="width: 20%; height: 20%;">
          <div class="modal-body text-dark text-center">
            <h3 style="color: #212529;">ADDED TO CART
              <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-check"
                viewBox="0 0 16 16">
                <path
                  d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
              </svg>
            </h3>
          </div>

        </div>

      </div>

</div>

<!-- Add this script to your head section or before the closing body tag -->
<script>
  // Function to update the cart counter
  function updateCartCounter() {
    // Retrieve the cart count element
    var cartCountElement = document.getElementById('cartCount');

    // You may need to adjust the way you fetch the cart count based on your PHP implementation
    var cartCount = <?php echo count($_SESSION['cart']); ?>;

    // Update the cart count element
    if (cartCountElement) {
      cartCountElement.textContent = cartCount;
    }
  }
</script>



  </main>
  <br>
  <footer class="py-3 my-0">
    <ul class="nav justify-content-center border-bottom pb-2 mb-2">
      <p class="text-center text-muted">Database Management System</p>
    </ul>
    <p class="text-center text-muted">© 2024 Kaleidoscope, Inc</p>
  </footer>
  </div>
  </footer>


</body>

</html>