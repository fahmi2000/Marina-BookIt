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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

	<!-- Local CSS -->
    <link rel="stylesheet" href="CSS/master.css">
    <style>
        #userPic
        {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }
    </style>

	<!-- Icon CDN -->
	<script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

	<title>Staff Management - <?php echo $userName; ?></title>
</head>
<body>


<div class="container h-100">

    <div class="row h-100 justify-content-center align-items-center">
        <div id="swapper-first">
            <div class="card" style="width: 70rem; padding: 5px">
                <h1 class="display-4 text-center">Staff Management</h1>
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="card-title"><?php echo $userName;?>'s Profile</h4>
                        <img class="d-inline" src="img/profilepic/<?= $userID ; ?>.jpg?<?= mt_rand() ; ?>" id="userPic"/>
                    </div>

                    <form action="Handler/eventListener.php" method="post" class="text-center">
                        <div class="btn-group dropdown" style="padding-bottom: 20px; padding-top: 20px">
                            <button type="button" class="btn btn-outline-warning dropdown-toggle text-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Change Password
                            </button>
                            <div class="dropdown-menu p-4" style="min-width: 20rem">
                                <input type="password" class="form-control" name="userID" value="<?= $userID ?>" readonly hidden>
                                <br>
                                <label for="userPwd">New Password</label>
                                <input type="password" class="form-control" name="userPwdNew" placeholder="Password" required>
                                <br>
                                <label for="userPwdNewRepeat">Repeat New Password</label>
                                <input type="password" class="form-control" name="userPwdNewRepeat" placeholder="Password" required>
                                <div class="dropdown-divider"></div>
                                <button type="submit" class="btn btn-primary float-right" name="ADMINpwdUpdateBtn">Save</button>
                            </div>
                        </div>
                    </form>

                    <form action="Handler/eventListener.php" method="post">
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
                                <input type="text" class="form-control"  value="<?= $userID ?>" id="userID" name="userID" readonly>
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
                            <button type="submit" class="btn btn-primary float-right" name="ADMINprofileUpdateBtn">Save Changes</button>
                            <button type="submit" class="btn btn-outline-danger float-left" name="ADMINprofileDeleteBtn">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Local JavaScript -->
<!-- Optional CDN -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
</body>
</html>

