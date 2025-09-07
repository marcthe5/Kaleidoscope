<?php
include('components/connector.php');
include('user_authentication.php');
//session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
  header("Location: login.php");
  exit();
}

// Retrieve user information from the session
$userID = $_SESSION['userID'];

// Fetch user's purchase history from the database
$result = $db->query("SELECT * FROM purchase_history WHERE user_id = $userID ORDER BY placed_on DESC");

// Check for errors in the query
if (!$result) {
  die("Error: " . $db->error);
}


// Fetch and display purchase history
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .bg-primary { background-color: gray; }
        .bg-success { background-color: green; }
        .bg-danger { background-color: red; }
    </style>
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


<body><header class="fixed-top">
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
<div class="container mt-5" style="transform: translateY(4vw);">
    <h2 class="mb-3">Purchase History</h2>

    <?php if ($result->num_rows > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
            <thead>
    <tr>
        <th>Purchase Date</th>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Address</th>
        <th>Order Status</th>
    </tr>
</thead>
<tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['placed_on']; ?></td>
            <td>
                <?php
                $productImage = $row['productImage'];
                echo "<img src='$productImage' alt='Product Image' style='max-width: 50px; max-height: 50px;'>";
                ?>
            </td>
            <td><?php echo $row['products']; ?></td>
            
            <td><?php echo $row['quantity']; ?>x</td>
            <td>₱<?php echo number_format($row['total_price']); ?></td>
            <td><?php echo $row['address']; ?></td>
            <td style="background-color: <?php echo getOrderStatusColor($row['order_status']); ?>">
                <?php echo $row['order_status']; ?>
            </td>
        </tr>
    <?php } ?>
</tbody>
            </table>
        </div>
    <?php } else { ?>
        <p class="text-muted">No purchase history available.</p>
    <?php } ?>

    <?php
    function getOrderStatusColor($orderStatus)
    {
        switch ($orderStatus) {
            case 'Pending':
                return 'bg-primary';
            case 'Delivered':
                return 'bg-success';
            case 'Cancel':
                return 'bg-danger';
            default:
                return ''; // Default or unknown status, no specific background color
        }
    }
    ?>
</body>


</html>
