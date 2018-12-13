<?php 
        if(isset($_POST['create_post'])){
            $title =  escape($_POST['title']);
            $author =  escape($_POST['post_author']);
            $category_id =  escape($_POST['post_category']);
            $status = escape($_POST['post_status']);
            
            $image = escace($_FILES['image']['name']);//上传图片的格式
            $image_temp = $_FILES['image']['tmp_name'];
            
            $tag = $_POST['post_tag'];
            $content = $_POST['post_content'];
            $post_date = date('d-m-y');//上传日期格式

            move_uploaded_file($image_temp, "../img/".$image);//迁移文件位置到指定img folder

            $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tag, post_status) ";
            $query.= "VALUES ({$category_id},'{$title}','{$author}', now(),'{$image}','{$content}','{$tag}','{$status}' ) ";//now()用来直接send today
            $result = mysqli_query($connection, $query);
            if(!$result){
                die('Error '.mysqli_error($connection));
            }
    		$pid = mysqli_insert_id($connection);//提取这个刚刚创建的id
    		echo "<p class='bg-success'>Post Created <a href='../posts.php?p_id={$pid}'>View Post</a></p> ";

    	}

 ?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title">
	</div>

	<div class="form-group">
		<label for="category">Post Categoty</label><br>
		<select name="post_category" id="post_category">
			<?php 
			    $query = "SELECT * FROM category";//LIMIT 3可以只显示3个
                $post_category = mysqli_query($connection,$query);     
                while($row = mysqli_fetch_assoc($post_category)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];   
				echo "<option value = '{$cat_id}'>{$cat_title}</option>";
			}
			?>

		</select>
	</div>


<!-- 	<div class="form-group">
		<label for="author">Post Author</label>
		<input type="text" class="form-control" name="author">
	</div> -->

	<div class="form-group">
		<label for="category">Post Users</label><br>
		<select name="post_author" id="post_author">
			<?php 
			    $query = "SELECT * FROM users";//LIMIT 3可以只显示3个
                $select_user = mysqli_query($connection,$query);     
                while($row = mysqli_fetch_assoc($select_user)){
                    $user_id = $row['user_id'];
                    $user_username = $row['username'];   
				echo "<option value = '{$user_username}'>{$user_username}</option>";
			}
			?>

		</select>
	</div>


	<div class="form-group">
		<label for="status">Post Status</label><br>
		<select name="post_status">
			<option value="draft">Select Options</option>
			<option value="published">Publish</option>
			<option value="draft">Draft</option>
		</select>
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tag">Post Tags</label>
		<input type="text" class="form-control" name="post_tag">
	</div>


	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea type="text" rows="30" cols="10" class="form-control" name="post_content" id="editor"></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
	</div>



</form>