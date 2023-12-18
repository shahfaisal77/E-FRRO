
<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$missingDocsStatus = ''; // Initialize missingDocsStatus variable

// Check the missing_docs_status value for the current applicant
if (isset($_SESSION['user_id'])) {
    $applicantId = $_SESSION['user_id'];

    $checkStatusQuery = "SELECT missing_docs_status FROM applicant WHERE id = ?";
    $checkStatusStmt = $conn->prepare($checkStatusQuery);
    $checkStatusStmt->bind_param("i", $applicantId);
    $checkStatusStmt->execute();
    $checkStatusResult = $checkStatusStmt->get_result();

    if ($checkStatusResult->num_rows === 1) {
        $statusRow = $checkStatusResult->fetch_assoc();
        $missingDocsStatus = $statusRow['missing_docs_status'];

        // Display message based on missing_docs_status
        switch ($missingDocsStatus) {
            case 'passport':
                $message = 'Your Passport Bio Data Page is missing. Please upload it to proceed with your application.';
                $docName = 'PassportBioDataPage';
                break;
            case 'residence_proof':
                $message = 'Your Residence Proof is missing. Please upload it to proceed with your application.';
                $docName = 'ResidenceProof';
                break;
            case 'visa':
                $message = 'Your Latest Indian Visa Copy is missing. Please upload it to proceed with your application.';
                $docName = 'LatestIndianVisaCopy';
                break;
            case 'photo':
                $message = 'Your Applicant\'s Photo is missing. Please upload it to proceed with your application.';
                $docName = 'ApplicantsPhoto';
                break;
            case 'bonafide_extension':
                $message = 'Your Bonafide Certificate is missing. Please upload it to proceed with your application.';
                $docName = 'BonafideCertificate';
                break;
            case 'passport_extension':
                $message = 'Your Passport Bio Data Page is missing. Please upload it to proceed with your application.';
                $docName = 'PassportBioDataPage';
                break;
            case 'registration_certificate_extension':
                $message = 'Your Registration Certificate is missing. Please upload it to proceed with your application.';
                $docName = 'RegistrationCertificate';
                break;
            case 'residence_proof_extension':
                $message = 'Your Residence Proof is missing. Please upload it to proceed with your application.';
                $docName = 'ResidenceProof';
                break;
            case 'visa_extension':
                $message = 'Your Indian Visa is missing. Please upload it to proceed with your application.';
                $docName = 'IndianVisa';
                break;
            case 'photo_extension':
                $message = 'Your Applicant\'s Photo is missing. Please upload it to proceed with your application.';
                $docName = 'ApplicantsPhoto';
                break;
            case 'financial_proof_extension':
                $message = 'Your Financial Resource Proof is missing. Please upload it to proceed with your application.';
                $docName = 'FinancialResourceProof';
                break;
            default:
                $message = 'No missing documents detected for your application.';
                $docName = '';
        }
    } else {
        $message = 'Applicant not found.';
        $docName = '';
    }
} else {
    $message = 'Invalid request';
    $docName = '';
}

$showButton = $docName !== '';

if (isset($_SESSION['document-uploaded'])) {
    $documentUploaded = $_SESSION['document-uploaded'];
    if ($documentUploaded) {
        echo "<script>alert('Your " . $docName . " has been uploaded successfully. Please wait for further processing.');</script>";
        $missingDocsStatus = '';
        $_SESSION['document-uploaded'] = false;
    } else {
        echo "<script>alert('Error uploading the file. Please try again later.');</script>";
        $_SESSION['document-uploaded'] = false;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Missing Documents</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .container {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            padding: 50px;
            margin-top: 50px;
        }
        h2 {
            font-size: 36px;
            margin-bottom: 50px;
        }
        p {
            font-size: 24px;
            margin-bottom: 50px;
        }
        input[type="file"] {
            margin-top: 20px;
        }
        button[type="submit"] {
            margin-top: 20px;
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
    <a href="registeredHome.php" class="btn btn-primary">Back</a>
        <h2 class="text-center">Upload Missing Documents</h2>
        <?php if ($missingDocsStatus === '') { ?>
            <p class="text-center">You do not have any missing documents to upload. Please wait for further processing.</p>
        <?php } else if ($showButton) { ?>
            <p class="text-center"><?php echo $message; ?></p>
            <form action="submit_missing_doc.php" method="post" enctype="multipart/form-data" class="text-center">
                <div class="form-group">
                    <label for="docFile">Upload <?php echo $docName; ?>:</label>
                    <input type="file" class="form-control-file" id="docFile" name="docFile">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        <?php } else { ?>
            <p class="text-center"><?php echo $message; ?></p>
        <?php } ?>
    </div>

    <!-- Link Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
