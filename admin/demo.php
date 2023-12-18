<?php
session_start();

require 'db_connect.php';
require '../vendor/autoload.php';
require_once '../vendor/setasign/fpdf/fpdf.php';
require_once '../vendor/setasign/fpdi/src/autoload.php';
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

use setasign\Fpdi\Fpdi;

// Fetch applicant details from the database
// Assuming you want to get 'id' from the URL
if (isset($_GET['id'])) {
    $applicantId = $_GET['id'];

    // Add the query to update the status_inquiry to 'accepted'
    $query = "UPDATE applicant SET status_inquiry = 'accepted' WHERE id = $applicantId";
    $conn->query($query);

    // Fetch applicant details
    $applicantQuery = "SELECT * FROM applicant WHERE id = $applicantId";
    $applicantResult = $conn->query($applicantQuery);
    $applicantData = $applicantResult->fetch_assoc();

    // Fetch passport details
    $passportQuery = "SELECT * FROM passport WHERE applicant_id = $applicantId";
    $passportResult = $conn->query($passportQuery);
    $passportData = $passportResult->fetch_assoc();

    // Fetch visa details
    $visaQuery = "SELECT * FROM visa WHERE applicant_id = $applicantId";
    $visaResult = $conn->query($visaQuery);
    $visaData = $visaResult->fetch_assoc();

    // Fetch address details
    $addressQuery = "SELECT * FROM address WHERE type = 'Applicant' LIMIT 1";
    $addressResult = $conn->query($addressQuery);
    $addressData = $addressResult->fetch_assoc();

    // Use the given_name directly from the applicant data
    $givenName = $applicantData['given_name'];
} else {
    // Default to a specific applicant ID or handle the case when 'id' is not provided
    $applicantId = 1;
}

// Generate random service number
$serviceNumber = generateRandomCharacters();

// Create PDF using FPDF and FPDI
$pdfFpdi = new Fpdi();
$pdfFpdi->AddPage();

// Set font for heading
$pdfFpdi->SetFont('Arial', 'B', 16);

// Add a heading with the logo
$pdfFpdi->Image('images/police1.png', 80, 10, 50); // Adjust coordinates and size as needed
$pdfFpdi->Ln(15);
$pdfFpdi->Cell(0, 20, '', 0, 1); // Add an empty line to create space between the logo and the text
$pdfFpdi->Cell(0, 10, 'e-FRRO', 0, 1, 'C'); // Adjust the Y-coordinate to move it below the logo

// Add the requested line
//$pdfFpdi->Ln(5); // Add some space before the additional line
$pdfFpdi->SetFont('Arial', 'I', 10); // Italic for the additional line
$pdfFpdi->Cell(0, 10, 'Foreigners Registration Office', 0, 1, 'C');
$pdfFpdi->Cell(0, 10, 'Police Commissioner Office, Sadhu Vaswani Road, Pune Urban-411001', 0, 1, 'C');

// Section to display Longer Stay Address
$pdfFpdi->SetMargins(10, 10, 10); // Set explicit margins
$pdfFpdi->SetY(10); // Set Y-coordinate for the top left corner
$pdfFpdi->SetX(10); // Set X-coordinate for the top left corner

// Initial dimensions for the border container
$borderWidth = 50;
$borderHeight = 40;

// Draw a border around the section
$pdfFpdi->Rect(10, 10, $borderWidth, $borderHeight);

$pdfFpdi->SetFont('Arial', '', 12);

// Check if $addressData is not null
if ($addressData !== null) {
    $fullAddress = $addressData['address'] . ', ' . $addressData['city'] . ', ' . $addressData['state'];

    // Calculate the number of lines based on the available height
    $lineHeight = 10; // Assuming a line height of 10
    $numLines = ceil($pdfFpdi->GetStringWidth($fullAddress) / ($borderWidth - 10));

    // Adjust the height of the border container based on the text
    $newBorderHeight = $numLines * $lineHeight + 10; // Adding extra space

    // Check if the new height is greater than the original height
    if ($newBorderHeight > $borderHeight) {
        // Reset the height of the border
        $pdfFpdi->Rect(10, 10, $borderWidth, $newBorderHeight);

        // Adjust the position for the text inside the border
        $pdfFpdi->SetY(15); // Adjust Y-coordinate for the text inside the border
        $pdfFpdi->SetX(15); // Adjust X-coordinate for the text inside the border

        // Display the address, city, and state with original line height
        $pdfFpdi->MultiCell($borderWidth - 10, $lineHeight, $fullAddress, 0, 'L', false, 1, '', '', true, 0, false, true, 10, 'T');
    } else {
        // Display the address without resetting the height
        $pdfFpdi->SetY(15); // Adjust Y-coordinate for the text inside the border
        $pdfFpdi->SetX(15); // Adjust X-coordinate for the text inside the border
        $pdfFpdi->MultiCell($borderWidth - 10, $lineHeight, $fullAddress, 0, 'L', false, 1, '', '', true, 0, false, true, 10, 'T');
    }

} else {
    // Display a message if the address is not available
    $pdfFpdi->MultiCell($borderWidth - 10, $borderHeight - 10, 'Address not available'); // Subtracting extra space
}



