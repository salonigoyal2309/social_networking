<?php
    include('connection.php');
?>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
            <a class="navbar-brand" href="#">
            <i class="fa fa-pencil" style="color:white;font-size:24px"></i> GUFTAGOO</a>
            <button id="tog" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php

                        $user = $_SESSION['user_email'];
                        $get_user = "select * from users where user_email = '$user' ";
                        $run_user = mysqli_query($con , $get_user);
                        $row = mysqli_fetch_array($run_user);

                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $first_name = $row['f_name'];
                        $last_name = $row['l_name'];
                        $describe_user = $row['describe_user'];
                        $Relationship_status = $row['Relationship'];
                        $user_pass = $row['user_pass'];
                        $user_email = $row['user_email'];
                        $user_country = $row['user_country'];
                        $user_gender = $row['user_gender'];
                        $user_birthday = $row['user_birthday'];
                        $user_image = $row['user_image'];
                        $user_cover = $row['user_cover'];
                        $recovery_account = $row['recovery_account'];
                        $reg_date = $row['user_reg_date'];

                        $user_posts = "select * from posts where user_id = '$user_id'";
                        $run_posts = mysqli_query($con,$user_posts);
                        $posts = mysqli_num_rows($run_posts);
                    ?>
                        
                    <li class="nav-item active"> <a class="nav-link" href = 'profile.php?<?php echo "u_id=$user_id"?>'>
                            <?php echo "$first_name" ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="member.php">Find people</a></li>
                    <li class="nav-item"><a class="nav-link" href="messages.php?u_id=new">Messages
                    
                    <?php

                        $user1 = "select * from users";
                        $run_user1 = mysqli_query($con,$user1);
                        $email1 = $_SESSION['user_email'];
                        $me = "select * from users where user_email='$email1'";
                        $run_me = mysqli_query($con,$me);
                        $row_me = mysqli_fetch_array($run_me);
                        $me_id = $row_me['user_id'];
                        $cnt=0;

                        while($row_user1 = mysqli_fetch_array($run_user1)){

                            $user_id1 = $row_user1['user_id'];
                            $user_name1 = $row_user1['user_name'];
                            $first_name1 = $row_user1['f_name'];
                            $last_name1 = $row_user1['l_name'];
                            $user_image1 = $row_user1['user_image'];

                            $query1 = "
                            SELECT * FROM chat_message 
                            WHERE from_user_id = '$user_id1' 
                            AND to_user_id = '$me_id' 
                            AND status = '1'
                            ";
                            $run_query2 = mysqli_query($con,$query1);
                            $count = mysqli_num_rows($run_query2);
                            $cnt+=$count;
                        }
                        echo '<span class="badge badge-success">'.$cnt.'</span>';
                    ?>
                    
                    </a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More options</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href='edit_profile.php?<?php echo "u_id=$user_id"?>'>Edit profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
        </div>
    </nav>
