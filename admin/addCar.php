<?php
    session_start();
    $_SESSION["page"]="addCar.php";
    $_SESSION["table"]="cars";
    $_SESSION["title"]="Rent Car Admin | Add Car";
	$managePageTitle="Manage Cars";
	$managePageSubTitle="Add Car";
    
    //check logging
    include_once("includes/logged.php");
    include_once("includes/conn.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $category_id = $_POST["category"];
        if($category_id > 0){
            $title = $_POST["title"];
            $price = $_POST["price"];
            $luggage = $_POST["luggage"];
            $doors = $_POST["doors"];
            $passenger = $_POST["passengers"];
            $content = $_POST["content"];
            if(isset($_POST["active"])){
                $active=1;
            }else{
                $active=0;
            }
			include_once("includes/addimage.php");
            try{
                $sql = "INSERT INTO `cars`(`title`, `price`, `luggage`, `doors`, `passenger`, `content`, `image`, `active`, `category_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$title, $price, $luggage, $doors, $passenger, $content, $image_name, $active, $category_id]);
                //action=login.php-->
                //preferring this way to check from several steps before moving to login page
                $_SESSION['user'] = "batman";
                $_SESSION['message'] = "Data Added Successfully.";
                $_SESSION['alert'] = "alert-success";
                header("Location: cars.php");
                die();
            }catch(PDOException $e){
                $message = $e->getMessage();
                $alert = "alert-danger";
                //echo "Connection failed:  ".$e->getMessage();
            }
        }else{
            $message = "Choose Category.";
            $alert = "alert-warning";
        }        
    }
    //show categories
    try{
        $sql = "SELECT * FROM `categories`";
        $stmt_categories = $conn->prepare($sql);
        $stmt_categories->execute();
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
					<!-- Manage Cars & search bar -->
					<?php include_once("includes/manage&search.php"); ?>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<!-- Add Car & buttons -->
								<?php include_once("includes/title&buttons.php"); ?>
								<div class="x_content">
									<br />
									<form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" required="required" class="form-control" name="title">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="content" name="content" required="required" class="form-control">Contents</textarea>
											</div>
										</div>
										<div class="item form-group">
											<label for="luggage" class="col-form-label col-md-3 col-sm-3 label-align">Luggage <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="luggage" class="form-control" type="number" name="luggage" required="required">
											</div>
										</div>
										<div class="item form-group">
											<label for="doors" class="col-form-label col-md-3 col-sm-3 label-align">Doors <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="doors" class="form-control" type="number" name="doors" required="required">
											</div>
										</div>
										<div class="item form-group">
											<label for="passengers" class="col-form-label col-md-3 col-sm-3 label-align">Passengers <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="passengers" class="form-control" type="number" name="passengers" required="required">
											</div>
										</div>
										<div class="item form-group">
											<label for="price" class="col-form-label col-md-3 col-sm-3 label-align">Price <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="price" class="form-control" type="number" name="price" required="required">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" name="active">
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="image" name="image" required="required" class="form-control">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Category <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="category" id="">
													<option value="">Select Category</option>
													<?php foreach($stmt_categories->fetchAll() as $row){
														$id=$row["id"];
														$category=$row["category"]; ?>
													<option value="<?php echo $id; ?>"><?php echo $category; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="cars.php"><button class="btn btn-primary" type="button">Cancel</button></a>
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
