<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                  <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Home
                </a>
            <a class="nav-link" href="profile.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                   Dashboard
                </a>
                <?php if ($_SESSION['USER_TYPE'] == 'garage') { ?>
                    <a class="nav-link" href="garage-enquiry.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Garage Bookings
                </a>
                    <?php } else { ?>
                <a class="nav-link" href="my-enquiry.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Booked Services
                </a>
                <?php } ?>
                <a class="nav-link" href="edit_profile.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Edit Profile
                </a>
                <a class="nav-link" href="logout.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Logout
                </a>
            </div>
        </div>
    </nav>
</div>