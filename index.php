<?php
    //database connection
    include_once("admin/includes/conn.php");

    session_start();
    $_SESSION["page"]="index.php";
    $_SESSION["title"]="CarRental &mdash; Free Website Template by Colorlib";

    //show categories
    try{
        $sql = "SELECT `categories`.`category`, `categories`.`id` FROM `categories` INNER JOIN `cars` ON cars.`category_id` = categories.`id` GROUP BY `categories`.`id`;
        ";
        $stmt_categories = $conn->prepare($sql);
        $stmt_categories->execute();
    }catch(PDOException $e){
        echo "Connection failed:  ".$e->getMessage();
    }

    //show 6 cars
    try{
        //select random 6 cars
        //$sql = "SELECT `id`, `title`, `price`, `luggage`, `doors`, `passenger`, LEFT (`content`, 100) AS `content`, `image`, `category_id` FROM `cars` WHERE `active` = 1 ORDER BY RAND() LIMIT 6";
        //select latest 6 cars
        $sql = "SELECT `id`, `title`, `price`, `luggage`, `doors`, `passenger`, LEFT (`content`, 100) AS `content`, `image`, `category_id` FROM `cars` WHERE `active` = 1 ORDER BY ID DESC LIMIT 6";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }catch(PDOException $e){
        echo "Connection failed:  ".$e->getMessage();
    }

    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $category_id = $_POST["category"];
        if($category_id){
            header("Location: listing.php?cat_id=$category_id");
            die();
        }
    }
?>

<!doctype html>
<html lang="en">

    <head>
        <?php include_once("includes/headTags.php"); ?>
    </head>

    <body>

    <div class="site-wrap" id="home-section">
        <!-- top section nav -->
        <?php include_once("includes/topNav.php"); ?>
      
        <div class="hero" style="background-image: url('images/hero_1_a.jpg');">
            <!-- search start -->
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-10">

                        <div class="row mb-5">
                            <div class="col-lg-7 intro">
                            <h1><strong>Rent a car</strong> is within your finger tips.</h1>
                            </div>
                        </div>
                    
                        <form action="" method="POST" class="trip-form">
                            <div class="row align-items-center">
                            <div class="mb-3 mb-md-0 col-md-3">
                                <select name="category" id="" class="custom-select form-control">
                                <option value="">Select Type</option>
                                <?php foreach($stmt_categories->fetchAll() as $row){
                                    $id=$row["id"];
                                    $category=$row["category"]; ?>
                                <option value="<?php echo $id; ?>"><?php echo $category; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <div class="form-control-wrap">
                                <input type="text" id="cf-3" placeholder="Pick up" class="form-control datepicker px-3">
                                <span class="icon icon-date_range"></span>

                                </div>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <div class="form-control-wrap">
                                <input type="text" id="cf-4" placeholder="Drop off" class="form-control datepicker px-3">
                                <span class="icon icon-date_range"></span>
                                </div>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <input type="submit" value="Search Now" class="btn btn-primary btn-block py-3">
                            </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- search end -->
        </div>
  

        <!-- how it works start -->
        <div class="site-section">
            <div class="container">
            <h2 class="section-heading"><strong>How it works?</strong></h2>
            <p class="mb-5">Easy steps to get you started</p>    

            <div class="row mb-5">
                <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="step">
                    <span>1</span>
                    <div class="step-inner">
                    <span class="number text-primary">01.</span>
                    <h3>Select a car</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, laboriosam!</p>
                    </div>
                </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="step">
                    <span>2</span>
                    <div class="step-inner">
                    <span class="number text-primary">02.</span>
                    <h3>Fill up form</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, laboriosam!</p>
                    </div>
                </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="step">
                    <span>3</span>
                    <div class="step-inner">
                    <span class="number text-primary">03.</span>
                    <h3>Payment</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, laboriosam!</p>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mx-auto">
                <a href="#" class="d-flex align-items-center play-now mx-auto">
                    <span class="icon">
                    <span class="icon-play"></span>
                    </span>
                    <span class="caption">Video how it works</span>
                </a>
                </div>
            </div>
            </div>
        </div>
        <!-- how it works end -->
        
        <!-- meet them now start -->
        <div class="site-section">
            <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center order-lg-2">
                <div class="img-wrap-1 mb-5">
                    <img src="images/feature_01.png" alt="Image" class="img-fluid">
                </div>
                </div>
                <div class="col-lg-4 ml-auto order-lg-1">
                <h3 class="mb-4 section-heading"><strong>You can easily avail our promo for renting a car.</strong></h3>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, explicabo iste a labore id est quas, doloremque veritatis! Provident odit pariatur dolorem quisquam, voluptatibus voluptates optio accusamus, vel quasi quidem!</p>
                
                <p><a href="#" class="btn btn-primary">Meet them now</a></p>
                </div>
            </div>
            </div>
        </div>
        <!-- meet them now end -->
        
        <!-- car listing start -->
        <div class="site-section bg-light">
            <div class="container">
                <?php include_once("includes/carListing.php"); ?>
            </div>
        </div>
        <!-- car listing end -->

        <!-- features start -->
        <?php include_once("includes/features.php"); ?>
        <!-- features end -->

        <!-- testimonials start -->
        <div class="site-section bg-light">
            <?php include_once("includes/testimonials.php"); ?>
        </div>
        <!-- testimonials end -->

        <!-- rent a car now start -->
        <?php include_once("includes/rentCarNow.php"); ?>
        <!-- rent a car now end -->

        <!-- footer start -->
        <?php include_once("includes/footer.php"); ?>
        <!-- footer end -->

        </div>

        <!-- links -->
        <?php include_once("includes/links.php"); ?>

    </body>

</html>

