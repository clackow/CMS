<?php ob_start()?>
<?php include session_start();?><!--SESSION用来传数据到server --> 

<?php 
            //当点击logout后，清理所有的session
            $_SESSION['username'] = null;  
            $_SESSION['password'] = null;
            $_SESSION['firstname'] = null;            
            $_SESSION['lastname'] = null;
            $_SESSION['role'] = null;   
            header("Location: ../index.php")
?>
