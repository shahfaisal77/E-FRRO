<?php
// Include the database connection details
require 'db_connect.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Get the 'id' from the URL
    $applicant_id = $_GET['id'];

    // Delete the user's application
    $delete_query = "DELETE FROM applicant WHERE id = $applicant_id";

    if ($conn->query($delete_query) === TRUE) {
        echo '<script>alert("User\'s application has been deleted."); window.location.href="new_registration_application.php";</script>';
        exit();
    } else {
        echo "Error deleting user's application: " . $conn->error;
    }
} else {
    echo "Invalid request. No 'id' parameter provided.";
}
?>
