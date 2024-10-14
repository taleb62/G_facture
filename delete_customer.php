<?php
// Include the connection file
require_once "conn.php";

// Check if customer_id is provided and numeric
if(isset($_GET['customer_id']) && is_numeric($_GET['customer_id'])) {
    // Sanitize the customer_id to prevent SQL injection
    $customer_id = mysqli_real_escape_string($conn, $_GET['customer_id']);

    // SQL query to delete the customer
    $sql = "DELETE FROM `customer` WHERE `customer_id` = $customer_id";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to a page after successful deletion
        header("Location: customerlist.php");
        exit();
    } else {
        // Error message if deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Error message if customer_id is not provided or not numeric
    echo "Invalid customer ID";
}

// Close the database connection
$conn->close();
?>
