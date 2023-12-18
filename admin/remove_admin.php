<?php
require '../db_connect.php'; // Adjust the path to your db_connect.php file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Delete admin from the database
        $sql = "DELETE FROM static_admin WHERE id = $id";
        if ($conn->query($sql)) {
            echo "<script>alert('Admin removed successfully!'); window.location.href = 'admins_list.php';</script>";
        } else {
            echo "<script>alert('Could not remove admin. Please try again later.'); window.location.href = 'admins_list.php';</script>";
        }
    } else if (isset($_GET['confirm']) && $_GET['confirm'] === 'no') {
        // Redirect back to the previous page
        header("Location: admins_list.php");
        exit();
    } else {
        // Display confirmation dialog
        echo "<script>
                var result = confirm('Are you sure you want to remove this admin?');
                if (result) {
                    window.location.href = 'remove_admin.php?id=$id&confirm=yes';
                } else {
                    window.location.href = 'remove_admin.php?id=$id&confirm=no';
                }
            </script>";
    }
} else {
    echo "<script>alert('Admin id not provided'); window.location.href = 'admins_list.php';</script>";
}
?>
