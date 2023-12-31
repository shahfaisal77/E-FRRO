<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Main Registration Page</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Your HTML content goes here -->

    <!-- Modal Dialog for Documents Required Alert -->
    <div class="modal fade" id="documentsRequiredModal" tabindex="-1" role="dialog" aria-labelledby="documentsRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentsRequiredModalLabel">Documents Required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    // Check the selected service and display the corresponding documents
                    $selectedService = isset($_SESSION['services']) ? $_SESSION['services'] : '';
                    if ($selectedService === 'Registration') {
                        echo '
                            <strong>PASSPORT:</strong><br>
                            Bio data page of passport<br><br>

                            <strong>RESIDENCE PROOF:</strong><br>
                            Updated Form "C" generated by hotel/lodge or registered/notarized lease deed or utility copy along with a copy of photo ID of the landlord with a declaration.<br><br>

                            <strong>VISA DETAIL:</strong><br>
                            Copy of the latest Indian visa<br><br>

                            <strong>PHOTO:</strong><br>
                            Applicant\'s photo
                        ';
                    } elseif ($selectedService === 'Registration_Extension') {
                        echo '
                            <strong>BONAFIDE CERTIFICATE:</strong><br>
                            Bonafide certificate to be obtained from a UGC or AICTE recognized institute/college/university mentioning Foreign Students Information System (FSIS) no, course undertaken, duration of the course, and email ID of the institute/college/university.<br><br>

                            <strong>PASSPORT:</strong><br>
                            Bio data page of passport along with the page bearing the last Indian immigration arrival stamp<br><br>

                            <strong>REGISTRATION CERTIFICATE:</strong><br>
                            FRRO/FRO registration certificate/residential permit of the student (S-1) visa holder<br><br>

                            <strong>RESIDENCE PROOF:</strong><br>
                            Residence certificate from hostel/updated Form "C" generated by hostel/lodge or registered/notarized lease deed, utility bill, copy of photo ID of the landlord along with a declaration and tenant police verification<br><br>

                            <strong>VISA:</strong><br>
                            Indian visa<br><br>

                            <strong>PHOTO:</strong><br>
                            Applicant\'s photo<br><br>

                            <strong>FINANCIAL RESOURCE PROOF:</strong><br>
                            NRO account details and scholarship letter (if any)
                        ';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="goBack()">Close</button>
                    <form method="post" action="" id="registrationForm">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript code to check if the selected service is "Registration" or "Registration Extension" and show the modal dialog -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Check the selected service on page load
        document.addEventListener('DOMContentLoaded', function() {
            var selectedService = "<?php echo isset($_SESSION['services']) ? $_SESSION['services'] : ''; ?>";
            if (selectedService === 'Registration' || selectedService === 'Registration_Extension') {
                // Show the modal dialog
                $('#documentsRequiredModal').modal('show');
                
                // Update the form's action attribute based on the selected service
                if (selectedService === 'Registration') {
                    document.getElementById('registrationForm').action = 'mainRegistrationForm.php';
                } else if (selectedService === 'Registration_Extension') {
                    document.getElementById('registrationForm').action = 'mainExtensionForm.php';
                }
            }
        });

        // Function to navigate back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
