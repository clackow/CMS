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
                GLOBAL $connection;
                $count_post_query = "SELECT * FROM posts WHERE post_status = 'published' ";
                
                if(isset($_GET['pager'])){
                    $page = $_GET['pager'];
                }else{
                    $page = "";
                }

                if($page == ""|| $page == 1){
                    $page_1 = 0;
                }else{
                    $page_1 = ($page*5) -5;
                }


                $find_count = mysqli_query($connection,$count_post_query);
                $count = mysqli_num_rows($find_count);
                $count = ceil($count / 5);



                $counter = 0;
                $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, 5";
                $select_all_post = mysqli_query($connection,$query);
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
                    by <a href="author_post.php?author=<?php echo $post_author?>&p_id=<?php echo $post_id?> "><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> </p>
                <hr>
                <a href=" posts.php?p_id=<?php echo $post_id?> ">
                    <img class="img-responsive" src="img/<?php echo $post_img?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="posts.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                <?php
                  }

                ?>
              
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>
        </div>
        <!-- /.row -->

<!-- Footer -->
<? include "includes/footer.php" ?>

<ul class="pager">
    <?php 
    for($i = 1; $i<=$count; $i++){
        if($i == $page){
            echo"<li><a class='active_link' href='index.php?pager=$i'>$i</a></li>";
        }else{
        echo"<li><a href='index.php?pager=$i'>$i</a></li>";
        }
    }
    ?>

</ul>
