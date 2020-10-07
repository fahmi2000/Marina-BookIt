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
    <link rel="stylesheet" href="CSS/dashboardMember.css">
    <link rel="stylesheet" href="CSS/dashboardAdmin.css">
    <style>
        #adminDiv
        {
            display: grid;
            grid-template-areas:
                "weekly"
                "monthly"
                "yearly";
            grid-template-rows: 33vh 33vh 33vh;
        }

        .weekly
        {
            grid-area: weekly;
        }

        .monthly
        {
            grid-area: monthly;
        }

        .yearly
        {
            grid-area: yearly;
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
                        <a class="dropdown-item" href="listOfBooking.php">List of booking</a>
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
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left">
                    Home <span class="fas fa-angle-down" style="right: -90px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item active" href="Dashboard.php">Home</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Booking Management</h6>    
                    <a class="dropdown-item" href="listOfBooking.php">List of booking</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Facility Management</h6>
                    <a class="dropdown-item" href="listOfFacility.php">List of facility</a>
                    
                </div>
            </div>
        ';
	}

    elseif ($_SESSION['userType'] == 3) //Member
	{
		echo '
            <div class="dropdown d1">
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left">
                    Home <span class="fas fa-angle-down" style="right: -90px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item active" href="Dashboard.php">Home</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Facilities and Rooms</h6>
                    <a class="dropdown-item" href="listOfFacility.php">All rooms and facilities</a>
                    <a class="dropdown-item" href="listOfFacility.php?listFormalFacilityBtn=">Formal space</a>
                    <a class="dropdown-item" href="listOfFacility.php?listSportsFacilityBtn=">Recreational facilities</a>
                    
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
<div class="container" id="adminDiv"><?php
    if ($_SESSION['userType'] == 1 || $_SESSION['userType'] == 2)
    {
        header("Location: listOfBooking.php");
    }
    ?>
</div>

<div class="container" id="staffDiv"><?php
	if ($_SESSION['userType'] == 1 || $_SESSION['userType'] == 2)
	{
		header("Location: listOfBooking.php");
	}
    ?>
</div>

<div class="container-fluid" id="memberDiv">

    <div class="explore">
        <div class="explore-1">
            <h1>Book Now</h1>
            <p>Book a room or facility</p>
            <a href="listOfFacility.php" class="btn btn-dark">Make reservations</a>
        </div>
    </div>

    <div class="type">
        <div class="type-1">
            <div class="row">
                <div class="col-lg-6" style="padding-top: 10px">
                    <div class="card" style="border-radius: 50px; cursor: pointer" onclick="window.location='listOfFacility.php?listFormalFacilityBtn=';">
                        <div class="card-body">
                            <img src="img/formal.jpg" alt="" class="card-img-top" style="border-radius: 40px 40px 0 0">
                            <h3 class="card-title" style="font-weight: bolder">Formal Space</h3>
                            <p class="text-muted">Unique venue to rent for off-site meeting, product launches, conferences and many more.</p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-lg-6" style="padding-top: 10px">
                    <div class="card" style="border-radius: 50px; cursor: pointer" onclick="window.location='listOfFacility.php?listSportsFacilityBtn=';">
                        <div class="card-body">
                            <img src="img/rec.jpg" alt="" class="card-img-top" style="border-radius: 40px 40px 0 0">
                            <h3 class="card-title" style="font-weight: bolder">Recreational Facilities</h3>
                            <p class="text-muted">Spaces where you can have an activity of leisure such as swimming or exercising.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="foot">
        <div class="row">
            <div class="col-sm-6">
                <p>Marina Putrajaya</p>
                <p class="text-muted">Managed and operated by MARINA PUTRAJAYA SDN. BHD.</p>
                <br>
                <br>
                <p class="text-muted">No 1, Jalan P5/5, Presint 5, 62200 Putrajaya, Wilayah Persekutuan Putrajaya</p>
                <br>
                <br>
                <p class="text-muted">Email: sales@cruisetasikputrajaya.com</p>
                <p class="text-muted">Phone: +(603) 8881 0648</p>
                <p class="text-muted">Fax: +(603) 8888 3769</p>
            </div>

            <div class="col-sm-6">
                <p>Social Media</p>
                <a class="text-muted" href="#">Facebook</a>
                <br>
                <a class="text-muted" href="#">Instagram</a>
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
        document.getElementById("staffDiv").style.display = "none";
    }
</script>
<!-- Optional CDN -->
<script>
    let url = new URL(window.location.href);
    let searchParams = new URLSearchParams(url.search);
    var msg = searchParams.get('msg');
    if(msg === 'regstaffsucc')
    {
        Swal.fire
        (
            'Staff Registered!',
            'Staff account registered successfully.',
            'success'
        )
    }

    if(msg === 'login')
    {
        Swal.fire
        (
            'Signed In',
            'You have signed in successfully.',
            'success'
        )
    }

    if(msg === 'OTP')
    {
        Swal.fire
        (
            'Signed In',
            'You have signed in successfully.',
            'success'
        )
    }
</script>
</body>
</html>