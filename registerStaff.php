<?php
session_start();
if (!(isset($_SESSION['userName']) && $_SESSION['userName'] != ''))
{
	header ("signinPage.html");
}

if($_SESSION['userType'] != 1)
{
	header ("Dashboard.php");
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
        .container > .row
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

	<title>Register Staff - Marina BookIt</title>
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
                    Register Staff <span class="fas fa-angle-down" style="right: -35px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Booking Management</h6>    
                        <a class="dropdown-item" href="listOfBooking.php">List of booking</a>
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Staff Management</h6>
                        <a class="dropdown-item" href="listOfStaff.php">List of staff</a>
                        <a class="dropdown-item active" href="registerStaff.php">Register staff</a>
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

<div class="container-2">
<div class="container">
<form action="Handler/registerHandler.php" method="post">
    <div class="row">
        <div class="col text-center">
            <h3>Staff Registration</h3>
            <p>Create a new account for staffs</p>
        </div>
    </div>
    <hr>
    <div class="row form-group">
        <div class="col">
            <label for="userName">USERNAME</label>
            <input class="form-control" type="text" name="userName" id="userName" placeholder="Username">
        </div>
        <div class="col">
            <label for="userEmail">EMAIL</label>
            <input class="form-control" type="email" name="userEmail" id="userEmail" placeholder="Email">
        </div>
    </div>
    <div class="row form-group">
        <div class="col">
            <label for="userPwd">PASSWORD</label>
            <input class="form-control" type="password" name="userPwd" id="userPwd" placeholder="Password">
        </div>
        <div class="col">
            <label for="userPwdRepeat">REPEAT PASSWORD</label>
            <input class="form-control" type="password" name="userPwdRepeat" id="userPwdRepeat" placeholder="Repeat password">
        </div>
    </div>
    <div class="row form-group">
        <div class="col">
            <label for="fName">FIRST NAME</label>
            <input class="form-control" type="text" name="fName" id="fName" placeholder="First name">
        </div>
        <div class="col">
            <label for="lName">LAST NAME</label>
            <input class="form-control" type="text" name="lName" id="lName" placeholder="Last name">
        </div>
    </div>
    <div class="row form-group">
        <div class="col">
            <label for="userGender">GENDER</label>
            <select class="form-control" id="userGender" name="userGender" required>
                <option value="maleGender">Male</option>
                <option value="femaleGender">Female</option>
                <option value="shyGender">Undisclosed</option>
            </select>
        </div>
        <div class="col">
            <label for="userType">ACCOUNT TYPE</label>
            <select class="form-control" id="userType" name="userType" required>
                <option value="1">Admin</option>
                <option value="2">Staff</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-dark" name="registerSubmitBtn" style="float: right">Save</button>
        </div>
    </div>
</form>
</div>
</div>
<!-- Local JavaScript -->

<!-- Optional CDN -->
<script>
    let url = new URL(window.location.href);
    let searchParams = new URLSearchParams(url.search);
    var msg = searchParams.get('msg');
    if(msg === 'regstaffsucc')
    {
        Swal.fire
        (
            'Success',
            'Staff successfully added!',
            'success'
        )
    }
</script>
</body>
</html>