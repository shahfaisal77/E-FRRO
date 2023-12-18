<?php
require '../db_connect.php'; // Adjust the path to your db_connect.php file

// Retrieve all admins from the database
$sql = "SELECT * FROM static_admin";
$result = $conn->query($sql);
$admins = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}
?>

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
                <a class="nav-link" href="#">
                    New Registration Application
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Registration Extension
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Change Of Address Application
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Change Of Course Application
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Stay Visa Extension (Only for Afghanistan nationals) Application
                </a>
            </li>
            
            <!-- "Admin" option with toggle functionality -->
            <li class="section-header">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#adminOptions" aria-expanded="false" aria-controls="adminOptions">
                    Admin <i class="fas fa-caret-down float-right"></i>
                </a>
                <ul class="nav flex-column collapse" id="adminOptions">
                    <li class="nav-item">
                        <a class="nav-link" href="add_admin.php">
                            New Admin Registration
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admins_list.php">
                            Display All Admins
                        </a>
                    </li>
                    
                </ul>
            </li>
        </ul>
        
    </nav>

    <!-- Main Content -->
    <main class="main-content">
    
    <!-- Place your dashboard content here -->
    <h2 class="mb-4">Admins List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo $admin['id']; ?></td>
                    <td><?php echo $admin['username']; ?></td>
                    <td><?php echo $admin['contact']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                    <td>
                        <a href="edit_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-primary">Modify</a>
                        <a href="remove_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

    <!-- Top Right Corner - Logout Button -->
    <div class="ml-auto mr-3 mt-3">
        <a class="btn btn-secondary" href="admin_login.php?logout=true">Logout</a>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
