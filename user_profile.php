<?php
session_start();
include("includes/header.php");
include('functions/functions.php');
if(!isset($_SESSION['user_email'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $user = $_SESSION['user_email'];
            $get_user = "select * from users where user_email = '$user' ";
            $run_user = mysqli_query($con , $get_user);
            $row = mysqli_fetch_array($run_user);

            $user_name = $row['user_name'];
        ?>
        <title><?php echo "$user_name" ?></title>
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

        #posts{
            border:2px outset lightgrey;
            padding:50px;
            margin:50px;
            background-color:white;
        }

        @media(max-width:800px){
            #img-posts{
                margin:100vw;
            }
        }

    </style>
    <body style="background-color:#e6ffff">
        <?php
            if(isset($_GET['u_id'])){
                $u_id = $_GET['u_id'];
            }
            if($u_id < 0 || $u_id ==""){
                echo "<script>window.open('home.php','_self')</script>";
            }
            else{

            }
        ?>

            <?php
                if(isset($_GET['u_id'])){

                    global $con;
                    $user_id = $_GET['u_id'];
                    $select = "select * from users where user_id ='$user_id' ";
                    $run = mysqli_query($con,$select);
                    $row = mysqli_fetch_array($run);

                    $name = $row['user_name'];
                }
            ?>

            <?php

                if(isset($_GET['u_id'])){
                    global $con;

                    $user_id = $_GET['u_id'];
                    $select = "select * from users where user_id ='$user_id' ";
                    $run = mysqli_query($con,$select);
                    $row = mysqli_fetch_array($run);

                    $id = $row['user_id'];
                    $image = $row['user_image'];
                    $name = $row['user_name'];
                    $f_name = $row['f_name'];
                    $l_name = $row['l_name'];
                    $descibe_user = $row['describe_user'];
                    $country = $row['user_country'];
                    $gender = $row['user_gender'];
                    $image = $row['user_image'];
                    $register_date = $row['user_reg_date'];

                    echo"

                        <div class='row' style='margin-top:100px'>
                            <div class='col-12 col-md-1'></div>
                                <div style='background-color:#e6e6e6;text-align:center' class='col-12 col-md-3'>
                                <h2>Information About</h2>
                                <img class='img-circle' src='users/$image' width='150' height='150'/>
                                <br><br>
                                <ul class='list-group'>
                                    <li  class='list-group-item' title='Username'><strong>
                                    $f_name $l_name</strong></li>

                                    <li  class='list-group-item' title='User Status' style='color:grey'><strong>
                                    $descibe_user</strong></li>

                                    <li  class='list-group-item' title='Gender'><strong>
                                    $gender</strong></li> 

                                    <li  class='list-group-item' title='Country'><strong>
                                    $country</strong></li>

                                    <li  class='list-group-item' title='User Registration Date'><strong>
                                    $register_date</strong></li>

                    ";

                    $user = $_SESSION['user_email'];  
                    $get_user = "select * from users where user_email='$user' ";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);

                    $userown_id = $row['user_id'];
                    if($user_id==$userown_id){
                        echo "<li class='list-group-item'><a href='edit_proile.php?u_id=$userown_id' class='btn btn-success'>
                        Edit Profile</a></li><br><br><br>";
                    }
                    else{
                        echo "<li class='list-group-item'></li><br><br><br>";
                    }

                    echo "
                            </ul>
                        </div>
                    ";


                }

            ?>
        <div class="col-12 col-md-8">
                <center><h1><strong><?php echo "$f_name $l_name" ?></strong></h1></center><br>
                <?php
                    global $con;

                    if(isset($_GET['u_id'])){
                        $u_id = $_GET['u_id'];
                    }

                    $get_posts = "select * from posts where user_id = $u_id ORDER by post_id
                     DESC limit 5";

                     $run_posts = mysqli_query($con,$get_posts);
                     echo "<div class='img-posts'>";

                     while($row_posts = mysqli_fetch_array($run_posts)){

                        $post_id = $row_posts['post_id'];
                        $user_id = $row_posts['user_id'];
                        $content = $row_posts['post_content'];
                        $upload_image = $row_posts['post_image'];
                        $post_date = $row_posts['post_date'];

                        $user = "select * from users where user_id='$user_id' AND posts='yes' ";
                        $run_user = mysqli_query($con,$user);
                        $row_user = mysqli_fetch_array($run_user);

                        $user_image = $row_user['user_image'];
                        $user_name = $row_user['user_name'];
                        $f_name = $row_user['f_name'];
                        $l_name = $row_user['l_name'];
                        if($content==NULL && strlen($upload_image)>=1){
                            echo"
                            <div class='row'>
                                <div class='col-sm-1 col-md-2'></div>
                                <div id='posts' class='col-sm-10 col-md-6'>
                                    <div class='row'>
                                        <div class='col-sm-3'>
                                            <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                            height='100px'></p>
                                        </div>
                                        <div class='col-md-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;'
                                            href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                            <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class=col-md-12'>
                                            <img id='posts-img' class='image-fluid' src='post_image/$upload_image' style='height:350px;width:400px;'/>
                                        </div>
                                    </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'>
                                            <button class='btn btn-info'>Comment</button></a><br>
                                </div>
                                <div class='col-md-3'></div>
                            </div>
                            ";
                        }
                        else if(strlen($content)>=1 && strlen($upload_image)>=1){
                            echo"
                            <div class='row'>
                                <div class='col-sm-1 col-md-3'></div>
                                <div id='posts' class='col-sm-10 col-md-6'>
                                    <div class='row'>
                                        <div class='col-sm-2 col-sm-2'>
                                            <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                            height='100px'></p>
                                        </div>
                                        <div class='col-sm-6 col-md-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;'
                                            href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                            <h4><small>Updated a post on<strong>   $post_date</strong></small></h4>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class=coll-12 col-md-12'>
                                            <p>$content</p>
                                            <img id='posts-img' class='image-fluid' src='post_image/$upload_image' class='img-fluid' style='height:350px;width:400px'/>
                                        </div>
                                    </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'>
                                            <button class='btn btn-info'>Comment</button></a><br>
                                </div>
                                <div class='col-12 col-md-3'></div>
                            </div>
                            ";
                        }
                        else{
                            echo"
                            <div class='row'>
                                <div class='col-md-3'></div>
                                <div id='posts' class='col-md-6'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                            height='100px'></p>
                                        </div>
                                        <div class='col-md-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;'
                                            href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                            <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class=col-md-12'>
                                            <p>$content</p>
                                        </div>
                                    </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'>
                                            <button class='btn btn-info'>Comment</button></a><br>
                                </div>
                                <div class='col-md-3'></div>
                            </div>
                            ";
                        }

                     }
                     echo "</div>";
                ?>
        </div>
    </body>
</html>