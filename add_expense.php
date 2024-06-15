<?php
	include("session.php");
	$update = false;
	$del = false;
	$expenseamount = "";
	$expensedate = date("d-m-Y");
	$expensecategory = "Entertainment";
	if(isset($_POST['add']))
	{
		$expenseamount = $_POST['expenseamount'];
		$expensedate = $_POST['expensedate'];
		$expensecategory =$_POST['expensecategory'];

		$expenses = "INSERT INTO expenses(user_id,expense,expensedate,expensecategory) VALUES ('$userid','$expenseamount','$expensedate','$expensecategory')";

		$result = mysqli_query($con, $expenses) or die ("Something Went Wrong");
		header("location: add_expense.php");
	}

	// Update
	if(isset($_POST['update']))
	{
		$id = $_GET['edit'];
		$expenseamount = $_POST['expenseamount'];
		$expensedate = $_POST['expensedate'];
		$expensecategory =$_POST['expensecategory'];

		$sql = "UPDATE expenses SET expense = '$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory' WHERE user_id='$userid' AND expense_id='$id' ";

		if(mysqli_query($con,$sql))
		{
			echo "Records were update successfully";
		}
		else
		{
			echo "Error Could not execute $sql . ". mysqli_error($con);
		}
		header('location: mange_expense.php');
	}

	// Delete
	if(isset($_POST['delete']))
	{
		$id = $_GET['delete'];
		$expenseamount = $_POST['expenseamount'];
		$expensedate = $_POST['expensedate'];
		$expensecategory =$_POST['expensecategory'];

		$sql = "DELETE FROM  expenses WHERE user_id='$userid' AND expense_id='$id'";

		if(mysqli_query($con, $sql))
		{
			echo "Records were Delete successfully";
		}
		else
		{
			echo "Error Could not execute $sql . ". mysqli_error($con);
		}
		header('location: mange_expense.php');
	}

	if(isset($_GET['edit']))
	{
		$id = $_GET['edit'];
		$update = true;

		$sql = mysqli_query($con, "SELECT * FROM  expenses WHERE user_id='$userid' AND expense_id='$id'");

		if(mysqli_num_rows($sql) == 1)
		{
			$n = mysqli_fetch_array($sql);
			$expenseamount = $n['expense'];
			$expensedate = $n['expensedate'];
			$expensecategory =$n['expensecategory'];
		}
		else
		{
			echo "WARNING: UNATHORIZATION ERROR: Trying to get unathorization data";
		}
	}

	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
		$del = true;

		$sql = mysqli_query($con, "SELECT * FROM  expenses WHERE user_id='$userid' AND expense_id='$id' ");

		if(mysqli_num_rows($sql) == 1)
		{
			$n = mysqli_fetch_array($sql);
			$expenseamount = $n['expense'];
			$expensedate = $n['expensedate'];
			$expensecategory =$n['expensecategory'];
		}
		else
		{
			echo "WARNING: UNATHORIZATION ERROR: Trying to get unathorization data";
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
				<h3 class="text-center mt-4">Add your daily Expenses</h3>
                <hr>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md" style="margin: 0 250px 0 0;">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="expenseamount" class="col-sm-6 col-form-label"><b>Enter Amount(₹)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expenseamount; ?>" name="expenseamount" id="expenseamount" require>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate; ?>" name="expensedate" id="expensedate" require>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory4" value="Medicine"<?php echo ($expensecategory == 'Medicine') ? 'checked' : '' ?>>
                                            <label for="expensecategory4" class="form-check-label">Medicine</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory5" value="Food"<?Php echo ($expensecategory == 'Food')?>>
                                            <label for="expensecategory5" class="form-check-label">Food</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory6" value="Bills and Recharges"<?Php echo ($expensecategory == 'Bills and Recharges')?>>
                                            <label for="expensecategory6" class="form-check-label">Bills and Recharges</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory7" value="Entetainment"<?Php echo ($expensecategory == 'Entetainment')?>>
                                            <label for="expensecategory7" class="form-check-label">Entetainment</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory1" value="Clothings"<?Php echo ($expensecategory == 'Clothings')?>>
                                            <label for="expensecategory1" class="form-check-label">Clothings</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory8" value="Rent"<?Php echo ($expensecategory == 'Rent')?>>
                                            <label for="expensecategory8" class="form-check-label">Rent</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory9" value="Household Items"<?Php echo ($expensecategory == 'Household Items')?>>
                                            <label for="expensecategory9" class="form-check-label">Household Items</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="expensecategory" id="expensecategory10" value="Other"<?Php echo ($expensecategory == 'Other')?>>
                                            <label for="expensecategory10" class="form-check-label">Other</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
									<?php if($update == true) : ?>
										<button type="submit" class="btn btn-lg btn-block btn-warning w-100 mt-4" name="update">Update</button>
									<?php elseif($del == true) : ?>
										<button type="submit" class="btn btn-lg btn-block btn-danger w-100 mt-4" name="delete">Delete</button>
									<?php else : ?>
										<button type="submit" class="btn btn-lg btn-block btn-success w-100 mt-4" name="add">Add Expense</button>
									<?php endif ?>
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

</body>
</html>