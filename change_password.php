<?php
	include("session.php");
	if(isset($_POST['updatepassword']))
	{
		$email = $_SESSION['email'];
		$curr_password = md5($_POST['curr_password']);
		$sql="SELECT * FROM users WHERE email = '$email' && password='$curr_password'";
		print_r($sql);
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		$rows = $row['password'] ?? [];
		
		$new_password = $_POST['new_password'];
		$confirm_new_password = $_POST['confirm_new_password'];

		if($curr_password == $rows && $new_password == $confirm_new_password)
		{
			$query="UPDATE users SET password='" . md5($new_password) . "' WHERE email=' " . $email ."' ";
			mysqli_query($con, $query);
			$message="Password changed Successfully";
        	echo $message;
			// header("Location: logout.php");
		}
		else
		{
			$message="Password changed Unsuccessfully";
        	echo $message;
		}


	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

	<script src="js/feather.min.js"></script>

	<title>Expense Manager - Dashboard</title>
</head>
<body>
<!-- Sidebar -->
	<div class="d-flex" id="wrapper">
		<div class="border border-right" id="sidebar-wrapper">
			<div class="user">
				<img class="img img-fluid rounded-circle"
				src="<?php echo $userprofile ?>" width="120">
				<h5><?php echo $username ?></h5>
				<p><?php echo $useremail ?></p>
			</div>
			<div class="sidebar-heading">Managment</div>
			<div class="list-group list-group-flush">
				<a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span>Dashborad</a>
				<a href="add_expense.php" class="list-group-item list-group-item-action"><span data-feather="plus-square"></span>Add Expense</a>
				<a href="mange_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span>Manage Expense</a>
			</div>

			<div class="sidebar-heading"> Setting </div>
			<div class="list-group list-group-flush">
				<a href="profile.php" class="list-group-item list-group-item-action"><span data-feather="user"></span>Profile</a>
				<a href="change_password.php" class="list-group-item list-group-item-action"><span data-feather="key"></span>Change Password</a>
				<a href="logout.php" class="list-group-item list-group-item-action"><span data-feather="power"></span>Logout</a>
			</div>
		</div>

		<!-- Page area -->
		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light border-bottom">
				<button class="toggler ms-2" type="button" id="menu-toggle" aria-expanded="false"><span data-feather="menu"></span></button>
				<div class="collapse navbar-collapse" id="navbarSupportContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expended="false">
								<img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a href="profile.php" class="dropdown-item">Your Profile</a>
								<div class="dropdown-divider"></div>
								<a href="logout.php" class="dropdown-item">Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>


			<div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                    <h3 class="mt-4 text-center"> Hi! <?php echo $firstname; ?> You can change your password here</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md">
                            <form class="form" method="post">
                                <div class="form-group">
                                    <div class="col">
                                        <label for="curr_password">Enter Current Password</label>
                                        <input type="password" class="form-control" name="curr_password" id="curr_password" placeholder="Current Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="new_password">Enter New Password</label>
                                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="confirm_new_password">Enter Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-12 text-center">
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-block" name="updatepassword" id="updatepassword" value="Update password">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>

	<script src="js/jquery.slim.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script type="module" src="js/Chart.min.js"></script>


	<!-- menu toggle script -->
	<script>
		$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
		});
	</script>
	<script>
		feather.replace()
	</script>

</body>
</html>