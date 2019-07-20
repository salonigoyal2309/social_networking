<?php
session_start();
include("includes/header.php");
include('functions/functions.php');
include('database_connection.php');
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

    <script>

        setInterval(function(){
            update_chat_history_data();
            fetch_group_chat_history();
        }, 1000);


        function make_chat_dialog_box(to_user_id, to_user_name){
 
            var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; background-color:white;overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
            $('#panel').html(modal_content);
        }
        
        function userData(identifier){
            var to_user_id = $(identifier).data('touserid');
            var to_user_name = $(identifier).data('tousername');
            //alert(to_user_name);
            make_chat_dialog_box(to_user_id, to_user_name);
            $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                width:400
            });
            $('#user_dialog_'+to_user_id).dialog('open');
        }

        $(document).on('click', '.send_chat', function(){
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_'+to_user_id).val();
            $.ajax({
                url:"insert_chat.php",
                method:"POST",
                data:{to_user_id:to_user_id, chat_message:chat_message},
                success:function(data){
                $('#chat_message_'+to_user_id).val('');
                $('#chat_history_'+to_user_id).html(data);
            }
            })
        });

        function fetch_user_chat_history(to_user_id){
  
            $.ajax({
                url:"fetch_user_chat_history.php",
                method:"POST",
                data:{to_user_id:to_user_id},
                success:function(data){
                $('#chat_history_'+to_user_id).html(data);
                }
            })
        }

        function update_chat_history_data(){

            $('.chat_history').each(function(){
            var to_user_id = $(this).data('touserid');
            fetch_user_chat_history(to_user_id);
        
        });
        }


    function groupy(){
 
        var chat_message = $('#group_chat_message').val();
        var action = 'insert_data';
        if(chat_message != ''){
  
            $.ajax({
                url:"group_chat.php",
                method:"POST",
                data:{chat_message:chat_message, action:action},
                success:function(data){
                    $('#group_chat_message').val('');
                    $('#group_chat_history').html(data);
                }
            })
        }
    }

function fetch_group_chat_history(){

        var action = "fetch_data";
            $.ajax({
                url:"group_chat.php",
                method:"POST",
                data:{action:action},
                success:function(data){
                    $('#group_chat_history').html(data);
                }
            })
        }
        

    </script>


    <body style="background-color:#e6ffff">
        <div style="margin-top:100px;">
            <div class='row'>
                <div class='col-sm-3 col-lg-3' id='select_user'>
                    <?php
                            $user = "select * from users";
                            $run_user = mysqli_query($con,$user);
                            $email = $_SESSION['user_email'];
                            $me = "select * from users where user_email='$email'";
                            $run_me = mysqli_query($con,$me);
                            $row_me = mysqli_fetch_array($run_me);
                            $me_id = $row_me['user_id'];

                            while($row_user = mysqli_fetch_array($run_user)){

                                $user_id = $row_user['user_id'];
                                $user_name = $row_user['user_name'];
                                $first_name = $row_user['f_name'];
                                $last_name = $row_user['l_name'];
                                $user_image = $row_user['user_image'];

                                echo "

                                        <img class='rounded-circle' src='users/$user_image' width:'90px'
                                        height='80px' title='$user_name'/>
                                        <button id='user' data-touserid='$user_id' data-tousername='$user_name' 
                                        onclick='userData(this)'>
                                        <strong>$first_name 
                                        $last_name </strong></button>
                                ";

                                echo count_unseen_message($user_id, $me_id);
                                echo " <br><br> ";
                            }
                    ?>

                </div>
                <div class='col-12 col-md-9' id='panel'></div>
            </div>
        </div>

<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<div id="group_chat_dialog" title="Group Chat Window">
 <div id="group_chat_history" style="height:400px; background-color:white;border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">
 </div>
 <div class="form-group">
  <textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>
 </div>
 <div class="form-group" style="align:right">
  <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info" onclick='groupy()'>Send</button>
 </div>
</div>
</div>
</div>

</body>
</html>