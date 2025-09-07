<!DOCTYPE html>
<html lang="en">
<?php
require_once 'components/connector.php';
include('admin_authentication.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['recover_id'])) {
        $recover_id = $_POST['recover_id'];
        
        // Get the product details from records table
        $result = $db->query("SELECT * FROM records WHERE productID = '$recover_id'");
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $productName = $product['productName'];
            $productPrice = $product['productPrice'];
            $productImage = $product['productImage'];
            $productQuantity = $product['productQuantity'];
            
            // Insert the product into the products table
            $db->query("INSERT INTO products (productID, productName, price, productImage, productQuantity) VALUES ('$recover_id', '$productName', '$productPrice', '$productImage', '$productQuantity')");
            
            // Remove the product from the records table
            $db->query("DELETE FROM records WHERE productID = '$recover_id'");
        }
    }

    //if (isset($_POST['delete_id'])) {
       // $delete_id = $_POST['delete_id'];
        
        // Remove the product from the records table
      //  $db->query("DELETE FROM records WHERE productID = '$delete_id'");
    //}

    // Refresh the page to update the table
    header("Location: removed_records.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="NEWLOGO.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Kaleidoscope | Records</title>
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
  </nav>    </header>
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mb-5">
        <br><br><br>
        <h1 class="mb-5 bg-dark text-white">Records of Removed Product</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Removed Date</th>
                    <th>Removed Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $removedRecordsResult = $db->query("SELECT * FROM records");
                if ($removedRecordsResult->num_rows > 0) {
                    while ($row = $removedRecordsResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['productID']}</td>";
                        echo "<td>{$row['productName']}</td>";
                        echo "<td>{$row['productPrice']}</td>";
                        echo "<td><img src='{$row['productImage']}' alt='{$row['productName']}' style='max-width: 50px; max-height: 50px;'></td>";
                        echo "<td>{$row['productQuantity']}</td>";
                        echo "<td>{$row['removed_date']}</td>";
                        echo "<td>{$row['removed_time']}</td>";
                        echo "<td>
                                <form method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='recover_id' value='{$row['productID']}'>
                                    <button type='submit' class='btn btn-success btn-sm'>Recover</button>
                                </form>
                                <form method='POST' style='display:inline-block;'>
                                   
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No removed records found.</td></tr>";
                }
                $db->close();
                ?>
            </tbody>
        </table>
    </div>

    
</body>
</html>
