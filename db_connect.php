<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'frro';

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
