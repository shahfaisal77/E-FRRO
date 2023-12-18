<?php
session_start(); // Start the session to access session data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once 'db_connect.php';

    // Retrieve form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Perform form validation (you can add more checks based on your requirements)
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        echo "<script>alert('Please fill in all required fields.'); window.location.href = 'change_password.php';</script>";
        exit;
    }

    // Check if the new password and confirm password match
    if ($newPassword != $confirmPassword) {
        echo "<script>alert('New password and confirm password do not match.'); window.location.href = 'change_password.php';</script>";
        exit;
    }

    // Get the user ID from the session
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('You are not logged in.'); window.location.href = 'change_password.php';</script>";
        exit;
    }
    $userId = $_SESSION['user_id'];

    // Prepare and execute the SQL query to retrieve the current hashed password
    $sql = "SELECT password FROM new_user_registration WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the current password
    if (password_verify($currentPassword, $hashedPassword)) {
        // Hash the new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to update the password
        $sql = "UPDATE new_user_registration SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $hashedNewPassword, $userId);
        if ($stmt->execute()) {
            // Close the prepared statement
            $stmt->close();

            // Close the database connection
            $conn->close();

            // Redirect to registeredHome.php with success message
            echo "<script>alert('Your password has been changed successfully!'); window.location.href = 'registeredHome.php';</script>";
            exit;
        } else {
            echo "<script>alert('Unable to update password.'); window.location.href = 'change_password.php';</script>";
        }
    } else {
        echo "<script>alert('Your current password is incorrect.'); window.location.href = 'change_password.php';</script>";
    }
} else {
    echo "<script>alert('Method not allowed.'); window.location.href = 'change_password.php';</script>";
}
?>
