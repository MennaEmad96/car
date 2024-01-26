<?php
    session_start();
    $_SESSION["page"]="users.php";
    $_SESSION["table"]="users";
    $_SESSION["title"]="Rent Car Admin | Users";
    $managePageTitle="Manage Users";
	  $managePageSubTitle="List of Users";
    
    //check logging
    include_once("includes/logged.php");
    include_once("includes/conn.php");

    //update and insert alert
    if(isset($_SESSION["user"])){
      $message = $_SESSION["message"];
      $alert = $_SESSION["alert"];
    }

    try{
      $sql = "SELECT `id`, DATE_FORMAT(`regDate`,'%d %M %Y') AS regDate, `name`, `userName`, `email`, `active` FROM `users`";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }catch(PDOException $e){
      $message = "Connection failed:  ".$e->getMessage();;
      $alert = "alert-danger";
      //echo "Connection failed:  ".$e->getMessage();
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
            <!-- Manage Users & search bar -->
					  <?php include_once("includes/manage&search.php"); ?>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <!-- List of Users & buttons -->
								  <?php include_once("includes/title&buttons.php"); ?>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Registration Date</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Active</th>
                          <th>Edit</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                        foreach($stmt->fetchAll() as $row){
                          $id=$row["id"];
                          $regDate=$row["regDate"];
                          $name=$row["name"];
                          $userName=$row["userName"];
                          $email=$row["email"];
                          $active=$row["active"];
                      ?>
                        <tr>
                          <td><?php echo $regDate; ?></td>
                          <td><?php echo $name; ?></td>
                          <td><?php echo $userName; ?></td>
                          <td><?php echo $email; ?></td>
                          <td><?php echo empty($active) ? "No" : "Yes"; ?></td>
                          <td><a href="edituser.php?id=<?php echo $id;?>"><img src="./images/edit.png" alt="Edit"></a></td>
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