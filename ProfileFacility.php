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
$facilityDescription = $row['facilityDescription'];
$facilityAmenities = $row['facilityAmenities'];
$facilityStatus = $row['facilityStatus'];
$facilityType = $row['facilityType'];

$facilityAmenitiesArr = explode(" · ", $facilityAmenities);
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

        #facilityUpdateBtn
        {
            float: right;
        }

        #facilityList
        {
            display: grid;
            height: 100%;
            grid-template-areas:
                "images"
                "head"
                "amenities"
                "butts";
            background-color: #ffffff;
            grid-template-rows: 70% auto auto auto;
        }

        .images
        {
            grid-area: images;
            display: grid;
            grid-template-areas:
                "bigImg img1 img2"
                "bigImg img3 img4";
            padding-top: 20px;
        }
            .bigImg
            {
                grid-area: bigImg;
                height: inherit;
            }
            .img1 {grid-area: img1}
            .img2 {grid-area: img2}
            .img3 {grid-area: img3}
            .img4 {grid-area: img4}

        .head
        {
            grid-area: head;
            display: grid;
            grid-template-areas:
                "facilityName facilityName check"
                "description description check"
                "description description check";
            grid-template-columns: 30% 30% 40%;
        }
            .facilityName {grid-area: facilityName}
            .check {grid-area: check}
            .description {grid-area: description}

        .amenities{grid-area: amenities}
        .butts{grid-area: butts}
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
                    Menu <span class="fas fa-angle-down" style="right: -90px; position: relative;"></span>
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
            <a class="dropdown-item" href="#">Sign out</a>
        </div>
    </div>
</div>

