<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
    include_once 'db/connect.php';
    $query = "SELECT * FROM admin WHERE username='$_SESSION[username]'";
    $data = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($data);
    $name = $result['name'];
    
?>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>LUNCHBOX</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?php echo $name; ?></h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" id="nav-link-assign" class="nav-item nav-link"><i class="fa fa-user-plus me-2"></i>Assign</a>
            <!--   <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>-->
            <a href="console.php" id='nav-link-console' class="nav-item nav-link"><i class="fa fa-desktop me-2"></i>Console</a>
            <a href="history.php" id='nav-link-history' class="nav-item nav-link"><i class="fa fa-history me-2"></i>History</a>
            <a href="status.php" id='nav-link-status' class="nav-item nav-link"><i class="fa fa-tasks me-2"></i>Status</a>
            <a href="?logout" class="nav-item nav-link"><i class="fa fa-power-off me-2"></i>Sign Out</a>
            <!--<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>-->
        </div>
    </nav>
</div>

<script>
    // Get the current page URL
    var currentPageUrl = window.location.href;

    // Get the navigation links
    var assignNavLink = document.getElementById("nav-link-assign");
    var consoleNavLink = document.getElementById("nav-link-console");
    var historyNavLink = document.getElementById("nav-link-history");

    // Check the current page URL and mark the corresponding navigation link as active
    if (currentPageUrl.includes("index.php")) {
        assignNavLink.classList.add("active");
    } else if (currentPageUrl.includes("console.php")) {
        consoleNavLink.classList.add("active");
    } else if (currentPageUrl.includes("history.php")) {
        historyNavLink.classList.add("active");
    }
</script>