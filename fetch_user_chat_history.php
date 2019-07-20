<?php
session_start();

include('database_connection.php');

$user = $_SESSION['user_email'];
$get_user = "select * from users where user_email = '$user' ";
$run_user = mysqli_query($con , $get_user);
$row = mysqli_fetch_array($run_user);

$user_id = $row['user_id'];

echo fetch_user_chat_history($user_id, $_POST['to_user_id']);
?>