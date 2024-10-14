<?php
// Include the connection file
require_once "conn.php";

// Check if product ID is provided and numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the product ID to prevent SQL injection
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to delete the product
    $sql = "DELETE FROM `product` WHERE `id` = $product_id";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to a page after successful deletion
        header("Location: productlist.php");
        exit();
    } else {
        // Error message if deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Error message if product ID is not provided or not numeric
    echo "Invalid product ID";
}

// Close the database connection
$conn->close();
?>
