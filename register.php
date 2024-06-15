<?php
    require('connect.php');
    if(isset($_REQUEST['firstname']))
    {
        if($_REQUEST['password'] == $_REQUEST['conf-password'])
        {
            $firstname = stripslashes($_REQUEST['firstname']);
            $firstname = mysqli_real_escape_string($con, $firstname);

            $lastname = stripslashes($_REQUEST['lastname']);
            $lastname = mysqli_real_escape_string($con, $lastname);

            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con, $email);

            $password= stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $tm_date = date("Y-m-d H:i:s");

            $query = "INSERT INTO `users` (firstname,lastname,email,password,tm_date) VALUES('$firstname','$lastname','$email','". md5($password) ."','$tm_date')";

            $result = mysqli_query($con,$query);
            if($result)
            {
                header("location: login.php");
            }
            else
            {
                echo "Error: Please check your password and confirm password";
            }
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

    <title>Register</title>
</head>
<body>
    <div class="signup-form">
        <form action="" method="post" autocomplete="off">
            <h2 class="">Register</h2>
            <div class="row">
                <div class="form-group col-6">
                    <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                </div>
                <div class="form-group col-6">
                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                </div>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="conf-password" class="form-control" placeholder="Confirm Password" required>
            </div>

            <div class="clearfix">
                <label class="form-check-label"><input type="checkbox" class="me-1">I accept the <a href="#" >Terms of use</a> & <a href="#" class="">Privacy Policye</a></label>
            </div>

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-danger btn-block btn-lg">Register</button>
            </div>
        </form>
        <p class="text-center">Already have an account?<a href="login.php" class="text-success text-decoration-none"> Login Here</a></p>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>