<?php include "includes/admin_header.php"?>
    <?php include "includes/functions.php"?>
    



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
                            case 'add_post':
                                include "includes/add_post.php";
                                break;
                            case 'edit_post':
                                include "includes/edit_post.php";
                                break;  
                            case '100':
                                echo '100';
                                break;

                            default:
                                include "includes/view_post.php";
                                break;
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

    <?php include "includes/admin_footer.php"?>