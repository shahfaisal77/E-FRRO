<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Foreign Student Registration</title>
    <!-- Include Bootstrap CSS and Font Awesome for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom styles for a more creative look -->
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
    margin-top: 50px;
    background-color: #fff;
    margin-top: 30px;
    transition: box-shadow 0.1s ease; /* Add transition for a smooth effect */
}

.container.hovered {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Increase the blur radius on hover */
    transform: scale(1.05); /* Increase the size on hover */
    transition: transform 0.3s ease-in; /* Add transition for a smooth scaling effect on hover */
}


.navbar {
    z-index: 1; /* Ensure the navbar stays above the scaled container */
}

h2:hover {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Increase the blur radius on hover */
    transform: scale(1.05); /* Increase the size on hover */
}

/* Your existing styles remain unchanged */

/* Rest of your styles... */


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
        color: #007bff !important;
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
        border: 1px solid #007bff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border: 1px solid #0062cc;
    }

    .login-icon {
        font-size: 36px;
        margin-right: 10px;
        color: #007bff;
    }
</style>



</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-university mr-2"></i>Foreign Student Registration
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="new_user_registration.php"><i class="fas fa-user-plus"></i> New Registration</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4"><i class="fas fa-sign-in-alt login-icon"></i>Login</h2>
        <form id="loginForm" method="post">
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email Id</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type"><i class="fas fa-user"></i> Type</label>
                <select id="type" name="type" class="form-control">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>
        // Add event listener to the form to dynamically set the action attribute
        document.getElementById("loginForm").addEventListener("submit", function (e) {
            const type = document.getElementById("type").value;
            if (type === "user") {
                this.action = "check_login.php";
            } else if (type === "admin") {
                this.action = "check_admin_login.php";
            }
        });
    </script>


<script>
        document.addEventListener('DOMContentLoaded', function () {
            var container = document.querySelector('.container');

            container.addEventListener('mouseenter', function () {
                container.classList.add('hovered');
            });

            container.addEventListener('mouseleave', function () {
                container.classList.remove('hovered');
            });
        });
    </script>
</body>

</html>
