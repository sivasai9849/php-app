<?php

//Comment the below connection if you are running on localhost

$servername = getenv('host') ? getenv('host') : 'mysql'; // Replace with your server name
$username = getenv('user') ? getenv('user') : 'lunchbox'; // Replace with your MySQL username
$password = getenv('password') ? getenv('password') : 'Lunchbox@123'; // Replace with your MySQL password
$dbname = getenv('database') ? getenv('database') : 'lunchbox'; // Replace with your database name


//Unomment the below connection if you are running on localhost

//$servername = "localhost"; // Replace with your server name
//$username = "root"; // Replace with your MySQL username
//$password = ""; // Replace with your MySQL password
//$dbname = "lunchbox"; // Replace with your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connected successfully


echo "Connected successfully to the database.";


// Close connection
// $conn->close();
?>
