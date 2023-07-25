<?php
// Replace the database connection details with your own
include 'db/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["childId"]) && isset($_POST["agentId"])) {
        $childId = $_POST["childId"];
        $agentId = $_POST["agentId"];

        $date = date("Y-m-d"); // Format the date as 'YYYY-MM-DD'

        // Update the trips table with the selected agent and today's date
        $updateSql = "INSERT INTO trips (c_id, agent_id, date) VALUES ($childId, $agentId, '$date')";
        if ($conn->query($updateSql) === TRUE) {
            // Fetch the agent name for the response
            $agentSql = "SELECT agent_name FROM deliveryagent WHERE agent_id = $agentId";
            $agentResult = $conn->query($agentSql);
            $agentName = $agentResult->fetch_assoc()["agent_name"];

            $response = array("agentName" => $agentName, "date" => $date);
            echo json_encode($response); // Corrected line to send JSON response
        } else {
            echo "Error updating record: " . $conn->error;
        }

    







    }
}
$conn->close();
?>