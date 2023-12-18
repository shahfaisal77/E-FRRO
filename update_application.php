<?php
session_start();
require('db_connect.php');

if(isset($_POST['save'])) {
    $userId = $_SESSION['user_id'];
    $success = true;

    // Update passport details
    $passportNo = $_POST['pno'];
    $passportDateOfIssue = $_POST['date_of_issue'];
    $passportExpiryDate = $_POST['expiry_date'];
    $passportUpdateQuery = "UPDATE passport SET
        pno = ?,
        date_of_issue = ?,
        expiry_date = ?
        WHERE applicant_id = ?";
    $stmtPassport = $conn->prepare($passportUpdateQuery);
    $stmtPassport->bind_param("sssi", $passportNo, $passportDateOfIssue, $passportExpiryDate, $userId);
    if (!$stmtPassport->execute()) {
        $success = false;
    }

    // Update visa details
    $visaNo = $_POST['vno'];
    $visaExpiryDate = $_POST['visa_expiry_date'];
    $visaDateOfIssue = $_POST['visa_date_of_issue'];
    $visaValidFor = $_POST['valid_for'];
    $visaType = $_POST['visa_type'];
    $visaSubType = $_POST['visa_sub_type'];
    $visaUpdateQuery = "UPDATE visa SET
        vno = ?,
        expiry_date = ?,
        date_of_issue = ?,
        valid_for = ?,
        visa_type = ?,
        visa_sub_type = ?
        WHERE applicant_id = ?";
    $stmtVisa = $conn->prepare($visaUpdateQuery);
    $stmtVisa->bind_param("ssssssi", $visaNo, $visaExpiryDate, $visaDateOfIssue, $visaValidFor, $visaType, $visaSubType, $userId);
    if (!$stmtVisa->execute()) {
        $success = false;
    }

    // Update emergency contact details
    $emergencyName = $_POST['name'];
    $emergencyRelationship = $_POST['relationship'];
    $emergencyContact = $_POST['contact'];
    $emergencyEmail = $_POST['email'];
    $emergencyUpdateQuery = "UPDATE emergency_contact SET
        name = ?,
        relationship = ?,
        contact = ?,
        email = ?
        WHERE applicant_id = ?";
    $stmtEmergency = $conn->prepare($emergencyUpdateQuery);
    $stmtEmergency->bind_param("ssssi", $emergencyName, $emergencyRelationship, $emergencyContact, $emergencyEmail, $userId);
    if (!$stmtEmergency->execute()) {
        $success = false;
    }

    // Update applicant details
    $surname = $_POST['surname'];
    $givenName = $_POST['given_name'];
    $sex = $_POST['sex'];
    $fatherName = $_POST['father_name'];
    $spouseName = $_POST['spouse_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $profession = $_POST['profession'];
    $newBornChild = $_POST['new_born_child'];
    $militaryService = $_POST['military_service'];
    $refuge = $_POST['refuge'];
    $applicantUpdateQuery = "UPDATE applicant SET
        surname = ?,
        given_name = ?,
        sex = ?,
        father_name = ?,
        spouse_name = ?,
        dob = ?,
        email = ?,
        profession = ?,
        new_born_child = ?,
        military_service = ?,
        refuge = ?
        WHERE id = ?";
    $stmtApplicant = $conn->prepare($applicantUpdateQuery);
    $stmtApplicant->bind_param("ssssssssssii", $surname, $givenName, $sex, $fatherName, $spouseName, $dob, $email, $profession, $newBornChild, $militaryService, $refuge, $userId);
    if (!$stmtApplicant->execute()) {
        $success = false;
    }

    if ($success) {
        echo '<script>alert("Details updated successfully."); window.location.href = "registeredHome.php";</script>';
    } else {
        echo '<script>alert("Error updating details. Please try again.");</script>';
    }
}

$conn->close();
?>
