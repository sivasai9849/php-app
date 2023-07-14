<?php
 session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
    include_once 'db/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lunch Box</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include 'sidebar.php'; ?>
        <!-- Sidebar End -->
   <!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <div class="container-fluid">
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
    <div class="container-fluid pt-1 pb-1 px-4 mt-4 bg-light">
       <div class="row g-0 d-flex align-items-center justify-content-between">
         <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <div class="input-group">
              <div class="input-group-prepend">
                <label for="birthday" class="input-group-text">From:</label>
              </div>
              <input type="date" class="form-control datepicker-input" id="fromDate" name="birthday">
            </div>
       </div>


            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3 mt-sm-0">
              <div class="input-group">
                <div class="input-group-prepend">
                 <label for="birthday" class="input-group-text">To:</label>
               </div>
              <input type="date" class="form-control datepicker-input" id="toDate" name="birthday">
              </div>
            </div>

            <div class="col-12 col-sm-auto mt-3 mt-sm-0">
                <div class="rounded d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-outline-primary m-2">Parent</button>
                </div>
            </div>
            <div class="col-12 col-sm-auto mt-3 mt-sm-0">
                <div class="rounded d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-outline-primary m-2">Agent</button>
                </div>
            </div>
            <div class="col-12 col-sm-auto mt-3 mt-sm-0 d-flex align-items-center justify-content-center">
                <form class="d-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
            </div>
            <div class="col-12 col-sm-auto mt-3 mt-sm-0">
                <div class="rounded d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-outline-primary m-2">Add</button>
                </div>
            </div>



        </div>
    </div>
    <!-- Horizontal Bar End -->
</div>
<!-- Content End -->




        
        
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>






    

</body>

</html>