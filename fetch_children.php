<?php
// Replace the database connection details with your own
include 'db/connect.php';

$sql = "SELECT * FROM child c JOIN parent p ON c.p_id = p.p_id JOIN school s ON c.s_id = s.s_id JOIN address a ON a.addr_id=p.addr_id ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "</tbody>";
    echo "</table>";

    // Dropdown for agent selection
    echo "<label for='agentDropdown'>Select Agent: </label>";
    echo "<select id='agentDropdown'>";
    echo "<option value=''>Select Agent</option>";

    // Fetch delivery agents from the deliveryagent table
    $agentsSql = "SELECT * FROM deliveryagent";
    $agentsResult = $conn->query($agentsSql);
    while ($agentRow = $agentsResult->fetch_assoc()) {
        echo "<option value='" . $agentRow["agent_id"] . "'>" . $agentRow["agent_name"] . "</option>";
    }

    echo "</select>";
    echo "<button id='reloadButton' onclick='assignTrips()'>Assign Selected Trips</button>";




    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Parent Name</th>";
    echo "<th>Address</th>";
    echo "<th>Child Name</th>";
    echo "<th>School</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";


    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["p_name"] . "</td>";
        echo "<td>" . $row["apartment"] . "</td>";
        echo "<td>" . $row["c_name"] . "</td>";
        echo "<td>" . $row["s_name"] . "</td>";

        // Check if the trip is already assigned
        $tripSql = "SELECT * FROM trips WHERE c_id = " . $row["c_id"];
        $tripResult = $conn->query($tripSql);
        if ($tripResult->num_rows > 0) {
            $tripRow = $tripResult->fetch_assoc();
            $agentId = $tripRow["agent_id"];
            $tripStatus = "Assigned to Agent " . $agentId . " on " . $tripRow["date"];
            echo "<td id='status_" . $row["c_id"] . "'>" . $tripStatus . "</td>";
        } else {
            // If trip is not assigned, display checkbox for assignment
            echo "<td><input type='checkbox' id='checkbox_" . $row["c_id"] . "' name='childIds[]' value='" . $row["c_id"] . "'></td>";
        }

        echo "</tr>";
    }
} else {
    echo "<p>No records found</p>";
}

$conn->close();


echo "
<script>
    // Function to reload the page when the button is clicked
    function reloadPage() {
      location.reload();
    }

    // Get a reference to the button element
    const reloadButton = document.getElementById('reloadButton');

    // Attach the event listener to the button
    reloadButton.addEventListener('click', reloadPage);
  </script>
  ";

?>
