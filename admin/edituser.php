<?php
    session_start();
	$_SESSION["page"]="editUser.php";
    $_SESSION["table"]="users";
    $_SESSION["title"]="Rent Car Admin | Edit User";
	$managePageTitle="Manage Users";
	$managePageSubTitle="Edit User";
    
    //check logging
    include_once("includes/logged.php");
    include_once("includes/conn.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
		$status = true;
	}
    
    if(isset($status)){
		try{
			$sql = "SELECT * FROM `users` WHERE id = ?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			$name=$result["name"];
            $userName=$result["userName"];
            $email=$result["email"];
            $password=$result["password"];
            $active=$result["active"];
			if($active){
				$activeStr="checked";
			}else{
				$activeStr="";
			}
		}catch(PDOException $e){
            $alert = "alert-danger";
            $message = $e->getMessage();
			//echo "Connection failed:  ".$e->getMessage();
		}
	}

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = $_POST["name"];
        $userName = $_POST["userName"];
        //password sent by form
        $newPassword = $_POST["password"];
        //compare current password in database and password from form
        //verify=0 --> password hasn't change
        //verify=-1 --> password changed
        $verify = strcmp($password, $newPassword);     //0 same, -1 no
        //if password changed --> hash it for database
        $newPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST["email"];
		if(isset($_POST["active"])){
			$active=1;
		}else{
			$active=0;
		}
        //don't update password
        if($verify == 0){
            try{
                $sql = "UPDATE `users` SET `name`=?,`userName`=?,`email`=?,`active`=? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $userName, $email, $active, $id]);
                //start session
                $_SESSION['user'] = "batman";
                $_SESSION['message'] = "Data Updated Successfully.";
                $_SESSION['alert'] = "alert-success";
                header("Location: users.php");
                die();
            }catch(PDOException $e){
                $alert = "alert-danger";
                $message = $e->getMessage();
                //echo "Connection failed:  ".$e->getMessage();
            }
        }
        //update password
        else{
            try{
                $sql = "UPDATE `users` SET `name`=?,`userName`=?,`email`=?,`active`=?,`password`=? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $userName, $email, $active, $newPassword, $id]);
                $_SESSION['user'] = "batman";
                $_SESSION['message'] = "Data Updated Successfully.";
                $_SESSION['alert'] = "alert-success";
                header("Location: users.php");
                die();
            }catch(PDOException $e){
                $alert = "alert-danger";
                $message = $e->getMessage();
                //echo "Connection failed:  ".$e->getMessage();
            }
        }
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
								<!-- Edit Users & buttons -->
								<?php include_once("includes/title&buttons.php"); ?>
								<div class="x_content">
									<br />
									<form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control" value="<?php echo $name; ?>" name="name">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="user-name">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="user-name" required="required" class="form-control" value="<?php echo $userName; ?>" name="userName">
											</div>
										</div>
										<div class="item form-group">
											<label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="email" class="form-control" type="email" required="required" value="<?php echo $email; ?>" name="email">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" <?php echo $activeStr; ?> name="active">
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" id="password" required="required" class="form-control" value="<?php echo $password; ?>" name="password">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="users.php"><button class="btn btn-primary" type="button">Cancel</button></a>
												<button type="submit" class="btn btn-success">Update</button>
											</div>
										</div>

									</form>
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
