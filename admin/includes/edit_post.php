<?php 
	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
	}
    $query = "SELECT * FROM posts WHERE post_id = '{$pid}' ";//LIMIT 3可以只显示3个

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
        $post_view_count = $row['post_view_count'];
    	}

    if(isset($_POST['update_post'])){
    	$post_title = $_POST['title'];
    	$post_category = $_POST['post_category'];
        $post_author = $_POST['author'];
    	$post_status = $_POST['post_status'];
    	$post_image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_view_count = $_POST['post_view_count'];
        $post_tag = $_POST['post_tag'];

        move_uploaded_file($image_temp, "../img/".$post_image);//迁移文件位置到指定img folder

        if(empty($post_image)){
    		$query = "SELECT * FROM posts WHERE post_id =  '{$pid}' ";
    		$select_image = mysqli_query($connection,$query);

    		while($row = mysqli_fetch_array($select_image)){
    			$post_image = $row['post_img'];
    		}
    	}


        $query = "UPDATE posts SET ";
        $query .= "post_category_id = '{$post_category}', ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_date = now(), ";
        $query .= "post_img = '{$post_image}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tag = '{$post_tag}', ";
        $query .= "post_view_count = '{$post_view_count}', ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = '{$pid}' ";

        $result = mysqli_query($connection,$query);

        if(!$result){
        	die('Failed '.mysqli_error($connection));
        }
        echo "<p class='bg-success'>Post Updated <a href='../posts.php?p_id={$pid}'>View Post</a> or <a href = './post.php'>Edit more</a> </p> ";








    }
	
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
	</div>

	<div class="form-group">
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


	<div class="form-group">
		<label for="author">Post Author</label>
		<input type="text" class="form-control" name="author" value="<?php echo $post_author?>">
	</div>

    <div class="form-group">
        <label for="status">Post Status</label><br>
        <select name="post_status" id="">
            <option value = '<?php echo $post_status ?>'><?php echo $post_status ?></option>
            <?php
                if($post_status == 'published'){
                    echo "<option value = 'draft'>Draft</option>";
                }else{
                    echo "<option value = 'published'>Published</option>";
                }
            ?>
        </select>
    </div>

	<div class="form-group">
		<img width="100" src="../img/<?php echo $post_img?>"  alt="">
	</div>

	<div class="form-group">
		<label for="post_img"></label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tag">Post Tags</label>
		<input type="text" class="form-control" name="post_tag" value="<?php echo $post_tag?>">
	</div>

    <div class="form-group">
        <label for="post_view_count">Post Views</label><br>
        <input type="number" name="post_view_count" value="<?php echo $post_view_count?>">
    </div>


	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea type="text" rows="10" cols="30" class="form-control" name="post_content" id="editor" ><?php echo $post_content ?></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
	</div>



</form>