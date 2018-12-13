<!-- Header -->
<? include "includes/header.php" ?>

<!-- Navigation -->
<? include "includes/nav.php"?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?
                if(isset($_GET['category'])){
                    $cat = $_GET['category'];
                }
                GLOBAL $connection;
                $query = "SELECT * FROM posts WHERE post_category_id = '{$cat}' ";
                $select_all_post = mysqli_query($connection,$query);
                $num_rows = mysqli_num_rows($select_all_post);
                if($num_rows==0){
                    echo'<h2>No posts on this category</h2>';
                }else{
                    while($row = mysqli_fetch_assoc($select_all_post)){
                        $post_id = $row ['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = substr($row['post_content'],0,100);
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
                    <a href="posts.php?p_id=<?php echo $post_id?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="img/<?php echo $post_img?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                <?php
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

