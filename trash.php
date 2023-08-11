<?php
// Replace the database connection details with your own
include 'db/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["childIds"])) {
        $selectedChildIds = $_POST["childIds"];

        // Check if the button is clicked for the removal of assignments
        if (isset($_POST["removeAssignments"])) {
            // Remove the assignments from the trips table for selected childIds
            $childIdsString = implode(",", $selectedChildIds);
            $removeSql = "DELETE FROM trips WHERE c_id IN ($childIdsString)";
            if ($conn->query($removeSql) === TRUE) {
                echo "Assignments removed successfully!";
            } else {
                echo "Error removing assignments: " . $conn->error;
            }
        }
    }
}
$conn->close();
?>
