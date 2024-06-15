<?php
    require('connect.php');
    session_start();
    $errorMsg = '';
    if(isset($_POST['email']))
    {
        $email = strip_tags($_REQUEST['email']);
        $email = mysqli_real_escape_string($con,$email);

        $password = strip_tags($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);

        $query = "SELECT * FROM `users` WHERE email = '$email' AND password = '". md5($password). "'";
        $result = mysqli_query($con,$query) or die(mysqli_error($con));
        $row = mysqli_num_rows($result);
        if($row==1)
        {
            $_SESSION['email'] = $email;
            header("location: index.php");
        }
        else
        {
            $errorMsg ="Wrong Password";
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

    <title>Login</title>
</head>
<body>
    <div class="login-form">
        <form action="" method="post" autocomplete="off">
            <h2 class="">D.E.M.S</h2>
            <p class="hint-text">Login Panel</p>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-block btn-lg">Login</button>
            </div>
            <div class="clearfix">
                <label class="float-left form-check-label"><input type="checkbox" class="me-1">Remember Me</label>
            </div>
        </form>
        <p class="text-center">Don't have an account?<a href="register.php" class="text-danger text-decoration-none"> Register Here</a></p>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>