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
        $uploadFolder = 'uploads/extension_applications/' . $givenName . '/';

        // Create the folder if it doesn't exist
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        $success = true; // Flag to track success
        $errorMessage = ''; // Store error messages

        // Loop through the uploaded files and process them
        foreach ($_FILES as $fileKey => $fileInfo) {
            $fileName = $fileInfo['name'];
            $fileTempName = $fileInfo['tmp_name'];

            // Check if a file was uploaded
            if (!empty($fileName)) {
                // Get the file extension
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Check if the file is a photo
                if (in_array($fileExtension, ['jpg', 'jpeg'])) {
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
            // Documents uploaded successfully, set status_inquiry to "underprocess"
            $updateQuery = "UPDATE applicant SET status_inquiry = 'underprocess' WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('i', $userId);

            if ($updateStmt->execute()) {
                echo '<script>alert("Documents uploaded successfully! You have successfully applied.");</script>';
                echo '<script>window.location.href = "registeredHome.php";</script>'; // Redirect to registeredHome.php
            } else {
                echo '<script>alert("Error updating application status. Please try again.");</script>';
                echo '<script>console.error("Error updating application status:", ' . $updateStmt->error . ')</script>'; // Log any error
            }

            $updateStmt->close();
        } else {
            // Documents not uploaded successfully, set status_inquiry to "not applied"
            $updateQuery = "UPDATE applicant SET status_inquiry = 'not applied' WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('i', $userId);

            if ($updateStmt->execute()) {
                echo '<script>alert("' . $errorMessage . ' Application status is not applied.");</script>';
            } else {
                echo '<script>alert("Error updating application status. Please try again.");</script>';
                echo '<script>console.error("Error updating application status:", ' . $updateStmt->error . ')</script>'; // Log any error
            }

            $updateStmt->close();
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
                <h5 class="card-title">BONAFIDE CERTIFICATE<span class="compulsory">*</span>:</h5>
                <p class="card-text">Obtain a bonafide certificate from a UGC or AICTE recognized institute/college/university. The certificate should mention Foreign Students Information System (FSIS) number, course undertaken, duration of the course, and email ID of the institute/college/university.</p>
                <input type="file" class="form-control-file" name="bonafide_certificate" accept=".pdf" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">PASSPORT<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload the bio data page of your passport along with the page bearing the last Indian immigration arrival stamp.</p>
                <input type="file" class="form-control-file" name="passport_file" accept=".pdf" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">REGISTRATION CERTIFICATE<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload your FRRO/FRO registration certificate/residential permit if you hold a student (S-1) visa.</p>
                <input type="file" class="form-control-file" name="registration_certificate" accept=".pdf" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">RESIDENCE PROOF<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload residence certificate from hostel/updated Form "C" generated by hostel/lodge or registered/notarized lease deed, utility bill, copy of photo ID of the landlord along with a declaration and tenant police verification.</p>
                <input type="file" class="form-control-file" name="residence_proof_file" accept=".pdf" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">VISA<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload a copy of your Indian visa.</p>
                <input type="file" class="form-control-file" name="visa_detail_file" accept=".pdf" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">PHOTO<span class="compulsory">*</span>:</h5>
                <p class="card-text">Upload your photo. Please provide a recent passport-sized photo.</p>
                <input type="file" class="form-control-file" name="photo_file" accept=".jpg, .jpeg" required>
            </div>

            <div class="card p-4">
                <h5 class="card-title">FINANCIAL RESOURCE PROOF:</h5>
                <p class="card-text">Upload NRO account details and scholarship letter (if any).</p>
                <input type="file" class="form-control-file" name="financial_resource_proof">
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="upload" class="btn btn-primary btn-upload">Upload Documents</button>
            </div>
        </form>
    </div>

    <!-- Link Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
