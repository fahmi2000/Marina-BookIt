<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.html");
}

require 'Handler/bookingHandler.php';

$qry = viewBooking();
$row = mysqli_fetch_assoc($qry);

$bookingID = $row['bookingID'];
$userName = $row['b_userName'];
$facilityID = $row['b_facilityID'];
$startDate = $row['startDate'];
$endDate = $row['endDate'];
$durationDay = $row['b_durationDay'];
$totalRate = $row['b_totalRate'];
$bookingStatus = $row['bookingStatus'];
$paymentMethod = $row['paymentMethod'];
$paymentStatus = $row['paymentStatus'];

$facilityNameQry = getFacilityName($facilityID);
$row2 = mysqli_fetch_assoc($facilityNameQry);
$facilityName = $row2['facilityName'];

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
                    List of booking <span class="fas fa-angle-down" style="right: -25px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Booking Management</h6>    
                        <a class="dropdown-item active" href="listOfBooking.php">List of booking</a>
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
                    List of Booking<span class="fas fa-angle-down" style="right: -25px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    
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
                    List of Booking<span class="fas fa-angle-down" style="right: -25px; position: relative;"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Dashboard.php">Home</a>
                    
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
            <a class="dropdown-item" href="#">Sign out</a>
        </div>
    </div>
</div>

<div class="container" style="border-radius: 10px">
    <div class="container-1">
        <h3 style="padding-top: 20px">Booking Information - <?= $bookingID ?></h3>

        <form action="Handler/bookingHandler.php" method="post">
            <div class="row">
                <div class="col">
                    <label for="bookingID">BOOKING ID</label>
                    <input type="text" class="form-control" name="bookingID" id="bookingID" value="<?= $bookingID ?>" readonly>
                </div>
                <div class="col">
                    <label for="userName">USERNAME</label>
                    <input type="text" class="form-control" name="userName" id="userName" value="<?= $userName ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="facilityID">FACILITY ID</label>
                    <input type="text" class="form-control" name="facilityID" id="facilityID" value="<?= $facilityID ?>" readonly>
                </div>
                <div class="col">
                    <label for="facilityName">FACILITY NAME</label>
                    <input type="text" class="form-control" name="facilityName" id="facilityName" value="<?= $facilityName ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="startDate">START DATE</label>
                    <input type="text" class="form-control" name="startDate" id="startDate" value="<?= $startDate ?>" readonly>
                </div>
                <div class="col">
                    <label for="endDate">END DATE</label>
                    <input type="text" class="form-control" name="endDate" id="endDate" value="<?= $endDate ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="totalRate">TOTAL PRICE</label>
                    <input type="text" class="form-control" name="totalRate" id="totalRate" value="<?= $totalRate ?>" readonly>
                </div>
                <div class="col">
                    <label for="bookingStatus">BOOKING STATUS</label><?php
                    if ($bookingStatus == 0)
                    {
                        echo '
                        <input type="text" class="form-control" name="bookingStatus" id="bookingStatus" value="PENDING" readonly>
                        ';
                    }

                    elseif ($bookingStatus == 1)
                    {
	                    echo '
                        <input type="text" class="form-control" name="bookingStatus" id="bookingStatus" value="APPROVED" readonly>
                        ';
                    }

                    elseif ($bookingStatus == 2)
                    {
	                    echo '
                        <input type="text" class="form-control" name="bookingStatus" id="bookingStatus" value="DENIED" readonly>
                        ';
                    }

                    elseif ($bookingStatus == 3)
                    {
	                    echo '
                        <input type="text" class="form-control" name="bookingStatus" id="bookingStatus" value="CANCELLED" readonly>
                        ';
                    }

                    elseif ($bookingStatus == 4)
                    {
	                    echo '
                        <input type="text" class="form-control" name="bookingStatus" id="bookingStatus" value="REQUESTING CANCELLATION" readonly>
                        ';
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="paymentMethod">PAYMENT METHOD</label>
                    <input type="text" class="form-control" name="paymentMethod" id="paymentMethod" value="<?= $paymentMethod ?>#" readonly>
                </div>
                <div class="col">
                    <label for="paymentStatus">PAYMENT STATUS</label>
                    <input type="text" class="form-control" name="paymentStatus" id="paymentStatus" value="<?= $paymentStatus ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col"><?php
                    if ($_SESSION['userType'] == 1 || $_SESSION['userType'] == 2)
                    {
	                    echo '
                            <div class="btn-group dropup" style="float: right">
                                <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approveModal">Approve</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#denyModal">Deny</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cancelModal">Cancel</a>
                                </div>
                            </div>
                        ';
                    }

                    elseif ($_SESSION['userType'] == 3)
                    {
                        echo '
                            <button class="btn btn-dark" type="submit" name="bookingCancelRequestBtn" style="float: right">Request Cancellation</button>
                        ';
                    }

                    ?>

                </div>
            </div>
            <div class="modal fade" id="approveModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Facility Booking Approval</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to approve this booking?</p>

                            <p>Booking made by <span style="font-weight: bold"><?= $userName ?></span></p>
                            <p>Who would be reserving <span style="font-weight: bold"><?= $facilityName ?></span> for <span style="font-weight: bold"><?= $durationDay ?> days</span></p>
                            <p>From <span style="font-weight: bold"><?= $startDate ?></span> until <span style="font-weight: bold"><?= $endDate ?></span></p>
                            <p>For the price of <span style="font-weight: bold">RM<?= $totalRate ?></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" name="bookingApproveBtn">Approve</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="denyModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Facility Booking Denial</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to deny this booking?</p>

                            <p>Booking made by <span style="font-weight: bold"><?= $userName ?></span></p>
                            <p>Who would be reserving <span style="font-weight: bold"><?= $facilityName ?></span> for <span style="font-weight: bold"><?= $durationDay ?> days</span></p>
                            <p>From <span style="font-weight: bold"><?= $startDate ?></span> until <span style="font-weight: bold"><?= $endDate ?></span></p>
                            <p>For the price of <span style="font-weight: bold">RM<?= $totalRate ?></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" name="bookingDenyBtn">Deny</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cancelModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Facility Booking Cancellation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to cancel this booking?</p>

                            <p>Booking made by <span style="font-weight: bold"><?= $userName ?></span></p>
                            <p>Who would be reserving <span style="font-weight: bold"><?= $facilityName ?></span> for <span style="font-weight: bold"><?= $durationDay ?> days</span></p>
                            <p>From <span style="font-weight: bold"><?= $startDate ?></span> until <span style="font-weight: bold"><?= $endDate ?></span></p>
                            <p>For the price of <span style="font-weight: bold">RM<?= $totalRate ?></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" name="bookingCancelBtn">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Local JavaScript -->

</body>
</html>
