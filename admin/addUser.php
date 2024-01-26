<?php
    session_start();
    $_SESSION["page"]="addUser.php";
    $_SESSION["table"]="users";
    $_SESSION["title"]="Rent Car Admin | Add User";
	$managePageTitle="Manage Users";
	$managePageSubTitle="Add User";
    
    //check logging
    include_once("includes/logged.php");
    include_once("includes/conn.php");

	//<input value="" />
	$nameVal="";
	$userNameVal="";
	$passwordVal="";
	$emailVal="";
	$activeVal="";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = $_POST["name"];
        $userName = $_POST["userName"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST["email"];
        if(isset($_POST["active"])){
			$active=1;
		}else{
			$active=0;
		}
        try{
            $sql = "INSERT INTO `users`(`name`, `userName`, `email`, `password`, `active`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $userName, $email, $password, $active]);
            //action=login.php-->
            //preferring this way to check from several steps before moving to login page
            $_SESSION['user'] = "batman";
            $_SESSION['message'] = "Data Added Successfully.";
            $_SESSION['alert'] = "alert-success";
            header("Location: users.php");
            die();
        }catch(PDOException $e){
			$nameVal=$name;
			$userNameVal=$userName;
			$passwordVal=$_POST["password"];
			$emailVal=$email;
			if($active){
				$activeVal="checked";
			}else{
				$activeVal="";
			}
            $message = $e->getMessage();
            $alert = "alert-danger";
            //echo "Connection failed:  ".$e->getMessage();
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
								<!-- Add User & buttons -->
								<?php include_once("includes/title&buttons.php"); ?>
								<div class="x_content">
									<br />
									<form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control" name="name" value="<?php echo $nameVal; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="user-name">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="user-name" name="userName" required="required" class="form-control" value="<?php echo $userNameVal; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="email" class="form-control" type="email" name="email" required="required" value="<?php echo $emailVal; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" name="active" <?php echo $activeVal; ?>>
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" id="password" name="password" required="required" class="form-control" value="<?php echo $passwordVal; ?>">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="users.php"><button class="btn btn-primary" type="button">Cancel</button></a>
												<button type="submit" class="btn btn-success">Add</button>
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
