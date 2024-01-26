<?php
    //check logging
    session_start();
    $_SESSION["page"]="categories.php";
    $_SESSION["table"]="categories";
    $_SESSION["title"]="Rent Car Admin | Categories";
    $managePageTitle="Manage Categories";
	  $managePageSubTitle="List of Categories";

    //update and insert alert
    if(isset($_SESSION["user"])){
      $message = $_SESSION["message"];
      $alert = $_SESSION["alert"];
    }

    include_once("includes/logged.php");
    //database connection
    include_once("includes/conn.php");
    try{
        $sql = "SELECT * FROM `categories`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }catch(PDOException $e){
        echo "Connection failed:  ".$e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once("includes/headtags.php"); ?>
  </head>

  <body class="nav-md">
    <!-- alert section -->
    <?php include_once("includes/alert.php"); ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <?php include_once("includes/menuprofilequickinfo.php"); ?>
            <!-- rentCarAdmin link -->
            <!-- menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include_once("includes/sidebarmenu.php"); ?>
					  <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php include_once("includes/menufooterbuttons.php"); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php include_once("includes/topnavigation.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <!-- Manage Categories & search bar -->
					  <?php include_once("includes/manage&search.php"); ?>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <!-- List of Categories & buttons -->
								  <?php include_once("includes/title&buttons.php"); ?>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Category Name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php foreach($stmt->fetchAll() as $row){
                          $id=$row["id"];
                          $category=$row["category"];
                          ?>
                        <tr>
                          <td><?php echo $category; ?></td>
                          <td><a href="editCategory.php?id=<?php echo $id;?>"><img src="./images/edit.png" alt="Edit"></a></td>
                          <td><a href="delete.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete?')"><img src="./images/delete.png" alt="Delete"></a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include_once("includes/footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- links -->
    <?php include_once("includes/links.php"); ?>

  </body>
</html>