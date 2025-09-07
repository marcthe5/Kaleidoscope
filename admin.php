<!DOCTYPE html>
<html>

<?php

require_once 'components/connector.php'; // Include database connection
include('admin_authentication.php');


if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
    echo '<script>
            // Trigger a JavaScript function to open the modal
            $(document).ready(function(){
                openDeleteSuccessModal();
            });
          </script>';
}
    
    // Handle form submission to update product price
    if (isset($_POST['update_product'])) {
        $productID = $_POST['productID'];
        $newProductName = $_POST['updateProductName'];
        $newProductPrice = $_POST['updateProductPrice'];
        $newProductQuantity = $_POST['updateProductQuantity'];

        // Update the product price in the database
        $db->query("UPDATE products SET productName = $newProductName, price = $newPrice, productQuantity = $newProductQuantity  WHERE productID = $productID");
    }

    // Handle form submission to delete product
    if (isset($_POST['delete_product'])) {
        $productID = $_POST['productIDDelete'];

        // Delete the product from the database
        $db->query("DELETE FROM products WHERE productID = $productID");
        // to be continue...$db->query("INSERT INTO  FROM products WHERE productID = $productID");
    }




// Fetch all products
$productResult = $db->query("SELECT * FROM products");

// Fetch total sales
$totalSalesResult = $db->query("SELECT SUM(total_price) AS total_sales FROM purchase_history");
$totalSales = $totalSalesResult->fetch_assoc()['total_sales'] ?? 0;

// Fetch top product sales
$topProductResult = $db->query("SELECT products , SUM(quantity) AS total_quantity, SUM(total_price) AS total_sales FROM purchase_history GROUP BY products ORDER BY total_quantity DESC LIMIT 6");

// Check for errors in the query
if (!$productResult || !$totalSalesResult || !$topProductResult) {
    die("Error: " . $db->error);
}
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
	<!--- CHART CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="adminstyle.css">
    <link rel="icon" href="NEWLOGO.png" type="image/png">
      <!-- Chart.js library -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script type="text/javascript">
function main(){
}

function logout(){
  let modal = document.getElementById("modalRedirect");
modal.style.display = "block";
setTimeout(() => {  location.replace("login.html"); }, 1000);


}

function addItem(){
    let modal = document.getElementById("modalAddItem");
modal.style.display = "block";

}
function cancelAdd(){
 let modal = document.getElementById("modalAddItem");
modal.style.display = "none";

}

function hideModal(){
let modal = document.getElementById("modalAddedItem");
modal.style.display = "none";

}

setInterval(hideModal,800);

</script>


	<title>Kaleidoscope | Admin</title>

</head>

<body class="bg-light" >

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
           
              <li><a href="#products" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 20 16">
  <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
</svg>Inventory</a></li>

              <li><a href="#business-insights" class="selection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 20 16">
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


	<div class="tab-content">
		<div id="home" class="container tab-pane active"><br>
        <center>  <img class="card-img-bottom" src="NEWLOGO.png" alt="aos" style="border: none; width: 40%; position: relative; transform: translateY(5%);"></center> 

			<p class="pt-5" style="font-size: 30px; text-align: center; color: black; font-family: sans-serif; transform:translateY(-7vw);"><span style="background-color: white; border: none; opacity:0.9;">The <b>MOST</b> reliable & hassle free<br> Booze & Spirits House<br>Accross Global.</span></p>
		</div>
		
		</div>
		

		<div class="body2" >

		<main class="bg-light" id="products" >

        <?php
// Fetch product sales, inventory, and images
$productResult = $db->query("SELECT * FROM products");
?>
<article>
<article>
    <h1 class="article-header">Inventory</h1>

    <!-- Search Bar -->
    <center>
        
    </center>

    <!-- Inventory section with the updated product form -->
    <center>
        <div class="m-3">
            <?php
          

            // Search functionality
            $search = isset($_GET['search']) ? $db->real_escape_string($_GET['search']) : '';

            // Modify query based on the search keyword
            if (!empty($search)) {
                $query = "SELECT * FROM products WHERE productName LIKE '%$search%'";
            } else {
                $query = "SELECT * FROM products";
            }

            $productResult = $db->query($query);

            if ($productResult->num_rows > 0) { ?>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Product ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                            <form method="GET" action="#products" class="form-outline" data-mdb-input-init>
  <input type="search" id="form1" name="search" class="form-control " style="width:20%; font-size:15px;" placeholder="Search products" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" aria-label="Search" />
</form>


                        </tr>
                    </thead>
                    <br>
                    <tbody>
                        <?php while ($row = $productResult->fetch_assoc()) {
                            $productName = htmlspecialchars($row['productName']);
                            $fix_price = number_format($row['price']);
                            $productQuantity = htmlspecialchars($row['productQuantity']);

                            echo "<tr>
                                <td>{$row['productID']}</td>
                                <td>";

                            if (!empty($row['productImage'])) {
                                echo "<img src='{$row['productImage']}' alt='{$productName}' style='max-width: 50px; max-height: 50px;'>";
                            } else {
                                echo 'No Image';
                            }

                            echo "</td>
                                <td>{$productName}</td>
                                <td>₱{$fix_price}</td>
                                <td>";

                            // Check if the product is out of stock
                            if ($productQuantity == 0) {
                                echo "<span class='text-danger'>Out of Stock</span>";
                            } else {
                                echo $productQuantity;
                            }

                            echo "</td>
                                <td>
                                    <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#modalCrudUpdate' onclick='openUpdateModal({$row['productID']}, \"{$row['productName']}\", {$row['price']}, {$row['productQuantity']})'>Update</button>
                                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#modalCrudDelete' onclick='openDeleteModal({$row['productID']})'>Remove</button>
                                </td>
                            </tr>";
                        } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No products available.</p>
            <?php }
            $db->close(); ?>
        </div>
    </center>
