<?php
require 'db_connect.php'; // Include the database connection details
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check the entered password against the stored password
    $enteredPassword = $_POST['password'];
    $adminId = $_POST['id']; // Retrieve 'id' from the form

    $query = "SELECT password FROM new_user_registration WHERE id = $adminId AND type = 'admin'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $adminPassword = $row['password'];

        if ($enteredPassword == $adminPassword) {
            // Password is correct, proceed with the rejection logic
            header("Location: reject_application.php?id=$adminId");
            exit();
        } else {
            echo '<script type="text/javascript">
                    alert("Password is not correct. Please try again.");
                    window.location.href = "new_registration_application.php";
                  </script>';
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Password and Proceed</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #F5F5F5;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #5dade2;
            border-radius: 5px;
            background-color: white;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
            margin-bottom: 10px; /* Added margin here */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Verify Password and Proceed</h2>
        <form method="post">
            <div class="form-group">
                <label for="password">Enter Your Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- Add a hidden input field to include the 'id' parameter -->
            <input type="hidden" name="id" value="<?php echo $adminId; ?>">
            <button type="submit" class="btn btn-primary">Proceed</button>
            <a href="new_registration_application.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
