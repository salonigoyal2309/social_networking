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
    </style>
    <body style="background-color:#e6ffff">
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='col-md-8'>
                <form method='post'>
                    <table class='table table-bordered table-hover'>
                        <tr style="align:'center'">
                            <td colspan='6' class='active'><h2>Edit your profile</h2></td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Change your first name</td>
                            <td>
                                <input class='form-control' type='text' name='f_name'
                                required value='<?php echo $first_name; ?>' >
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Change your last name</td>
                            <td>
                                <input class='form-control' type='text' name='l_name'
                                required value='<?php echo $last_name; ?>' >
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Description</td>
                            <td>
                                <input class='form-control' type='text' name='describe_user'
                                required value='<?php echo $describe_user; ?>' >
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Relationship status</td>
                            <td>
                                <select class='form-control' name='Relationship'>
                                <option><?php echo $Relationship_status ?></option>
                                <option>Engaged</option>
                                <option>Married</option>
                                <option>Single</option>
                                <option>In a relationship</option>
                                <option>Its complicated</option>
                                <option>Seperated</option>
                                <option>Divorced</option>
                                <option>Widowed</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Password</td>
                            <td>
                                <input type="password" name="u_pass" id="mypass" 
                                required class="form-control" value="<?php echo $user_pass ?>">
                                <input type="checkbox" id="check" onclick="show_password()"><strong>
                                Show Password</strong>

                                <script>
                                    function show_password(){
                                        var x = document.getElementById("mypass");
                                        if(x.type=="password") x.type="text";
                                        else x.type="password";
                                    }
                                </script>

                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Email</td>
                            <td>
                                <input class='form-control' type='email' name='u_email'
                                required value='<?php echo $user_email; ?>' >
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Country</td>
                            <td>
                                <select class='form-control' name='u_country'>
                                <option><?php echo $user_country; ?></option>
                                <option>United states</option>
                                <option>UAE</option>
                                <option>India</option>
                                <option>Brazil</option>
                                <option>UK</option>
                                <option>Pakistan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Gender</td>
                            <td>
                                <select class='form-control' name='u_gender'>
                                <option><?php echo $user_gender; ?></option>
                                <option>Engaged</option>
                                <option>Married</option>
                                <option>Single</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Birthdate</td>
                            <td>
                                <input class='form-control' type='date' name='u_birthday'
                                required value='<?php echo $user_birthday; ?>' >
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Forgotten Password</td>
                            <td>
                                <button type="button" class="btn btn-primary" 
                                data-toggle="modal" data-target="#myModal">Turn On</button>

                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Modal header</h4>
                                                <button type="button" class="close" data-dismiss="modal">
                                                &times;</button>
                                            </div>
                                            <div class="modal-body">
                                             <form action="recovery.php?id=<?php echo $user_id;?>"
                                             metod="post" id="f">
                                                <strong>What is your School,Best Friend Name?</strong>
                                                <textarea class="form-control" cols="83" row="4" name="content"
                                                placeholder="Someone"></textarea><br>
                                                <input class="btn btn-primary" type="submit" name="sub" value="Submit"
                                                style="width:100px;"><br><br>
                                                <pre>Answer the above question we will ask this question if you <br>forgot your Password.</pre>
                                                <br><br>
                                             </form>
                                             <?php
                                                if(isset($_POST['sub'])){
                                                    $bfn = htmlentities(mysqli_real_escape_string($con,$_POST['content']));
                                                    if($bfn==""){
                                                        echo "<script>alert('please enter something!')</script>";
                                                        echo "<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
                                                        exit();
                                                    }
                                                    else{
                                                        $update = "update users set recovery_account='$bfn' where 
                                                        user_id = '$user_id'";
                                                        echo "<sript>alert($update)</script>";
                                                        
                                                        $run = mysqli_query($con,$update);
                                                        if($run){
                                                            echo "<script>alert('working...')</script>";
                                                            echo "<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
                                                        }
                                                        else{
                                                            echo "<script>alert('error while updating information')</script>";
                                                            echo "<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
                                                        }
                                                    }
                                                }
                                             ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:center;">
                            <input type="submit" name="update" style="width:250px;" value="Update">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
<?php

    if(isset($_POST['update'])){

        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $describe_user = $_POST['describe_user'];
        $Relationship_status = $_POST['Relationship'];
        $u_pass = $_POST['u_pass'];
        $u_email = $_POST['u_email'];
        $u_country = $_POST['u_country'];
        $u_gender = $_POST['u_gender'];
        $u_birthday = $_POST['u_birthday'];

        $update = "update users set f_name ='$f_name' , l_name = '$l_name',
        describe_user ='$describe_user', Relationship='$Relationship_status',
        user_pass='$u_pass' , user_email='$u_email', user_country='$u_country',
        user_gender = '$u_gender' where user_id='$user_id' ";
        echo "<script>alert($update)</script>";
        $run = mysqli_query($con,$update);
        if($run){
            echo "<script>alert('updated successfully!')</script>";
            echo "<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
        }
        else{
            echo "<script>alert('Error!')</script>";
            echo "<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
        }
    }

?>