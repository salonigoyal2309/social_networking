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

        #upload-image-button{
            position:absolute;
            top:56%;
            right:-2.5%;
            border-radius:4px;
            transform: translate(-50%,-50%);
        }

        #content{
            width:80%;
            height:150px;
        }

        #posts{
            border:2px outset lightgrey;
            padding:50px;
            margin:50px;
            background-color:white;
        }

        @media(max-width:800px){
            #upload-image-button{
                font-size:2vw;
                right:-14vw;
                top:130px;
            }


        }

    </style>
    <body style="background-color:#e6ffff">
        
        <div class="row" style="margin-top:100px">
            <div id="insert_post" class="col md-12">
                <center>
                    <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f"
                    enctype="multipart/form-data">
                    <textarea class="form-control" id="content" row="5" name="content"
                     placeholder="Whats in your mind?" ></textarea><br>
                     <label class="btn btn-warning" id="upload-image-button">Select Image
                     <input type="file" name="upload_image" size="30">
                     </label>
                     <button id="btn-post" class="btn btn-success" id="sub" name="sub">Post</button>
                     </form>
                     <?php bleh(); ?>
                </center>
            </div>
        </div><hr>
        <div class="row">
            <div class="col-md-12">
                <center><h2><strong>News Feed</strong></h2></center>
                <?php echo get_posts(); ?>
            </div>
        </div>
    </body>
</html>