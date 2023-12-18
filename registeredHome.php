<?php
session_start();

// Include the database connection file
include 'db_connect.php';

// Fetch missing_docs_status from the applicant table
$user_id = $_SESSION['user_id'];
$query = "SELECT missing_docs_status FROM applicant WHERE user_id = $user_id";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $missingDocsStatus = $row['missing_docs_status'];

    // Check if missing_docs_status is not null
    if ($missingDocsStatus !== null) {
        // Display a notification or message
        echo '<div class="alert alert-warning" role="alert">
                <strong>Attention:</strong> You have something to upload on the photo and document upload link.
              </div>';
    }
}

// Close the database connection
$conn->close();
?>








<!DOCTYPE html>
<html>

<head>
  <title>Registered Home</title>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Add Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f6f6f6;
      font-family: Arial, sans-serif;
    }

    .container {
      margin-top: 40px;
    }

    .card {
      border: none;
      border-radius: 20px;
      -webkit-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.25);
      -moz-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.25);
      box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.25);
      background-color: #fff;
    }
    
    .card-header {
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      background-color: #117a8b;
      color: #fff;
    }
    
    .list-group-item {
      border: none;
      border-radius: 20px;
      transition: all .2s ease-in-out;
    }

    .list-group-item:hover {
      background-color: #b9e3eb;
      transform: translateY(-5px);
    }

    .list-group-item a:hover {
      text-decoration: none;
    }

    .list-group-item i {
      font-size: 3rem;
      margin-right: 20px;
      vertical-align: middle;
      color: #117a8b;
    }

    .list-group-item a {
      color: #4e616c;
      display: flex;
      align-items: center;
      height: 80px;
    }

    .card-body {
      margin-bottom: 40px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Registered Home</h4>
          </div>
          <div class="card-body">
            <div class="row">
              
              <!-- Fresh Application link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="check_application.php" class="list-group-item">
                  <i class="fas fa-file"></i> Fresh/New Online Application Submission
                </a>
              </div>
              <!-- Edit Application link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="edit_application_form.php" class="list-group-item">
                  <i class="fas fa-edit"></i> Edit Application Form
                </a>
              </div>
              <!-- Photo & Document upload link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="upload_missing_documents.php" class="list-group-item">
                  <i class="fas fa-upload"></i> Photo & Document Upload
                </a>
              </div>
              <!-- Reprint Application PDF link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="reprint_application.php" class="list-group-item">
                  <i class="fas fa-print"></i> Reprint Application PDF
                </a>
              </div>
              <!-- Change Password link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="change_password.php" class="list-group-item">
                  <i class="fas fa-lock"></i> Change Password
                </a>
              </div>
              <!-- Edit Profile link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="edit_profile.php" class="list-group-item">
                  <i class="fas fa-user-edit"></i> Edit Profile
                </a>
              </div>
              <!-- Status Enquiry link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="status_enquiry.php" class="list-group-item">
                  <i class="fas fa-info-circle"></i> Status Enquiry
                </a>
              </div>
              <!-- Logout link -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="#" onclick="confirmLogout();" class="list-group-item">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
              <!-- Add more links here -->
            </div>
            <div class="row">
              <!-- Add more links here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Moving message div -->
<div id="movingMessage" class="alert alert-info text-center" style="position: fixed; bottom: 80px; right: 0; width: 100%; margin: 0; background-color: #b9e3eb;">
  <span id="movingText" style="position: relative; right: 0;"><strong>Important:</strong> While applying for the application, the applicant must be present in India.</span>
</div>

<script>
  // JavaScript to make the text move to the left and loop
  var movingText = document.getElementById('movingText');
  var position = 0; // Start from the left
  var direction = 1; // Move towards the right

  function moveText() {
    position += direction;
    movingText.style.right = position + 'px';

    // Check if the text has moved beyond the window's width
    if (position >= window.innerWidth) {
      position = -movingText.offsetWidth; // Reset position to start from the left
    }

    // Repeat the movement every 10 milliseconds
    setTimeout(moveText, 10);
  }

  // Start moving the text when the page loads
  window.onload = function () {
    moveText();
  };
</script>




  <script>
    // JavaScript function to handle logout confirmation
    function confirmLogout() {
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = "logout.php";
      }
    }
  </script>







</body>

</html>
