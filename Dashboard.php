<?php
session_start();
if (!(isset($_SESSION['userName']) && $_SESSION['userName'] != ''))
{
	header ("signinPage.html");
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
	<link rel="stylesheet" href="CSS/master.css">   <!-- All pages  -->
    <link rel="stylesheet" href="CSS/dashboard.css">
    <style>
        .btn > span:last-child
        {
            right: -90px;
            position: relative;
        }

        #adminDiv
        {
            display: grid;
            height: 100%;
            grid-template-areas:
                "explore"
                "type"
                "special"
                "common"
                "foot";
            background-color: white;
            grid-template-rows: 100vh 50vh 100vh 100vh 100vh;
        }

        .explore
        {
            display: flex;

            grid-area: explore;

            background-image: url("img/ex1.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;

            align-items: flex-end;
        }

        .explore > .explore-1
        {
            padding-left: 100px;
            padding-bottom: 250px;
            color: white;
        }

        .type
        {
            grid-area: type
        }

        .type > .type-1
        {
            padding: 100px;
        }

        .special
        {
            grid-area: special
        }

        .common
        {
            grid-area: common
        }

        .foot
        {
            grid-area: foot
        }

        .card-img-top
        {
            padding-bottom: 10px;
        }

        .col-6 > .card
        {
            width: inherit;
        }

    </style>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/popper.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/sweetalert2.all.min.js" crossorigin="anonymous"></script> <!-- SweetAlert2 js -->
	<script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script> <!-- Icon CDN -->

	<title>Dashboard - Marina BookIt</title>
</head>
<body>
<!--navbar-->
<div class="flex-container naviBar sticky-top" style="padding: 10px">
    <div>
        <img src="img/logo.png" id="logo">
    </div><?php
	if ($_SESSION['userType'] == 1) //Admin
	{
		echo '
            <div class="dropdown d1">
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left">
                    Home <span class="fas fa-angle-down" style="right: -90px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item active" href="Dashboard.php">Home</a>
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
                        <a class="dropdown-item" href="registerFacility.php">Add facility</a>
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


<!--Contents-->
<!--<div class="container" id="adminDiv">-->
<!--    <h1>This is an admin div</h1>-->
<!--    <p>Dashboard/report system go here</p>-->
<!--</div>-->

<div class="container" id="staffDiv">
    <h1>This is a staff div</h1>
    <p>Booking management system go here</p>
</div>

<!--tukar balik jadi id="memberDiv" nanti, tengah develop-->
<div class="container-fluid" id="adminDiv">
    <div class="explore">
        <div class="explore-1">
            <h1>Book Now</h1>
            <p>Book a room or facility</p>
            <a href="#" class="btn btn-dark">Make reservations</a>
        </div>
    </div>
    <div class="type">
        <div class="type-1">
            <div class="row">
                <div class="col-6">
                    <div class="card" style="border-radius: 50px">
                        <div class="card-body">
                            <img src="img/bg1.jpg" alt="" class="card-img-top" style="border-radius: 40px 40px 0 0">
                            <h3 class="card-title" style="font-weight: bolder">Formal Space</h3>
                            <p class="text-muted">Unique venue to rent for off-site meeting, product launches, conferences and many more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="border-radius: 50px">
                        <div class="card-body">
                            <img src="img/bg1.jpg" alt="" class="card-img-top" style="border-radius: 40px 40px 0 0">
                            <h3 class="card-title" style="font-weight: bolder">Recreational Facilities</h3>
                            <p class="text-muted">Spaces where you can have an activity of leisure such as swimming or exercising.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Local JavaScript -->
<script>
    const userType = "<?= $_SESSION['userType']; ?>";
    if (userType === "1")
    {
        document.getElementById("staffDiv").style.display = "none";
        document.getElementById("memberDiv").style.display = "none";
    }

    else if (userType === "2")
    {
        document.getElementById("adminDiv").style.display = "none";
        document.getElementById("memberDiv").style.display = "none";
    }

    else if (userType === "3")
    {
        document.getElementById("adminDiv").style.display = "none";
        document.getElementById("memberDiv").style.display = "none";
    }
</script>
<!-- Optional CDN -->

</body>
</html>