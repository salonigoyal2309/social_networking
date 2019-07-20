<?php
session_start();
//group_chat.php

include('database_connection.php');

$user = $_SESSION['user_email'];
$get_user = "select * from users where user_email = '$user' ";
$run_user = mysqli_query($con , $get_user);
$row = mysqli_fetch_array($run_user);

$from_user_id = $row['user_id'];



if($_POST["action"] == "insert_data")
{    
    $chat_message = $_POST['chat_message'];
    $status   = '1';
 

    $query = "
 INSERT INTO chat_message 
 (from_user_id, chat_message, status) 
 VALUES ('$from_user_id', '$chat_message', '$status')
 ";

 $statement = mysqli_query($con,$query);

 if($statement){
  echo fetch_group_chat_history($from_user_id);
 }

}

if($_POST["action"] == "fetch_data")
{
 echo fetch_group_chat_history($from_user_id);
}

?>