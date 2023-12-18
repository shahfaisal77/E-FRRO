<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border: 2px solid #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: 2px solid #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border: 2px solid #0056b3;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Back Button -->
        <a href="registeredHome.php" class="btn btn-light back-button"><i class="fas fa-chevron-left"></i> Back</a>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2><i class="fas fa-lock"></i> Change Password</h2>
                <form method="post" id="changePasswordForm" action="process_change_password.php">
                    <div class="form-group">
                        <label for="currentPassword"><i class="fas fa-key"></i> Current Password:</label>
                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword"><i class="fas fa-lock"></i> New Password:</label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword"><i class="fas fa-check-double"></i> Confirm New Password:</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Change Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Add Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
