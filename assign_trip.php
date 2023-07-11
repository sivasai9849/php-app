<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit;
}

require_once "./db/connect.php"; // Replace with the correct path to your connect.php file
global $conn;
if (isset($_POST["cId"]) && isset($_POST["agentId"])) {
    $cId = $_POST["cId"];
    $date = date("Y-m-d");
    $agentId = $_POST["agentId"]; // Use the selected agent ID from the AJAX request

    // Insert the trip into the trips table
    $sql = "INSERT INTO trips (date, c_id, agent_id) VALUES ('$date', '$cId', '$agentId')";

    if ($conn->query($sql) === TRUE) {
        echo "Trip assigned successfully.";
    } else {
        echo "Error assigning trip: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
