<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.html");
}

require 'Handler/facilityHandler.php';

$qry = viewFacility();
$row = mysqli_fetch_assoc($qry);

$facilityID = $row['facilityID'];
$facilityName = $row['facilityName'];
$facilityCapacity= $row['facilityCapacity'];
$facilityRate = $row['facilityRate'];
$facilityAmenities = $row['facilityAmenities'];
$facilityStatus = $row['facilityStatus'];
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
        .container
        {
            margin-top: 50px;
            background-color: white;
            border-radius: 10px;
        }

        .container-2
        {
            padding: 40px;
        }

        label
        {
            padding-top: 20px;
        }

        #facilityUpdateBtn
        {
            float: right;
        }
    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
    <script src="JavaScript/sweetalert2.all.min.js" crossorigin="anonymous"></script> <!-- SweetAlert2 js -->
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script> <!-- Icon CDN -->

    <title>Facility Management - Marina BookIt</title>
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
                    Home <span class="fas fa-angle-down"></span>
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
            <a class="dropdown-item" href="#">Sign out</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="container-2">
        <h3 style="text-align: center">Facility Information - <?= $facilityName ?></h3>
        <p style="text-align: center">Edit or update information of a room or facility</p>
        <hr id="hr1">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <button class="btn btn-dark" data-toggle="button" aria-pressed="false" onclick="editFunction()">Edit</button>
            </div>
            <div class="col-3"></div>
        </div>

        <form class="form-group" method="post" action="Handler/eventListener.php">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">

                    <br>
                    <label for="facilityID">ID</label>
                    <input class="form-control" name="facilityID" id="facilityID" value="<?= $facilityID ?>" readonly>

                    <label for="facilityName">Name</label>
                    <input class="form-control" name="facilityName" id="facilityName" value="<?= $facilityName ?>" readonly>

                    <label for="facilityCapacity">Capacity</label>
                    <input class="form-control" name="facilityCapacity" id="facilityCapacity" value="<?= $facilityCapacity ?>" readonly>

                    <label for="facilityRate">Rate</label>
                    <input class="form-control" name="facilityRate" id="facilityRate" value="<?= $facilityRate ?>" readonly>

                    <label for="facilityAmenities">Amenities</label>
                    <input class="form-control" name="facilityAmenities" id="facilityAmenities" value="<?= $facilityAmenities ?>" readonly>

                    <label for="facilityStatus">Status</label>
                    <input class="form-control" name="facilityStatus" id="facilityStatus" value="<?= $facilityStatus ?>" readonly>
                    <br>
                    <div class="butt">
                        <button type="submit" class="btn btn-danger" id="facilityDeleteBtn" name="facilityDeleteBtn">Delete Account</button>
                        <button type="submit" class="btn btn-success" id="facilityUpdateBtn" name="facilityUpdateBtn">Save</button>
                    </div>

                </div>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>

<div class="container" style="max-height: 1%"></div>


<!-- Local JavaScript -->
<script>
    function editFunction()
    {
        document.getElementById('facilityName').readOnly = document.getElementById('facilityName').readOnly !== true;
        document.getElementById('facilityCapacity').readOnly = document.getElementById('facilityCapacity').readOnly !== true;
        document.getElementById('facilityRate').readOnly = document.getElementById('facilityRate').readOnly !== true;
        document.getElementById('facilityAmenities').readOnly = document.getElementById('facilityAmenities').readOnly !== true;
        document.getElementById('facilityStatus').readOnly = document.getElementById('facilityStatus').readOnly !== true;

        if (document.getElementById("hr1").style.borderColor !== "red")
        {
            document.getElementById("hr1").style.borderColor = "red";
        }

        else
        {
            document.getElementById("hr1").style.borderColor = "rgba(0, 0, 0, 0.1)";
        }
    }
</script>
<!-- Optional CDN -->

</body>
</html>
