<?php
// Include the database connection details
require 'db_connect.php';

// Check if the user is logged in
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}

// Get the user's ID from the session
$userId = $_SESSION['user_id'];

// Fetch the user's application status and service_selected
$query = "SELECT status_inquiry, service_selected FROM applicant WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    // Check for a query preparation error
    echo "<script>alert('Query not prepared.'); window.location.href='registeredHome.php';</script>";
    exit();
}

$stmt->bind_param("i", $userId);
$stmt->execute();

if ($stmt->error) {
    // Check for a query execution error
    echo "<script>alert('Query not executed.'); window.location.href='registeredHome.php';</script>";
    exit();
}

$stmt->bind_result($status, $serviceSelected);
$stmt->fetch();
$stmt->close();

if ($status === 'underprocess') {
    // The application is already under process, check the service_selected
    if ($serviceSelected === 'Registration') {
        // The user has a Registration application under process
        echo "<script>alert('Your application for New Registration is under process. You cannot apply for other applications. Please wait until further notice.'); window.location.href='registeredHome.php';</script>";
    } elseif ($serviceSelected === 'Registration_Extension') {
        // The user has a Registration_Extension application under process
        echo "<script>alert('Your application for Registration Extension is under process. You cannot apply for other applications. Please wait until further notice.'); window.location.href='registeredHome.php';</script>";
    }
} elseif ($status === 'accepted') {
    // The application has been accepted
    echo "<script>alert('If your RP extension is still valid, please refrain from applying for a new application. Please check your email for further details.'); window.location.href='fresh_application.php';</script>";
} elseif ($status === null) {
    // The application status is null, redirect to the fresh_application.php page
    echo "<script>window.location.href = 'fresh_application.php';</script>";
} else {
    // Handle the case where no results were returned
    echo "<script>alert('No row was found for the user ID: " . $userId . "'); window.location.href='registeredHome.php';</script>";
    exit();
}

// Close the database connection
$conn->close();
?>
