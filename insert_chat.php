<?php
session_start();

//insert_chat.php

include('database_connection.php');

$user = $_SESSION['user_email'];
$get_user = "select * from users where user_email = '$user' ";
$run_user = mysqli_query($con , $get_user);
$row = mysqli_fetch_array($run_user);

$user_id = $row['user_id'];

 $to_user_id  = $_POST['to_user_id'];
 $from_user_id  = $user_id;
 $chat_message  = $_POST['chat_message'];
 $status   = '1';



$query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES ('$to_user_id', '$from_user_id', '$chat_message', '$status')
";

//echo $query;

$statement = mysqli_query($con,$query);
if($statement)
{
 echo fetch_user_chat_history($user_id, $_POST['to_user_id']);
}

?>