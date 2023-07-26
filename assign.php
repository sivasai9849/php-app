<?php


if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit;
}

require_once "./db/connect.php"; // Replace with the correct path to your connect.php file



function fetchDeliveryAgents()
{
    global $conn; // Assuming $conn is the database connection variable defined in connect.php



    // SQL query to fetch delivery agent names
    $agentsSql = "SELECT * FROM deliveryagent";

    // Execute the query
    $agentsResult = $conn->query($agentsSql);



    // Check if any rows are returned
    while ($agentRow = $agentsResult->fetch_assoc()) {
        echo "<option value='" . $agentRow["agent_id"] . "'>" . $agentRow["agent_name"] . "</option>";
    }

    echo "</select>";
    echo "<button class='col-sm-6 btn btn-primary  m-2 d-flex justify-content-center' id='reloadButton' onclick='assignTrips()'>Assign Selected Trips</button>";
}



?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- First Column - Delivery Agents -->
        <div class="col-sm-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Delivery Agents</h6>
                <div class="">
                    <select class="form-select" id="agentDropdown" aria-label="Floating label select example">
                        <option value=''>Select Delivery Agents</option>
                        <?php fetchDeliveryAgents() ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Second Column - Remove Button -->
        <div class="col-sm-6 d-flex justify-content-center align-items-center">
            <button class="btn btn-primary  m-2" onclick="handleAssignedCheckboxClick()">Remove Selected Assignments</button>
        </div>
    </div>
</div>



<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Customers Data</h6>
            <a href="#">Show All</a>
        </div>
        <div class="table-responsive">
        <?php
                    include_once("fetch_children.php");
                    ?>
           
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function assignTrip(childId) {
        const agentDropdown = document.getElementById('agentDropdown');
        const selectedAgentId = agentDropdown.value;

        if (!selectedAgentId) {
            alert("Please select an agent for assignment.");
            return;
        }

        $.ajax({
            method: 'POST',
            url: 'assign_trip.php',
            data: {
                childId: childId,
                agentId: selectedAgentId
            },
            success: function(response) {
                const agentName = response.agentName;
                const date = response.date;
                const statusCell = document.getElementById('status_' + childId);
                if (statusCell) {
                    statusCell.innerHTML = "Assigned to Agent " + agentName + " on " + date;
                    agentDropdown.disabled = true;
                }
            },
            error: function() {
                alert('Failed to assign the trip. Please try again.');
            }
        });
    }

    function assignTrips() {
        const selectedChildIds = Array.from(document.querySelectorAll('input[name="childIds[]"]:checked')).map(el => el.value);
        const agentId = document.getElementById('agentDropdown').value;

        if (selectedChildIds.length === 0 || !agentId) {
            alert("Please select children and agent for assignment.");
            return;
        }

        selectedChildIds.forEach(childId => {
            assignTrip(childId);
        });
    }
</script>