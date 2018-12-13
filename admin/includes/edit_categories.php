
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Edit Category</label>
                                <?php
                                //update
                                if(isset($_GET['update'])) {
                                $cat_id = $_GET['update'];
                                $query = "SELECT * FROM category WHERE cat_id = $cat_id ";//LIMIT 3可以只显示3个
                                $select_categories1 = mysqli_query($connection,$query);     
                                 while($row = mysqli_fetch_assoc($select_categories1)){
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];   
                                    ?>
                                <input value="<?php if(isset($cat_title)){ echo $cat_title; } ?>" class="form-control" type="text" name="cat_title">


                                                                 
                                <?php 
                                    }
                                } 
                                ?>
                                <?php 
                                //////update query
                                if(isset($_POST['update_query'])){
                                    $cat_title_update = $_POST['cat_title'];
                                    $query1 = "UPDATE category SET cat_title = '{$cat_title_update}' WHERE cat_id = {$the_cat_id} ";
                                    $update_query = mysqli_query($connection,$query1);
                                    if(!$update_query){
                                        die('Error on updating'.mysqli_error($connection));
                                    }
                                    header("Location: categories.php");//refresh the page

                                }

                                ?>

                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_query" value="Update Category">
                            </div>      
                        </form>