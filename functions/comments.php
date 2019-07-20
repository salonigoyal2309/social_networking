<?php
    $get_id = $_GET['post_id'];

    $get_com = "select * from comments where post_id='$get_id' ORDER by com_id DESC";

    $run_com = mysqli_query($con,$get_com);

    while($row = mysqli_fetch_array($run_com)){

        $com = $row['comment'];
        $com_name = $row['comment_author'];
        $date = $row['date'];
        
        echo "

            <div class='row'style='margin:5px;' width:100px >
            <div class='col-12 col-md-3'></div>
                <div class='col-12 col-md-6'>
                    <div class='card'>
                    <div class='card-body'>
                        <div>
                            <h4><strong>$com_name</strong><i> commented</i> on $date </h4>
                            <p class='text-primary' 
                            style='margin-left:5px;font-size:20px;'>$com
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class='col-12 col-md-3'></div>
            </div>
        
        ";

    }

?>s