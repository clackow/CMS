<?php 
        if(isset($_POST['create_user'])){
        	
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

            $query = "INSERT INTO users( username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
            $query.= "VALUES ('{$username}','{$password}','{$firstname}', '{$lastname}','{$email}','{$image}','{$role}') ";//now()用来直接send today
            $add_new_user = mysqli_query($connection, $query);
            if(!$add_new_user){
                die('Error '.mysqli_error($connection));
            }
        echo "User Created". " ". "<a href = 'users.php'>View Users</a>";
            
    }

 ?>


<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>

	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="user_lastname">Last Name</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="user_role">Role</label><br>
		<select name="user_role" class="custom-select">
			<option value='Subscriber'>Select a Role</option>";		
			<option value='Admin'>Admin</option>";
			<option value='Subscriber'>Subscriber</option>";

		</select>
	</div>

	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>

	<div class="form-group">
		<label for="image">User Image</label>
		<input type="file" name="image">
	</div>


	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
	</div>



</form>