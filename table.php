<!DOCTYPE html>
<html>

<head>
    <title>Children Records</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <h1>Children Records</h1>

    <?php include 'fetch_children.php'; ?>

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
</body>

</html>