<?php
    include("includes/connection.php");
    
    if(isset($_POST['sign_up'])){

        $user_name = htmlentities(mysqli_real_escape_string($con,$_POST['user_name']));
        $first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
        $last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
        $password = htmlentities(mysqli_real_escape_string($con,$_POST['password']));
        $email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
        $country = htmlentities(mysqli_real_escape_string($con,$_POST['country']));
        $gender = htmlentities(mysqli_real_escape_string($con,$_POST['gender']));
        $birthday = htmlentities(mysqli_real_escape_string($con,$_POST['birthdate']));
        $status = "verified";
        $posts = "no";
        //echo $user_name ;
        $check_mail = "select * from users where user_email = '$email' ";
        $run_email = mysqli_query($con , $check_mail);
        $check =  mysqli_num_rows($run_email);
        //echo $check;
        if($check==1){
            echo "<script>alert('Email already exists, try using another email')</script>";
            echo "<script>window.open('signup.php','_self')<script>";
            exit();
        }

        $profile_pic = "user_profile.png";
        $cover_pic = "cover_picture.gif";
        $insert = "insert into users(f_name,l_name,user_name,describe_user,
        Relationship,user_pass,user_email,user_country,user_gender,user_birthday,user_image,
        user_cover,user_reg_date,status,posts,recovery_account) 
        values(
        '$first_name','$last_name','$user_name','No status!','...','$password','$email',
        '$country','$gender','$birthday','$profile_pic','$cover_pic',NOW(),'$status',
        '$posts','Life is beautiful.'
        )
        ";

        $query = mysqli_query($con , $insert);
        echo mysqli_error($con);
        if($query){
            echo "<script>alert('Well Done! $first_name,you are good to go')</script>";
            echo "<script>window.open('signin.php','_self')<script>";
        }
        else{
            echo "<script>alert('Registration failed! Please try again! ')</script>";
            echo "<script>window.open('signup.php','_self')<script>";
        }
    }

?>