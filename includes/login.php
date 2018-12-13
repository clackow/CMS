<?php include "db.php"; ?>
<?php include session_start();?><!--SESSION用来传数据到server --> 

<?php 
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($connection,$username);
        $password = mysqli_real_escape_string($connection,$password);//secure,for sql injection

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_query = mysqli_query($connection,$query);
        if(!$select_user_query){
            die("Error ".mysqli_error($connection));
        }

        while($row = mysqli_fetch_array($select_user_query)){
            $user_id = $row['user_id'];
            $user_username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $user_password = $row['user_password'];
        }
     
        
        if(password_verify($password, $user_password)) {
            $_SESSION['username'] = $user_username;//Associate array   
            $_SESSION['password'] = $user_password;
            $_SESSION['firstname'] = $user_firstname;            
            $_SESSION['lastname'] = $user_lastname;
            $_SESSION['role'] = $user_role;            
            header("Location: ../admin");
        }else{
            header("Location: ../index.php");
        }
        
    }

?>