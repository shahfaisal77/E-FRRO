<?php
// Start the session to access session data
session_start();

// Clear all session data (user data) and destroy the session
session_unset();
session_destroy();

// Redirect to the index.php page after logging out
header("Location: index.php");
exit;
?>
