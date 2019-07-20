<?php
include("includes/connection.php");
if(isset($_POST["search"])) {

    $output = $_POST["search"];
    $sql = "select * from users where CONCAT(f_name,' ',l_name) like '%$output%' ";
    $result = mysqli_query($con,$sql);
    //echo "<script>alert('bjbjb');</script>";
    if(mysqli_num_rows($result)>0){

        while($row_user=mysqli_fetch_array($result)){
            $user_id = $row_user['user_id'];
            $f_name = $row_user['f_name'];
            $l_name = $row_user['l_name'];
            $username = $row_user['user_name'];
            $user_image = $row_user['user_image'];

            echo"

                <div class='row'>
                    <div class='col-12 col-md-3'></div>
                    <div class='col-12 col-md-6'>
                        <div class='row' id='find_people'>
                            <div class='col-md-3'>
                                <a href='user_profile.php?u_id=$user_id'>
                                <img src='users/$user_image' width='150px' height='140px' 
                                title='$username' style='float:left;margin:5px;' />
                                </a>
                            </div><br><br>
                            <div class='col-12 col-md-6'>
                                <a style='text-decoration:none;cursor:pointer;color:#3897f0' 
                                href='user_profile.php?u_id=$user_id'><strong>
                                $f_name $l_name</strong></a>
                            </div>
                            <div class='col-md-3'></div>
                        </div>
                    </div>
                    <div class='col-12 col-md-3'></div>
                </div>
            ";
        }
    }
    else{
        echo "
        <div class='row'>
        <div class='col-12 col-md-3'></div>
        <div class='col-12 col-md-6'>
            <h3>Data Not Found</h3>
        </div>
        <div class='col-12 col-md-3'></div>
        </div>
        ";
    }
}
?>