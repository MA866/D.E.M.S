<?php
	include("session.php");
	$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");

    if(isset($_POST['save']))
    {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];

        $sql = "UPDATE users SET firstname = '$fname', lastname='$lname' WHERE user_id='$userid'";
        if(mysqli_query($con, $sql))
        {
            echo "Records were updated successfully";
        }
        else
        {
            echo "ERROR: Not able to execute $sql. " . mysqli_error($con);
        }
        header("Location:profile.php");
    }
    if(isset($_POST['but_upload']))
    {
        $name = $_FILES['file']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir .basename($name);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg",'jpeg','png','gif');
        if(in_array($imageFileType,$extensions_arr))
        {
            $query = "UPDATE users SET profile_path='$name' WHERE user_id='$userid'";
            mysqli_query($con,$query);
            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir . $name);
            header("Refresh:0");
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


			<div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                    <h3 class="mt-4 text-center">Update Profile</h3>
                    <hr>
                        <form class="form" method="post" action="" enctype='multipart/form-data'>
                            <div class="text-center mt-3">
                                <img src="<?php echo $userprofile; ?>" class="text-center img img-fluid rounded-circle avatar" width="120" alt="Profile Picture">
                            </div>
                            <div class="input-group col-md mb-3 mt-3">
                                <div class="custom-file">
                                    <input type="file" name='file' class="custom-file-input form-control" id="profilepic" aria-describedby="profilepicinput">
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit" name='but_upload' id="profilepicinput">Upload Picture</button>
                                </div>
                            </div>
                        </form>


                        <form class="form" method="post" id="registrationForm" autocomplete="off">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="col-md">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $firstname; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="col-md">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last Name" value="<?php echo $lastname; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md">
                                    <label for="email">Last Name</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $useremail; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md">
                                    <button class="btn btn-success btn-md btn-block" name="save" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
		</div>
	</div>

	<script type="module" src="js/Chart.min.js"></script>
	<script src="js/jquery.slim.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/brands.min.js"></script>

	<script>
		feather.replace()
	</script>

	<!-- menu toggle script -->
	<script>
		$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
		});
	</script>
    <script type="text/javascript">
        $(document).ready(function(){
            var readURL = function(input)
            {
                if(input.files && input.files[0])
                {
                    var reader = new FileReader();
                    reader.onload = function(e)
                    {
                        $('.avatar').attr('src',e.target.result)
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('.file_upload').on('change', function()
            {
                readURL(this);
            })
        })
    </script>

</body>
</html>