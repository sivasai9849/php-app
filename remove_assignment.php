<?php
// Replace the database connection details with your own
include 'db/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["childId"])) {
        $childId = $_POST["childId"];

        // Delete the assignment from the trips table
        $deleteSql = "DELETE FROM trips WHERE c_id = $childId";
        if ($conn->query($deleteSql) === TRUE) {
            // Return a success response (you can customize the response as needed)
            echo "Assignment removed successfully.";
        } else {
            echo "Error removing assignment: " . $conn->error;
        }
    }
}

?>
