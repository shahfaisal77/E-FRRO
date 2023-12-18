<?php
// Include the database connection details
require 'db_connect.php';

// Fetch records from the new_user_registration table where type is 'user'
$query = "SELECT id, email, gender, nationality, mobile, given_name, date_of_birth, passport_number
          FROM new_user_registration
          WHERE type = 'user'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Registered Users</title>
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
    .btn-secondary {
      margin-bottom: 20px;
    }
    /* Add styling to make the "Status" text bold */
    .bold-status {
      font-weight: bold; /* Make the text bold */
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Add a back button to go back to admin_home.php -->
    <a href="admin_home.php" class="btn btn-secondary">&lt; Back to Admin Home</a>
    <h2 class="text-center mt-4">All Users</h2>

    <!-- Show registered users in the main part -->
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Nationality</th>
          <th>Mobile</th>
          <th>Given Name</th>
          <th>Date of Birth</th>
          <th>Passport Number</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['gender']; ?></td>
          <td><?php echo $row['nationality']; ?></td>
          <td><?php echo $row['mobile']; ?></td>
          <td><?php echo $row['given_name']; ?></td>
          <td><?php echo $row['date_of_birth']; ?></td>
          <td><?php echo $row['passport_number']; ?></td>
          <td class="bold-status">
            <?php
            // Check the status_inquiry column from the applicant table
            $applicantId = $row['id'];
            $statusQuery = "SELECT status_inquiry FROM applicant WHERE id = $applicantId";
            $statusResult = $conn->query($statusQuery);
            $statusRow = $statusResult->fetch_assoc();

            // Display the status or "Not Applied" if null
            echo isset($statusRow['status_inquiry']) ? $statusRow['status_inquiry'] : 'Not Applied';
            ?>
          </td>
          <td>
            <!-- Add a "Delete" button with a confirmation dialog -->
            <button class="btn btn-danger" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Link Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function confirmDelete(userId) {
      if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = "delete_reg_user.php?id=" + userId;
      }
    }
  </script>
</body>
</html>
