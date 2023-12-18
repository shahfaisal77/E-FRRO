<?php
// Include the database connection details
require 'db_connect.php';

// Check if the user is logged in
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the user's ID from the session
$userId = $_SESSION['user_id'];

// Fetch the user's application status and selected service
$query = "SELECT status_inquiry, service_selected FROM applicant WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($status, $service);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Inquiry</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .parent {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .child {
            background-color: #F8F9FA;
            color: #343A40;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .child i {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .back-btn {
            margin-top: 20px;
        }
        
        /* Style the button to match the design of child element */
        .btn.back-btn {
            background-color: #343A40;
            border-color: #343A40;
            color: #F8F9FA;
        }
    </style>
</head>
<body>
    <div class="parent">
        <div class="child">
            <?php
            if ($status === 'accepted') {
                echo '<i class="fas fa-check-circle" style="color: #28a745;"></i>';
                echo '<h2 class="mb-3 mt-4">Congratulations!</h2>';
                echo '<p>Your application has been accepted. Please check your email for the extension PDF file. Thank you for choosing our services!</p>';
            } elseif ($status === 'underprocess') {

                if (strpos($service, 'Registration') !== false && strpos($service, 'Registration_Extension') !== false) {
                    echo '<i class="fas fa-spinner fa-pulse"></i>';
                    echo '<h2 class="mb-3">Please wait...</h2>';
                    echo '<p>Your applications is under process. We are doing our best to review your applications as soon as possible. Thank you for your patience.</p>';
                } elseif (strpos($service, 'Registration') !== false) {
                    echo '<i class="fas fa-spinner fa-pulse"></i>';
                    echo '<h2 class="mb-3">Please wait...</h2>';
                    echo '<p>Your application for  Registration is currently under process. We are doing our best to review your application as soon as possible. Thank you for your patience.</p>';
                } elseif (strpos($service, 'Registration_Extension') !== false) {
                    echo '<i class="fas fa-spinner fa-pulse"></i>';
                    echo '<h2 class="mb-3">Please wait...</h2>';
                    echo '<p>Your application for Registration Extension is currently under process. We are doing our best to review your application as soon as possible. Thank you for your patience.</p>';
                }
            } elseif (is_null($status)) {
                echo '<i class="fas fa-exclamation-circle"></i>';
                echo '<h2 class="mb-3 mt-4">Oops!</h2>';
                echo '<p>You have not applied for any application yet. Click below to apply and start your process today.</p>';

                echo '<a href="fresh_application.php" class="btn btn-success btn-lg back-btn">Apply Now</a>';
            } else {
                echo '<i class="fas fa-exclamation-triangle"></i>';
                echo '<h2 class="mb-3 mt-4">Pending Review</h2>';
                echo '<p>We have received your application and it is currently under review. We will update you on the status of your application as soon as possible.</p>';
            }
            ?>

            <!-- Back button -->
            <a href="registeredHome.php" class="btn btn-primary btn-lg back-btn mt-4">Back to Home</a>
        </div>
    </div>

    <!-- Link FontAwesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <!-- Link Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
