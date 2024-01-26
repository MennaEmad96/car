<?php
    session_start();
    $_SESSION["page"]="editCategory.php";
    $_SESSION["table"]="categories";
    $_SESSION["title"]="Rent Car Admin | Edit Category";
    $managePageTitle="Manage Categories";
	$managePageSubTitle="Edit Category";

    //check logging
    include_once("includes/logged.php");
    include_once("includes/conn.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
		$status = true;
	}
    
    if(isset($status)){
		try{
			$sql = "SELECT * FROM `categories` WHERE id = ?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			$category=$result["category"];
		}catch(PDOException $e){
            $alert = "alert-danger";
            $message = $e->getMessage();
			//echo "Connection failed:  ".$e->getMessage();
		}
	}

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $category = $_POST["category"];
        try{
            $sql = "UPDATE `categories` SET `category`=? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$category, $id]);
            //start session
            $_SESSION['user'] = "batman";
            $_SESSION['message'] = "Data Updated Successfully.";
            $_SESSION['alert'] = "alert-success";
            header("Location: categories.php");
            die();
        }catch(PDOException $e){
            $alert = "alert-danger";
            $message = $e->getMessage();
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
					<!-- Manage Categories & search bar -->
					<?php include_once("includes/manage&search.php"); ?>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<!-- Edit Category & buttons -->
								<?php include_once("includes/title&buttons.php"); ?>
								<div class="x_content">
									<br />
									<form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="add-category">Edit Category <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="add-category" required="required" class="form-control" name="category" value="<?php echo $category; ?>">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="categories.php"><button class="btn btn-primary" type="button">Cancel</button></a>
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
