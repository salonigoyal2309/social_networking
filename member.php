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


        @media(max-width:800px){

        }

    </style>
        <script>
        
        $(function(){

            $('#search_user').on("keyup", function(){
                //alert('ya');
                var text = $(this).val();
                    jQuery.ajax({
                        url: "fetch.php",
                        data:'search='+text,
                        type: "POST",
                        success:function(data){
                            $('#result').html(data);
                        }
                    })
            })
        })

    </script>

    <body style="background-color:#e6ffff">
    <div style="margin-top:100px;">
        <div class="row">
            <div class="col-md-12">
            <center><h2>Find New People</h2></center><br><br>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <center><form class="justify-content-center" action="">
                    <input type="text" id="search_user" placeholder="Search Friend"  name="search_user">
                    <button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
                </form></center>
            </div>
        <div class="col-md-4"></div>
        </div><br><br>
    </div>
    <div id="result"></div>
    </div>
    </body>
</html>