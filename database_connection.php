<?php

//database_connection.php

include("includes/connection.php");


function fetch_user_chat_history($from_user_id, $to_user_id)
{
    global $con;
    $query = "
        select * from chat_message 
        where (from_user_id = '$from_user_id' AND to_user_id = '$to_user_id') 
        OR (from_user_id = '$to_user_id' AND to_user_id = '$from_user_id') 
        ORDER by timestamp ASC
        ";

    $run_query = mysqli_query($con,$query);
    $output = '<ul class="list-unstyled">';
    
    while($row = mysqli_fetch_array($run_query)){
  
        $user_name = '';
        if($row["from_user_id"] == $from_user_id){
            $user_name = '<b class="text-success">You</b>';
        }
        else{
            $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id']).'</b>';
        }
  
        $output .= '
            <li style="border-bottom:1px dotted #ccc">
            <p>'.$user_name.' - '.$row["chat_message"].'
            <div align="right">
            -<small><em>'.$row['timestamp'].'</em></small>
            </div>
            </p>
            </li>
            ';
        }
        $output .= '</ul>';
        $query = "update chat_message 
        SET status = '0' 
        WHERE from_user_id = '".$to_user_id."' 
        AND to_user_id = '".$from_user_id."' 
        AND status = '1'
        ";
        $statement = mysqli_query($con,$query);
       
        return $output;

    }

function get_user_name($user_id){
    
    global $con;
    $query = "select * FROM users where user_id = '$user_id'";
    $statement = mysqli_query($con,$query);

    while($row=mysqli_fetch_array($statement)){
        return $row['user_name'];
    }

}

function count_unseen_message($from_user_id, $to_user_id)
{
    global $con;
    $query = "
        SELECT * FROM chat_message 
        WHERE from_user_id = '$from_user_id' 
        AND to_user_id = '$to_user_id' 
        AND status = '1'
        ";
 $run_query = mysqli_query($con,$query);
 $count = mysqli_num_rows($run_query);
 //return 'this'.$count;
 $output = '';
 if($count > 0)
 {
  $output = '<span class="badge badge-success">'.$count.'</span>';
 }
 return $output;
}


function fetch_group_chat_history($user_id){

    global $con;
    $query = "
 select  * from chat_message 
 where to_user_id IS NULL 
 ORDER by timestamp DESC
 ";

 $statement = mysqli_query($con,$query);
 $output = '<ul class="list-unstyled">';
 while($row = mysqli_fetch_array($statement)) {
    
    $user_name = '';
    if($row["from_user_id"] == $user_id){
        $user_name = '<b class="text-success">You</b>';
    }
    else{
        $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id']).'</b>';
    }

  $output .= '

  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row['chat_message'].' 
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 echo "<script>alert($output)</script>";
 return $output;
}


?>
