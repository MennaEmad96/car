<?php
    //database connection
    include_once("admin/includes/conn.php");

    session_start();
    $_SESSION["page"]="listing.php";
    $_SESSION["title"]="Car Rental &mdash; Car detail";

    //show cars for a desired category
    if(isset($_GET["cat_id"])){
        $id = $_GET["cat_id"];
        try{
            $sql = "SELECT `id`, `title`, `price`, `luggage`, `doors`, `passenger`, LEFT (`content`, 100) AS `content`, `image`, `category_id` FROM `cars` WHERE `active` = 1 AND category_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
        }catch(PDOException $e){
            echo "Connection failed:  ".$e->getMessage();
        }
	}
    //show all cars
    else{
        try{
            $sql = "SELECT `id`, `title`, `price`, `luggage`, `doors`, `passenger`, LEFT (`content`, 100) AS `content`, `image`, `category_id` FROM `cars` WHERE `active` = 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo "Connection failed:  ".$e->getMessage();
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

            <!-- address start -->
            <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">
                <div class="container">
                    <div class="row align-items-end ">
                        <div class="col-lg-5">
                            <div class="intro">
                                <h1><strong>Listings</strong></h1>
                                <div class="custom-breadcrumbs"><a href="index.php">Home</a> <span class="mx-2">/</span> <strong>Listings</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- address end -->
    
        <!-- car listing start -->
        <div class="site-section bg-light">
            <div class="container">
                <?php include_once("includes/carListing.php"); ?>
                <div class="row">
                    <div class="col-5">
                        <div class="custom-pagination">
                            <a href="#">1</a>
                            <span>2</span>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- car listing end -->

        
        <!-- testimonials start -->
        <div class="site-section">
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

