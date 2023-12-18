<?php
// Include the database connection details
require 'db_connect.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user from the new_user_registration table
    $deleteQuery = "DELETE FROM new_user_registration WHERE id = $userId";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        // Deletion successful
        echo '<script>alert("User has been removed from the database.");</script>';
    } else {
        // Deletion failed
        echo '<script>alert("Error: Unable to remove the user from the database.");</script>';
    }
} else {
    // Invalid or missing user ID in the URL
    echo '<script>alert("Error: Invalid request.");</script>';
}

// Redirect back to view_reg_users.php after processing
echo '<script>window.location.href = "view_reg_users.php";</script>';
?>
