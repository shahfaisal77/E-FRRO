<?php
require '../db_connect.php'; // Adjust the path to your db_connect.php file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.location.href = 'add_admin.php';</script>";
        exit();
    }

    // Check if admin with the same email or contact exists
    $checkAdminSql = "SELECT * FROM static_admin WHERE email = '$email' OR contact = '$contact'";
    $adminResult = $conn->query($checkAdminSql);
    if ($adminResult->num_rows > 0) {
        echo "<script>alert('An admin with the same email or contact already exists. Please choose a different email or contact.'); window.location.href = 'add_admin.php';</script>";
        exit();
    }

    // Insert new admin into the database
    $sql = "INSERT INTO static_admin (username, password, contact, email) VALUES ('$username', '$password', '$contact', '$email')";
    if ($conn->query($sql)) {
        echo "<script>alert('Admin added successfully!'); window.location.href = 'admin_home.php';</script>";
    } else {
        echo "<script>alert('Could not add the admin. Please try again later.'); window.location.href = 'admin_home.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Add New Admin</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact:</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
