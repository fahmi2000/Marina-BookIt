<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
	header("signinPage.html");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="CSS/bootstrap.css">    <!-- All pages -->
	<link rel="stylesheet" href="CSS/dashboard.css">    <!-- For pages that uses side navbar -->
	<link rel="stylesheet" href="CSS/master.css">   <!-- All pages  -->
    <style>
        label
        {
            padding-top: 20px;
        }

        .container
        {
            background-color: white;
            padding: 50px;
            border-radius: 10px;
        }

        .container-2
        {
            margin-top: 50px;
        }
    </style>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/popper.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/sweetalert2.all.min.js" crossorigin="anonymous"></script> <!-- SweetAlert2 js -->
	<script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script> <!-- Icon CDN -->

	<title>Add Facility - Marina BookIt</title>
</head>
<body>
<div class="flex-container naviBar sticky-top" style="padding: 10px">
    <div>
        <img src="img/logo.png" id="logo">
    </div><?php
	if ($_SESSION['userType'] == 1) //Admin
	{
		echo '
            <div class="dropdown d1">
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left">
                    Add Facility <span class="fas fa-angle-down" style="right: -47px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Booking Management</h6>    
                        <a class="dropdown-item" href="#">Pending booking</a>
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Staff Management</h6>
                        <a class="dropdown-item" href="listOfStaff.php">List of staff</a>
                        <a class="dropdown-item" href="registerStaff.php">Register staff</a>
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Facility Management</h6>
                        <a class="dropdown-item" href="listOfFacility.php">List of facility</a>
                        <a class="dropdown-item active" href="registerFacility.php">Add facility</a>
                </div>
            </div>
        ';
	}

    elseif ($_SESSION['userType'] == 2) //Staff
	{
		echo '
            <div class="dropdown d1">
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu <span class="fas fa-angle-down"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Booking Management</a>
                    <a class="dropdown-item" href="#">Booking Management</a>
                    <a class="dropdown-item" href="#">Booking Management</a>
                </div>
            </div>
        ';
	}

    elseif ($_SESSION['userType'] == 3) //Member
	{
		echo '
            <div class="dropdown d1">
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu <i class="fas fa-angle-down"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Booking Management</a>
                    <a class="dropdown-item" href="#">Booking Management</a>
                    <a class="dropdown-item" href="#">Booking Management</a>
                </div>
            </div>
        ';
	}

	?>

    <div class="dropdown">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?php echo $_SESSION['userName'] ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="ProfileUser.php">View profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Handler/signoutHandler.php">Sign out</a>

        </div>
    </div>
</div>

<div class="container-2">
    <div class="container">

        <div class="row">
            <div class="col text-center">
                <h3>Add Facility</h3>
                <p>Add new rooms or facility of the complex</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-3"></div>

            <div class="col-6">
                <form class="form-group" method="post" action="Handler/facilityHandler.php">
                <label for="facilityName">Name</label>
                <input class="form-control" type="text" name="facilityName" id="facilityName" placeholder="Name">

                <label for="facilityCapacity">Capacity</label>
                <input class="form-control" type="text" name="facilityCapacity" id="facilityCapacity" placeholder="Capacity">

                <label for="facilityRate">Rental Rate</label>
                <input class="form-control" type="text" name="facilityRate" id="facilityRate" placeholder="Rental Rate">

                <label for="facilityAmenities">Amenities</label>
                <input class="form-control" type="text" name="facilityAmenities" id="facilityAmenities" placeholder="Amenities">
                <br>
                <button type="submit" class="btn btn-success" name="facilitySubmitBtn" style="float: right">Save</button>
                </form>
            </div>

            <div class="col-3"></div>
        </div>
    </div>
</div>
<!-- Local JavaScript -->

<!-- Optional CDN -->

</body>
</html>