</article>

<center>
    <button type="button" class="btn btn-lg btn-dark mb-4" data-bs-toggle="modal" data-bs-target="#addproductModal">ADD PRODUCT</button>
</center>

<style>
    .modal-backdrop {
        z-index: -1;
    }
    #addproductModal {
        position: relative;
        background: none;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -88%);
        overflow: hidden;
    }
</style>

<!-- Add Product Modal -->
<div class="modal fade" id="addproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">KALEIDOSCOPE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add product form -->
                <div class="m-3">
                    <form method="POST" action="add_product.php" enctype="multipart/form-data" class="form-control">
                        <label for="productName">Product Name</label>
                        <input type="text" name="productName" id="productName" class="form-control mb-3" required>

                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control mb-3" min="0" required>

                        <label for="productQuantity">Quantity</label>
                        <input type="number" name="productQuantity" id="productQuantity" class="form-control mb-3" min="0" required>

                        <label for="productImage">Product Image</label>
                        <input type="file" name="productImage" id="productImage" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp" required>

                        <input type='hidden' name='action' value=''>
                        <button type="submit" class="btn btn-success mt-3" name="add_product">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



				</article>

</main>
<main class="bg-white" id="business-insights">
				<article >
					<div class="body2">
					<h1 class="article-header"> Business Insights</h1>




<!-- Top Product Sales -->

<div class="container mt-2" id="business-insights">
    <div class="row">
      <h5 class="text-center mb-4"> Top Product Sale </h5>
        <?php while ($row = $topProductResult->fetch_assoc()) { ?>
            <div class="col-md-4 mb-4">
                <!-- Top Product Sales Card -->
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['products']; ?></h5>
                        <p class="card-text">
                            Quantity Sale: <?php echo $row['total_quantity']; ?><br>
                            Total Sales: <?php echo '₱' . number_format($row['total_sales'], 2); 
                                $totalAllSales = 0;
                            $totalAllSales += $totalSales;
                            ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <h4 class="bg-light text-center">Total Sales of All Products: <br><h3 class="bg-success text-white text-center">₱ <strong><?php echo number_format($totalAllSales, 2); ?></h3></strong></h4>

    </div>
</div>




				</article>
		</main>

	</div>










<!--- MODALS--->






<!-- THE MODAL (ITEM ADDED) -->
<div id="modalAddedItem" class="modal text-center "  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >

  <!-- Modal content -->
  <div class="modal-content text-center" style="width: 30%; height: 40%;">
      <div class="modal-body text-dark text-center">
                <img src="NEWLOGO.png" style="width:65%;">
        <hr>
        <h3>ITEM ADDED<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="green" class="bi bi-check" viewBox="0 0 16 16">
  <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
</svg></h3>
      </div>    
      
  </div>

</div>







<!-- Update Product Price Modal -->
<div class="modal fade" id="modalCrudUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Update Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

        
                <!-- Update product form -->
                <form method="POST" action="update_product.php" id="updateForm" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_product">
   <center>
    <label for="updateProductName" class="d-flex justify-content-center">Product ID</label>
    <input type="text" class="text-center " id="productID" name="productID" value="" style="width:30px;" readonly>
        </center>
    <br>

    <label for="updateProductName">New Product Name</label>
    <input type="text" name="updateProductName" id="updateProductName" class="form-control mb-3">

    <label for="updateProductPrice">New Price</label>
    <input type="number" name="updateProductPrice" id="updateProductPrice" class="form-control mb-3" min="0">

    <label for="updateProductQuantity">New Product Quantity</label>
    <input type="number" name="updateProductQuantity" id="updateProductQuantity" class="form-control mb-3" min="0">

    <label for="updateProductImage">New Product Image</label>
    <input type="file" name="updateProductImage" id="updateProductImage" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp" >

    <br><center>
    <button type="submit" class="btn btn-success" >Update Product</button>
    </center>
</form>


            </div>
        </div>
    </div>
</div>
<!-- Delete Product Confirmation Modal -->
<div class="modal fade" id="modalCrudDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
                <form method="POST" action="delete_product.php" id="deleteForm">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" id="deleteProductID" name="productID" value="">
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add this modal section to your admin.php file -->
<div class="modal fade" id="deleteSuccessModal" tabindex="-1" role="dialog" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSuccessModalLabel">Product Deleted Successfully</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your modal content goes here -->
                <!-- You can display additional details or messages if needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // Function to open update modal with the product ID
    function openUpdateModal(productID,productName,price,productQuantity) {
        document.getElementById("productID").value = productID;
        document.getElementById("updateProductName").value = productName;
       document.getElementById("updateProductPrice").value = price;
      // document.getElementById("updateProductImage").value = productImage;
       document.getElementById("updateProductQuantity").value = productQuantity;

    }

    // Function to open delete modal with the product ID
    function openDeleteModal(productID) {
        document.getElementById("deleteProductID").value = productID;
    }
    function openDeleteSuccessModal() {
        // Assuming you're using Bootstrap for modals
        $('#deleteSuccessModal').modal('show');
    }
    
    function updateModal() {
    let modal = document.getElementById("myModal");
    modal.style.display = "block";
    let timeout = setTimeout(modal, 900);
    setTimeout(() => {  location.replace("admin.php"); }, 900);
}


setInterval(hideModal,800);

</script>

<script>
    
function showAddedModal2() {
let modal = document.getElementById("AddedModal");


  modal.style.display = "block";
  
     let timeout = setTimeout(modal, 1000);
     setTimeout(() => {  location.replace("admin.php"); }, 1000);


  }
    </script>
</body>


</html>