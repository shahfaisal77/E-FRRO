<?php
session_start();

// Include the database connection file
require 'db_connect.php';

// Assuming you have a valid user session and user_id
if (isset($_SESSION['user_id'])) {
    $applicantId = $_SESSION['user_id'];

    // Fetch applicant details
    $applicantQuery = "SELECT * FROM applicant WHERE id = ?";
    $applicantStmt = $conn->prepare($applicantQuery);
    $applicantStmt->bind_param("i", $applicantId);
    $applicantStmt->execute();
    $applicantResult = $applicantStmt->get_result();
    $applicantData = $applicantResult->fetch_assoc();
    $applicantStmt->close();

    // Fetch arrival details
    $arrivalQuery = "SELECT * FROM arrival_detail WHERE applicant_id = ?";
    $arrivalStmt = $conn->prepare($arrivalQuery);
    $arrivalStmt->bind_param("i", $applicantId);
    $arrivalStmt->execute();
    $arrivalResult = $arrivalStmt->get_result();
    $arrivalDetails = $arrivalResult->fetch_assoc();
    $arrivalStmt->close();

    // Fetch passport details
    $passportQuery = "SELECT * FROM passport WHERE applicant_id = ?";
    $passportStmt = $conn->prepare($passportQuery);
    $passportStmt->bind_param("i", $applicantId);
    $passportStmt->execute();
    $passportResult = $passportStmt->get_result();
    $passportDetails = $passportResult->fetch_assoc();
    $passportStmt->close();

    // Fetch visa details
    $visaQuery = "SELECT * FROM visa WHERE applicant_id = ?";
    $visaStmt = $conn->prepare($visaQuery);
    $visaStmt->bind_param("i", $applicantId);
    $visaStmt->execute();
    $visaResult = $visaStmt->get_result();
    $visaDetails = $visaResult->fetch_assoc();
    $visaStmt->close();
} else {
    // Handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reprint Application - Foreign Student Registration</title>
    <!-- Include Bootstrap CSS and Font Awesome for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
            background-color: #fff;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .section {
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }

        .section-header {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        .icon {
            font-size: 20px;
            margin-right: 10px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
    <a href="registeredHome.php" class="btn btn-secondary" style="position: absolute; top: 10px; left: 10px;">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <div class="section">
            <div class="section-header">
                <i class="fas fa-user icon"></i> Applicant Details
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Surname:</strong></td>
                        <td><?php echo $applicantData['surname']; ?></td>
                        <td><strong>Given Name:</strong></td>
                        <td><?php echo $applicantData['given_name']; ?></td>
                        <td><strong>Sex:</strong></td>
                        <td><?php echo $applicantData['sex']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Father's Name:</strong></td>
                        <td><?php echo $applicantData['father_name']; ?></td>
                        <td><strong>Spouse's Name:</strong></td>
                        <td><?php echo $applicantData['spouse_name']; ?></td>
                        <td><strong>Date of Birth:</strong></td>
                        <td><?php echo $applicantData['dob']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo $applicantData['email']; ?></td>
                        <td><strong>Profession:</strong></td>
                        <td><?php echo $applicantData['profession']; ?></td>
                        <td><strong>New Born Child:</strong></td>
                        <td><?php echo $applicantData['new_born_child']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Military Service:</strong></td>
                        <td><?php echo $applicantData['military_service']; ?></td>
                        <td><strong>Refuge:</strong></td>
                        <td><?php echo $applicantData['refuge']; ?></td>
                        <td><strong>Service Selected:</strong></td>
                        <td><?php echo $applicantData['service_selected']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-header">
                <i class="fas fa-plane icon"></i> Arrival Details
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>City of Boarding:</strong></td>
                        <td><?php echo $arrivalDetails['city_of_boarding']; ?></td>
                        <td><strong>Country of Boarding:</strong></td>
                        <td><?php echo $arrivalDetails['country_of_boarding']; ?></td>
                        <td><strong>Date of Arrival:</strong></td>
                        <td><?php echo $arrivalDetails['date_of_arrival']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Place of Arrival:</strong></td>
                        <td><?php echo $arrivalDetails['place_of_arrival']; ?></td>
                        <td><strong>Mode of Journey:</strong></td>
                        <td><?php echo $arrivalDetails['mode_of_journey']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-header">
                <i class="fas fa-passport icon"></i> Passport Details
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Passport Number:</strong></td>
                        <td><?php echo $passportDetails['pno']; ?></td>
                        <td><strong>Date of Issue:</strong></td>
                        <td><?php echo $passportDetails['date_of_issue']; ?></td>
                        <td><strong>Expiry Date:</strong></td>
                        <td><?php echo $passportDetails['expiry_date']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-header">
                <i class="fas fa-stamp icon"></i> Visa Details
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Visa Number:</strong></td>
                        <td><?php echo $visaDetails['vno']; ?></td>
                        <td><strong>Date of Issue:</strong></td>
                        <td><?php echo $visaDetails['date_of_issue']; ?></td>
                        <td><strong>Expiry Date:</strong></td>
                        <td><?php echo $visaDetails['expiry_date']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Valid For:</strong></td>
                        <td><?php echo $visaDetails['valid_for']; ?></td>
                        <td><strong>Visa Type:</strong></td>
                        <td><?php echo $visaDetails['visa_type']; ?></td>
                        <td><strong>Visa Subtype:</strong></td>
                        <td><?php echo $visaDetails['visa_sub_type']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
