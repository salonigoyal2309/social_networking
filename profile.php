<?php
session_start();
include("includes/header.php");
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

        #change_cover{
            position:absolute;
            top: -14vw;
            left:1vw;
            border-radius:5px;
        }


        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 1000px;
            height:450px;
        }

        #posts{
            padding:50px;
            background-color:white;
            margin-left:0px;
        }


        #change_profile{
            position:absolute;
            top:-3.5vw;
            left:5vw;
            font-size:0.8vw;
            opacity:0.5;
        }

        #profile-img{
            position:absolute;
            top: 12vw;
            left:5vw;
        }

        #profile_image{
            height:250px;
            width:270px;
            top: 1vw;
        }

        #head-info{
            background-color:lightgrey;
            text-align:center;
            margin-left:15px;
            overflow:hidden; 
            padding-top:20px;
            margin-right:0px;
        }
        .pagination a{
        color:black;
        padding: 8px 16px;
        transition : background-color .3s;
    }

    .pagination a:active{
        background-color: #5bc0de;

    }


        @media(max-width:800px){
            .center{
                width:100%;
                height:230px;
            }
            #posts{
                width:100%;
            }
            #change_cover{
                top: -19vw;
                left:2vw;
                font-size:1.5vw;
            }
            #profile-img{
                width:150px;
                height:150px;
                top:13vw;
                left:3vw;
            }
            #profile_image{
                width:150px;
                height:150px;
            }
            #change_profile{
                left:8vw;
                top:-5vw;
            }
            #head-info{
                margin-left:0px;
            }
        }

    </style>
    <body style="background-color:#e6ffff">

        <div style="margin-top:100px;">
                <?php
                    echo"
                    <div class='row'>
                    <div class='col-12 col-md-2'></div>
                    <div class='col-12 col-md-8'>
                    <img class='center' src='cover/$user_cover' alt='cover'>
                    <div class='dropdown'>
                    <form id='change_cover' action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
                        <button style='color:black;background:white;' class='btn btn-primary dropdown-toggle' type='button' id='change_cover' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Change Cover
                        </button>
                        <div class='dropdown-menu' aria-labelledby='Change Cover'>
                            <center>
                            <input type='file' name='u_cover' size='60'/>
                            <br><br>
                            <button  name='submit' class='btn btn-info' >Update Cover</button>
                            </center>
                        </div>
                    </div>

                    <div id='profile-img'>
                    <div><img id='profile_image' src='users/$user_image' class='rounded-circle' alt='cover'></div>
                    <div class='dropdown'>
                    <form id='change_profile' action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
                        <button style='color:black;background:white;' class='btn btn-primary dropdown-toggle' type='button' id='change_profile' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Change profile
                        </button>
                        <div class='dropdown-menu' aria-labelledby='Change profile'>
                            <center>
                            <input type='file' name='u_image' size='60'/>
                            <br><br>
                            <button name='update' class='btn btn-info' >Update Profile</button>
                            </center>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class='col-12 col-md-2'></div>
                </div>
                    "
                ?>

                <?php

                    if(isset($_POST['submit'])){

                        $u_cover = $_FILES['u_cover']['name'];
                        $image_tmp = $_FILES['u_cover']['tmp_name'];
                        $random_number = rand(1,100);
                        //alert($u_cover);
                        if($u_cover==''){
                            echo "<script>alert('select cover picture first')</script>";
                            echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                            exit();
                        }
                        else{

                            move_uploaded_file($image_tmp,"C:\wamp64\www\social_networking\cover\\$u_cover.$random_number");
                            $update = "update users set user_cover='$u_cover.$random_number'
                            where user_id=$user_id";

                            $run = mysqli_query($con,$update);
                            if($run){
                                echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                            }
                            else{
                                echo "<script>alert('error occured')</script>";
                                echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                                exit();    
                            }
                        }
                    }
                ?>
        </div>

        <?php
            if(isset($_POST['update'])){

                $u_image = $_FILES['u_image']['name'];
                $image_tmp1 = $_FILES['u_image']['tmp_name'];
                $random_number1 = rand(1,100);
                if($u_image==''){
                    echo "<script>alert('select profile picture first')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                    exit();
                }
                else{
                    
                    move_uploaded_file($image_tmp1,"C:\wamp64\www\social_networking\users\\$u_image.$random_number1");
                    $update1 = "update users set user_image='$u_image.$random_number1'
                    where user_id=$user_id";

                    $run1 = mysqli_query($con,$update1);
                    if($run1){
                        echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                    }
                    else{
                        echo "<script>alert('error occured')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                        exit();    
                    }
                }
            }
        ?>
        <div class='row' style="margin-top:20px;">
            <div class='col-12 col-md-2'></div>
            <div class=" col-12 col-md-2" id="head-info">      
            <?php
                echo "
                <center><h2><strong>About</strong></h2></center>
                <center><h4><strong>$first_name $last_name</strong></h4></center>
                <br>
                <p><strong>Rleationship status: </strong>$Relationship_status</p>
                <p><strong>Lives In: </strong>$user_country</p>
                <p><strong>Member since: </strong>$reg_date</p>
                <p><strong>Gender: </strong>$user_gender</p>
                <p><strong>Date of birth: </strong>$user_birthday</p>
                "
            ?>
            </div>
            <div class='col-12 col-md-6'>
                <?php

                    global $con;
                    $per_page = 1;

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }
                    else{
                        $page=1;
                    }

                    $start_from = ($page-1)*$per_page;
                    $get_posts = "select * from posts where user_id=$user_id ORDER by post_id DESC LIMIT $start_from,$per_page";
                    $run_posts = mysqli_query($con,$get_posts);

                    while($row_posts = mysqli_fetch_array($run_posts)){

                        $post_id = $row_posts['post_id'];
                        $user_id = $row_posts['user_id'];
                        $content = substr($row_posts['post_content'],0,40);
                        $upload_image = $row_posts['post_image'];
                        $post_date = $row_posts['post_date'];

                        $user = "select * from users where user_id='$user_id' AND posts='yes' ";
                        $run_user = mysqli_query($con,$user);
                        $row_user = mysqli_fetch_array($run_user);

                        $user_name = $row_user['user_name'];
                        $user_image = $row_user['user_image'];
    
                        // displaying posts
                        if($content==NULL && strlen($upload_image)>=1){
                            echo"
                                <div id='posts'>
                                    <div class='row no-gutters'>    
                                        <div class='col-md-2'>
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
                                        <div class='col-md-12'>
                                            <img id='posts-img' src='post_image/$upload_image' style='width:500px;height:350px'/>
                                        </div>
                                    </div><br>
                                    <a href='single.php?post_id=$post_id' style='float:right;' class='btn btn-success'>View</a>
                                    <a href='edit_post.php?post_id=$post_id' style='float:right;' class='btn btn-info'>Edit</a>
                                    <a href='functions/delete.php?post_id=$post_id' style='float:right;' class='btn btn-danger'>
                                    Delete</a><br><br><hr><br>
                                <div>
                            ";
                        }
                        else if(strlen($content)>=1 && strlen($upload_image)>=1){
                            echo"
                            <div id='posts'>
                            <div class='row no-gutters'>    
                                <div class='col-md-2'>
                                    <p><img src='users/$user_image' class='rounded-circle' width='100px'
                                    height='100px'></p>
                                </div>
                                <div class='col-md-6'>
                                    <h3><a style='text-decoration:none; cursor:pointer;'
                                    href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                    <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <p>$content</p>
                                    <img class='image-fluid' id='posts-img' src='post_image/$upload_image' style='width:500px;;height:350px'/>
                                </div>
                            </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;' class='btn btn-success'>View</a>
                            <a href='edit_post.php?post_id=$post_id' style='float:right;' class='btn btn-info'>Edit</a>
                            <a href='functions/delete.php?post_id=$post_id' style='float:right;' class='btn btn-danger'>
                            Delete</a><br><br><hr><br>
                            <div>
                        ";   
                    }
                        else{
                            echo"
                            <div id='posts'>
                            <div class='row no-gutters'>    
                                <div class='col-md-2'>
                                    <p><img src='users/$user_image' class='rounded-circle' width='100px'
                                    height='100px'></p>
                                </div>
                                <div class='col-md-6'>
                                    <h3><a style='text-decoration:none; cursor:pointer;'
                                    href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                    <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <p>$content</p>
                                </div><br>
                                <a href='single.php?post_id=$post_id' style='float:right;' class='btn btn-success'>View</a>
                                <a href='edit_post.php?post_id=$post_id' style='float:right;' class='btn btn-info'>Edit</a>
                                <a href='functions/delete.php?post_id=$post_id' style='float:right;' class='btn btn-danger'>
                                Delete</a><br><br><hr><br>
                                </div><br>
                        <div>
                    ";
                        }
                    }
                    ?>
                    <?php

                        $query="select * from posts where user_id=$user_id";
                        $result = mysqli_query($con,$query);
                        $total_posts = mysqli_num_rows($result);

                        $total_pages = ceil($total_posts/$per_page);

                        echo "
                            <center>
                            <ul class='pagination pagination-md justify-content-center'>
                            <li class='page-item'><a class='page-link' href='profile.php?page=1&u_id=$user_id'>First Page</a></li>
                        ";

                        for($i=1;$i<=$total_pages;$i++){
                            echo "<li id='$i' class='page-item'><a class='page-link' href='profile.php?page=$i&u_id=$user_id'>$i</a></li>";
                        }

                        echo "<li class='page-item'><a class='page-link' href='profile.php?page=$total_pages&u_id=$user_id'>Last Page</a><li></center></div>";
                    ?>
                    </div>
                    <div class="col-12 col-md-2"></div>
                    </div>
                    <?php

                        if(isset($_GET['u_id'])){
                            $u_id = $_GET['u_id'];
                        }
                        //echo "<script>alert($u_id)</script>";

                        $get_posts = "select * from users where user_id= '$u_id' ";
                        $run_user = mysqli_query($con,$get_posts);
                        if(!($run_user)){
                            echo 'gfygy'.mysqli_error($con);
                        }
                        $row = mysqli_num_rows($run_user);

                        $email = $row['user_email'];
                        //echo $email;
                        $user = $_SESSION['user_email'];
                        //echo $user;

                        $get_user = "select * from users where user_email='$user' ";
                        $run_user = mysqli_query($con,$get_user);
                        $row = mysqli_num_rows($run_user);

                        $user_id = $row['user_id'];
                        $u_email = $row['user_email'];
                        //echo "<script>alert($u_email)</script>";

                        if($email!=$u_email){
                            echo "<script>window.open('profile.php?u_id=$user_id','_self');</script>";
                        }
                        //include('functions/delete.php');
                    ?>
    </body>
</html>