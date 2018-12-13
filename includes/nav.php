<?php include 'db.php'?>


    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    GLOBAL $connection; 
                    $query = 'SELECT * FROM category ';
                    $select_all = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all)){
                        $cat_title = $row['cat_title'] ;
                        $cat_id = $row['cat_id'];
                        $category_class = '';
                        $registration_class = '';
                        $pageName = basename($_SERVER['PHP_SELF']);
                        if(isset($_GET['category']) && isset($_GET['category'])==$cat_id){
                            $category_class = 'active';
                        }elseif($pageName == 'registration.php'){
                            $registration_class = 'active';
                        }
                        echo "<li> <a class='$category_class' href='category.php?category={$cat_id}' >$cat_title</a> </li>";
                    }

                    ?>
                    
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                    <li class="<?php echo $registration_class?>">
                        <a href="registration.php">Sign Up</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                    <?php
                    if(session_status()=== PHP_SESSION_NONE){

                        session_start();
                        if(isset($_SESSION['role'])){

                            if(isset($_GET['p_id'])){
                                $post_id = $_GET['p_id'];
                                echo "<a href='admin/post.php?source=edit_post&pid=$post_id'>Edit Post</a>";
                                }
                            }
                        }
                    ?>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right top-nav ">
            </ul>
            </div>
            <!-- /.navbar-collapse -->

        </div>
        <!-- /.container -->
    </nav>