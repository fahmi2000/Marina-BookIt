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

if (isset($_GET['listAllFacilityBtn']))
{
	$listFacility2 = listFacility();
}

elseif (isset($_GET['listFormalFacilityBtn']))
{
	$listFacility2 = listFormalFacility();
}

elseif (isset($_GET['listSportsFacilityBtn']))
{
	$listFacility2 = listSportsFacility();
}

else
{
	$listFacility2 = listFacility();
}


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

        .container-3
        {
            display: grid;
            min-height: 100vh;
            grid-template-areas:
                "title"
                "categories"
                "title2"
                "facilities";
            grid-template-rows: auto;
            gap 30px;
        }

        .title
        {
            grid-area: title;
        }

        .categories
        {
            grid-area: categories;
        }

        .facilities
        {
            grid-area: facilities;
        }

        .flex1
        {
            padding: 10px;
        }

        #imgfac1
        {
            max-width: 40%;
            padding: 10px;
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
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left">
                    List of Facilities<span class="fas fa-angle-down" style="right: -25px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Booking Management</h6>    
                    <a class="dropdown-item" href="listOfBooking.php">List of booking</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Facility Management</h6>
                    <a class="dropdown-item active" href="listOfFacility.php">List of facility</a>
                    
                </div>
            </div>
        ';
	}

    elseif ($_SESSION['userType'] == 3) //Member
	{
		echo '
            <div class="dropdown d1">
                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left">
                    List of Facilities<span class="fas fa-angle-down" style="right: -25px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="dropdown-header">Facilities and Rooms</h6>
                    <a class="dropdown-item active" href="listOfFacility.php">All rooms and facilities</a>
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


<div class="container" id="staffDiv">
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
			$viewFacility = $row['facilityID'];

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

<div class="container" id="memberDiv">
    <div class="container-3">
        <div class="title">
            <h4>Categories</h4>
            <p class="text-muted">Sort by categories from our wide range of offerings.</p>
        </div>
        <div class="categories">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <form method="get" action="">
                        <div class="flex1">
                            <div class="card" style="width: 70vh">
                                <div class="row no-gutters">
                                    <div class="col-4">
                                        <img src="img/bg1.jpg" alt="" class="card-img">
                                    </div>
                                    <div class="col-8">
                                        <button type="submit" name="listAllFacilityBtn" style="text-align: left; border: none; background: none">
                                            <h5 class="card-title side" style="padding-left: 10px; padding-top: 10px">View All</h5>
                                            <p class="card-text side text-muted" style="padding-left: 10px">Display all of our offerings.</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex1">
                            <div class="card" style="width: 70vh">
                                <div class="row no-gutters">
                                    <div class="col-4">
                                        <img src="img/formal.jpg" alt="" class="card-img">
                                    </div>
                                    <div class="col-8">
                                        <button type="submit" name="listFormalFacilityBtn" style="text-align: left; border: none; background: none">
                                            <h5 class="card-title side" style="padding-left: 10px; padding-top: 10px">Formal Space</h5>
                                            <p class="card-text side text-muted" style="padding-left: 10px">Unique venue to rent for off-site meeting, product launches, conferences and many more.</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex1" style="padding-bottom: 30px">
                            <div class="card" style="width: 70vh">
                                <div class="row no-gutters">
                                    <div class="col-4">
                                        <img src="img/rec.jpg" alt="" class="card-img">
                                    </div>
                                    <div class="col-8">
                                        <button type="submit" name="listSportsFacilityBtn" style="text-align: left; border: none; background: none">
                                            <h5 class="card-title side" style="padding-left: 10px; padding-top: 10px">Recreational Facilities</h5>
                                            <p class="card-text side text-muted" style="padding-left: 10px">Spaces where you can have an activity of leisure such as swimming or exercising.</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-2"></div>
            </div>

        </div>

        <div class="title2">
            <h4>List of Rooms and Facilities</h4>
            <p class="text-muted">Our list of facilities and rooms available for booking.</p>
        </div>

        <div class="facilities text-center"><?php
	    $loop2 = 1;

	    while ($row2 = mysqli_fetch_assoc($listFacility2))
	    {
	        $viewFacility2 = $row2['facilityID'];
	        echo '<form action="ProfileFacility.php" method="get">';
		    echo "<input type='hidden' value='$viewFacility2' name='viewFacility'>";
		    echo '<img src="img/facility/'.$row2['facilityName'].'/0.jpg" id="imgfac1" style="border-radius: 20px">';
		    echo '<img src="img/facility/'.$row2['facilityName'].'/1.jpg" id="imgfac1" style="border-radius: 20px">';
		    echo '<button type="submit" class="btn btn-outline-dark btn-block" name="viewFacilityBtn" style="border: none">';
		    echo '<h4>'.$row2['facilityName'].'</h4>';
		    echo '<p>'.$row2['facilityAmenities'].'</p>';
		    echo '<p class="font-weight-bold">RM'.$row2['facilityRate'].' / day</p>';
		    echo '</button>';
	        echo '<hr>';
		    echo '<br>';
		    echo '</form>';
	        $loop2++;
        }
        ?>
        </div>
    </div>
</div>


<!-- Local JavaScript -->
<script>
    const userType = "<?= $_SESSION['userType']; ?>";
    if (userType === "1" || userType === "2")
    {

        document.getElementById("memberDiv").style.display = "none";
    }

    else if (userType === "3")
    {
        document.getElementById("staffDiv").style.display = "none";
    }
</script>
<!-- Optional CDN -->
<script>
    let url = new URL(window.location.href);
    let searchParams = new URLSearchParams(url.search);
    var msg = searchParams.get('msg');
    if(msg === 'sql')
    {
        Swal.fire
        (
            'Error',
            'Server connection could not be established.',
            'error'
        )
    }
    if(msg === 'updated')
    {
        Swal.fire
        (
            'Success',
            'Facility information updated.',
            'success'
        )
    }
    if(msg === 'deleted')
    {
        Swal.fire
        (
            'Success',
            'Facility deleted.',
            'success'
        )
    }
    if(msg === 'empty')
    {
        Swal.fire
        (
            'Error',
            'Fields must not be left empty.',
            'error'
        )
    }
    if(msg === 'taken')
    {
        Swal.fire
        (
            'Error',
            'Facility name is in use.',
            'error'
        )
    }
    if(msg === 'insert')
    {
        Swal.fire
        (
            'Success',
            'Facility has been added.',
            'success'
        )
    }
    if(msg === 'success')
    {
        Swal.fire
        (
            'Success',
            'Facility image updated.',
            'success'
        )
    }
</script>
</body>
</html>
