<?php
    session_start();
    $_SESSION["page"]="single.php";
    $_SESSION["title"]="Car Rental &mdash; Detail";

    //database
    include_once("admin/includes/conn.php");
    //desired car id
    if(isset($_GET["id"])){
        $id = $_GET["id"];
		$status = true;
	}

    //show car detail
    if(isset($status)){
		try{
			$sql = "SELECT DATE_FORMAT(`regDate`,'%M %d, %Y') AS `regDate`, `title`, `price`, `luggage`, `doors`, `passenger`, `content`, `image`, `category_id` FROM `cars` WHERE  id = ?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$id]);
			$result = $stmt->fetch();
            $regDate=$result["regDate"];
			$title=$result["title"];
            $price=$result["price"];
            $luggage=$result["luggage"];
            $doors=$result["doors"];
            $passenger=$result["passenger"];
            $content=$result["content"];
            $category_id=$result["category_id"];
            $image=$result["image"];
		}catch(PDOException $e){
            $alert = "alert-danger";
            $message = $e->getMessage();
			//echo "Connection failed:  ".$e->getMessage();
		}

        //category name of this car
        try{
            $sql1 = "SELECT * FROM `categories`";
            $stmt_categories1 = $conn->prepare($sql1);
            $stmt_categories1->execute();
        }catch(PDOException $e){
            echo "Connection failed:  ".$e->getMessage();
        }
        foreach($stmt_categories1->fetchAll() as $row){
            if($category_id == $row["id"]){
                $carCategory = $row["category"];
                $cat_id = $row["id"];
            }
        }
	}else{
        $title="Invalid Request";
        $regDate="";
    }

    //show categories and their related cars count
    try{
        $sql2 = "SELECT `categories`.`category`, COUNT(*) AS num, `categories`.`id` FROM `cars` INNER JOIN `categories` ON `cars`.`category_id` = `categories`.`id` AND `cars`.`active` = 1 GROUP BY `categories`.`category`";
        $stmt_categories2 = $conn->prepare($sql2);
        $stmt_categories2->execute();
    }catch(PDOException $e){
        echo "Connection failed:  ".$e->getMessage();
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

            <!-- head start -->
            <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">
                <div class="container">
                    <div class="row align-items-end ">
                        <div class="col-lg-12">
                            <div class="intro">
                                <!-- car title and date -->
                                <h1><strong><?php echo $title; ?></strong></h1>
                                <div class="pb-4"><strong class="text-black">Posted on <?php echo $regDate; ?></strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- head end -->        

        <div class="site-section">
        <div class="container">
            <div class="row">
            <div class="col-md-8 blog-content">
                <!-- car detail start -->
                <?php if(isset($status)){ ?>
                <img src="images/<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-fluid p-3 mb-5 bg-white rounded">
                
                <div class="grey-bg container-fluid">
                <section id="minimal-statistics">
                    <div class="row">
                    <div class="col-12 mt-3 mb-1">
                        <h4 class="text-uppercase">Properties</h4>
                        <p>Car Details</p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12"> 
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                <i class="icon-pencil primary font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                <h3><?php echo $doors; ?></h3>
                                <span>Doors</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                <i class="icon-speech warning font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                <h3><?php echo $luggage; ?></h3>
                                <span>Luggage</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                <i class="icon-graph success font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                <h3><?php echo $price; ?> $</h3>
                                <span>Price</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </section>              
                </div>

                <p class="lead"><?php echo $content; ?></p>
                
                <div class="pt-5">
                <p>Category:  <a href="listing.php?cat_id=<?php echo $cat_id; ?>"><?php echo $carCategory; ?></a></p>
                </div>
                <?php } ?>
                <!-- car detail end -->


                <div class="pt-5">
                    <!-- comment list start -->
                    <h3 class="mb-5">6 Comments</h3>
                    <ul class="comment-list">
                        <li class="comment">
                        <div class="vcard bio">
                            <img src="images/person_2.jpg" alt="Free Website Template by Free-Template.co">
                        </div>
                        <div class="comment-body">
                            <h3>Jacob Smith</h3>
                            <div class="meta">January 9, 2018 at 2:21pm</div>
                            <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                            <p><a href="#" class="reply">Reply</a></p>
                        </div>
                        </li>

                        <li class="comment">
                        <div class="vcard bio">
                            <img src="images/person_3.jpg" alt="Free Website Template by Free-Template.co">
                        </div>
                        <div class="comment-body">
                            <h3>Chris Meyer</h3>
                            <div class="meta">January 9, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                            <p><a href="#" class="reply">Reply</a></p>
                        </div>

                        <ul class="children">
                            <li class="comment">
                            <div class="vcard bio">
                                <img src="images/person_5.jpg" alt="Free Website Template by Free-Template.co">
                            </div>
                            <div class="comment-body">
                                <h3>Chintan Patel</h3>
                                <div class="meta">January 9, 2018 at 2:21pm</div>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                <p><a href="#" class="reply">Reply</a></p>
                            </div>


                            <ul class="children">
                                <li class="comment">
                                <div class="vcard bio">
                                    <img src="images/person_1.jpg" alt="Free Website Template by Free-Template.co">
                                </div>
                                <div class="comment-body">
                                    <h3>Jean Doe</h3>
                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                                    <p><a href="#" class="reply">Reply</a></p>
                                </div>

                                    <ul class="children">
                                    <li class="comment">
                                        <div class="vcard bio">
                                        <img src="images/person_4.jpg" alt="Free Website Template by Free-Template.co">
                                        </div>
                                        <div class="comment-body">
                                        <h3>Ben Afflick</h3>
                                        <div class="meta">January 9, 2018 at 2:21pm</div>
                                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                        <p><a href="#" class="reply">Reply</a></p>
                                        </div>
                                    </li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                        </ul>
                        </li>

                        <li class="comment">
                        <div class="vcard bio">
                            <img src="images/person_1.jpg" alt="Free Website Template by Free-Template.co">
                        </div>
                        <div class="comment-body">
                            <h3>Jean Doe</h3>
                            <div class="meta">January 9, 2018 at 2:21pm</div>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                            <p><a href="#" class="reply">Reply</a></p>
                        </div>
                        </li>
                    </ul>
                    <!-- comment list end -->
                
                    <!-- leave comment section start -->
                    <div class="comment-form-wrap pt-5">
                        <h3 class="mb-5">Leave a comment</h3>
                        <form action="#" class="">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website">
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn btn-primary btn-md text-white">
                            </div>
                        </form>
                    </div>
                    <!-- leave comment section end -->
                </div>

            </div>
            <div class="col-md-4 sidebar">

                <!-- search section start -->
                <div class="sidebar-box">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="icon fa fa-search"></span>
                            <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                        </div>
                    </form>
                </div>
                <!-- search section end -->

                <!-- categories section start -->
                <div class="sidebar-box">
                    <div class="categories">
                        <h3>Categories</h3>
                        <?php foreach($stmt_categories2->fetchAll() as $row){
                            $cat_id=$row["id"];
                            $category=$row["category"];
                            $num=$row["num"];
                        ?>
                        <li><a href="listing.php?cat_id=<?php echo $cat_id; ?>"><?php echo $category; ?><span><?php echo $num; ?></span></a></li>
                        <?php } ?>
                    </div>
                </div>
                <!-- categories section end -->

                <!-- author section start -->
                <div class="sidebar-box">
                    <img src="images/person_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-4 w-50 rounded-circle">
                    <h3 class="text-black">About The Author</h3>
                    <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                    <p><a href="#" class="btn btn-primary btn-md text-white">Read More</a></p>
                </div>
                <!-- author section end -->

                <!-- paragraph section start -->
                <div class="sidebar-box">
                    <h3 class="text-black">Paragraph</h3>
                    <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                </div>
                <!-- paragraph section end -->
            </div>
            </div>
        </div>
        </div>

        
        <!-- footer start -->
        <?php include_once("includes/footer.php"); ?>
        <!-- footer end -->

        </div>

        <!-- links -->
        <?php include_once("includes/links.php"); ?>

    </body>

</html>

