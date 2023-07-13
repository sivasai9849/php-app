<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "./db/connect.php"; // Replace with the correct path to your connect.php file

if (isset($_POST["cId"]) && isset($_POST["agentId"])) {
    $cId = $_POST["cId"];
    $date = date("Y-m-d");
    $agentId = $_POST["agentId"]; // Use the selected agent ID from the AJAX request

    // Prepare the SQL statement to avoid SQL injection
    $sql = "INSERT INTO trips (date, c_id, agent_id) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $date, $cId, $agentId);

    if ($stmt->execute()) {
        echo "Trip assigned successfully.";
    } else {
        echo "Error assigning trip: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>