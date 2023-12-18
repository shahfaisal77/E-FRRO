
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-FRRO Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
    background-image: url('uploads/registration.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

.container {
    max-width: 800px;
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 30px;
    background-color: #fff;
    transition: box-shadow 0.1s ease, transform 0.3s ease-in; /* Add transition for a smooth effect */
}

.container:hover {
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); /* Increase the blur radius to 40px on hover */
    
}

.navbar {
    z-index: 1; /* Ensure the navbar stays above the scaled container */
}

/* Your existing styles remain unchanged */

/* Rest of your styles... */


        .container:hover {
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); /* Increase the blur radius to 40px on hover */
}

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .nav-link:hover {
            color: #007bff !important;
        }

        .home-link:hover,
        .registration-link:hover {
            color: #0069d9 !important; /* Change the color on hover */
            font-weight: bold;
        }

        h2 {
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">E-FRRO Registration</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link home-link" href="index.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
    <h2 class="text-center mb-4">New Registration</h2>
        <form id="registrationForm" action="submit_new_user_registration.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="email">Email Id<span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="password">Password<span class="text-danger">*</span></label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="gender">Gender<span class="text-danger">*</span></label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="nationality">Nationality<span class="text-danger">*</span></label>
                    <input type="text" id="nationality" name="nationality" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="mobile">Mobile Number<span class="text-danger">*</span></label>
                    <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="given_name">Given Name<span class="text-danger">*</span></label>
                    <input type="text" id="given_name" name="given_name" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                    <input type="date" id="dob" name="dob" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="passport_number">Passport Number<span class="text-danger">*</span></label>
                    <input type="text" id="passport_number" name="passport_number" class="form-control" pattern="[A-Z]{2}[0-9]{7}" required>
                    <small class="form-text text-muted">Example: AB1234567</small>
                </div>
            </div>
            <!-- Add more form rows here if needed -->
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
