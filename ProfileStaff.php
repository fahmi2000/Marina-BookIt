<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.html");
}

require "Handler/staffHandler.php";

$qry = viewStaff();
$row = mysqli_fetch_assoc($qry);

$userID = $row['userID'];
$userName = $row['userName'];
$userEmail = $row['userEmail'];
$fName = $row['fName'];
$lName = $row['lName'];
$phoneNumber = $row['phoneNumber'];
$userGender = $row['userGender'];
$userType = $row['userType'];
?>

<!doctype html>
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
        .row
        {
            padding-top: 20px;
        }

        .container
        {
            background-color: #ffffff;
            margin-top: 50px;
            border: 10px;
        }

        .container-1
        {
            padding: 40px;
        }
    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

	<title>Staff Management - <?php echo $userName; ?></title>
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
                        <a class="dropdown-item" href="#">Register staff</a>
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Facility Management</h6>
                        <a class="dropdown-item" href="#">List of facility</a>
                        <a class="dropdown-item" href="#">Add facility</a>
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

<div class="container" style="border-radius: 10px">
    <div class="container-1">
        <h3 style="padding-top: 20px">Staff's Account Information</h3>
        <button class="btn btn-dark" data-toggle="button" aria-pressed="false" onclick="editFunction()">Edit</button>
        <button class="btn btn-dark">Change Password</button>
        <form action="Handler/eventListener.php" method="post">

            <input type="text" class="form-control" name="userID" value="<?= $userID ?>" readonly hidden>
            <div class="row">
                <div class="col">
                    <label for="fName">First name:</label>
                    <input type="text" class="form-control" name="fName" id="fName" value="<?= $fName ?>" readonly>
                </div>
                <div class="col">
                    <label for="lName">Last name:</label>
                    <input type="text" class="form-control" name="lName" id="lName" value="<?= $lName ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="userName">Username:</label>
                    <input type="text" class="form-control" name="userName" id="userName" value="<?= $userName ?>" readonly>
                </div>
                <div class="col">
                    <label for="userEmail">Email address:</label>
                    <input type="text" class="form-control" name="userEmail" id="userEmail" value="<?= $userEmail ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="phoneNumber">Phone number:</label>
                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" value="<?= $phoneNumber ?>" readonly>
                </div>
                <div class="col">
                    <label for="userGender">Gender:</label>
                    <input type="text" class="form-control" name="userGender" id="userGender" value="<?= $userGender ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-danger" name="ADMINprofileDeleteBtn">Delete Account</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success" name="ADMINprofileUpdateBtn" style="float: right">Save</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Local JavaScript -->
<script>
    function editFunction()
    {
        document.getElementById('fName').readOnly = document.getElementById('fName').readOnly !== true;
        document.getElementById('lName').readOnly = document.getElementById('lName').readOnly !== true;
        document.getElementById('phoneNumber').readOnly = document.getElementById('phoneNumber').readOnly !== true;
        document.getElementById('userEmail').readOnly = document.getElementById('userEmail').readOnly !== true;
        document.getElementById('userGender').readOnly = document.getElementById('userGender').readOnly !== true;
    }
</script>

</body>
</html>

