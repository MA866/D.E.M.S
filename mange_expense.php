<?php
	include("session.php");
	$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");

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
				<h3 class="text-center">Manage Expenses</h3>
                <hr>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6" style="margin: 0 400px;">
                        <table class="table tabble-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Expense Category</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
							<?php
							$count = 1;
							while($row = mysqli_fetch_array($exp_fetched)){ ?>
								<tr>
									<td><?php echo $count ?></td>
									<td><?php echo $row['expensedate']; ?></td>
									<td><?php echo '₹'. $row['expense']; ?></td>
									<td><?php echo $row['expensecategory']; ?></td>
									<td class="text-center">
										<a href="add_expense.php?edit=<?php echo $row['expense_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
									</td>
									<td class="text-center">
										<a href="add_expense.php?delete=<?php echo $row['expense_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
									</td>
								</tr>
							<?php $count++; }?>

                        </table>
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