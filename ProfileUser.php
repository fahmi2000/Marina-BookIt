<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.html");
}

    require 'Handler/databaseConnect.php';

    $userID = $_SESSION['userID'];

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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <!-- Local CSS -->
    <link rel="stylesheet" href="CSS/master.css">
    <style>
        body
        {
            height: 100vh;
        }

        #userPic
        {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        #backBtn
        {
            position: fixed;
            top: 10px;
            left: 10px;
        }
    </style>
    <!-- Icon CDN -->
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

    <title><?php echo $_SESSION['userName'];?>'s Profile - Marina BookIt</title>
</head>
<body>
<!-- Profile Card -->
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
<!-- Local JavaScript -->
<?php
    if ($userType == 1)
        echo '<a href="DashboardAdmin.php" class="btn btn-dark" type="button" id="backBtn">Back to Dashboard</a>';
    elseif ($userType == 2)
        echo '<a href="DashboardStaff.php" class="btn btn-dark" type="button" id="backBtn">Back to Dashboard</a>';
    elseif ($userType == 3)
        echo '<a href="DashboardMember.php" class="btn btn-dark" type="button" id="backBtn">Back to Dashboard</a>';
?>
<!-- Optional CDN -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
</body>
</html>