<?php
    include('../includes/connection.php');

    if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    $delete_post = "delete from posts where post_id='$post_id' ";
    //echo $delete_post;
    $run_delete = mysqli_query($con,$delete_post);

    if($run_delete){
        echo "<script>alert('Apost has been deleted')</script>";
        echo "<script>window.open('../home.php','_self')</script>";
    }
}
?>