<?php include "includes/admin_header.php"?>
    <?php include "includes/functions.php"?>
     <div id="wrapper">
        <!-- Navigation -->
        <?php  
                include "includes/admin_nav.php";
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Hello</small>
                        </h1>
                    </div>
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>In Response to</th>
                                    <th>Delete</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $_GET['id'];
                                GLOBAL $connection;
                                //find all categories
                                $query = 'SELECT * FROM comment WHERE comment_post_id = '.mysqli_real_escape_string($connection, $id);//LIMIT 3可以只显示3个
                                $select_comment = mysqli_query($connection,$query);     
                                while($row = mysqli_fetch_assoc($select_comment)){
                                    $comment_id = $row['comment_id'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_content = $row['comment_content'];
                                    $comment_email = $row['comment_email'];
                                    $comment_date = $row['comment_date'];
                                    $comment_status = $row['comment_status'];

                                    echo "<tr>";
                                    echo "<td>".$comment_id."</td>";
                                    echo "<td>".$comment_author."</td>";
                                    echo "<td>".$comment_content."</td>";
                                    /*
                                    $query = "SELECT * FROM category WHERE cat_id = '{$post_category_id}' ";//LIMIT 3可以只显示3个
                                    $select_categories1 = mysqli_query($connection,$query); //用来display category name    
                                    while($row = mysqli_fetch_assoc($select_categories1)){
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];   
                                    }
                                    */

                                    echo "<td>".$comment_email."</td>";
                                    echo "<td>".$comment_status."</td>";
                                    echo "<td>".$comment_date."</td>";

                                    //in response to
                                    $query = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}' ";
                                    $send_response_to = mysqli_query($connection,$query);
                                    if(!$send_response_to){
                                        die('Error '.mysqli_error($connection));
                                    }
                                    while($row = mysqli_fetch_assoc($send_response_to)){

                                        $post_title = $row['post_title'];
                                        $post_id = $row['post_id'];

                                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>"; 
                                    }

                                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want be delete')\" href='post_comment.php?delete=$comment_id&id=$id'>Delete</a></td>";//pid是一个新的变量，通过pid来确定post_id
                                    //echo "<td><a href='post.php?delete={$post_id}'>Delete</a></td>";
                                    echo "<td><a href='comment.php?approve=$comment_id'>Approve</a></td>";
                                    echo "<td><a href='post_comment.php?unapprove=$comment_id&id=$id'>Unapprove</a></td>";
                                    echo "</tr>";
                                    }

                                ?>
                            </tbody>

                        </table>  


<?php
    if(isset($_GET['delete'])){
        $delete_comment = $_GET['delete'];
        $query = "DELETE FROM comment WHERE comment_id = $comment_id ";
        $delete_query = mysqli_query($connection, $query);
        if(!$delete_query){
            die('Error'.mysqli_error($connection));
        }
        header("Location: post_comment.php?id=".$id."");

    }


    if(isset($_GET['approve'])){
        $approve_comment = $_GET['approve'];
        $query = "UPDATE comment SET comment_status = 'approved' WHERE comment_id=$approve_comment ";
        $approve_query = mysqli_query($connection, $query);
        if(!$approve_query){
            die('Error'.mysqli_error($connection));
        }
        header("Location: comment.php");

    }

    if(isset($_GET['unapprove'])){
        $unapprove_comment = $_GET['unapprove'];
        $query = "UPDATE comment SET comment_status = 'unapproved' WHERE comment_id=$unapprove_comment ";
        $unapprove_query = mysqli_query($connection, $query);
        if(!$unapprove_query){
            die('Error'.mysqli_error($connection));
        }
        header("Location: comment.php");

    }

?>
                   </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

    <?php include "includes/admin_footer.php"?>


