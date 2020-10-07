<?php
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
	<link rel="stylesheet" href="CSS/index.css">
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

	<title>Explore - Marina Bookit</title>
</head>
<body>
<div class="container-fluid naviBar sticky-top" style="background-color: #ffffff;">
	<div class="container-fluid">
		<div class="row text-center">
			<div class="col indexLogo">
				<img src="img/logo.png" alt="">
				<div class="btn-group signBtn" role="group">
					<a class="btn btn-dark" href="signinPage.html" role="button">Sign In</a>
					<a class="btn btn-dark" href="registerMember.html" role="button">Register</a>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col">
				<div class="btn-group" role="group">
					<a href="index.html" type="button" class="btn btn-dark" id="button3">Home</a>
					<a href="index.html" type="button" class="btn btn-dark">Explore</a>
					<a href="index.html" type="button" class="btn btn-dark" id="button1">About Us</a>
					<a href="index.html" type="button" class="btn btn-dark" id="button2">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container" id="memberDiv">
	<div class="container-3">
		<div class="title">
			<h4>Categories</h4>
			<p class="text-muted">Sort by categories from our wide range of offerings.</p>
		</div>
		<div class="categories">
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
								<img src="img/bg1.jpg" alt="" class="card-img">
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
								<img src="img/bg1.jpg" alt="" class="card-img">
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
				echo '<a href="signinPage.html" class="btn btn-outline-dark btn-block" style="border: none">';
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

<!-- Optional CDN -->

</body>
</html>

