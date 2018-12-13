<?php 

    function escape($string) {
        GLOBAL $connection;
        mysqli_real_escape_string($connection, trim($string));
    }


   function insert_cat(){
   	   	GLOBAL $connection;    
   	    if(isset($_POST['submit'])){
            $cat_title =  $_POST['cat_title'];
            if($cat_title == " " || empty($cat_title)){
                echo "This field should not be empty";
            }else{
                           
            	$query = "INSERT INTO category(cat_title) VALUES ('{$cat_title}') ";
                $result = mysqli_query($connection,$query);
                if(!$result){
                    die('Error '.mysqli_error($connection));
                }
            }
		}
	}


	function findall_cat(){
		GLOBAL $connection;
		//find all categories
        $query = 'SELECT * FROM category ';//LIMIT 3可以只显示3个
        $select_categories = mysqli_query($connection,$query);     
        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo '<tr>';
            echo '<td>'.$cat_id.'</td>';    
            echo '<td>'.$cat_title.'</td> ';
            echo "<td><a class='btn' href='categories.php?delete={$cat_id}'>Delete</td> ";//delete={$cat_id}用来确认需要被delete的id
            echo "<td><a class='btn' href='categories.php?update={$cat_id}'>Update</td> ";//delete={$cat_id}用来确认需要被delete的id
			echo '</tr>';
        }
	}


	function delete_cat(){
		GLOBAL $connection;
		if(isset($_GET['delete'])){
			$cat_id_delete = $_GET['delete'];
            $query1 = "DELETE FROM category WHERE cat_id = {$cat_id_delete}";
            $result1 = mysqli_query($connection,$query1);
            if(!$result1){
            	die('Error '.mysqli_error($connection));
            }
            header("Location: categories.php");//refresh the page
        }                        
	}

    function is_admin($username){
        GLOBAL $connection;
        $query = "SELECT user_role FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($result);
        if($row['user_role'] === 'Admin'){
            return true;
        }else{
            return false;
        }
    }

    function username_exists($username){
        GLOBAL $connection;
        $query = "SELECT username FROM users WHERE username='$username'";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result)>0){
            return true;
        }else{
            return false;
        }
    }

    function email_exists($email){
        GLOBAL $connection;
        $query = "SELECT user_email FROM users WHERE  user_email='$email'";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result)>0){
            return true;
        }else{
            return false;
        }
    }

?>