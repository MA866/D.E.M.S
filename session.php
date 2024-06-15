<?php
    include('connect.php');
    session_start();
    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
        exit();
    }

    $sess_email = $_SESSION['email'];
    $sql = "SELECT user_id,firstname,lastname,email,profile_path FROM `users` WHERE email = '$sess_email'";
    $result = $con->query($sql);
    if($result->num_rows > 0)

    {
        while($row = $result -> fetch_assoc())
        {
            $userid = $row["user_id"];
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $username = $row["firstname"] .  " " . $row["lastname"];
            $useremail = $row["email"];
            $userprofile = "uploads/" .$row["profile_path"];
        }
    }
    else
        {
            $userid = "HANSA12";
            $username = "Admin";
            $useremail = "mail@gmail.com";
            $userprofile = "uploads/user.png";
        }
?>