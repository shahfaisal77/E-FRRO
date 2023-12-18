<?php
// Start the session to access session variables
session_start();

// Include the database connection script
require('db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// Get the user's ID from the session
$userId = $_SESSION['user_id'];

// Fetch applicant details from the database
$applicantQuery = "SELECT surname, given_name, sex, father_name, spouse_name, dob, email, profession, new_born_child, military_service, refuge, service_selected FROM applicant WHERE id = ?";
$stmtApplicant = $conn->prepare($applicantQuery);
$stmtApplicant->bind_param("i", $userId);
$stmtApplicant->execute();
$applicantData = $stmtApplicant->get_result()->fetch_assoc();
$stmtApplicant->close();

// Fetch passport details from the database
$passportQuery = "SELECT pno, date_of_issue, expiry_date FROM passport WHERE applicant_id = ?";
$stmtPassport = $conn->prepare($passportQuery);
$stmtPassport->bind_param("i", $userId);
$stmtPassport->execute();
$passportData = $stmtPassport->get_result()->fetch_assoc();
$stmtPassport->close();

// Fetch visa details from the database
$visaQuery = "SELECT vno, expiry_date, date_of_issue, valid_for, visa_type, visa_sub_type FROM visa WHERE applicant_id = ?";
$stmtVisa = $conn->prepare($visaQuery);
$stmtVisa->bind_param("i", $userId);
$stmtVisa->execute();
$visaData = $stmtVisa->get_result()->fetch_assoc();
$stmtVisa->close();

// Fetch emergency contact details from the database
$emergencyQuery = "SELECT name, relationship, contact, email FROM emergency_contact WHERE applicant_id = ?";
$stmtEmergency = $conn->prepare($emergencyQuery);
$stmtEmergency->bind_param("i", $userId);
$stmtEmergency->execute();
$emergencyData = $stmtEmergency->get_result()->fetch_assoc();
$stmtEmergency->close();

// Close the database connection
$conn->close();
?>





<?php
// ... (previous PHP code) ...
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- ... (previous code) ... -->

    <style>
        body {
            background-color: #FFFFFF;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            background-color: #FFFFFF;
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #007bff;
        }

        h2 {
            margin-top: 20px;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0px;
            border: 1px solid #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .fa {
            margin-right: 5px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="registeredHome.php" class="btn btn-light"><i class="fas fa-chevron-left"></i> Back to Dashboard</a>

        <h1><i class="fas fa-edit"></i> Edit Application</h1>
        <form method="post" action="update_application.php">
            <!-- Applicant Details -->
            <h2><i class="fas fa-user-circle"></i> Applicant Details</h2>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="surname"><i class="fas fa-user"></i> Surname:</label>
                        <input type="text" class="form-control" name="surname" value="<?php echo $applicantData['surname']; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="given_name"><i class="fas fa-user"></i> Given Name:</label>
                        <input type="text" class="form-control" name="given_name" value="<?php echo $applicantData['given_name']; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sex"><i class="fas fa-venus-mars"></i> Sex:</label>
                        <select class="form-control" name="sex">
                            <option value="Male" <?php if ($applicantData['sex'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($applicantData['sex'] == 'Female') echo 'selected'; ?>>Female</option>
                            <option value="Other" <?php if ($applicantData['sex'] == 'Other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div>
                </div>

                <!-- New Fields for Applicant Details -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="father_name"><i class="fas fa-user"></i> Father's Name:</label>
                        <input type="text" class="form-control" name="father_name" value="<?php echo $applicantData['father_name']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="spouse_name"><i class="fas fa-user"></i> Spouse's Name:</label>
                        <input type="text" class="form-control" name="spouse_name" value="<?php echo $applicantData['spouse_name']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="dob"><i class="fas fa-calendar-alt"></i> Date of Birth:</label>
                        <input type="date" class="form-control" name="dob" value="<?php echo $applicantData['dob']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $applicantData['email']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="profession"><i class="fas fa-suitcase"></i> Profession:</label>
                        <input type="text" class="form-control" name="profession" id="profession" value="<?php echo $applicantData['profession']; ?>" required>
                    </div>
                </div>
                <!-- Fields for new_born_child, military_service, refuge, and other applicant details -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="new_born_child"><i class="fas fa-baby"></i> New Born Child:</label>
                        <input type="text" class="form-control" name="new_born_child" value="<?php echo $applicantData['new_born_child']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="military_service"><i class="fas fa-shield-alt"></i> Military Service:</label>
                        <input type="text" class="form-control" name="military_service" value="<?php echo $applicantData['military_service']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="refuge"><i class="fas fa-home"></i> Refuge:</label>
                        <input type="text" class="form-control" name="refuge" value="<?php echo $applicantData['refuge']; ?>">
                    </div>
                </div>

            </div>

            <!-- Passport Details -->

            <h2><i class="fas fa-passport"></i> Passport Details</h2>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="pno"><i class="fas fa-hashtag"></i> Passport Number:</label>
                        <input type="text" class="form-control" name="pno" value="<?php echo $passportData['pno']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="date_of_issue"><i class="fas fa-calendar-alt"></i> Date of Issue:</label>
                        <input type="date" class="form-control" name="date_of_issue" value="<?php echo $passportData['date_of_issue']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for "expiry_date"><i class="fas fa-calendar-alt"></i> Expiry Date:</label>
                        <input type="date" class="form-control" name="expiry_date" value="<?php echo $passportData['expiry_date']; ?>">
                    </div>
                </div>

            </div>

            <!-- Visa Details -->
            <h2><i class="fas fa-plane"></i> Visa Details</h2>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="vno"><i class="fas fa-hashtag"></i> Visa Number:</label>
                        <input type="text" class="form-control" name="vno" value="<?php echo $visaData['vno']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="expiry_date"><i class="fas fa-calendar-alt"></i> Visa Expiry Date:</label>
                        <input type="date" class="form-control" name="visa_expiry_date" value="<?php echo $visaData['expiry_date']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="date_of_issue"><i class="fas fa-calendar-alt"></i> Visa Date of Issue:</label>
                        <input type="date" class="form-control" name="visa_date_of_issue" value="<?php echo $visaData['date_of_issue']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="valid_for"><i class="fas fa-clock"></i> Valid For:</label>
                        <input type="text" class="form-control" name="valid_for" value="<?php echo $visaData['valid_for']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="visa_type"><i class="fas fa-plane"></i> Visa Type:</label>
                        <input type="text" class="form-control" name="visa_type" value="<?php echo $visaData['visa_type']; ?>">
                    </div>
                </div>

                <!-- Fields for visa sub-type and other visa details -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="visa_sub_type"><i class="fas fa-plane"></i> Visa Sub-Type:</label>
                        <input type="text" class="form-control" name="visa_sub_type" value="<?php echo $visaData['visa_sub_type']; ?>">
                    </div>
                </div>
            </div>

            <!-- Emergency Contact Details -->
            <h2><i class="fas fa-phone"></i> Emergency Contact</h2>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $emergencyData['name']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="relationship"><i class="fas fa-heart"></i> Relationship:</label>
                        <input type="text" class="form-control" name="relationship" value="<?php echo $emergencyData['relationship']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="contact"><i class="fas fa-phone"></i> Contact:</label>
                        <input type="text" class="form-control" name="contact" value="<?php echo $emergencyData['contact']; ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $emergencyData['email']; ?>">
                    </div>
                </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" name="save" class="btn btn-primary mt-3"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
