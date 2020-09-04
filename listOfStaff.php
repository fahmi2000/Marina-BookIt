<?php
session_start();
if (!(isset($_SESSION['userName']) && $_SESSION['userName'] != ''))
{
	header ("signinPage.html");
}

if ($_SESSION['userType'] != 1)
{
	header ("Dashboard.php");
}

require 'Handler/staffHandler.php';

$listStaff = listStaff();
$loop = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.css">    <!-- All pages -->
    <link rel="stylesheet" href="CSS/dashboard.css">
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

        .btn > span:last-child
        {
            right: -50px;
            position: relative;
        }

    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

	<title>List of Staff - Marina BookIt System</title>
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
                    List of Staff <span class="fas fa-angle-down"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Booking Management</h6>    
                        <a class="dropdown-item" href="#">Pending booking</a>
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Staff Management</h6>
                        <a class="dropdown-item active" href="listOfStaff.php">List of staff</a>
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


<div class="container">
    <div class="container-2">
        <div class="text-center">
            <h3>List of Staff</h3>
            <p>List of staff with accounts of Marina BookIt</p>
            <hr>
        </div><?php

        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">#</th>';
        echo '<th scope="col">User ID</th>';
        echo '<th scope="col">Username</th>';
        echo '<th scope="col">Type</th>';
        echo '<th scope="col"></th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($listStaff))
        {
            $viewStaff  = $row['userName'];


            echo '<tr>';
            echo '<th scope="row">' .$loop. '</th>';
            echo '<td>' .$row['userID']. '</td>';
            echo '<td>' .$row['userName']. '</td>';
            if ($row['userType'] == 1)
            {
                echo '<td>Admin</td>';
            }
            elseif ($row['userType'] == 2)
            {
                echo '<td>Staff</td>';
            }
            echo '<td>';
            echo '<form action="ProfileStaff.php" method="post">';
            echo "<input type='hidden' value='$viewStaff' name='viewStaff'>";
            echo '<input class="btn btn-outline-dark btn-block" type="submit" name="viewStaffBtn" value="View">';
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

<!-- Local JavaScript -->

</body>

</html>