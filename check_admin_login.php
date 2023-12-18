<?php
session_start(); // Start the session to access session data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once 'db_connect.php';

    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform form validation (you can add more checks based on your requirements)
    if (empty($email) || empty($password)) {
        http_response_code(400); // Bad Request
        echo "Please enter your email and password.";
        exit;
    }

    // Prepare and execute the SQL query to check if the user is of type 'admin' and fetch the plain text password
    $sql = "SELECT id, password FROM new_user_registration WHERE email = ? AND type = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $storedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the password (comparing plain text passwords)
    if ($password === $storedPassword) {
        // Password is correct, set up the session
        $_SESSION['user_id'] = $userId; // Store the user ID in the session
        $_SESSION['user_type'] = 'admin'; // Set the user type to 'admin'

        // Close the database connection
        $conn->close();

        // Redirect to admin_home.php
        header("Location: admin/admin_home.php");
        exit;
    } else {
        // Incorrect email or password
        echo '<script type="text/javascript">
                alert("Incorrect email or password. Please try again.");
                window.location.href = "login.php";
              </script>';
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method not allowed.";
}
?>
