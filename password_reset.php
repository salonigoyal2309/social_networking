<?php
session_start();
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

            #message {
                display:none;
                background: #e6ffff;
                color: #111;
                position: relative;
                padding: 20px;
                margin-top: 10px;
            }

            #present{
                display:none;
                color: red;
                position: relative;
                margin-top: 5px; 
            }

            #available{
                display:none;
                color: green;
                position: relative;
                margin-top: 5px; 
            }

            .valid{
                color:green;
            }

            .valid:before{
                position:relative;
                content: "✔";
                left:-10px;
            }

            .invalid{
                color:red;
            }

            .invalid:before{
                position:relative;
                content:"✖";
                left:-10px;
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
                            <h3 style="text-align:center;"><strong>RESET PASSWORD ?</strong></h3>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <form action="" method="POST">
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-key"></i>
                    </span>
                    <input required type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                     class="form-control" placeholder="Password" name="password" id="password">
                </div>

                <div id="message">
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                </div>


                <script>
                    var myInput = document.getElementById("password");
                    var letter = document.getElementById("letter");
                    var capital = document.getElementById("capital");
                    var number = document.getElementById("number");
                    var length = document.getElementById("length");

                // When the user clicks on the password field, show the message box
                    myInput.onfocus = function() {
                    document.getElementById("message").style.display = "block";
                }
                // When the user clicks outside of the password field, hide the message box
                    myInput.onblur = function() {
                        document.getElementById("message").style.display = "none";
                }

                myInput.onkeyup = function() {
                // Validate lowercase letters
                var lowerCaseLetters = /[a-z]/g;
                if(myInput.value.match(lowerCaseLetters)) {  
                    letter.classList.remove("invalid");
                    letter.classList.add("valid");
                } else {
                    letter.classList.remove("valid");
                    letter.classList.add("invalid");
                }
  
                // Validate capital letters
                var upperCaseLetters = /[A-Z]/g;
                if(myInput.value.match(upperCaseLetters)) {  
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                }

                // Validate numbers
                var numbers = /[0-9]/g;
                if(myInput.value.match(numbers)) {  
                     number.classList.remove("invalid");
                    number.classList.add("valid");
                } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                }
  
                // Validate length
                if(myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                }
            }
                </script>


            </div><br>
            <center><button class="btn btn-info" type="submit" id="reset" name="reset">Reset</button><center>
        </form>
        </div>
    </body>

    <?php

        if(isset($_POST['reset'])){
        
            if(isset($_GET['u_id'])){
                $user_id = $_GET['u_id'];
            }
           // echo "<Script>alert($user_id)</script>";
            $pass = $_POST['password'];
           // echo $pass;
            $get_user = " update users set user_pass = '$pass' where user_id = '$user_id' ";
           // echo $get_user;
            $run_user = mysqli_query($con , $get_user);
            //$row = mysqli_fetch_array($run_user);

            if($run_user){
                echo "<Script>alert('password resetted')</script>";
                echo "<script>window.open('signin.php','_self')</script>";
            }
            else{
                echo "<script>alert('error')</script>";
                echo "<script>window.open('forgot_password.php','_self')</script>";
            }
        }

    ?>

</html>