<?php
    include("includes/connection.php");

    if(isset($_POST["username"])) {

        $userName = $_POST["username"];
        //echo $userName;
        $query = "select * from users where user_name='$userName'";
        //echo $query;
        $result  = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        if($rowcount>0){
            echo "taken";
        }
        else{
            echo "not_taken";
        }
      }

      exit();
?>
