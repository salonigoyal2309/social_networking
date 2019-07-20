<?php
    include('includes/connection.php');

    function bleh(){
        global $con;
        global $user_id;

    if(isset($_POST['sub'])){

        $content = mysqli_real_escape_string($con,$_POST['content']);
        //echo "<script>alert('$content')</script>";
        $upload_image = $_FILES['upload_image']['name'];
        $image_tmp = $_FILES['upload_image']['tmp_name'];
        $random_number = rand(1,100);

        if(strlen($content) > 250){
            echo "<script>alert('Please use 250 or less than 250 words')</script>";
            echo "<script>window.open('home.php','_self')</script>";
        }
        else{
            if(strlen($upload_image)>=1 && strlen($content)>=1){
                move_uploaded_file($image_tmp,"C:\wamp64\www\social_networking\post_image\\$upload_image.$random_number");
                $insert="insert into posts(user_id,post_content,post_image,post_date) values('$user_id','$content','$upload_image.$random_number',NOW() )";
                $run = mysqli_query($con,$insert);
                if($run){
                    echo "<script>alert('Your post updated a moment ago!')</script>";
                    echo "<script>window.open('home.php','_self')</script>";    
                    $update = "update users set posts='yes' where user_id='$user_id' ";
                    $run_update = mysqli_query($con,$update);      
                }
                exit();
            }
            else{
                if(strlen($upload_image)=='' && strlen($content)==''){
                    echo "<script>alert('Error occured while uploading!')</script>";
                    echo "<script>window.open('home.php','_self')</script>";    
                }
                else{
                    if($content==''){
                        move_uploaded_file($image_tmp,"C:\wamp64\www\social_networking\post_image\\$upload_image.$random_number");
                        $insert="insert into posts(user_id,post_content,post_image,post_date) values('$user_id','$content','$upload_image.$random_number',NOW() )";
                        $run = mysqli_query($con,$insert);   
                        if($run){
                            echo "<script>alert('Your post updated a moment ago!')</script>";
                            echo "<script>window.open('home.php','_self')</script>";    
                            $update = "update users set posts='yes' where user_id='$user_id' ";
                            $run_update = mysqli_query($con,$update);      
                        }
                        exit();             
                    }
                    else{
                        $insert = "insert into posts(`user_id`,post_content,post_date) values( '$user_id','$content',NOW() )";
                        $run = mysqli_query($con,$insert);   
                        if (!$run) {
                            echo "Failed".mysqli_error($con);
                         }                         
                        if($run){
                            echo "<script>alert('Your post updated a moment ago!')</script>";
                            echo "<script>window.open('home.php','_self')</script>";    
                            $update = "update users set posts='yes' where user_id='$user_id' ";
                            $run_update = mysqli_query($con,$update);      
                        }
                        exit();             
                    }
                }
            }
        }

    }
    }

    function get_posts(){

        global $con;
        $per_page = 4;

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page=1;
        }

        $start_from = ($page-1)*$per_page;
        $get_posts = "select * from posts ORDER by post_id DESC LIMIT $start_from,$per_page";
        $run_posts = mysqli_query($con,$get_posts);
        //echo "<script>alert($run_posts)</script>";

        while($row_posts = mysqli_fetch_array($run_posts)){

            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $content = substr($row_posts['post_content'],0,40);
            $upload_image = $row_posts['post_image'];
            $post_date = $row_posts['post_date'];

            $user = "select * from users where user_id='$user_id' AND posts='yes' ";
            $run_user = mysqli_query($con,$user);
            $row_user = mysqli_fetch_array($run_user);

            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            
            // displaying posts

            if($content==NULL && strlen($upload_image)>=1){
                echo"
                <div class='row'>
                    <div class='col-md-3'></div>
                    <div id='posts' class='col-md-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                height='100px'></p>
                            </div>
                            <div class='col-md-6'>
                                <h3><a style='text-decoration:none; cursor:pointer;'
                                href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                            </div>
                        </div>
                        <div class='row'>
                            <div class=col-md-12'>
                                <img id='posts-img' src='post_image/$upload_image' style='height:350px;width:400px;'/>
                            </div>
                        </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;'>
                                <button class='btn btn-info'>Comment</button></a><br>
                    </div>
                    <div class='col-md-3'></div>
                </div>
                ";
            }
            else if(strlen($content)>=1 && strlen($upload_image)>=1){
                echo"
                <div class='row'>
                    <div class='col-12 col-md-3'></div>
                    <div id='posts' class='col-md-6'>
                        <div class='row'>
                            <div class='col-12 col-sm-2'>
                                <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                height='100px'></p>
                            </div>
                            <div class='col-12 col-md-6'>
                                <h3><a style='text-decoration:none; cursor:pointer;'
                                href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                <h4><small>Updated a post on<strong>   $post_date</strong></small></h4>
                            </div>
                        </div>
                        <div class='row'>
                            <div class=coll-12 col-md-12'>
                                <p>$content</p>
                                <img id='posts-img' src='post_image/$upload_image' class='img-fluid' style='height:350px;width:400px;'/>
                            </div>
                        </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;'>
                                <button class='btn btn-info'>Comment</button></a><br>
                    </div>
                    <div class='col-12 col-md-3'></div>
                </div>
                ";
            }
            else{
                echo"
                <div class='row'>
                    <div class='col-md-3'></div>
                    <div id='posts' class='col-md-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                height='100px'></p>
                            </div>
                            <div class='col-md-6'>
                                <h3><a style='text-decoration:none; cursor:pointer;'
                                href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                            </div>
                        </div>
                        <div class='row'>
                            <div class=col-md-12'>
                                <p>$content</p>
                            </div>
                        </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;'>
                                <button class='btn btn-info'>Comment</button></a><br>
                    </div>
                    <div class='col-md-3'></div>
                </div>
                ";
            }
        }
        include("pagination.php");
    }

