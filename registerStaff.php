<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.php");
}

if ($_SESSION['userType'] != 1)
{
	session_unset();
	session_destroy();

	header("Location: /index.php?error=unauthorized");
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.css">    <!-- All pages -->
    <link rel="stylesheet" href="CSS/dashboard.css">    <!-- For pages that uses side navbar -->
    <link rel="stylesheet" href="CSS/master.css">   <!-- All pages  -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

    <style>
        .row
        {
            padding-top: 20px;
        }
    </style>

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <title>Register Staff - Marina BookIt System</title>
</head>

<body>

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="sidebar-header">
            <h3 style="padding-bottom: 2rem">Admin Dashboard</h3>
            <div class="dropdown">
                <button class="btn btn-outline-dark btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-address-card" style="padding-right: 5px"></i><span><?php echo $_SESSION['userName']; ?></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 210px">
                    <p class="text-center"><?php $_SESSION['userEmail']; ?></p>

                    <div class="container">
                        <a href="ProfileUser.php" type="button" class="btn btn-outline-secondary btn-block text-center">View Profile</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="container">
                        <a href="Handler/signoutHandler.php" type="button" class="btn btn-outline-danger btn-block">Sign Out</a>
                    </div>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Booking</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Pending Booking</a>
                    </li>
                    <li>
                        <a href="#">Home 2</a>
                    </li>
                    <li>
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Staff</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="listOfStaff.php">List of Staff</a>
                    </li>
                    <li>
                        <a href="registerStaff.php">Register Staff</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#facilitySubmenu" data-toggle="collapse" aria-expanded="false">Facility</a>
                <ul class="collapse list-unstyled" id="facilitySubmenu">
                    <li>
                        <a href="#">List of Facility</a>
                    </li>
                    <li>
                        <a href="#">Edit Facility</a>
                    </li>
                    <li>
                        <a href="#">Add New Facility</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled CTAs" id="moreInfo">
            <li>
                <a href="#">About Us</a>
            </li>
            <li>
                <a href="#">Contact Us</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div class="row-container" id="content">
        <div class="first-row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <span class="navbar-brand mb-0 h1" id="sysTitle"><img src="img/logo.png"></span>
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark btn-lg">
                        <i class="fas fa-align-left"></i>
                    </button>
                </div>
            </nav>
        </div>
        <div class="second-row">
            <div class="container">
                <form action="Handler/registerHandler.php" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="fName">First Name</label>
                            <input type="text" class="form-control" id="fName" name="fName" required>
                        </div>
                        <div class="col">
                            <label for="lName">Last Name</label>
                            <input type="text" class="form-control"  id="lName" name="lName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="userName">Username</label>
                            <input type="text" class="form-control" id="userName" name="userName" required>
                        </div>
                        <div class="col">
                            <label for="userEmail">Email Address</label>
                            <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="userPwd">Password</label>
                            <input type="password" class="form-control" id="userPwd" name="userPwd" required>
                        </div>
                        <div class="col">
                            <label for="userPwdRepeat">Repeat Password</label>
                            <input type="password" class="form-control" id="userPwdRepeat" name="userPwdRepeat" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="userGender">Gender</label>
                            <select class="form-control" id="userGender" name="userGender" required>
                                <option value="maleGender">Male</option>
                                <option value="femaleGender">Female</option>
                                <option value="shyGender">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="userType">User Type</label>
                            <select class="form-control" id="userType" name="userType" required>
                                <option value="1">Admin</option>
                                <option value="2">Staff</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary btn-block" name="registerSubmitBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<!-- Local JavaScript -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

</body>

</html>