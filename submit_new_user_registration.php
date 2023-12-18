<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once 'db_connect.php';

    // Retrieve form data
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $mobile = $_POST['mobile'];
    $givenName = $_POST['given_name'];
    $dateOfBirth = $_POST['dob'];
    $passportNumber = $_POST['passport_number'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // Set the 'type' to 'user' for each insertion
    $type = 'user';

    // Perform form validation (you can add more checks based on your requirements)
    if (empty($email) || empty($gender) || empty($nationality) || empty($givenName) || empty($dateOfBirth) || empty($passportNumber) || empty($password) || empty($confirmPassword)) {
        http_response_code(400); // Bad Request
        echo "Please fill in all required fields.";
        exit;
    }

    // Check if the email already exists in the database
    $sql = "SELECT id FROM new_user_registration WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, show an alert prompt and redirect to registration.php
        echo '<script>alert("Email already exists. Please use a different email."); window.location.href = "new_user_registration.php";</script>';
        exit;
    }

    // Check if the passport number already exists in the database
    $sql = "SELECT id FROM new_user_registration WHERE passport_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $passportNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Passport number already exists, show an alert prompt and redirect to registration.php
        echo '<script>alert("Passport number already exists. Please use a different passport number."); window.location.href = "new_user_registration.php";</script>';
        exit;
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match. Please re-enter your password."); window.location.href = "new_user_registration.php";</script>';
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert data into the database, including the 'type' column
    $sql = "INSERT INTO new_user_registration (email, password, gender, nationality, mobile, given_name, date_of_birth, passport_number, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $email, $hashedPassword, $gender, $nationality, $mobile, $givenName, $dateOfBirth, $passportNumber, $type);

    // Check if the query is successful
    if ($stmt->execute()) {
        // Close the prepared statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        // Show a JavaScript prompt and redirect to index.php with a success message
        echo '<script>alert("You are now successfully registered!"); window.location.href = "index.php";</script>';
        exit;
    } else {
        // Return an error message
        http_response_code(500); // Internal Server Error
        echo "Error: Unable to insert registration data.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method not allowed.";
}
?>
