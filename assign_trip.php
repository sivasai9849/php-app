<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "./db/connect.php"; // Replace with the correct path to your connect.php file

if (isset($_POST["cId"]) && isset($_POST["agentId"])) {
    $cId = $_POST["cId"];
    $date = date('Y-m-d');
    $agentId = $_POST["agentId"]; // Use the selected agent ID from the AJAX request

    // Check if a trip with the same child ID and date already exists
    $checkSql = "SELECT * FROM trips WHERE c_id = ? AND date = ?";
    $getAgentIdSql = "SELECT agent_name FROM deliveryagent WHERE agent_id = ?";
    
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $cId, $date);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Trip already assigned
        $getAgentIdStmt = $conn->prepare($getAgentIdSql);
        $getAgentIdStmt->bind_param("s", $agentId);
        $getAgentIdStmt->execute();
        $getAgentIdResult = $getAgentIdStmt->get_result();

        if ($getAgentIdResult->num_rows > 0) {
            $agentData = $getAgentIdResult->fetch_assoc();
            $agentName = $agentData["agent_name"];
            echo "Trip assigned to " . $agentName;
        } else {
            echo "Agent not found.";
        }

        $getAgentIdStmt->close();
    } else {
        // Prepare the SQL statement to insert the trip
        $insertSql = "INSERT INTO trips (date, c_id, agent_id) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("sss", $date, $cId, $agentId);

        if ($insertStmt->execute()) {
            echo "" . $agentName;
        } else {
            echo "Error assigning trip: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}


?>