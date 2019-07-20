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
        <title>Edit-Post</title>
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

    </style>
    <body>

        <div style="margin-top:100px">
        <div class='row'>
            <div class='col-12 col-md-3'></div>
            <div class='col-md-6'>
                <?php
                    if(isset($_GET['post_id'])){

                        $get_id = $_GET['post_id'];
                        $get_post = "select * from posts where post_id='$get_id' ";
                        $run_post = mysqli_query($con,$get_post);
                        $row = mysqli_fetch_array($run_post);
                        $post_con = $row['post_content'];

                    }
                ?>

                <form action="" method="post" id="f">
                    <center><h2>Edit Your Post</h2></center>
                    <textarea class="form-control" cols="83" rows="4" name="content" placeholder='<?php $post_con ?>'>
                    <?php echo $post_con; ?>
                    </textarea><br>
                    <center><input type="submit" name="update" value="Update Post" class="btn btn-info" />
                    <a href='profile.php?u_id=<?php $user_id ?>'  class="btn btn-info">Back</a>
                    </center>
                </form>

                <?php

                    if(isset($_POST['update'])){

                        $content = $_POST['content'];

                        $update_post = "update posts set post_content='$content' where post_id='$get_id' ";
                        $run_update = mysqli_query($con,$update_post);

                        if($run_update){
                            echo "<script>alert('A post have been updated')</script>";
                            echo "<script>window.open('home.php','_self')</script>";
                        }

                    }



                ?>

            </div>
        </div>
    </body>
</html>
