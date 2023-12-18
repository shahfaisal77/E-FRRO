<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['request_bonafide_certificate'])) {
    // Handle request for Bonafide Certificate
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'bonafide_extension'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'bonafide_extension' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to registration_extension.php
        echo '<script>alert("Missing document request for Bonafide Certificate has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "registration_extension.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_passport_bio_data_page'])) {
    // Handle request for Passport Bio Data Page
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'passport_extension'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'passport_extension' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to registration_extension.php
        echo '<script>alert("Missing document request for Passport Bio Data Page has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "registration_extension.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_registration_certificate'])) {
    // Handle request for Registration Certificate
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'registration_certificate_extension'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'registration_certificate_extension' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to registration_extension.php
        echo '<script>alert("Missing document request for Registration Certificate has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "registration_extension.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_residence_proof'])) {
    // Handle request for Residence Proof
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'residence_proof_extension'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'residence_proof_extension' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to registration_extension.php
        echo '<script>alert("Missing document request for Residence Proof has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "registration_extension.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_visa'])) {
    // Handle request for Visa
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'visa_extension'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'visa_extension' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to registration_extension.php
        echo '<script>alert("Missing document request for Visa has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "registration_extension.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_applicant_photo'])) {
    // Handle request for Applicant's Photo
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'photo_extension'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'photo_extension' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to registration_extension.php
        echo '<script>alert("Missing document request for Applicant\'s Photo has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "registration_extension.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} elseif (isset($_POST['request_financial_resource_proof'])) {
    // Handle request for Financial Resource Proof
    $applicantId = $_POST['applicant_id'];

    // Update the database: set missing_docs_status to 'financial_proof_extension'
    $updateQuery = "UPDATE applicant SET missing_docs_status = 'financial_proof_extension' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $applicantId);

    if ($updateStmt->execute()) {
        // Display an alert and redirect to registration_extension.php
        echo '<script>alert("Missing document request for Financial Resource Proof has been sent to the applicant.");</script>';
        echo '<script>window.location.href = "registration_extension.php";</script>';
    } else {
        echo 'Error updating the database.';
    }
} else {
    echo 'Invalid request';
    exit();
}
?>
