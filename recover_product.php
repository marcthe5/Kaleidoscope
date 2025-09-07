<?php
require_once 'components/connector.php'; // Include database connection

if (isset($_GET['id'])) {
    $productID = intval($_GET['id']);

    // Retrieve product details including the productName, productImage, and productQuantity
    $productQuery = "SELECT productName, productImage, productQuantity FROM records WHERE productID = ? AND is_deleted = TRUE";
    $stmt = $db->prepare($productQuery);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $stmt->close();

        // Display the product details before recovery
        echo "<h2>Product Recovery</h2>";
        echo "<p>Product Name: " . htmlspecialchars($product['productName']) . "</p>";
        echo "<p>Product Image: <img src='" . htmlspecialchars($product['productImage']) . "' alt='" . htmlspecialchars($product['productName']) . "' /></p>";
        echo "<p>Product Quantity: " . htmlspecialchars($product['productQuantity']) . "</p>";

        // Check for an existing or proceeding ID in the inventory
        $newIDQuery = "SELECT productID FROM records WHERE productID > ? ORDER BY productID ASC LIMIT 1";
        $stmt = $db->prepare($newIDQuery);
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $newIDResult = $stmt->get_result();

        if ($newIDResult->num_rows > 0) {
            $newIDRow = $newIDResult->fetch_assoc();
            $newProductID = $newIDRow['productID'];
        } else {
            $newProductID = $productID + 1; // If no proceeding ID exists, use the next ID
        }
        $stmt->close();

        // Update the record to set is_deleted to FALSE and update the productID if needed
        $recoverQuery = "UPDATE records SET productID = ?, is_deleted = FALSE WHERE productID = ?";
        $stmt = $db->prepare($recoverQuery);
        $stmt->bind_param("ii", $newProductID, $productID);

        if ($stmt->execute()) {
            // Add the product back to inventory (if necessary, implement logic here)
            // For example, you might want to update the productQuantity if it's relevant

            echo "<p>Product recovered successfully.</p>";
        } else {
            echo "<p>Error recovering product: " . htmlspecialchars($db->error) . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Product not found or already recovered.</p>";
    }

    // Redirect back to the deleted products list after a short delay
    header("refresh:5; url=deleted_products.php");
} else {
    echo "<p>No product ID provided.</p>";
}
?>
