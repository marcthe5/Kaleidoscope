<?php
require_once 'components/connector.php'; // Include database connection
include('admin_authentication.php');
//session_start();


// Check if the user is logged in and is an admin
if (!isset($_SESSION['adminID']) || $_SESSION['adminID'] !== true) {
    //header("Location: orderlist.php");
   // exit();
}
// Handle form submission to update order status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['order_id']) && isset($_POST['new_status'])) {
      $orderId = $_POST['order_id'];
      $newStatus = $_POST['new_status'];

      // Update the order status in the database
      $db->query("UPDATE purchase_history SET order_status = '$newStatus' WHERE id = $orderId");
  }
}

// Fetch user purchase history
$userHistoryResult = $db->query("SELECT * FROM purchase_history ORDER BY placed_on DESC");

// Fetch product sales and inventory
$productResult = $db->query("SELECT * FROM products");

// Check for errors in the queries
if (!$userHistoryResult || !$productResult) {
    die("Error: " . $db->error);
}
?>

<!DOCTYPE html>
<html lang="en">
    
	<title>Kaleidoscope | Orderlist</title>

<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- BOOTSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href="adminstyle.css">
    <link rel="icon" href="NEWLOGO.png" type="image/png">

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
       <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 nav text-dark">
         <li><a href="admin.php" class="selection "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
               fill="currentColor" class="bi bi-house" viewBox="0 0 20 16">
               <path
                 d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
             </svg>Home</a></li>
          
             <li><a href="admin.php" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 20 16">
 <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
</svg>Inventory</a></li>

             <li><a href="admin.php" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 20 16">
 <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
</svg>Business Insights</a></li>


             <li><a href="orderlist.php" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 20 16">
 <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
 <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
</svg>Orders</a></li>




<li><a href="removed_records.php" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 20 16">
  <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
</svg>Records</a></li>


       </ul>
       <!-- Left links -->
     </div>
  <!-- Profile dropdown -->
  <li class="nav-item dropdown" style="list-style-type: none;">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 11 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg></i> <?php echo $name; ?>
            </a>
            <ul class="dropdown-menu " aria-labelledby="navbarDropdown" style="transform:translateX(-6vw);">
              <!-- You can customize the content of the dropdown menu here -->
              <li><a class="dropdown-item" href="user_logout.php?logout">Logout</a></li>
            </ul>
          </li>
        </ul>   
   

</div>
     <!-- Right elements -->
     <div class="d-flex align-items-center">
       <!-- Icon -->
       <a class="text-reset me-3" href="#">
         <i class="fas fa-shopping-cart"></i>
       </a>


               

     <!-- Right elements -->
   </div>
   <!-- Container wrapper -->
 </nav>
 
 </header>
 <body class="bg-light">
 <div class="container mt-5" style="transform: translateY(3vw);">
    <?php
    $userHistoryData = array();

    while ($row = $userHistoryResult->fetch_assoc()) {
        $userHistoryData[] = $row;
    }

    $userHistoryData = array_reverse($userHistoryData);

    if (!empty($userHistoryData)) {
        ?>
        <div class="row">
            <?php foreach ($userHistoryData as $row) { ?>
                <div class="col-sm-6 mb-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="orderDetailsTab<?php echo $row['id']; ?>" data-bs-toggle="tab" href="#orderDetails<?php echo $row['id']; ?>">Order Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="userInfoTab<?php echo $row['id']; ?>" data-bs-toggle="tab" href="#userInfo<?php echo $row['id']; ?>">User Information</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane fade show active" id="orderDetails<?php echo $row['id']; ?>">
                                <h5 class="card-title">Order #<?php echo $row['id']; ?></h5>
                                <img src="<?php echo $row['productImage']; ?>" alt="Product Image" class="card-img-top" style="width: 100px; height: 100px;">

                                <p class="card-text">Product: <?php echo $row['products']; ?></p>
                                <p class="card-text">Quantity: <?php echo $row['quantity']; ?>x</p>
                                <p class="card-text">Total Price: ₱<?php echo number_format($row['total_price']); ?></p>
                                <p class="card-text">Order Status: <span style="background-color:dark; font-weight:bolder; color: black;"><?php echo $row['order_status']; ?></span></p>
                                <p class="card-text">
                                    <small class="text-muted">Placed on: <?php echo $row['placed_on']; ?></small>
                                </p>
                                <!-- Button to trigger user information link -->
                            </div>

                         

                        <!-- User Information Content -->
                        <div class="tab-pane fade" id="userInfo<?php echo $row['id']; ?>">
                            <p><strong>User ID:</strong> <?php echo $row['user_id']; ?></p>
                            <p><strong>Firstname:</strong> <?php echo $row['firstname']; ?></p>
                            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                            <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
                            <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                            <!-- Add other user information fields as needed -->
                        </div>
                           <!-- Order Status Form -->
                           <form method="post" action="">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <select name="new_status" class="form-control mb-2" style="width: 50%; margin: auto; box-shadow: 2px 3px 3px gray;">
                                    <option selected disabled class="text-center">Choose Action</option>
                                    <option value="Pending" class="text-center">Pending</option>
                                    <option value="Delivered" class="text-center">Delivered</option>
                                    <option value="Cancel" class="text-center">Cancel</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-block" style="width:100%;">Update Order Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>No user purchase history available.</p>
    <?php } ?>
</div>


<!-- Bootstrap JS and Popper.js scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tZ1oFuTPti8BOYqtnqyZJeMEO4+v2kFrB4EJs=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
