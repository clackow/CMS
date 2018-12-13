
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
                if(isset($_GET['p_id'])){
                    $the_p_id = $_GET['p_id'];
                    $the_post_author = $_GET['author'];
                }
                GLOBAL $connection;
                $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
                $select_all_post = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_post)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                        $post_tag = $row['post_tag'];
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
                    All posts by <?php echo $post_author?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="img/<?php echo $post_img?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
                <?php
                    }

                ?>
               <!-- Blog Comments -->

                <hr>

                <!-- Posted Comments -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>
        </div>
        <!-- /.row -->

<!-- Footer -->
<? include "includes/footer.php" ?>

