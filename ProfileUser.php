<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.html");
}

    require 'Handler/databaseConnect.php';

    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];

    $sql = "SELECT * FROM users WHERE userID = ?;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location: ../loginPage.php?error=sqlerror");
        exit();
    }

    else
    {
        mysqli_stmt_bind_param($stmt, "s" , $userID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

	    $fName = $row['fName'];
	    $lName = $row['lName'];
	    $userEmail = $row['userEmail'];
	    $phoneNumber = $row['phoneNumber'];
	    $userGender = $row['userGender'];
	    $userType = $row['userType'];
    }
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

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

    <style>
        #userPic
        {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .container
        {
            display: grid;
            height: 80%;
            grid-template-areas:
                "pic name name"
                "option info info"
                "option info info";
            grid-template-rows: 280px;
            grid-template-columns: 300px;
            background-color: white;
            padding: 50px;
            border-radius: 10px;
        }

        .picture {grid-area: pic;}
        .title {grid-area: name;}
        .settings {grid-area: option;}
        .content {grid-area: info;}

        label
        {
            padding-top: 10px;
        }

        .outainer
        {
            padding-top: 50px;
        }

        .card
        {
            border: none;
        }
    </style>

    <title><?php echo $_SESSION['userName'];?>'s Profile - Marina BookIt</title>
</head>
<body>
<!-- Profile Card -->
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
                        <a class="dropdown-item" href="#">List of facility</a>
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
<div class="outainer">
    <div class="container">
        <div class="picture">
            <img src="img/profilepic/<?= $userID ; ?>.jpg?<?= mt_rand() ; ?>" id="userPic"/>
        </div>
        <div class="title">
            <input type="text" class="form-control-plaintext" value="<?= $userName ?>">
            <input type="text" class="form-control-plaintext" value="<?= $userEmail ?>">
        </div>
        <div class="settings">
            <div class="btn-group-vertical btn-block btn-group-lg">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseExample">
                    Account Info
                </button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseExample">
                    Personal Details
                </button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseExample">
                    Transactions
                </button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseExample">
                    History
                </button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseExample">
                    Password & Security
                </button>
            </div>
        </div>
        <div class="content">
            <div class="collapse show" id="collapse1">
                <div class="card card-body">
                    <div class="form-group row">
                        <label class="col-2" for="userID">ID:</label>
                        <input class="col-10 form-control" type="text" id="userID" value="<?= $userID ?>" readonly>
                    </div>

                    <div class="form-group row">
                        <label class="col-2" for="userName">Username:</label>
                        <input class="col-10 form-control" type="text" id="userName" value="<?= $userName ?>" readonly>
                    </div>

                    <div class="form-group row">
                        <label class="col-2" for="userEmail">Email:</label>
                        <input class="col-10 form-control" type="text" id="userEmail" value="<?= $userEmail ?>" readonly>
                    </div>

                </div>
            </div>

            <div class="collapse" id="collapse2">
                <div class="card card-body">
                    <input class="form-control" type="text" value="<?= $fName ?>" readonly>
                    <input class="form-control" type="text" value="<?= $lName ?>" readonly><?php

                    if ($userGender == 'maleGender'){ echo '<input class="form-control" type="text" value="Male" readonly>'; }
                    elseif ($userGender == 'femaleGender'){ echo '<input class="form-control" type="text" value="Female" readonly>'; }
                    elseif ($userGender == 'shyGender'){ echo '<input class="form-control" type="text" value="Prefer not to say" readonly>'; }

                    if ($userType == 1){ echo '<input class="form-control" type="text" value="Admin" readonly>'; }
                    elseif ($userType == 2){ echo '<input class="form-control" type="text" value="Staff" readonly>'; }
                    elseif ($userType == 3){ echo '<input class="form-control" type="text" value="Registered Member" readonly>'; }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div id="swapper-first">
            <div class="card" style="width: 70rem; padding: 5px">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="card-title"><?php echo $_SESSION['userName'];?></h4>
                        <img class="d-inline" src="img/profilepic/<?= $userID ; ?>.jpg?<?= mt_rand() ; ?>" id="userPic"/>
                    </div>

                    <p class="px-4 text-center" style="padding-top: 20px">
                        <a class="btn btn-outline-secondary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fas fa-camera"></i> Change Picture </a>
                    </p>
                    <div class="row" style="padding-bottom: 20px">
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="card card-body text-center">
                                    <form action="Handler/profileHandler.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="file" accept=".jpg">
                                        <button class="btn btn-primary" name="userPicBtn" type="submit">
                                            Upload
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div<?php if ($userType == 2) echo " style='display: none';"; ?>>
                        <form action="Handler/profileHandler.php" method="post" class="text-center">
                            <div class="btn-group dropdown" style="padding-bottom: 20px">
                                <button type="button" class="btn btn-outline-warning dropdown-toggle text-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Change Password
                                </button>
                                <div class="dropdown-menu p-4" style="min-width: 20rem">
                                    <label for="userPwd">Current Password</label>
                                    <input type="password" class="form-control" name="userPwd" placeholder="Password" required>
                                    <br>
                                    <label for="userPwd">New Password</label>
                                    <input type="password" class="form-control" name="userPwdNew" placeholder="Password" required>
                                    <br>
                                    <label for="userPwdNewRepeat">Repeat New Password</label>
                                    <input type="password" class="form-control" name="userPwdNewRepeat" placeholder="Password" required>
                                    <div class="dropdown-divider"></div>
                                    <button type="submit" class="btn btn-primary float-right" name="pwdUpdateBtn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <form action="Handler/profileHandler.php" method="post">
                        <div class="row">
                            <div class="col">
                                <label for="fName">First Name</label>
                                <input type="text" class="form-control"  value="<?= $fName ?>" id="fName" name="fName" required>
                            </div>
                            <div class="col">
                                <label for="lName">Last Name</label>
                                <input type="text" class="form-control"  value="<?= $lName ?>" id="lName" name="lName" required>
                            </div>
                            <div class="col">
                                <label for="userID">User ID</label>
                                <input type="text" class="form-control"  value="<?= $userID ?>" id="userID" readonly>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 3rem">
                            <div class="col">
                                <label for="userEmail">Email Address</label>
                                <input type="email" class="form-control"  value="<?= $userEmail ?>" id="userEmail" name="userEmail" required>
                            </div>
                            <div class="col">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control"  value="<?= $phoneNumber ?>" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="col">
                                <label for="userGender">Gender</label>
                                <select class="form-control" id="userGender" name="userGender" required>
                                    <option value="maleGender">Male</option>
                                    <option value="femaleGender">Female</option>
                                    <option value="shyGender">Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                        <div style="padding-top: 20px">
                            <button type="submit" class="btn btn-primary float-right" name="profileUpdateBtn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- Local JavaScript -->

</body>
</html>