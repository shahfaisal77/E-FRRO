
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
    $applicantQuery = "SELECT * FROM applicant WHERE id = ?";
    $applicantStmt = $conn->prepare($applicantQuery);
    $applicantStmt->bind_param("i", $applicantId);
    $applicantStmt->execute();
    $applicantResult = $applicantStmt->get_result();
    
    if ($applicantResult->num_rows === 1) {
        $applicantRow = $applicantResult->fetch_assoc();
    } else {
        echo 'Applicant not found';
        exit();
    }

    // Fetch passport details
    $passportQuery = "SELECT * FROM passport WHERE id = ?";
    $passportStmt = $conn->prepare($passportQuery);
    $passportStmt->bind_param("i", $applicantId);
    $passportStmt->execute();
    $passportResult = $passportStmt->get_result();
    
    if ($passportResult->num_rows === 1) {
        $passportRow = $passportResult->fetch_assoc();
    } else {
        echo 'Passport details not found';
        exit();
    }

    // Fetch visa details
    $visaQuery = "SELECT * FROM visa WHERE id = ?";
    $visaStmt = $conn->prepare($visaQuery);
    $visaStmt->bind_param("i", $applicantId);
    $visaStmt->execute();
    $visaResult = $visaStmt->get_result();
    
    if ($visaResult->num_rows === 1) {
        $visaRow = $visaResult->fetch_assoc();
    } else {
        echo 'Visa details not found';
        exit();
    }

    // Fetch emergency contact details
    $emergencyContactQuery = "SELECT * FROM emergency_contact WHERE id = ?";
    $emergencyContactStmt = $conn->prepare($emergencyContactQuery);
    $emergencyContactStmt->bind_param("i", $applicantId);
    $emergencyContactStmt->execute();
    $emergencyContactResult = $emergencyContactStmt->get_result();
    
    if ($emergencyContactResult->num_rows === 1) {
        $emergencyContactRow = $emergencyContactResult->fetch_assoc();
    } else {
        echo 'Emergency contact details not found';
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
<title>Applicant Details</title>
<!-- Link Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
     body {
        background-color: #F5F5F5;
        padding-bottom: 20px;
    }
    .container {
        border: 2px solid #5dade2;
        border-radius: 5px;
        padding: 20px;
        margin-top: 50px;
    }
    .section {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 20px;
    }

    .highlight-alert {
    color: #FF6347; /* This is a red color, you can change it to your preferred color */
    font-weight: bold;
    padding: 8px; /* Increase padding for a larger area */
    margin-right: 10px;
    border-radius: 8px; /* Increase border-radius for a more rounded look */
    margin-bottom: 10px;
    display: inline-block; /* Make it an inline block to wrap the text tightly */
    border: 2px solid #FF6347; /* Add a border for emphasis */
}



</style>
</head>
<body>
<div class="container ">

<!-- Button to open the path -->
<button id="openPathButton" class="btn btn-primary float-right" style="margin-right: 10px; margin-top: 2px;">View Files</button>



     <!-- Display document status message at the top right corner -->
     <div class="highlight-alert float-right">
        <?php
        // Check document files in the folder
        $folderPath = '../uploads/extension_applications/' . $applicantRow['given_name'];

        // Check if the folder exists
        if (is_dir($folderPath)) {
            $fileCount = count(glob("$folderPath/*.{pdf,jpeg,png}", GLOB_BRACE));

            // Display appropriate message based on file count
            if ($fileCount >= 7) {
                echo 'All documents are uploaded.';
            } else {
                echo 'Documents are missing.';
            }
        } else {
            // Folder does not exist
            echo 'Documents folder is missing.';
        }
        ?>
    </div>



    <a href="registration_extension.php" class="btn btn-secondary">&lt;Back to Previous Page</a>
    <h2 class="text-center">Applicant Details</h2>
        
    <!-- Applicant Details Section -->
    <div class="section">
        <h3>Applicant Details</h3>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Surname:</strong> <?php echo $applicantRow['surname'] ? $applicantRow['surname'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Given Name:</strong> <?php echo $applicantRow['given_name']; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Sex:</strong> <?php echo $applicantRow['sex']; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Father's Name:</strong> <?php echo $applicantRow['father_name'] ? $applicantRow['father_name'] : 'N/A'; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Spouse Name:</strong> <?php echo $applicantRow['spouse_name'] ? $applicantRow['spouse_name'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Date of Birth:</strong> <?php echo $applicantRow['dob']; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Email:</strong> <?php echo $applicantRow['email'] ? $applicantRow['email'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Profession:</strong> <?php echo $applicantRow['profession'] ? $applicantRow['profession'] : 'N/A'; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p><strong>New Born Child:</strong> <?php echo $applicantRow['new_born_child'] ? $applicantRow['new_born_child'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Military Service:</strong> <?php echo $applicantRow['military_service'] ? $applicantRow['military_service'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Refuge:</strong> <?php echo $applicantRow['refuge'] ? $applicantRow['refuge'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Service Selected:</strong> <?php echo $applicantRow['service_selected'] ? $applicantRow['service_selected'] : 'N/A'; ?></p>
            </div>
        </div>
    </div>

    <!-- Passport Details Section -->
    <div class="section">
        <h3>Passport Details</h3>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Passport Number:</strong> <?php echo $passportRow['pno'] ? $passportRow['pno'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Date of Issue:</strong> <?php echo $passportRow['date_of_issue'] ? $passportRow['date_of_issue'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Expiry Date:</strong> <?php echo $passportRow['expiry_date'] ? $passportRow['expiry_date'] : 'N/A'; ?></p>
            </div>
        </div>
    </div>

    <!-- Visa Details Section -->
    <div class="section">
        <h3>Visa Details</h3>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Visa Number:</strong> <?php echo $visaRow['vno'] ? $visaRow['vno'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Expiry Date:</strong> <?php echo $visaRow['expiry_date'] ? $visaRow['expiry_date'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Date of Issue:</strong> <?php echo $visaRow['date_of_issue'] ? $visaRow['date_of_issue'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Valid For:</strong> <?php echo $visaRow['valid_for'] ? $visaRow['valid_for'] : 'N/A'; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Visa Type:</strong> <?php echo $visaRow['visa_type'] ? $visaRow['visa_type'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Visa Sub Type:</strong> <?php echo $visaRow['visa_sub_type'] ? $visaRow['visa_sub_type'] : 'N/A'; ?></p>
            </div>
        </div>
    </div>

    <!-- Emergency Contact Details Section -->
    <div class="section">
        <h3>Emergency Contact Details</h3>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Name:</strong> <?php echo $emergencyContactRow['name'] ? $emergencyContactRow['name'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Relationship:</strong> <?php echo $emergencyContactRow['relationship'] ? $emergencyContactRow['relationship'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Contact:</strong> <?php echo $emergencyContactRow['contact'] ? $emergencyContactRow['contact'] : 'N/A'; ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Email:</strong> <?php echo $emergencyContactRow['email'] ? $emergencyContactRow['email'] : 'N/A'; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


<!-- JavaScript to open the path when the button is clicked -->
<script>
    document.getElementById('openPathButton').addEventListener('click', function() {
      window.open('<?php echo $folderPath; ?>', '_blank');
    });
  </script>










</html>
