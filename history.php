<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}
include_once 'db/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lunch Box</title>
     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Rest of the code remains the same -->

<body>
    <!-- Rest of the code remains the same -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <div class="container-fluid">
        <?php include 'sidebar.php'; ?>
            <?php include 'navbar.php'; ?>

        </div>
        <!-- Navbar End -->

        <!-- Horizontal Bar Start -->
        <style>
            .datepicker-input {
                height: 38px;
                font-size: 12px;
            }
        </style>
        <div class="container-fluid pt-1 pb-1 px-4 mt-4 bg-white">
            <!-- Rest of the code remains the same -->

            <!-- Trips Table Start -->
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                           
                            <th scope="col">Agent Name</th>
                           
                            <th scope="col">Child Name</th>
                            <th scope="col">Area</th>
                            <th scope="col">Apartment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // SQL query to fetch trips data and additional information
                        $sql = "SELECT da.agent_name, p.p_name, c.c_name, c.c_class, a.area, a.apartment, a.pincode
                        FROM trips t
                        INNER JOIN deliveryagent da ON t.agent_id = da.agent_id
                        INNER JOIN child c ON t.c_id = c.c_id
                        INNER JOIN parent p ON c.p_id = p.p_id
                        INNER JOIN address a ON p.addr_id = a.addr_id";
                
                
                

                        // Execute the query
                        $result = $conn->query($sql);

                        // Check if any rows are returned
                        if ($result->num_rows > 0) {
                            // Loop through the rows and fetch data
                            while ($row = $result->fetch_assoc()) {
                                
                                $agentName = $row["agent_name"];
                               
                                $childName = $row["c_name"];
                                $area = $row["area"];
                                $apartment = $row["apartment"];

                                echo "<tr>";
                               
                                echo "<td>" . $agentName . "</td>";
                              
                                echo "<td>" . $childName . "</td>";
                                echo "<td>" . $area . "</td>";
                                echo "<td>" . $apartment . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='6'>No data found.</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Trips Table End -->

        </div>
        <!-- Horizontal Bar End -->
    </div>
    <!-- Content End -->

    <!-- Rest of the code remains the same -->

</body>

</html>
