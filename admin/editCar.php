<?php
    session_start();
    $_SESSION["page"]="editCar.php";
    $_SESSION["table"]="cars";
    $_SESSION["title"]="Rent Car Admin | Edit Car";
	$managePageTitle="Manage Cars";
	$managePageSubTitle="Edit Car";
    
    //check logging
    include_once("includes/logged.php");
    include_once("includes/conn.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
		$status = true;
	}
    
    if(isset($status)){
		try{
			$sql = "SELECT * FROM `cars` WHERE id = ?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			$title=$result["title"];
            $price=$result["price"];
            $luggage=$result["luggage"];
            $doors=$result["doors"];
            $passenger=$result["passenger"];
            $content=$result["content"];
            $active=$result["active"];
            $category_id=$result["category_id"];
            $image=$result["image"];
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
        $title = $_POST["title"];
        $price = $_POST["price"];
        $luggage = $_POST["luggage"];
        $doors = $_POST["doors"];
        $passenger = $_POST["passenger"];
        $content = $_POST["content"];
        $category_id = $_POST["category"];
        $oldImage = $_POST["oldImage"];
        include_once("includes/updateImage.php");
        if(isset($_POST["active"])){
            $active=1;
        }else{
            $active=0;
        }
        try{
            $sql = "UPDATE `cars` SET `title`=?,`price`=?,`luggage`=?,`doors`=?,`passenger`=?,`content`=?,`image`=?,`active`=?,`category_id`=? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title,$price,$luggage,$doors,$passenger,$content,$image_name,$active,$category_id,$id]);
            //start session
            $_SESSION['user'] = "batman";
            $_SESSION['message'] = "Data Updated Successfully.";
            $_SESSION['alert'] = "alert-success";
            header("Location: cars.php");
            die();
        }catch(PDOException $e){
            $alert = "alert-danger";
            $message = $e->getMessage();
            //echo "Connection failed:  ".$e->getMessage();
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
								<!-- Edit Car & buttons -->
								<?php include_once("includes/title&buttons.php"); ?>
								<div class="x_content">
									<br />
									<form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" required="required" class="form-control" name="title" value="<?php echo $title; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="content" name="content" required="required" class="form-control"><?php echo $content; ?></textarea>
											</div>
										</div>
										<div class="item form-group">
											<label for="luggage" class="col-form-label col-md-3 col-sm-3 label-align">Luggage <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="luggage" class="form-control" type="number" name="luggage" required="required" value="<?php echo $luggage; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="doors" class="col-form-label col-md-3 col-sm-3 label-align">Doors <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="doors" class="form-control" type="number" name="doors" required="required" value="<?php echo $doors; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="passengers" class="col-form-label col-md-3 col-sm-3 label-align">Passengers <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="passengers" class="form-control" type="number" name="passenger" required="required" value="<?php echo $passenger; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="price" class="col-form-label col-md-3 col-sm-3 label-align">Price <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="price" class="form-control" type="number" name="price" required="required" value="<?php echo $price; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input name="active" type="checkbox" class="flat" <?php echo $activeStr; ?>>
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="image" name="image" class="form-control">
												<img src="../images/<?php echo $image; ?>" alt="<?php echo $title; ?>" style="width: 300px;">
											</div>
                                            <input type="hidden" value="<?php echo $image ?>" name="oldImage">
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Category <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="category" id="">
                                                <?php foreach($stmt_categories->fetchAll() as $row){
                                                    $id=$row["id"];
                                                    $category=$row["category"]; ?>
                                                <option value="<?php echo $id; ?>" <?php if($category_id == $id) echo "selected"; ?>><?php echo $category; ?></option>
                                                <?php } ?>
												</select>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="cars.php"><button class="btn btn-primary" type="button">Cancel</button></a>
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
