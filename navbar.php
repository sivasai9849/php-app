<?php
   
    include_once 'db/connect.php';
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
    $query = "SELECT * FROM admin WHERE username='$_SESSION[username]'";
    $data = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($data);
    $name = $result['name'];
    function logout() {
        session_destroy(); // Destroy the session and remove all session data
        echo '<script>window.location.href = "login.php";</script>'; // Redirect to login page
        exit;
    }
    
    if (isset($_GET['logout'])) {
        logout(); // Call the logout function if the 'logout' parameter is present in the URL
    }

?>
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"><?php echo $name; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="?logout" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>