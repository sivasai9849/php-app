    <?php
    // Replace the database connection details with your own
    include 'db/connect.php';

    $sql = "SELECT * FROM child c JOIN parent p ON c.p_id = p.p_id JOIN school s ON c.s_id = s.s_id JOIN address a ON a.addr_id=p.addr_id ";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo '<table class="table text-start align-middle table-bordered table-hover mb-0">
        <form action="index.php" method="post">
        <thead>
            <tr class="text-dark">
                <th scope="col">Parent</th>
                <th scope="col">Address</th>
                <th scope="col">child</th>
                <th scope="col">school</th>
                <th ="col">Assign</th>
            </tr>
        </thead>
         ';
        // echo "<thead>";
        // echo "<tr>";
        // echo "<th>Parent Name</th>";
        // echo "<th>Address</th>";
        // echo "<th>Child Name</th>";
        // echo "<th>School</th>";
        // echo "<th>Status</th>";
        // echo "</tr>";
        // echo "</thead>";
        // echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>" . $row["p_name"] . "</th>";
            echo "<th>" . $row["apartment"] . "</th>";
            echo "<th>" . $row["c_name"] . "</th>";
            echo "<th>" . $row["s_name"] . "</th>";
            // Check if the trip is already assigned
            $tripSql = "SELECT * FROM trips WHERE c_id = " . $row["c_id"];
            $tripResult = $conn->query($tripSql);
            if ($tripResult->num_rows > 0) {
                $tripRow = $tripResult->fetch_assoc();
                $agentId = $tripRow["agent_id"];
               $agent_name = mysqli_fetch_assoc(mysqli_query($conn,"select agent_name from deliveryagent where agent_id = '$agentId'"))['agent_name'];

                $tripStatus = "Assigned to  " . $agent_name . "  on " . $tripRow["date"];
                echo "<td id='status_" . $row["c_id"] . "'>" . $tripStatus . "</td>";

            } else {
                // If trip is not assigned, display checkbox for assignment
                echo "<td><input type='checkbox' id='checkbox_" . $row["c_id"] . "' name='childIds[]' value='" . $row["c_id"] . "'></td>";
            }

            echo " </tr>";


        }
        echo "</table>

        </form>";
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
        
