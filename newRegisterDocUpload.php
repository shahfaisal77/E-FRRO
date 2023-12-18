<?php
session_start(); // Start the session

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch user details from registrations table
    require 'db_connect.php'; // Include your database connection details
    $query = "SELECT given_name FROM new_user_registration WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($givenName);
    $stmt->fetch();
    $stmt->close();

    if (isset($_POST['upload'])) {
        // Define the folder where files will be stored
        $uploadFolder = 'uploads/new_registration_applications/' . $givenName . '/';

        // Create the folder if it doesn't exist
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        $success = true; // Flag to track success
        $errorMessage = ''; // Store error messages

        // Loop through the uploaded files
        foreach ($_FILES as $fileKey => $fileInfo) {
            $fileName = $fileInfo['name'];
            $fileTempName = $fileInfo['tmp_name'];

            // Check if a file was uploaded
            if (!empty($fileName)) {
                // Get the file extension
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Check the file number to determine the allowed file extensions
                if ($fileKey === 'passport_file' || $fileKey === 'residence_proof_file' || $fileKey === 'visa_detail_file') {
                    // Check if the file extension is 'pdf'
                    if ($fileExtension !== 'pdf') {
                        // Invalid file extension, show an error message
                        $success = false;
                        $errorMessage = 'Error: Please upload only PDF files for the required documents.';
                        break; // Exit the loop if an error occurs
                    }
                } elseif ($fileKey === 'photo_file') {
                    // Check if the file extension is 'jpeg' or 'jpg'
                    if ($fileExtension !== 'jpeg' && $fileExtension !== 'jpg') {
                        // Invalid file extension, show an error message
                        $success = false;
                        $errorMessage = 'Error: Please upload only JPEG or JPG images for the photo.';
                        break; // Exit the loop if an error occurs
                    }

                    // Rename the photo file to a fixed name
                    $fileName = 'image.' . $fileExtension;
                }

                // Move the uploaded file to the user's folder
                $destination = $uploadFolder . $fileName;

                if (move_uploaded_file($fileTempName, $destination)) {
                    // File uploaded successfully
                } else {
                    $success = false; // Set success to false if any file upload fails
                    $errorMessage = 'Error uploading files. Please try again.';
                    break; // Exit the loop if an error occurs
                }
            }
        }

        if ($success) {
            // Update status to 'underprocess'
            $updateStatusQuery = "UPDATE applicant SET status_inquiry = 'underprocess' WHERE id = ?";
            $updateStatusStmt = $conn->prepare($updateStatusQuery);
            $updateStatusStmt->bind_param('i', $userId);

            if ($updateStatusStmt->execute()) {
                echo '<script>alert("Documents uploaded successfully! You have successfully applied.");</script>';
                echo '<script>window.location.href = "registeredHome.php";</script>'; // Redirect to registeredHome.php
            } else {
                echo '<script>alert("Error updating application status. Please try again.");</script>';
            }

            $updateStatusStmt->close();
        } else {
            // Documents not uploaded successfully, show an error message
            echo '<script>alert("' . $errorMessage . '");</script>';
        }
    }

    $conn->close(); // Close the database connection
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Registration - Document Upload</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            padding: 20px;
        }
        .container {
            background-color: #ffffff; /* White container background */
            border: 2px solid black;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .card {
            border: 2px solid black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        .card-text {
            font-size: 16px;
            color: #555;
        }
        .form-control-file {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 6px 12px;
        }
        .btn-upload {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-upload:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .compulsory {
            color: red;
            font-weight: bold;
        }
    </style>




</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Upload Required Documents</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="card p-4">
                <h5 class="card-title">PASSPORT<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload the bio data page of your passport.<br><small class="text-muted">This document is required for identification purposes.</small></p>
                <input type="file" class="form-control-file" name="passport_file" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">RESIDENCE PROOF<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload Form "C" generated by hotel/lodge or registered/notarized lease deed along with a copy of photo ID of the landlord.<br><small class="text-muted">This document is required to verify your place of residence.</small></p>
                <input type="file" class="form-control-file" name="residence_proof_file" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">VISA DETAIL<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload a copy of your latest Indian visa.<br><small class="text-muted">This document is required to confirm your visa status.</small></p>
                <input type="file" class="form-control-file" name="visa_detail_file" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">PHOTO<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload your photo.<br><small class="text-muted">Please provide a recent passport-sized photo.</small></p>
                <input type="file" class="form-control-file" name="photo_file" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="upload" class="btn btn-primary btn-upload">Upload Documents</button>
            </div>
        </form>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




