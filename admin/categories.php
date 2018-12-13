    <?php include "includes/admin_header.php"?>
    <?php include "includes/functions.php"?>
    



    <div id="wrapper">
        <!-- Navigation -->
        <?php  include "includes/admin_nav.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Hello</small>
                        </h1>
                   
                    <div class="col-xs-6">
                        <?php insert_cat();?>
                    	<form action="" method="post">
                    		<div class="form-group">
                                <label for="cat-title">Add Category</label>
                    			<input class="form-control" type="text" name="cat_title">
                    		</div>
                    		<div class="form-group">
                    			<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                    		</div>		
                    	</form>

                    <?php //update and include query
                    if(isset($_GET['update'])){
                        $the_cat_id = $_GET['update'];
                        include "includes/edit_categories.php";
                    }
                    ?>

                    </div>

                    <div class="col-xs-6">       
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Categoty Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php findall_cat() ?>
                            <?php delete_cat() ?>

                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
    <?php include "includes/admin_footer.php"?>