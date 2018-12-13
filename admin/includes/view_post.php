<?php
    include "delete_modal.php";
    if(isset($_POST['checkboxArray'])){
         foreach ($_POST['checkboxArray'] as $post_value_id) {
            $bulk_option = $_POST['bulk_options'];
            switch ($bulk_option) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = $post_value_id ";
                    $publish_post = mysqli_query($connection,$query);
                    if(!$publish_post){
                        die('error '.mysqli_error($publish_post));
                    }
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = $post_value_id ";
                    $draft_post = mysqli_query($connection,$query);
                    if(!$draft_post){
                        die('error '.mysqli_error($draft_post));
                    }
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $post_value_id ";
                    $delete_post = mysqli_query($connection,$query);
                    if(!$delete_post){
                        die('error '.mysqli_error($delete_post));
                    }
                    break;

                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = $post_value_id ";//LIMIT 3可以只显示3个
                    $select_post_by_id = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_post_by_id)){
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                        $post_tag = $row['post_tag'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_status = $row['post_status'];
                        }                

                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tag, post_status) ";
                    $query.= "VALUES ({$post_category_id},'{$post_title}','{$post_author}', now(),'{$post_img}','{$post_content}','{$post_tag}','{$post_status}' ) ";//now()用来直接send today
                    $clone_query = mysqli_query($connection, $query);
                    if(!$clone_query){
                        die('error '.mysqli_error($clone_query));
                    }
                    break;
             }
        }
    }

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

?> 
                <form method="post" action="">   
                    <table class="table table-bordered table-hover">
                            <div class="col-xs-4" style="padding-left: 0px; padding-bottom: 10px;" id="bulkOptionsContainer">
                                
                                <select class="form-control" name="bulk_options" id="">
                                    <option value="">Select options</option>
                                    <option value="published">Publish</option>
                                    <option value="draft">Draft</option>
                                    <option value="clone">Clone</option>
                                    <option value="delete">Delete</option>

                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                <a href="post.php?source=add_post" class="btn btn-primary">Add New</a>
                            </div>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes" name=""></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View Count</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                GLOBAL $connection;
                                //find all categories
                                $query = "SELECT * FROM posts";//LIMIT 3可以只显示3个
                                $select_post = mysqli_query($connection,$query);     
                                while($row = mysqli_fetch_assoc($select_post)){
                                    $post_id = $row['post_id'];
                                    $post_category_id = $row['post_category_id'];
                                    $post_title = $row['post_title'];
                                    $post_author = $row['post_author'];
                                    $post_date = $row['post_date'];
                                    $post_img = $row['post_img'];
                                    $post_content = $row['post_content'];
                                    $post_tag = $row['post_tag'];
                                    $post_comment_count = $row['post_comment_count'];
                                    $post_status = $row['post_status'];
                                    $post_view_count = $row['post_view_count'];
                                    echo "<tr>";
                                    ?>

                                    <td><input class='checkAll' type='checkbox' name="checkboxArray[]" value="<?php echo $post_id?>"></td>
                                    
                                    <?php
                                    echo "<td>".$post_id."</td>";
                                    echo "<td>".$post_author."</td>";
                                    echo "<td>".$post_title."</td>";

                                    $query = "SELECT * FROM category WHERE cat_id = '{$post_category_id}' ";//LIMIT 3可以只显示3个
                                    $select_categories1 = mysqli_query($connection,$query); //用来display category name    
                                    while($row = mysqli_fetch_assoc($select_categories1)){
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];   
                                    }


                                    echo "<td>".$cat_title."</td>";
                                    echo "<td>".$post_status."</td>";
                                    echo "<td><img width=100px src='../img/".$post_img."'></td>";
                                    echo "<td>".$post_tag."</td>";
                                    $query = "SELECT * FROM comment WHERE comment_post_id = $post_id";
                                    $send_comment_query = mysqli_query($connection,$query);
                                    if(!$send_comment_query){
                                        die('Error'.mysqli_error($send_comment_query));
                                    }
                                    $row = mysqli_fetch_array($send_comment_query);
                                    $comment_id = $row['comment_id'];
                                    $post_comment_count = mysqli_num_rows($send_comment_query);


                                    echo "<td><a href='post_comment.php?id=$post_id'>$post_comment_count</a></td>";
                                    echo "<td>".$post_date."</td>";
                                    echo "<td>".$post_view_count."</td>";                                   
                                    echo "<td><a href='../posts.php?p_id=$post_id'>View</a></td>";
                                    echo "<td><a href='post.php?source=edit_post&pid={$post_id}'>Edit</a></td>";//pid是一个新的变量，通过pid来确定post_id
                                    echo "<td><a rel='$post_id' class='delete_link' href='javascript:viod(0)'>Delete</a></td>";
                                    // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want be delete')\" href='post.php?delete={$post_id}'>Delete</a></td>";
                                    echo "</tr>";
                                    }

                                ?>
                            </tbody>
                        </table>
                    </form>  
<ul class="pager">
    <?php 
    for($i = 1; $i<=$count; $i++){
        if($i == $page){
            echo"<li><a class='active_link' href='post.php?pager=$i'>$i</a></li>";
        }else{
        echo"<li><a href='post.php?pager=$i'>$i</a></li>";
        }
    }
    ?>

</ul>


<?php
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$delete_id}";
        $delete_query = mysqli_query($connection, $query);
        if(!$delete_query){
            die('Error'.mysqli_error($connection));
        }
        header("Location: post.php");

    }

?>

<script>
    $(document).ready(function(){
        $('.delete_link').on('click',function(){
        var id = $(this).attr('rel');
        var delete_url = `post.php?delete=${id}`;
        $(".modal_delete_link").attr("href", delete_url);
        $("#myModal").modal('show');
        });
    })

</script>



