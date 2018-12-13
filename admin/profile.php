<?php include "includes/admin_header.php"?>
<?php include "includes/functions.php"?>
<?php
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_profile_query = mysqli_query($connection,$query);
        if(!$select_user_profile_query){
            die('Error'.mysqli_error($connection));
        }
        while($row = mysqli_fetch_array($select_user_profile_query)){
            $user_id = $row['user_id'];
            $user_password = $row['user_password'];
            $user_username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];            
        }
    }    

        if(isset($_POST['update_profile'])){
            $user_username =  $_POST['username'];
            $password =  $_POST['user_password'];
            $firstname =  $_POST['user_firstname'];
            $lastname = $_POST['user_lastname'];
            
            $image = $_FILES['image']['name'];//上传图片的格式
            $image_temp = $_FILES['image']['tmp_name'];
            
            $email = $_POST['user_email'];
            $role = $_POST['user_role'];
            //$post_date = date('d-m-y');//上传日期格式

            //move_uploaded_file($image_temp, "../img/".$image);//迁移文件位置到指定img folder
            $password = password_hash($password,PASSWORD_BCRYPT, array('cost' => 10 ));

           
            $query = "UPDATE users SET ";
            $query .= "username = '{$user_username}', ";
            $query .= "user_password = '{$password}', ";
            $query .= "user_firstname = '{$firstname}', ";
            $query .= "user_lastname = '{$lastname}', ";
            $query .= "user_email = '{$email}' ";
            $query .= "WHERE username = '{$username}' ";
            $edit_user_query = mysqli_query($connection, $query);
            if(!$edit_user_query){
                die('Error '.mysqli_error($connection));
            }
            header("Location: index.php");
        }    

    ?>




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
                            Welcome to CMS
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
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
                                <option value='subscriber'><?php echo $user_role ?></option>;     
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
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>



                    </form>



                    </div>

                    </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

    <?php include "includes/admin_footer.php"?>