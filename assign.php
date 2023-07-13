<?php


if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit;
}

require_once "./db/connect.php"; // Replace with the correct path to your connect.php file



function fetchDeliveryAgents() {
    global $conn; // Assuming $conn is the database connection variable defined in connect.php

    // SQL query to fetch delivery agent names
    $sql = "SELECT agent_id, agent_name FROM deliveryagent";

    // Execute the query
    $result = $conn->query($sql);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Loop through the rows and fetch data
        while ($row = $result->fetch_assoc()) {
            $agentId = $row["agent_id"];
            $agentName = $row["agent_name"];

            // Create option with agent ID as value and agent name as display text
            echo '<option value="' . $agentId . '">' . $agentName . '</option>';
        }
    } else {
        echo '<option value="" disabled>No delivery agents found</option>';
    }
}



?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Delivery Agents</h6>
                <div class="">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option class="" selected>Select Delivery Agents</option>
                        <?php fetchDeliveryAgents(); ?>
                    </select>
                </div>
            </div>
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
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Date</th>
                        <th scope="col">School</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Child</th>
                        <th scope="col">Address</th>
                        <th scope="col">Assign</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "./db/connect.php"; // Replace with the correct path to your connect.php file

                    function fetchData()
                    {
                        global $conn; // Assuming $conn is the database connection variable defined in connect.php
                        // SQL query to fetch data from the table
                        $sql = "SELECT
                        p.p_name AS parent_name,
                        c.c_name AS child_name,
                        c.c_id As cId,
                        a.apartment,
                        a.area,
                        a.pincode,
                        s.s_name AS school_name
                    FROM
                        parent p
                        INNER JOIN address a ON p.addr_id = a.addr_id
                        INNER JOIN child c ON p.p_id = c.p_id
                        INNER JOIN school s ON c.s_id = s.s_id";
            

                        // Execute the query
                        $result = $conn->query($sql);

                        // Check if any rows are returned
                        if ($result->num_rows > 0) {
                            // Fetch and display the data
                            while ($row = $result->fetch_assoc()) {
                                $date  = date('Y-m-d'); 
                                $schoolName = $row["school_name"];
                                $parentName = $row["parent_name"];
                                $address = $row["apartment"] . ", " . $row["area"] . ", " . $row["pincode"];
                                $childName = $row["child_name"];
                                $cId=$row["cId"];

                                echo "<tr>";
                                echo "<td>" . $date . "</td>";
                                echo "<td>" . $schoolName . "</td>";
                                echo "<td>" . $parentName . "</td>";
                                echo "<td>". $childName."</td>";
                                echo "<td>" . $address . "</td>";
                                echo "<td><button class='btn btn-sm btn-primary assign-btn' data-cid='" . $cId . "'>Assign</button></td>";


                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='6'>No data found.</td>";
                            echo "</tr>";
                        }
                    }

                    fetchData();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Assign button click event
$(document).on("click", ".assign-btn", function () {
    var button = $(this); // Store the button element in a variable

    var cId = button.data("cid");

    var agentId = $("#floatingSelect").val(); // Get the selected agent ID from the dropdown
console.log(cId);
console.log(agentId);
    // AJAX request to assign the trip
    $.ajax({
        url: "assign_trip.php", // Replace with the path to your assign_trip.php file
        method: "POST",
        data: {
            cId: cId,
            agentId: agentId // Pass the selected agent ID
        },
        success: function (response) {
            // Handle the response
            console.log(response);
            button.text("" + response);
            button.removeClass("btn-primary").addClass("btn-secondary"); // Change button color to grey
            button.prop("disabled", true); // Disable the button
           // alert("Trip assigned successfully.");
        },
        error: function (xhr, status, error) {
            // Handle the error
            console.error(xhr.responseText);
            alert("Failed to assign trip. Please try again.");
        }
    });
});


</script>
