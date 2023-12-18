<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['request_passport_bio_data_page'])) {
    // Handle request for Passport Bio Data Page
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'passport'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'passport' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to new_registration_application.php
        echo '<script>alert("Missing document request for Passport Bio Data Page has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "new_registration_application.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_residence_proof'])) {
    // Handle request for Residence Proof
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'residence_proof'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'residence_proof' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to new_registration_application.php
        echo '<script>alert("Missing document request for Residence Proof has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "new_registration_application.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_latest_indian_visa'])) {
    // Handle request for Latest Indian Visa Copy
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'visa'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'visa' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to new_registration_application.php
        echo '<script>alert("Missing document request for Latest Indian Visa Copy has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "new_registration_application.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_applicant_photo'])) {
    // Handle request for Applicant's Photo
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'photo'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'photo' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to new_registration_application.php
        echo '<script>alert("Missing document request for Applicant\'s Photo has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "new_registration_application.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} else {
    echo 'Invalid request';
    exit();
}

?>
