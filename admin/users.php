<?php include "includes/admin_header.php"?>
<?php include "includes/functions.php"?>
<?php 
    if(!is_admin($_SESSION['username'])){
        header("Location: ../index.php");
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
                            Welcome
                            <small>Hello</small>
                        </h1>
                    </div>
                        <?php 
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source = '';
                        }
                        switch ($source) {
                            case 'add_user':
                                include "includes/add_user.php";
                                break;
                            case 'edit_user':
                                include "includes/edit_user.php";
                                break;  

                            default:
                                include "includes/view_user.php";
                                break;
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
    <?php include "includes/admin_footer.php"?>