<?php
$host = 'localhost'; // MySQL server host
$dbUser = 'root'; // MySQL username
$dbPass = ''; // MySQL password
$dbName = 'lunchbox'; // Name of your database

// Create a new MySQLi object and establish a connection
$connection = mysqli_connect($host, $dbUser, $dbPass, $dbName);
// Check if the connection was successful
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Connection successful
// Perform database operations or queries here

// Close the database connection when done

?>
