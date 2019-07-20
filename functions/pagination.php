<style>
    .pagination a{
        color:black;
        padding: 8px 16px;
        transition : background-color .3s;
    }

    .pagination a:active{
        background-color: #5bc0de;

    }

</style>
<?php

    $query="select * from posts";
    $result = mysqli_query($con,$query);
    $total_posts = mysqli_num_rows($result);

    $total_pages = ceil($total_posts/$per_page);

    echo "
        <center>
        <ul class='pagination pagination-md justify-content-center'>
            <li class='page-item'><a class='page-link' href='home.php?page=1'>First Page</a></li>
    ";

    for($i=1;$i<=$total_pages;$i++){
        echo "<li id='$i' class='page-item'><a class='page-link' href='home.php?page=$i'>$i</a></li>";
    }

    echo "<li class='page-item'><a class='page-link' href='home.php?page=$total_pages'>Last Page</a><li></center></div>";
?>