function single_post(){

    if(isset($_GET['post_id'])){
        global $con;
        $get_id = $_GET['post_id'];
        $get_posts = "select * from posts where post_id ='$get_id' ";
        $run_posts = mysqli_query($con,$get_posts);
        $row_posts = mysqli_fetch_array($run_posts);

        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['post_image'];
        $post_date = $row_posts['post_date'];

        $user = "select * from users where user_id ='$user_id'  AND posts='yes' ";

        $run_user = mysqli_query($con,$user);
        $row_user = mysqli_fetch_array($run_user);

        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        $user_com = $_SESSION['user_email'];

        $get_com = "select * from users where user_email='$user_com' ";

        $run_com = mysqli_query($con,$get_com);
        $row_com = mysqli_fetch_array($run_com);

        $user_com_id = $row_com['user_id'];
        $user_com_name = $row_com['user_name'];

        if(isset($GET['post_id'])){
            $post_id = $_GET['post_id'];
        }

        $get_posts = "select post_id from users where post_id='$post_id' ";
        $run_user = mysqli_query($con,$get_posts);     

        $post_id = $_GET['post_id'];
        $post = $_GET['post_id'];
        $get_user = "select * from posts where post_id='$post' ";
        $run_user = mysqli_query($con,$get_user);
        $row = mysqli_fetch_array($run_user);

        $p_id = $row['post_id'];
        if($p_id != $post_id){
            echo "<script>alert('ERROR')</script>";
            echo "<script>whindow.open('home.php' ,'_self')</script>";
        }
        else{
            echo "<br><div>";
            if($content==NULL && strlen($upload_image)>=1){
                echo"
                <div class='row'>
                    <div class='col-md-3'></div>
                    <div id='posts' class='col-md-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                height='100px'></p>
                            </div>
                            <div class='col-md-6'>
                                <h3><a style='text-decoration:none; cursor:pointer;'
                                href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                            </div>
                        </div>
                        <div class='row'>
                            <div class=col-md-12'>
                                <img id='posts-img' src='post_image/$upload_image' style='height:350px;width:400px;'/>
                            </div>
                        </div><br>
                    </div>
                    <div class='col-md-3'></div>
                </div>
                ";
            }
            else if(strlen($content)>=1 && strlen($upload_image)>=1){
                echo"
                <div class='row'>
                    <div class='col-12 col-md-3'></div>
                    <div id='posts' class='col-md-6'>
                        <div class='row'>
                            <div class='col-12 col-sm-2'>
                                <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                height='100px'></p>
                            </div>
                            <div class='col-12 col-md-6'>
                                <h3><a style='text-decoration:none; cursor:pointer;'
                                href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                <h4><small>Updated a post on<strong>   $post_date</strong></small></h4>
                            </div>
                        </div>
                        <div class='row'>
                            <div class=coll-12 col-md-12'>
                                <p>$content</p>
                                <img id='posts-img' src='post_image/$upload_image' class='img-fluid' style='height:350px;width:400px;'/>
                            </div>
                        </div><br>
                    </div>
                    <div class='col-12 col-md-3'></div>
                </div>
                ";
            }
            else{
                echo"
                <div class='row'>
                    <div class='col-md-3'></div>
                    <div id='posts' class='col-md-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='rounded-circle img-fluid' width='100px'
                                height='100px'></p>
                            </div>
                            <div class='col-md-6'>
                                <h3><a style='text-decoration:none; cursor:pointer;'
                                href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                <h4><small>Updated a post on<strong>  $post_date</strong></small></h4>
                            </div>
                        </div>
                        <div class='row'>
                            <div class=col-md-12'>
                                <p>$content</p>
                            </div>
                        </div><br>
                    </div>
                    <div class='col-md-3'></div>
                </div>
                ";
                echo "</div>";
            }//else condition ending
            
            include("comments.php");
            echo "
            <div class='row' style='margin:5px;' width:100px >
                <div class='col-sm-12 col-md-3'></div>
                <div class='col-sm-6 col-md-6'>
                    <div class='card'>
                        <div class='card-body'>
                            <form action='' method='post' class='form-inline'>
                                <textarea id='pb_content_textarea' rows='4' cols='100' placeholder = 'Write your comment here!' class='pb-cmt-textarea' name='comment'></textarea>
                                <br><br><button class='btn btn-info pull-right' name='reply'>Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class='col-12 col-md-3'></div>
            </div>
            ";

            if(isset($_POST['reply'])){

                $comment = htmlentities(mysqli_real_escape_string($con,$_POST['comment']));
                if($comment == ""){
                    echo "<script>alert('Enter your comment first!')</script>";
                    echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
                }else{
                    $insert = "insert into comments(post_id,user_id,comment,comment_author,date) values('$post_id','$user_id',
                    '$comment','$user_com_name',NOW())";
                    //echo "<script>alert($insert)</script>";

                    $run = mysqli_query($con,$insert);

                    echo "<script>alert('comment added!')</script>";
                    echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";

                }
            }

            }
        }
    }


?>