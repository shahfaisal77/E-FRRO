<?php
require '../db_connect.php'; // Adjust the path to your db_connect.php file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.location.href = 'edit_admin.php?id=$id';</script>";
        exit();
    }

    // Check if contact or email already exists
    $checkContactEmailSql = "SELECT * FROM static_admin WHERE (contact = '$contact' OR email = '$email') AND id != $id";
    $contactEmailResult = $conn->query($checkContactEmailSql);
    if ($contactEmailResult->num_rows > 0) {
        echo "<script>alert('Contact or Email already exists. Please choose different contact or email.'); window.location.href = 'edit_admin.php?id=$id';</script>";
        exit();
    }

    // Update admin details in the database
    $sql = "UPDATE static_admin SET username = '$username', password = '$password', contact = '$contact', email = '$email' WHERE id = $id";
    if ($conn->query($sql)) {
        echo "<script>alert('Admin details updated successfully!'); window.location.href = 'admins_list.php';</script>";
    } else {
        echo "<script>alert('Could not update admin details. Please try again later.'); window.location.href = 'edit_admin.php?id=$id';</script>";
    }
}

// Retrieve admin details based on the provided id in the URL query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM static_admin WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $contact = $row['contact'];
        $email = $row['email'];
    } else {
        echo "<script>alert('Admin not found');</script>";
        exit();
    }
} else {
    echo "<script>alert('Admin id not provided');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Edit Admin</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
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
                            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
