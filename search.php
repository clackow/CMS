<!-- Header -->
<? include "includes/header.php" ?>

<!-- Navigation -->
<? include "includes/nav.php"?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                /** Search Engine **/
                if(isset($_POST['submit'])){//对应的是button name
                    $search =  $_POST['search']; //对应的是input的search

                    $query = "SELECT * FROM posts WHERE post_tag LIKE '%$search%' ";//variable得这么写
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        die('Failed '. mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($result);//count有几个对应词条
                    if($count == 0){
                        echo "<h1>No Result</h1>";
                    }else{
                        GLOBAL $connection;

                    while($row = mysqli_fetch_assoc($result)){//只display被选中的query;
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                        $post_tag = $row['post_tag'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_status = $row['post_status'];

                    ?>



                 
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="img/<?php echo $post_img ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                <?php
                        }                    
                    }
              
                }

                ?>
              

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>
        </div>
        <!-- /.row -->

<!-- Footer -->
<? include "includes/footer.php" ?>

