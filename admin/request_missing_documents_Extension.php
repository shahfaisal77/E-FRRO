
<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $applicantId = $_GET['id'];

    // Fetch applicant details
    $applicantQuery = "SELECT given_name, surname, email, missing_docs_status FROM applicant WHERE id = ?";
    $applicantStmt = $conn->prepare($applicantQuery);
    $applicantStmt->bind_param("i", $applicantId);
    $applicantStmt->execute();
    $applicantResult = $applicantStmt->get_result();

    if ($applicantResult->num_rows === 1) {
        $applicantRow = $applicantResult->fetch_assoc();
        $missingDocsStatus = $applicantRow['missing_docs_status'];
    } else {
        echo 'Applicant not found';
        exit();
    }
} else {
    echo 'Invalid request';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Missing Documents</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <style>
        body {
            background-color: #f2f2f2;
           
        }
        .container {
        background-color: #ffffff;
        border: 2px solid #5dade2;
        border-radius: 5px;
        padding: 25px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* Add padding to separate from bottom of the page */
        padding-bottom: 10px;
    }
        h2, h4, p {
            text-align: center;
            margin-bottom: 20px;
        }
        .row {
            justify-content: space-evenly;
        }
        .btn {
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 18px;
            padding: 12px 20px;
        }
        .btn-warning:hover {
            background-color: #f0ad4e;
        }
        .alert {
            border-radius: 5px;
            margin-top: 10px;
        }
        .already-sent-message {
            color: #007BFF;
            margin-top: 5px;
        }
        .fas {
            margin-right: 10px;
        }
        .request-title, .btn, .already-sent-message {
            font-family: Arial, Helvetica, sans-serif;
        }
        .back-button {
            position: absolute;
            left: 10px;
            top: 10px;
            font-size: 16px;
            padding: 6px 12px;
        }
    </style>
    <script>
        function confirmRequest(documentType) {
            if (confirm("Are you sure you want to request " + documentType + "?")) {
                // If 'Yes' is clicked, proceed with the form submission
                return true;
            } else {
                // If 'Cancel' is clicked, do nothing
                return false;
            }
        }

        function alertAlreadySent(documentType) {
            alert("Request for " + documentType + " has already been sent to the user.");
        }
    </script>
</head>
<body>
    <div class="container">
        <button type="button" class="btn btn-secondary back-button" onclick="location.href='registration_extension.php'"><i class="fas fa-arrow-left"></i>Back</button>
        
        <h2>Request Missing Documents</h2>
        <p>Applicant: <?php echo $applicantRow['given_name'] . ' ' . $applicantRow['surname']; ?></p>
        <p>Email: <?php echo $applicantRow['email']; ?></p>

        <hr>

        <h4>Request Required Documents:</h4>
        <form method="post" action="process_missing_documents_Extension.php">
            <input type="hidden" name="applicant_id" value="<?php echo $applicantId; ?>">
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <button type="submit" name="request_bonafide_certificate" class="btn btn-warning btn-block" onclick="return confirmRequest('Bonafide Certificate')"><i class="fas fa-file-alt"></i>Request Bonafide Certificate</button>
                    <?php if ($missingDocsStatus === 'bonafide_extension') : ?>
                        <script>
                            alertAlreadySent('Bonafide Certificate');
                        </script>
                        <div class="alert alert-info already-sent-message"><i class="fas fa-exclamation-triangle"></i>Request for Bonafide Certificate has already been sent.</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="request_passport_bio_data_page" class="btn btn-warning btn-block" onclick="return confirmRequest('Passport Bio Data Page')"><i class="fas fa-passport"></i>Request Passport Bio Data Page</button>
                    <?php if ($missingDocsStatus === 'passport_extension') : ?>
                        <script>
                            alertAlreadySent('Passport Bio Data Page');
                        </script>
                        <div class="alert alert-info already-sent-message"><i class="fas fa-exclamation-triangle"></i>Request for Passport Bio Data Page has already been sent.</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="request_residence_proof" class="btn btn-warning btn-block" onclick="return confirmRequest('Residence Proof')"><i class="fas fa-map-marker-alt"></i>Request Residence Proof</button>
                    <?php if ($missingDocsStatus === 'residence_proof_extension') : ?>
                        <script>
                            alertAlreadySent('Residence Proof');
                        </script>
                        <div class="alert alert-info already-sent-message"><i class="fas fa-exclamation-triangle"></i>Request for Residence Proof has already been sent.</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <button type="submit" name="request_registration_certificate" class="btn btn-warning btn-block" onclick="return confirmRequest('Registration Certificate')"><i class="fas fa-certificate"></i>Request Registration Certificate</button>
                    <?php if ($missingDocsStatus === 'registration_certificate_extension') : ?>
                        <script>
                            alertAlreadySent('Registration Certificate');
                        </script>
                        <div class="alert alert-info already-sent-message"><i class="fas fa-exclamation-triangle"></i>Request for Registration Certificate has already been sent.</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="request_visa" class="btn btn-warning btn-block" onclick="return confirmRequest('Indian Visa Copy')"><i class="fas fa-plane"></i>Request Indian Visa Copy</button>
                    <?php if ($missingDocsStatus === 'visa_extension') : ?>
                        <script>
                            alertAlreadySent('Indian Visa Copy');
                        </script>
                        <div class="alert alert-info already-sent-message"><i class="fas fa-exclamation-triangle"></i>Request for Indian Visa Copy has already been sent.</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="request_financial_resource_proof" class="btn btn-warning btn-block" onclick="return confirmRequest('Financial Resource Proof')"><i class="fas fa-money-bill-wave"></i>Request Financial Resource Proof</button>
                    <?php if ($missingDocsStatus === 'financial_proof_extension') : ?>
                        <script>
                            alertAlreadySent('Financial Resource Proof');
                        </script>
                        <div class="alert alert-info already-sent-message"><i class="fas fa-exclamation-triangle"></i>Request for Financial Resource Proof has already been sent.</div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
    <!-- Link Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
