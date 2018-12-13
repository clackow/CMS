<?php 
    if(isset($_GET['uid'])){  

        $the_user_id = $_GET['uid'];
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $show_all_user = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($show_all_user)){
            $user_id = $row['user_id'];
            $user_password = $row['user_password'];
            $user_username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
        
        if(isset($_POST['update_user'])){
            
            $username =  $_POST['username'];
            $password =  $_POST['user_password'];
            $firstname =  $_POST['user_firstname'];
            $lastname = $_POST['user_lastname'];
            
            $image = $_FILES['image']['name'];//上传图片的格式
            $image_temp = $_FILES['image']['tmp_name'];
            
            $email = $_POST['user_email'];
            $role = $_POST['user_role'];
            //$post_date = date('d-m-y');//上传日期格式

            move_uploaded_file($image_temp, "../img/".$image);//迁移文件位置到指定img folder
            $password = password_hash($password,PASSWORD_BCRYPT, array('cost' => 10 ));

            
           
            $query = "UPDATE users SET ";
            $query .= "username = '{$username}', ";
            $query .= "user_password = '{$password}', ";
            $query .= "user_firstname = '{$firstname}', ";
            $query .= "user_lastname = '{$lastname}', ";
            $query .= "user_email = '{$email}' ";
            $query .= "WHERE user_id = $the_user_id ";
            
            $edit_user_query = mysqli_query($connection, $query);
            if(!$edit_user_query){
                die('Error '.mysqli_error($connection));
            }
            header("Location: users.php");
        }    
    }

 ?>


<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $user_username ?>">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>" >
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" class="custom-select">
            <option value='<?php echo $user_role ?>'><?php echo $user_role ?></option>;     
            <?php 
                if($user_role == 'Admin'){
                    echo "<option value='Subscriber'>Subscriber</option>";

                }else {
                    echo "<option value='Admin'>Admin</option>";

                }

            ?>


        </select>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>" >
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image">
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>



</form>