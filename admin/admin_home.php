<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Adjust sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding-top: 15px;
            background-color: #f8f9fa;
        }

        /* Add styling for section headers */
        .section-header {
            font-weight: bold;
            padding: 10px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin-top: 20px;
        }

        /* Adjust main content styles */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Hide submenu by default */
        #adminOptions {
            display: none;
        }

        /* Show submenu when "Admin" is clicked */
        #adminOptions.show {
            display: block;
        }

        /* Add styles for the warning message */
        .warning-message {
            background-color: #ffc107;
            color: #333;
            border: 1px solid #ffca28;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }
        
        /* Bold divider line */
        hr.my-2 {
            border-top: 2px solid #ddd;
        }
    </style>

    <script>
        // Function to toggle submenu visibility
        function toggleSubMenu() {
            var submenu = document.getElementById("adminOptions");
            submenu.classList.toggle("show");
        }
    </script>
</head>

<body>

    <div class="d-flex">
        <!-- Left Sidebar -->
        <nav class="sidebar">
            <ul class="nav flex-column">
                <li class="section-header">
                    Application Options
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="new_registration_application.php">
                        New Registration Application
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration_extension.php">
                        Registration Extension
                    </a>
                </li>
            </ul>
            <!-- Add margin and bold divider line -->
            <div style="margin-top: 20px;"></div>
            <hr class="my-2">
            <ul class="nav flex-column">
                <!-- New list item for "View Registered Users" -->
                <li class="nav-item">
                    <a class="nav-link" href="view_reg_users.php">
                        View All Users
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <h1 class="mb-4">Admin Dashboard</h1>
            <!-- Place your dashboard content here -->
            <p>Welcome to the admin dashboard!</p>

            <!-- Warning Message -->
            <div class="warning-message">
                <h4>Important Warning!</h4>
                <p>As an administrator, you are expected to act within the laws and adhere to ethical standards. Please refrain from any unethical use of your privileges, taking bribes, or engaging in any illegal activities. Remember to:</p>
                <ul>
                    <li>Act ethically and responsibly.</li>
                    <li>Exercise good manners and professionalism with foreign nationals.</li>
                    <li>Ensure compliance with all applicable laws and regulations.</li>
                </ul>
                <p>Thank you for your cooperation!</p>
            </div>
        </main>

        <!-- Top Right Corner - Logout Button -->
        <div class="ml-auto mr-3 mt-3">
            <a class="btn btn-secondary" href="../login.php?logout=true">Logout</a>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
