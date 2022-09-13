<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
              
               <?php   $role = $_SESSION['ROLE'] ; ?>
               <?php  if($role == 'operator'){ ?>
               
                <a class="nav-link" href="booking.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Booking
                </a> 
                <?php } else { ?>
                <a class="nav-link" href="all-booking.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                   All  Booking
                </a> 
                 <a class="nav-link" href="all-operator.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                   Garage  Operator
                </a> 
                <a class="nav-link" href="all-user.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                 All User
                </a>
                <?php } ?>
                <a class="nav-link" href="add-garage.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Add Garage
                </a>
                <a class="nav-link" href="listing.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Garage List
                </a>
                
                
                  <a class="nav-link" href="edit_profile.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Edit Profile
                </a>
                <a class="nav-link" href="logout.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Logout
                </a>

            </div>
        </div>

    </nav>
</div>