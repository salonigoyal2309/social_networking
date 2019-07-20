<?php

include("includes/connection.php");
if(isset($_POST['login'])){

    $email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($con,$_POST['password']));

    $select_user = "select * from users where user_email = '$email' AND user_pass = '$password' 
    AND status = 'verified' ";
    $query = mysqli_query($con,$select_user);
    $check_user = mysqli_num_rows($query);

    if($check_user==1){
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('home.php')</script>";
    }
    else{
        echo "<script>alert('Email or password is incorrect')</script>";
        echo "<script>window.open('login.php','_self')<script>";
    }

}