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

require 'Handler/facilityHandler.php';

$listFacility = listFacility();
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

    </style>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/popper.min.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script> <!-- Required by Bootstrap 4 -->
	<script src="JavaScript/sweetalert2.all.min.js" crossorigin="anonymous"></script> <!-- SweetAlert2 js -->
	<script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script> <!-- Icon CDN -->

	<title>List of Facility</title>
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
                    List of Facility <span class="fas fa-angle-down" style="right: -35px; position: relative;"></span>
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
                        <a class="dropdown-item active" href="listOfFacility.php">List of facility</a>
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
			<h3>List of Facilites</h3>
			<p>List of facilities that are available for online booking through Marina BookIt</p>
			<hr>
		</div><?php

		echo '<table class="table table-striped table-bordered">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col">#</th>';
		echo '<th scope="col">ID</th>';
		echo '<th scope="col">Name</th>';
		echo '<th scope="col">Capacity</th>';
		echo '<th scope="col">Rate</th>';
		echo '<th scope="col">Amenities</th>';
		echo '<th scope="col">Status</th>';
		echo '<th scope="col"></th>';
		echo '</tr>';
		echo '</thead>';

		echo '<tbody>';

		while ($row = mysqli_fetch_assoc($listFacility))
		{
			$viewFacility  = $row['facilityID'];

			echo '<tr>';
			echo '<th scope="row">' .$loop. '</th>';
			echo '<td>' .$row['facilityID']. '</td>';
			echo '<td>' .$row['facilityName']. '</td>';
			echo '<td>' .$row['facilityCapacity']. '</td>';
			echo '<td>' .$row['facilityRate']. '</td>';
			echo '<td>' .$row['facilityAmenities']. '</td>';

			if ($row['facilityStatus'] == 0)
            {
	            echo '<td>Not available</td>';
            }

			elseif ($row['facilityStatus'] == 1)
			{
				echo '<td>Available</td>';
			}

            elseif ($row['facilityStatus'] == 2)
			{
				echo '<td>Maintenance</td>';
			}
			echo '<td>';
			echo '<form action="ProfileFacility.php" method="post">';
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

<!-- Local JavaScript -->

<!-- Optional CDN -->

</body>
</html>
