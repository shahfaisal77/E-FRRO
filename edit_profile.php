
<?php
// Start the session
session_start();

// Include the database connection details
require 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}

// Get the user's ID from the session
$userId = $_SESSION['user_id'];

// Fetch the user's profile info from the new_user_registration table
$query = "SELECT email, gender, nationality, given_name, date_of_birth, passport_number, mobile, password FROM new_user_registration WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    // Check for a query preparation error
    echo "<script>alert('query not prepared.'); window.location.href='registeredHome.php';</script>";
    exit();
}

$stmt->bind_param("i", $userId);
$stmt->execute();

if ($stmt->error) {
    // Check for a query execution error
    echo "<script>alert('query not executed.'); window.location.href='registeredHome.php';</script>";
    exit();
}

$stmt->bind_result($email, $gender, $nationality, $name, $dob, $passport, $mobile, $password);
$stmt->fetch();
$stmt->close();

// Disable all fields except email and mobile number
$emailDisabled = "";
$genderDisabled = "disabled";
$nationalityDisabled = "disabled";
$nameDisabled = "disabled";
$dobDisabled = "disabled";
$passportDisabled = "disabled";
$mobileDisabled = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the new email and mobile number from the form
    $newEmail = $_POST["email"];
    $newMobile = $_POST["mobile"];

    // Validate the new email and mobile number
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href='edit_profile.php';</script>";
        exit();
    }

    if (!preg_match('/^[0-9]+$/', $newMobile)) {
        echo "<script>alert('Invalid mobile number format.'); window.location.href='edit_profile.php';</script>";
        exit();
    }

    // Check if the current password is correct
    $password = $_POST["password"];
    $query = "SELECT password FROM new_user_registration WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        // Check for a query preparation error
        echo "<script>alert('query not prepared.'); window.location.href='edit_profile.php';</script>";
        exit();
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    if ($stmt->error) {
        // Check for a query execution error
        echo "<script>alert('query not executed.'); window.location.href='edit_profile.php';</script>";
        exit();
    }

    $stmt->bind_result($passwordHash);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($password, $passwordHash)) {
        echo "<script>alert('Incorrect password.'); window.location.href='edit_profile.php';</script>";
        exit();
    }

    // Update the user's email and mobile number
    $query = "UPDATE new_user_registration SET email = ?, mobile = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        // Check for a query preparation error
        echo "<script>alert('query not prepared.'); window.location.href='edit_profile.php';</script>";
        exit();
    }

    $stmt->bind_param("ssi", $newEmail, $newMobile, $userId);
    $stmt->execute();

    if ($stmt->affected_rows < 1) {
        // Check if the update query succeeded
        echo "<script>alert('Failed to update user info.'); window.location.href='edit_profile.php';</script>";
        exit();
    }

    echo "<script>alert('Changes successfully saved.'); window.location.href='registeredHome.php';</script>";
    exit();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<!-- Add Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-5">
		<h1 class="text-center mb-4">Edit Profile</h1>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group row">
				<label for="email" class="col-sm-3 col-form-label">Email:</label>
				<div class="col-sm-9">
					<input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" <?php echo $emailDisabled; ?> required>
				</div>
			</div>
			<div class="form-group row">
				<label for="gender" class="col-sm-3 col-form-label">Gender:</label>
				<div class="col-sm-9">
					<select name="gender" id="gender" class="form-control" <?php echo $genderDisabled; ?>>
						<option value="male" <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male</option>
						<option value="female" <?php echo ($gender == 'female') ? 'selected' : ''; ?>>Female</option>
						<option value="other" <?php echo ($gender == 'other') ? 'selected' : ''; ?>>Other</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="nationality" class="col-sm-3 col-form-label">Nationality:</label>
				<div class="col-sm-9">
					<input type="text" name="nationality" id="nationality" class="form-control" value="<?php echo htmlspecialchars($nationality); ?>" <?php echo $nationalityDisabled;?>>
				</div>
			</div>
			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label">Name:</label>
				<div class="col-sm-9">
					<input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" <?php echo $nameDisabled; ?> required>
				</div>
			</div>
			<div class="form-group row">
				<label for="dob" class="col-sm-3 col-form-label">Date of Birth:</label>
				<div class="col-sm-9">
					<input type="date" name="dob" id="dob" class="form-control" value="<?php echo $dob; ?>" <?php echo $dobDisabled; ?> required>
				</div>
			</div>
			<div class="form-group row">
				<label for="passport" class="col-sm-3 col-form-label">Passport Number:</label>
				<div class="col-sm-9">
					<input type="text" name="passport" id="passport" class="form-control" value="<?php echo $passport; ?>" <?php echo $passportDisabled; ?> required>
				</div>
			</div>
			<div class="form-group row">
				<label for="mobile" class="col-sm-3 col-form-label">Mobile Number:</label>
				<div class="col-sm-9">
					<input type="tel" name="mobile" id="mobile" class="form-control" pattern="[0-9]{10,15}" value="<?php echo htmlspecialchars($mobile); ?>" <?php echo $mobileDisabled; ?>>
				</div>
			</div>
			<div class="form-group row">
				<label for="password" class="col-sm-3 col-form-label">Current Password:</label>
				<div class="col-sm-9">
					<input type="password" name="password" id="password" class="form-control" required>
				</div>
			</div>
			<div class="text-center">
				<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
				<a href="registeredHome.php" class="btn btn-secondary">Back</a>
			</div>
		</form>
	</div>

	<!-- Add Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
