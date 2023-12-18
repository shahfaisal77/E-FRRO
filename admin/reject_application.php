<?php
// Include the database connection details
require 'db_connect.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Start the session if needed

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Get the 'id' from the URL
    $applicant_id = $_GET['id'];

    // Check if the current status is already 'rejected'
    $check_query = "SELECT status_inquiry, email, given_name FROM applicant WHERE id = $applicant_id";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentStatus = $row['status_inquiry'];
        $applicantEmail = $row['email'];
        $applicantName = $row['given_name'];

        if ($currentStatus === 'rejected') {
            // Application is already rejected, display an alert and then redirect back to the previous page (new_registration_application.php)
            echo '<script>alert("Application is already rejected."); window.location.href="new_registration_application.php";</script>';
            exit();
        } else {
            // Update the status_inquiry to 'rejected' for the specified applicant
            $update_query = "UPDATE applicant SET status_inquiry = 'rejected' WHERE id = $applicant_id";

            if ($conn->query($update_query) === TRUE) {
                // Successfully updated the status, send rejection email
                sendRejectionEmail($applicantEmail, $applicantName);
                
                // Display an alert and then redirect back to the previous page (new_registration_application.php)
                echo '<script>alert("Application has been rejected. An email has been sent to the applicant."); window.location.href="registration_extension.php";</script>';
                exit();
            } else {
                echo "Error updating status: " . $conn->error;
            }
        }
    } else {
        echo "Error checking the current status.";
    }
} else {
    echo "Invalid request. No 'id' parameter provided.";
}

function sendRejectionEmail($recipientEmail, $recipientName)
{
    try {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'nnn128422@gmail.com'; // Replace with your email
        $mail->Password = 'xjry amxx czoa vwjf'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('nnn128422@gmail.com', 'noreply-efrro@nic.in'); // Replace with your email and name
        $mail->addAddress($recipientEmail, $recipientName); // Replace with applicant's email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Visa Application Status';
        $mail->Body = 'Dear ' . $recipientName . ',<br>Your visa application for Registration Extension has been rejected. Please visit our FRRO office as soon as possible for further assistance.<br>Thank you.';

        $mail->send();
    } catch (Exception $e) {
        // Handle the exception as needed
        echo "Email could not be sent. Mailer Error: " . $e->getMessage();
    }
}
?>
