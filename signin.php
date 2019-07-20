<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>

            #main{
                margin-left:30vw;
                margin-right:30vw;
                margin-top:100px;
                margin-bottom:100px;
                padding-top:50px;
                padding-bottom:50px;
                padding-left:100px;
                padding-right:100px;
                border:1px solid black;

            }

            @media(max-width:900px){
                #main{
                    margin-left:10vw;
                    margin-right:10vw;
                    padding-left:10vw;
                    padding-right:10vw;
                }
                h3{
                    font-size:20px;
                }
            }

            .input-group input {
                border-right: 0px solid transparent;
            }

            .input-group .input-group-addon {
                background-color: transparent;
                border-left: 0px solid transparent;
            }
        </style>

    </head>
    <body>
    
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

        <div id="main">
        
        <div class="row bg-info" style="height:55px;padding-top:10px" id="main2">
            <div class="col-12 col-md-12">
                <div class="main-content">
                    <div class="header" style="top:5px;">
                        <h3 style="text-align:center;"><strong>LOGIN GUFTAGOO</strong></h3>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <?php // form ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <input required type="email" class="form-control" placeholder="Email" id="email" name="email">
            </div>

            <div class="form-group">
                <input required type="password" class="form-control" placeholder="Password" id="password" name="password">
            </div>

            <a href="forgot_password.php" title="forgot_password" class="text-info" style="text-decoration:none;float:left;">Fogot password?</a>
            <a href="Signup.php" title="Signin" class="text-info" style="text-decoration:none;float:right;">Don't have an account?</a>
            <br><br>
            <center><button class="btn btn-info" type="submit" id="login" name="login">Login</button><center>
            <?php include('login.php');?>
        </form>
    </body>
</html>