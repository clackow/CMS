    <?php include "includes/admin_header.php"?>
    <div id="wrapper">
    <?php
        //catch the session id
        $session = session_id();
        $time = time();
        $time_out_sec = 30;
        $time_out = $time/$time_out_sec;

        $query = "SELECT * FROM users_on_line WHERE session='$session'";
        $session_query = mysqli_query($connection,$query);
        $count = mysqli_num_rows($session_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_on_line(session, time) VALUES('$session','$time')");
        }else{
            mysqli_query($connection, "UPDATE users_on_line SET time = '$time' WHERE session='$session'");
        }  
        $users_online_query = mysqli_query($connection, "SELECT * FROM users_on_line WHERE time > '$time_out' ");
        $count_user = mysqli_num_rows($users_online_query);

    ?>



        <!-- Navigation -->
        <?php  include "includes/admin_nav.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to CMS
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM posts ";
                                        $count_all_post = mysqli_query($connection,$query);
                                        if(!$count_all_post){
                                            die('Error'.mysqli_error($connection));
                                        }
                                        $post_num = mysqli_num_rows($count_all_post);
                                    ?>
                                  <div class='huge'><?php echo $post_num;?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="post.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM comment ";
                                        $count_all_comment = mysqli_query($connection,$query);
                                        if(!$count_all_comment){
                                            die('Error'.mysqli_error($connection));
                                        }
                                        $comment_num = mysqli_num_rows($count_all_comment);//count how many rows in a database,like how many comment
                                    ?>
                                     <div class='huge'><?php echo $comment_num ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comment.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM users ";
                                        $count_all_users = mysqli_query($connection,$query);
                                        if(!$count_all_users){
                                            die('Error'.mysqli_error($connection));
                                        }
                                        $users_num = mysqli_num_rows($count_all_users);
                                    ?>
                                    <div class='huge'><?php echo $users_num ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM category ";
                                        $count_all_category = mysqli_query($connection,$query);
                                        if(!$count_all_category){
                                            die('Error'.mysqli_error($connection));
                                        }
                                        $category_num = mysqli_num_rows($count_all_category);
                                    ?>
                                        <div class='huge'><?php echo $category_num ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php

                    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                    $count_all_publish_post = mysqli_query($connection,$query);
                    if(!$count_all_publish_post){
                        die('Error'.mysqli_error($connection));
                    }
                    $publish_post_num = mysqli_num_rows($count_all_publish_post);


                    $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                    $count_all_draft_post = mysqli_query($connection,$query);
                    if(!$count_all_draft_post){
                        die('Error'.mysqli_error($connection));
                    }
                    $draft_post_num = mysqli_num_rows($count_all_draft_post);

                    $query = "SELECT * FROM comment WHERE comment_status = 'unapproved' ";
                    $count_all_unapproved_comment = mysqli_query($connection,$query);
                    if(!$count_all_unapproved_comment){
                        die('Error'.mysqli_error($connection));
                    }
                    $unapproved_comment_num = mysqli_num_rows($count_all_unapproved_comment);

                    $query = "SELECT * FROM users WHERE user_role = 'Admin' ";
                    $count_admin_user = mysqli_query($connection,$query);
                    if(!$count_admin_user){
                        die('Error'.mysqli_error($connection));
                    }
                    $admin_user_num = mysqli_num_rows($count_admin_user);


                ?>




                
                <!-- api for google charts-->
                <div class="row">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Date', 'Count'],
                          <?php
                            $all_post_count = $publish_post_num + $draft_post_num;
                            $element_text = ['All Posts','Published Posts','Draft Posts','Categories','Users','Admin Users','Comments','Unapproved Comments'];
                            $element_count = [ $all_post_count, $publish_post_num, $draft_post_num, $category_num, $users_num, $admin_user_num,$comment_num, $unapproved_comment_num];
                            for($i = 0; $i < 8; $i++){
                                echo "[ '{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                //通过array自动输出post,comment,category,users count;
                            }

                          ?>
                          //['Post',1000],

                        ]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div> 
                </div>  
            </div>
    <?php include "includes/admin_footer.php"?>