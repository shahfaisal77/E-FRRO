
<?php
// Include the database connection details
require 'db_connect.php';

// Fetch records from the applicant table where service_selected is 'Registration' and status_inquiry is not 'rejected' or 'accepted'
$query = "SELECT id, given_name, sex, email, status_inquiry
          FROM applicant 
          WHERE service_selected = 'Registration_Extension' AND status_inquiry <> 'rejected' AND status_inquiry <> 'accepted'
          ORDER BY id ASC"; // Sorted by ID in descending order - latest applicants will come first
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Registration Applications</title>
  <!-- Link Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #F5F5F5;
    }
    .container {
      border: 2px solid #5dade2;
      border-radius: 5px;
      padding: 20px;
      margin-top: 50px;
    }
    .table {
      margin-top: 30px;
    }
    .thead-light {
      background-color: #E9ECEF;
      border-color: #5dade2;
    }
    .btn-action {
      margin-right: 10px;
    }
    .btn-secondary {
      margin-bottom: 20px;
    }
    .rejected {
      margin-top: 50px; /* Add margin to the rejected section */
    }
    .rejected h3 {
      color: #dc3545; /* Use red color for the section header */
    }
    .accepted {
      margin-top: 50px; /* Add margin to the accepted section */
    }
    .accepted h3 {
      color: #28a745; /* Use green color for the section header */
    }
    .text-danger {
      color: #dc3545; /* Use red color for the rejected message */
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Add a back button to go back to admin_home.php -->
    <a href="admin_home.php" class="btn btn-secondary">&lt; Back to Admin Home</a>
    <h2 class="text-center mt-4">Registration Extension Applications</h2>

    <!-- Show applicant section in the main part -->
    <h3 style="color: #007bff;">Pending Applications</h3>
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>Given Name</th>
          <th>Sex</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['given_name']; ?></td>
          <td><?php echo $row['sex']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td>
    <?php if ($row['status_inquiry'] === 'rejected') { ?>
        <button class="btn btn-danger btn-action" disabled>Reject (Meet in FRRO)</button>
        <a href="#" class="btn btn-danger btn-action" onclick="deleteApplication(<?php echo $row['id']; ?>);">Delete</a>
        <span class="text-danger">Rejected</span> <!-- Show the rejected message -->
    <?php } else { ?>
        <div class="btn-group">
            <a href="view_details_extension.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-action">View Details</a>
            <a href="request_missing_documents_Extension.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-action">Ask for Missing Documents</a>
            <a href="#" class="btn btn-success btn-action" onclick="confirmAccept(event, <?php echo $row['id']; ?>);">Accept</a>
            <a href="javascript:confirmReject(<?php echo $row['id']; ?>);" class="btn btn-danger btn-action">Reject (Meet in FRRO)</a>
        </div>
    <?php } ?>
</td>


        </tr>
        <?php } ?>
      </tbody>
    </table>
    <hr>

    <!-- Show accepted applicants in a separate section at the bottom -->
    <div class="accepted">
      <h3>Accepted Applicants</h3>

      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Given Name</th>
            <th>Sex</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Fetch accepted applicants
          $query = "SELECT id, given_name, sex, email
                    FROM applicant 
                    WHERE service_selected = 'Registration_Extension' AND status_inquiry = 'accepted'
                    ORDER BY id DESC"; // Sorted by ID in descending order - latest accepted applicants will come first
          $accepted = $conn->query($query);

          while ($row = $accepted->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['given_name']; ?></td>
            <td><?php echo $row['sex']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
            <button class="btn btn-success btn-action" disabled>Accept</button>
              <a href="#" class="btn btn-danger btn-action" onclick="deleteApplication(<?php echo $row['id']; ?>);">Delete</a>
              <span class="text-success">Accepted</span> <!-- Show the accepted message -->
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
     <hr>
    <!-- Show rejected applicants in a separate section at the bottom -->
    <div class="rejected">
      <h3>Rejected Applicants</h3>

      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Given Name</th>
            <th>Sex</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Fetch rejected applicants
          $query = "SELECT id, given_name, sex, email
                    FROM applicant 
                    WHERE service_selected = 'Registration_Extension' AND status_inquiry = 'rejected'
                    ORDER BY id DESC"; // Sorted by ID in descending order - latest rejected applicants will come first
          $rejected = $conn->query($query);

          while ($row = $rejected->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['given_name']; ?></td>
            <td><?php echo $row['sex']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
              <button class="btn btn-danger btn-action" disabled>Reject (Meet in FRRO)</button>
              <a href="#" class="btn btn-danger btn-action" onclick="deleteApplication(<?php echo $row['id']; ?>);">Delete</a>
              <span class="text-danger">Rejected</span> <!-- Show the rejected message -->
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  

  <!-- JavaScript function for confirmation -->
  <script>
   function confirmReject(applicantId) {
    var confirmation = confirm("Are you sure you want to reject the application of this user?");
    if (confirmation) {
        window.location.href = "reject_application.php?id=" + applicantId;
    } else {
        // Redirect to new_registration_application.php when the user clicks "Cancel"
        window.location.href = "new_registration_application.php";
    }
}





function confirmAccept(event, applicantId) {
    event.preventDefault(); // Prevent the default anchor tag behavior

    if (confirm("Do you want to generate the PDF file and send an email to the user?")) {
      window.location.href = "accept_application_extension.php?id=" + applicantId;
    } else {
      // User clicked "Cancel" - Stay on the same page
    }
  }




function deleteApplication(id) {
    if (confirm("Are you sure you want to delete the application record of this user?")) {
        window.location.href = "reject_application_extension?id=" + id;
    } else {
        // Redirect to new_registration_application.php when the user clicks "Cancel"
        window.location.href = "registration_extension.php";
    }
}

  </script>

  <!-- Link Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
