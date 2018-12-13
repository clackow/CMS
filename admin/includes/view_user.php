                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Delete</th>
                                    <th></th>
                                    <th></th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                GLOBAL $connection;
                                //find all categories
                                $query = 'SELECT * FROM users ';//LIMIT 3可以只显示3个
                                $select_users = mysqli_query($connection,$query);     
                                while($row = mysqli_fetch_assoc($select_users)){
                                    $user_id = $row['user_id'];
                                    $username = $row['username'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];

                                    echo "<tr>";
                                    echo "<td>".$user_id."</td>";
                                    echo "<td>".$username."</td>";
                                    echo "<td>".$user_firstname."</td>";
                                    echo "<td>".$user_lastname."</td>";
                                    echo "<td>".$user_email."</td>";
                                    echo "<td>".$user_role."</td>";
                                    /*
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
                                    */
                                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want be delete')\" href='users.php?delete=$user_id'>Delete</a></td>";//pid是一个新的变量，通过pid来确定post_id
                                    echo "<td><a href='users.php?change_to_admin=$user_id '>Change to Admin</a></td>";
                                    echo "<td><a href='users.php?change_to_sub=$user_id '>Change to Subscriber</a></td>";
                                    echo "<td><a href='users.php?source=edit_user&uid=$user_id'>Edit</a></td>";
                                    echo "</tr>";
                                    }

                                ?>
                            </tbody>

                        </table>  


<?php
    if(isset($_GET['delete'])){
        if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role']==='admin'){    
                $delete_user = mysqli_real_escape_string($connection,$_GET['delete']);
                $query = "DELETE FROM users WHERE user_id = $delete_user ";
                $delete_user = mysqli_query($connection, $query);
                if(!$delete_user){
                    die('Error'.mysqli_error($connection));
                }
                header("Location: users.php");
            }
        }
    }


    if(isset($_GET['change_to_admin'])){
        $admin_change = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id=$admin_change ";
        $admin_into = mysqli_query($connection, $query);
        if(!$admin_into){
            die('Error'.mysqli_error($connection));
        }
        header("Location: users.php");

    }

     if(isset($_GET['change_to_sub'])){
        $sub_change = $_GET['change_to_sub'];
        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id=$sub_change ";
        $sub_into = mysqli_query($connection, $query);
        if(!$sub_into){
            die('Error'.mysqli_error($connection));
        }
        header("Location: users.php");

    }
    

?>



