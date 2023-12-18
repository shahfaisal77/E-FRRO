
<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_FILES['docFile'])) {
    $applicantId = $_SESSION['user_id'];

    // Fetch the service_selected for the current user
    $serviceSelectedQuery = "SELECT service_selected, given_name FROM applicant WHERE id = ?";
    $serviceSelectedStmt = $conn->prepare($serviceSelectedQuery);
    $serviceSelectedStmt->bind_param("i", $applicantId);
    $serviceSelectedStmt->execute();
    $serviceSelectedResult = $serviceSelectedStmt->get_result();

    if ($serviceSelectedResult->num_rows === 1) {
        $serviceRow = $serviceSelectedResult->fetch_assoc();
        $serviceSelected = $serviceRow['service_selected'];
        $givenName = $serviceRow['given_name'];

        // Check and create the appropriate upload directory
        if ($serviceSelected === 'Registration') {
            $uploadDir = 'uploads/new_registration_applications/' . $givenName . '/';
        } elseif ($serviceSelected === 'Registration_Extension') {
            $uploadDir = 'uploads/extension_applications/' . $givenName . '/';
        } else {
            echo "<script>alert('Invalid service selected.'); window.history.back();</script>";
            exit();
        }

        // Create the directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the appropriate directory
        $uploadedFile = $uploadDir . $_FILES['docFile']['name'];

        if (move_uploaded_file($_FILES['docFile']['tmp_name'], $uploadedFile)) {
            // File uploaded successfully, update missing_docs_status to null
            $updateStatusQuery = "UPDATE applicant SET missing_docs_status = null WHERE id = ?";
            $updateStatusStmt = $conn->prepare($updateStatusQuery);
            $updateStatusStmt->bind_param("i", $applicantId);

            if ($updateStatusStmt->execute()) {
                echo "<script>alert('File uploaded successfully.'); window.history.back();</script>";
            } else {
                echo "<script>alert('Error updating the missing_docs_status.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Error uploading the file.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Applicant not found.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('No file uploaded.'); window.history.back();</script>";
}
?>