// New Section: Service Granted
$pdfFpdi->SetFont('Arial', 'B', 14);
$pdfFpdi->SetFillColor(255, 255, 0); // Yellow background for highlighting
$pdfFpdi->SetY(80); // Adjust the Y-coordinate to move the entire section down
$pdfFpdi->Cell(0, 10, 'SERVICE GRANTED', 1, 1, 'C', true); // Highlighted section heading with border
$pdfFpdi->SetFont('Arial', 'B', 12); // Bold for the service granted date
$pdfFpdi->Cell(0, 10, 'Visa extended from ' . date('Y-m-d') . ' till ' . date('Y-m-d', strtotime('+11 months')), 1, 1, 'C');
$pdfFpdi->SetFont('Arial', '', 12);
//$pdfFpdi->Ln(10); // Add some space after the section



// Section 1: Service Number
$pdfFpdi->Ln(10);
$allowedExtensions = ['jpg', 'jpeg'];
$imageFile = null;

foreach ($allowedExtensions as $extension) {
    $potentialImagePath = "../uploads/new_registration_applications/$givenName/image.$extension";

    if (file_exists($potentialImagePath)) {
        $imageFile = $potentialImagePath;
        break;
    }
}

if ($imageFile !== null) {
    $pdfFpdi->Image($imageFile, $pdfFpdi->GetX() + 160, $pdfFpdi->GetY() + 15, 30);
} else {
    echo 'Image file does not exist: ' . $imagePath;
}

$pdfFpdi->Cell(0, 10, 'Service Number: ' . $serviceNumber, 0, 1, 'L');

// Section 2: Applicant Details
$pdfFpdi->Ln(5);
$pdfFpdi->SetFont('Arial', 'B', 14);
$pdfFpdi->Cell(0, 10, 'Applicant Details', 0, 1, 'L');
$pdfFpdi->SetFont('Arial', '', 12);

$details = array(
    'Surname' => $applicantData['surname'],
    'Given Name' => $applicantData['given_name'],
    'Sex' => $applicantData['sex'],
    'Date of Birth' => $applicantData['dob'],
    'Email' => $applicantData['email'],
    'Profession' => $applicantData['profession']
);

numberedDetails($pdfFpdi, $details);

// Section 3: Passport Details
$passportDetailsX = 80; // Adjust as needed
$passportDetailsY = $pdfFpdi->GetY() - 70; // Adjust the Y-coordinate to move it up

$pdfFpdi->SetXY($passportDetailsX, $passportDetailsY);
$pdfFpdi->SetFont('Arial', 'B', 14);
$pdfFpdi->Cell(0, 10, 'Passport Details', 0, 1, 'L');
$pdfFpdi->SetFont('Arial', '', 12);

$passportDetails = array(
    'Passport Number' => $passportData['pno'],
    'Date of Issue' => $passportData['date_of_issue'],
    'Expiry Date' => $passportData['expiry_date']
);

// Adjust the X-coordinate for each detail in Passport Details
$count = 1; // Counter variable

foreach ($passportDetails as $label => $value) {
    $pdfFpdi->SetX($passportDetailsX);
    $pdfFpdi->Cell(0, 10, "$count. $label: $value", 0, 1);
    $count++;
}



// Section 4: Visa Details
$pdfFpdi->Ln(40);
$pdfFpdi->SetFont('Arial', 'B', 14);
$pdfFpdi->Cell(0, 10, 'Visa Details', 0, 1, 'L');
$pdfFpdi->SetFont('Arial', '', 12);

$visaDetails = array(
    'Visa Number' => $visaData['vno'],
    'Date of Issue' => $visaData['date_of_issue'],
    'Expiry Date' => $visaData['expiry_date'],
    'Valid For' => $visaData['valid_for']
);

numberedDetails($pdfFpdi, $visaDetails);

// Footer
$pdfFpdi->Ln(5);
$pdfFpdi->SetFont('Arial', 'B', 10);
$pdfFpdi->Cell(0, 10, 'Date: ' . date('Y-m-d') . '                 Issued by: FRRO                 Tel No.: 02222621169                 Email: frromum@nic.in', 0, 1, 'L');
$pdfFpdi->SetFont('Arial', 'I', 10);
//$pdfFpdi->Cell(0, 10, '*. This is a computer-generated document and does not require a signature/stamp.', 0, 1, 'L');


// Save PDF to a file
$folderName = '../accepted_applications/new_registration/' . $givenName;
if (!is_dir($folderName)) {
    mkdir($folderName, 0777, true);
}

$pdfFileName = $folderName . '/application_acceptance.pdf';
$pdfFpdi->Output('F', $pdfFileName);

// Function to generate random characters
function generateRandomCharacters($length = 8)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

// Helper function to number and display details in PDF
function numberedDetails($pdf, $details)
{
    $count = 1;
    foreach ($details as $label => $value) {
        $pdf->Cell(0, 10, "$count. $label: $value", 0, 1);
        $count++;
    }
}
?>
