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
            min-height: 100vh;
            grid-template-areas:
                "pic name name"
                "option info info"
                "option info info";
            grid-template-rows: 280px;
            grid-template-columns: 300px;
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            column-gap: 20px;
            border: 1px solid;
            border-color: rgba(0, 0, 0, 0.1);
        }

        .picture {grid-area: pic; justify-self: center; align-self: center}
        .title {grid-area: name; align-self: center}
        .settings
        {
            grid-area: option;

            display: grid;
            grid-template-areas:
                "btn1"
                "btn2"
                "btn3"
                "btn4"
                "btn5"
                "btn6";
            grid-template-rows: repeat(5, min-content);
            background-color: #292e32;
        }
        .btn1 {grid-area: btn1; background-color: #343a40}
        .btn2 {grid-area: btn2; background-color: #343a40}
        .btn3 {grid-area: btn3; background-color: #343a40}
        .btn4 {grid-area: btn4; background-color: #343a40}
        .btn5 {grid-area: btn5; background-color: #343a40}
        .btn6 {grid-area: btn6; background-color: #343a40; align-self: end}

        .content {grid-area: info;}

        .outainer
        {
            padding-top: 10px;
        }

        .card
        {
            border: none;
        }

        h3.title
        {
            font-size: 200%;
        }

        #btnSettings > button:last-child
        {
            margin-top: auto;
        }

    </style>

    <title><?php echo $_SESSION['userName'];?>'s Profile - Marina BookIt</title>
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
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left">
                    Menu <span class="fas fa-angle-down" style="right: -90px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Booking Management</h6>    
                    <a class="dropdown-item" href="#">List of booking</a>
                    
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

<div class="outainer">
    <div class="container">
        <div class="picture">
            <input type="image" src="img/profilepic/<?= $userID ; ?>.jpg?<?= mt_rand() ; ?>" id="userPic" data-toggle="modal" data-target="#exampleModalCenter">
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="Handler/profileHandler.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="file" name="file" accept=".jpg">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-dark" name="userPicBtn" type="submit">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="title">
            <h4 class="title"><?= $userName ?></h4>
            <h4 class="title text-muted"><?= $userEmail ?></h4>
        </div>

        <div class="settings">
            <div class="btn1">
                <button class="btn btn-dark btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Account Information
                </button>
            </div>

            <div class="btn2">
                <button class="btn btn-dark btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Personal Details
                </button>
            </div>

            <div class="btn3">
                <button class="btn btn-dark btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Transactions
                </button>
            </div>

            <div class="btn4">
                <button class="btn btn-dark btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    History
                </button>
            </div>

            <div class="btn5">
                <button class="btn btn-dark btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Password & Security
                </button>
            </div>

            <div class="btn6">
                <button class="btn btn-dark btn-block text-left">
                    <span style="padding-right: 10px">Sign Out</span>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                        <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="content">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">

                            <h4>Account Information</h4>

                            <hr>

                            <div class="form-group">
                                <label for="userID">USER ID</label>
                                <input class="form-control" type="text" id="userID" value="<?= $userID ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="userName">USERNAME</label>
                                <input class="form-control" type="text" id="userName" value="<?= $userName ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="userEmail">EMAIL</label>
                                <input class="form-control" type="text" id="userEmail" value="<?= $userEmail ?>" readonly>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">

                            <div class="input-group">
                                <h4>Personal Details</h4>
                                <button class="btn btn-outline-dark" type="button" style="margin-left: auto">Edit</button>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="fName">FIRST NAME</label>
                                <input class="form-control" type="text" id="fName" value="<?= $fName ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="lName">LAST NAME</label>
                                <input class="form-control" type="text" id="lName" value="<?= $lName ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="userEmail">GENDER</label><?php
	                            if ($userGender == 'maleGender'){ echo '<input class="form-control" type="text" id="userGender" value="Male" readonly>'; }
                                elseif ($userGender == 'femaleGender'){ echo '<input class="form-control" type="text" id="userGender" value="Female" readonly>'; }
                                elseif ($userGender == 'shyGender'){ echo '<input class="form-control" type="text" id="userGender" value="Prefer not to say" readonly>'; }

                                ?>
                            </div>

                            <div class="form-group">
                                <label for="userEmail">ACCOUNT TYPE</label><?php
	                            if ($userType == 1){ echo '<input class="form-control" type="text" value="Admin" readonly>'; }
                                elseif ($userType == 2){ echo '<input class="form-control" type="text" value="Staff" readonly>'; }
                                elseif ($userType == 3){ echo '<input class="form-control" type="text" value="Registered Member" readonly>'; }

		                        ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <h4>Transaction<?= $_SESSION['userName'] ?></h4>

                            <hr>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <h4>History</h4>
                            <hr><?php
                                require 'Handler/bookingHandler.php';
                                $listBooking = listBooking();
                                $loop = 1;
                                echo '<table class="table table-striped table-bordered">';
                                echo '<thead>';
                                echo '<tr>';
                                    echo '<th scope="col">#</th>';
                                    echo '<th scope="col">ID</th>';
                                    echo '<th scope="col">Facility</th>';
                                    echo '<th scope="col">From</th>';
                                    echo '<th scope="col">Until</th>';
                                    echo '<th scope="col">Duration</th>';
                                    echo '<th scope="col">Price</th>';
                                    echo '<th scope="col">Status</th>';
	                                echo '<th scope="col"></th>';
                                    echo '</tr>';
                                echo '</thead>';

                                echo '<tbody>';

                                while ($row = mysqli_fetch_assoc($listBooking))
                                {
                                $viewFacility  = $row['facilityID'];

                                echo '<tr>';
                                    echo '<th scope="row">' .$loop. '</th>';
                                    echo '<td>' .$row['bookingID']. '</td>';
                                    echo '<td>' .$row['b_facilityID']. '</td>';
                                    echo '<td>' .$row['startDate']. '</td>';
                                    echo '<td>' .$row['endDate']. '</td>';
                                    echo '<td>' .$row['b_durationDay']. '</td>';
	                                echo '<td>' .$row['b_totalRate']. '</td>';

                                    if ($row['facilityStatus'] == 0)
                                    {
                                    echo '<td>Pending</td>';
                                    }

                                    elseif ($row['facilityStatus'] == 1)
                                    {
                                    echo '<td>Unpaid</td>';
                                    }

                                    elseif ($row['facilityStatus'] == 2)
                                    {
                                    echo '<td>Completed</td>';
                                    }
                                    echo '<td>';
                                        echo '<form action="ProfileFacility.php" method="get">';
                                            echo "<input type='hidden' value='$viewFacility' name='viewFacility'>";
                                            echo '<input class="btn btn-outline-dark btn-block" type="submit" name="viewFacilityBtn" value="View">';
                                            echo '</form>';
                                        echo '</td>';
                                    echo '</tr>';
                                $loop++;
                                }

                                echo '</tbody>';

                                echo '</table>';

                            ?>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <h4>Password & Security</h4>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-outline-dark" type="button" data-toggle="modal" data-target="#pwdModal" style="min-width: 200px">Change Password</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-outline-danger" type="button" style="min-width: 200px">Delete Account</button>
                                </div>
                            </div>

                            <div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="Handler/profileHandler.php" method="post">
                                            <div class="modal-body">
                                                <label for="userPwd">Current Password</label>
                                                <input type="password" class="form-control" name="userPwd" placeholder="Password" required>
                                                <br>
                                                <hr>
                                                <label for="userPwd">New Password</label>
                                                <input type="password" class="form-control" name="userPwdNew" placeholder="Password" required>
                                                <br>
                                                <label for="userPwdNewRepeat">Repeat New Password</label>
                                                <input type="password" class="form-control" name="userPwdNewRepeat" placeholder="Password" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-dark" name="pwdUpdateBtn">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Local JavaScript -->

</body>
</html>