<div class="container" id="facilityListAdmin">
    <div class="container-2">
        <h3 style="text-align: center">Facility Information - <?= $facilityName ?></h3><?php
	    if ($_SESSION['userType'] == 1)
        {
            echo '
                <p style="text-align: center">Edit or update information of a room or facility</p>
            ';
        }

	    elseif ($_SESSION['userType'] == 2)
        {
	        echo '
                <p style="text-align: center">Information of a room or facility</p>
            ';
        }
         ?>
        <hr id="hr1"><?php

        if ($_SESSION['userType'] == 1)
        {
            echo '
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <button class="btn btn-outline-dark" data-toggle="button" aria-pressed="false" onclick="editFunction()">Edit</button>
                                <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Show Images</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            ';
        }

        else
        {
	        echo '
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="form-group">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Button with data-target</button>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        ';
        }

        ?>
        <div class="row" style="display: flex">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">
                <div class="collapse" id="collapseExample">
                    <input type="image" src="img/facility/<?= $facilityName; ?>/1.jpg?<?= mt_rand(); ?>" style="width: 50%" data-toggle="modal" data-target="#img1">
                    <img src="img/facility/<?= $facilityName; ?>/2.jpg?<?= mt_rand(); ?>" style="width: 50%">
                    <img src="img/facility/<?= $facilityName; ?>/3.jpg?<?= mt_rand(); ?>" style="width: 50%">
                    <img src="img/facility/<?= $facilityName; ?>/4.jpg?<?= mt_rand(); ?>" style="width: 50%">
                    <img src="img/facility/<?= $facilityName; ?>/5.jpg?<?= mt_rand(); ?>" style="width: 50%">
                </div>
                <div class="modal fade" id="img1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Change Facility Image #1</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="Handler/facilityHandler.php" method="post" enctype="multipart/form-data">

                                <div class="modal-body">
                                    <div class="form-group text-center">
                                        <img src="img/facility/<?= $facilityName; ?>/1.jpg?<?= mt_rand(); ?>" style="max-width: 90%">
                                        <input type="text" name="facilityName" value="<?= $facilityName ?>" hidden>

                                    </div>
                                    <div class="form-group" style="text-align: right">
                                        <input type="file" name="facilityImg1" accept=".jpg">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-dark" name="facilityPicBtn1" type="submit">
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3"></div>

        </div>

        <div class="row">
            <div class="col-3"></div>

            <div class="col-6">
                <form method="post" action="Handler/eventListener.php">
                    <div class="form-group">
                        <label for="facilityID">ID</label>
                        <input class="form-control" type="text" name="facilityID" id="facilityID" value="<?= $facilityID ?>" >
                    </div>

                    <div class="form-group">
                        <label for="facilityName">NAME</label>
                        <input class="form-control" type="text" name="facilityName" id="facilityName" value="<?= $facilityName ?>" >
                    </div>

                    <div class="form-group">
                        <label for="facilityCapacity">CAPACITY</label>
                        <input class="form-control" type="text" name="facilityCapacity" id="facilityCapacity" value="<?= $facilityCapacity ?>" >
                    </div>

                    <div class="form-group">
                        <label for="facilityRate">RENTAL RATE PER DAY</label>
                        <input class="form-control" type="text" name="facilityRate" id="facilityRate" value="<?= $facilityRate ?>" >
                    </div>

                    <div class="form-group">
                        <label for="facilityDescription">DESCRIPTION</label>
                        <textarea class="form-control" type="text" name="facilityDescription" id="facilityDescription" rows="10"><?= $facilityDescription ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="facilityAmenities">TYPE</label>
                        <div class="form-check"><?php
                            if ($facilityType == "Formal")
                                echo '<input class="form-check-input" type="radio" name="facilityType" value="Formal" id="radio1" checked>';

                            else
	                            echo '<input class="form-check-input" type="radio" name="facilityType" value="Formal" id="radio1">';
                            ?>
                            <label class="form-check-label" for="radio1">Formal</label>
                        </div>
                        <div class="form-check"><?php
	                        if ($facilityType == "Sports")
		                        echo '<input class="form-check-input" type="radio" name="facilityType" value="Sports" id="radio2" checked>';

	                        else
		                        echo '<input class="form-check-input" type="radio" name="facilityType" value="Sports" id="radio2">';
	                        ?>
                            <label class="form-check-label" for="radio2">Sports</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="facilityAmenities">AMENITIES</label>
                        <div class="form-check"><?php
                            if (in_array("Pool", $facilityAmenitiesArr))
                                echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="Pool" id="checkBox1" checked>';

                            else
	                            echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="Pool" id="checkBox1">';
                            ?>
                            <label class="form-check-label" for="checkBox1">Pool</label>
                        </div>
                        <div class="form-check"><?php
	                        if (in_array("Seat", $facilityAmenitiesArr))
                                echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="Seat" id="checkBox2" checked>';

	                        else
		                        echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="Seat" id="checkBox2">';
                            ?>
                            <label class="form-check-label" for="checkBox2">Seats</label>
                        </div>
                        <div class="form-check"><?php
	                        if (in_array("Table", $facilityAmenitiesArr))
		                        echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="Table" id="checkBox3" checked>';

	                        else
		                        echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="Table" id="checkBox3">';
	                        ?>
                            <label class="form-check-label" for="checkBox3">Tables</label>
                        </div>
                        <div class="form-check"><?php
	                        if (in_array("PA", $facilityAmenitiesArr))
		                        echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="PA" id="checkBox4" checked>';

	                        else
		                        echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="PA" id="checkBox4">';
	                        ?>
                            <label class="form-check-label" for="checkBox4">PA System</label>
                        </div>
                        <div class="form-check"><?php
	                        if (in_array("AC", $facilityAmenitiesArr))
		                        echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="AC" id="checkBox5" checked>';

	                        else
		                        echo '<input class="form-check-input" type="checkbox" name="facilityAmenities[]" value="AC" id="checkBox5">';
	                        ?>
                            <label class="form-check-label" for="checkBox5">Air Conditioning</label>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="form-check"><?php
                            if ($facilityStatus == 1)
                            {
                                echo '
                                    <input class="form-check-input" type="radio" name="facilityStatus" value="1" id="radio3" checked>
                                    <label class="form-check-label" for="radio3">Available</label>
                                ';
                            }

                            else
                            {
	                            echo '
                                    <input class="form-check-input" type="radio" name="facilityStatus" value="1" id="radio3">
                                    <label class="form-check-label" for="radio3">Available</label>
                                ';
                            }
                            ?>
                        </div>

                        <div class="form-check"><?php
                            if ($facilityStatus == 2)
                            {
	                            echo '
                                    <input class="form-check-input" type="radio" name="facilityStatus" value="2" id="radio4" checked>
                                    <label class="form-check-label" for="radio4">Maintenance</label>
                                ';
                            }

                            else
	                            echo '
                                    <input class="form-check-input" type="radio" name="facilityStatus" value="2" id="radio4">
                                    <label class="form-check-label" for="radio4">Maintenance</label>
                                ';
                            ?>

                        </div>

                        <div class="form-check"><?php
	                        if ($facilityStatus == 2)
	                        {
		                        echo '
                                    <input class="form-check-input" type="radio" name="facilityStatus" value="3" id="radio5" checked>
                                    <label class="form-check-label" for="radio5">Not Available</label>
                                ';
	                        }

	                        else
		                        echo '
                                    <input class="form-check-input" type="radio" name="facilityStatus" value="3" id="radio5">
                                    <label class="form-check-label" for="radio5">Not Available</label>
                                ';
                            ?>
                        </div>
                    </div>

                    <div class="form-group"><?php
                        if ($_SESSION['userType'] = 1)
                        {
	                        echo '<button type="submit" class="btn btn-dark" name="facilityUpdateBtn" style="float: right">Save</button>';
	                        echo '<button type="submit" class="btn btn-outline-danger" name="facilityDeleteBtn">Delete</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>

            <div class="col-3"></div>
        </div>

    </div>
</div>
<!--member div-->
<div class="container" id="facilityList">
    <div class="images">
        <div class="bigImg" style="background-image: url('img/facility/<?= $facilityName ?>/1.jpg'); background-size: cover; border-radius: 30px 0 0 30px">

        </div>

        <div class="img1" style="background-image: url('img/facility/<?= $facilityName ?>/2.jpg'); background-size: cover;">

        </div>

        <div class="img2" style="background-image: url('img/facility/<?= $facilityName ?>/3.jpg'); background-size: cover; border-radius: 0 30px 0 0">

        </div>

        <div class="img3" style="background-image: url('img/facility/<?= $facilityName ?>/4.jpg'); background-size: cover;">

        </div>

        <div class="img4" style="background-image: url('img/facility/<?= $facilityName ?>/5.jpg'); background-size: cover; border-radius: 0 0 30px 0">

        </div>
    </div>

    <div class="head">
        <div class="facilityName" style="padding: 20px">
            <h3><?= $facilityName ?></h3>
            <h5><?= $facilityAmenities ?></h5>
            <hr>
        </div>
        <div class="check" style="padding: 20px">
            <div class="box" style="width: inherit; border: solid 1px; border-color: gray; border-radius: 20px">
                <div style="padding-left: 20px; padding-right: 20px; padding-top: 20px">
                    <form class="form-group" action="Handler/bookingHandler.php" method="post">
                        <input type="text" class="form-control" name="facilityName" value="<?= $facilityName ?>" hidden readonly>
                        <input type="text" class="form-control" name="facilityID" value="<?= $facilityID ?>" hidden readonly>
                        <div class="row">
                            <div class="col-sm-12">
                                <span style="font-size: 2rem">RM<?= $facilityRate ?> </span><span class="text-muted">/ day</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="startDate">CHECK-IN</label>
                                    <input type="date" class="form-control" id="startDate" name="startDate">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="endDate">CHECK-OUT</label>
                                    <input type="date" class="form-control" id="endDate" name="endDate">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-dark btn-block" name="checkAvailableFacilityBtn">Check availability</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="description" style="padding: 20px">
            <p><?= $facilityDescription ?></p>
        </div>
    </div>

    <div class="modal fade" id="myModal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">The facility is available!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-group" action="Handler/bookingHandler.php" method="post">
                    <input type="hidden" name="facilityID" value="<?= $facilityID ?>">
                    <input type="hidden" name="facilityName" value="<?= $facilityName ?>">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="startDate">CHECK-IN</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" value="<?= $_GET['startDate'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="endDate">CHECK-OUT</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate" value="<?= $_GET['endDate'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center text-muted">You won't be charged yet</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>RM<?= $facilityRate ?> x <?= $_GET['numDays'] ?> days <span style="float: right">RM<?= $facilityRate * $_GET['numDays'] ?></span></p>
                                    <input type="hidden" name="numDays" value="<?= $_GET['numDays'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12"><?php $cleanFee = 80?>
                                    <p>Cleaning fee <span style="float: right">RM<?=$cleanFee?></span></p>
                                    <input type="hidden" name="cleanFee" value="<?= $cleanFee ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12"><?php $serveFee = 69?>
                                    <p>Service fee <span style="float: right">RM<?=$serveFee?></span></p>
                                    <input type="hidden" name="serveFee" value="<?= $serveFee ?>">
                                </div>
                            </div>
                            <hr class="text-muted">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="font-weight-bold">Total <span style="float: right">RM<?= $totalRate = $cleanFee + $serveFee + ($facilityRate * $_GET['numDays']) ?></span></p>
                                    <input type="hidden" name="totalRate" value="<?= $totalRate ?>">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark btn-block btn-lg" name="bookFacilityBtn">Book</button>
                        <br>
                        <button type="button" class="btn btn-outline-dark btn-block" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div><?php
    if (isset($_GET['date']))
    {
	    if ($_GET['date'] == "Available")
        {
            echo "
            <script>
                $('#myModal').modal('show');
            </script>
            ";
        }
    }
    ?>

</div>

<div class="container" style="max-height: 1%"></div>

<!-- Local JavaScript -->

<script>
    //const userType = "<?//= $_SESSION['userType']; ?>//";
    //if (userType === "1")
    //{
    //    document.getElementById("facilityList").style.display = "none";
    //}
    //
    //else if (userType === "2")
    //{
    //    document.getElementById("facilityList").style.display = "none";
    //}
    //
    //else if (userType === "3")
    //{
    //    document.getElementById("facilityListAdmin").style.display = "none";
    //}
</script>
<script>
    function editFunction()
    {
        document.getElementById('facilityName').readOnly = document.getElementById('facilityName').readOnly !== true;
        document.getElementById('facilityCapacity').readOnly = document.getElementById('facilityCapacity').readOnly !== true;
        document.getElementById('facilityRate').readOnly = document.getElementById('facilityRate').readOnly !== true;
        document.getElementById('facilityAmenities').readOnly = document.getElementById('facilityAmenities').readOnly !== true;
        document.getElementById('facilityStatus').readOnly = document.getElementById('facilityStatus').readOnly !== true;
        document.getElementById('facilityDescription').readOnly = true;

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
