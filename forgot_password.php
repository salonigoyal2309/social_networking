<?php
    include("includes/connection.php");
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Forgot Passsword?</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <style>

            #main{
                margin-left:20vw;
                margin-right:20vw;
                margin-top:200px;
                margin-bottom:100px;
                padding-top:50px;
                padding-bottom:50px;
                padding-left:100px;
                padding-right:100px;
                border:1px solid black;

            }


        @media(max-width:800px){

            #main{
                margin-left:20vw;
                margin-right:20vw;
                margin-top:70px;
                margin-bottom:100px;
                padding-top:50px;
                padding-bottom:50px;
                padding-left:100px;
                padding-right:100px;
                border:1px solid black;

            }

        }

    </style>
    <body style="background-color:#e6ffff">

    <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-info">
            <div class="container">
                <a class="navbar-brand" href="main.php">
                <i class="fa fa-pencil" style="color:white;font-size:24px"></i> GUFTAGOO</a>
                <button id="tog" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="Signin.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="signup.php">Sign up</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div id="main" >
        
            <div class="row bg-info" style="height:55px;padding-top:10px" id="main2">
                <div class="col-12 col-md-12">
                    <div class="main-content">
                        <div class="header" style="top:5px;">
                            <h3 style="text-align:center;"><strong>FORGOT PASSWORD ?</strong></h3>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <form action="" method="POST">
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input required type="email" class="form-control" placeholder="Email" id="u_email" name="u_email">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Enter your school's Best Friends name
                    </span>
                    <input required type="text" class="form-control" placeholder="Name" id="u_name" name="u_name">
                </div>
            </div><br>
            <center><button class="btn btn-info" type="submit" id="submit" name="submit">Submit</button><center>
        </form>
        </div>
    </body>

    <?php

        if(isset($_POST['submit'])){
        
            $user = $_POST['u_email'];
            $get_user = "select * from users where user_email = '$user' ";
            
            $run_user = mysqli_query($con , $get_user);
            $row = mysqli_fetch_array($run_user);

            $friend = $row['recovery_account'];
            $user_id = $row['user_id'];
            //$_SESSION['idd'] = $user_id;
            if($friend==$_POST['u_name']){
                echo "<script>window.open('password_reset.php?u_id=$user_id','_self')</script>";
            }
            else{
                echo "<script>alert('error')</script>";
                echo "<script>window.open('forgot_password.php','_self')</script>";
            }
            
        }

    ?>

</html>