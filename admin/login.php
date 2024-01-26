<?php
    //check logging
    session_start();  
    if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
        header("Location: cars.php");
        die();
    }
    $fullNameVal="";
    $userNameVal="";
    $emailVal="";
    $passwordVal="";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        include_once("includes/conn.php");
        //start register
        if(isset($_POST["register"])){
            //maintain the value sent by the form
            $fullNameVal=$_POST["fullName"];
            $userNameVal=$_POST["userName"];
            $emailVal=$_POST["email"];
            $passwordVal=$_POST["password"];
            //if null values found don't proceed to database
            if(!($fullNameVal) || !($userNameVal) || !($passwordVal) || !($emailVal)){
                $alert = "alert-info";
                $message = "All Fields Are Required";
            }
            //all values are sent
            else{
                $name = $_POST["fullName"];
                $userName = $_POST["userName"];
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $email = $_POST["email"];
                try{
                    $sql = "INSERT INTO `users`(`name`, `userName`, `email`, `password`) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$name, $userName, $email, $password]);
                    //action=login.php-->
                    //preferring this way to check from several steps before moving to login page
                    header("Location: login.php#signin");
                    die();
                }catch(PDOException $e){
                    $alert = "alert-danger";
                    $message = $e->getMessage();
                    //echo "Connection failed:  ".$e->getMessage();
                }
            }
        }
        //end register

        //start login
        elseif(isset($_POST["login"])){
            //maintain the value sent by the form
            $userNameVal=$_POST["userName"];
            $passwordVal=$_POST["password"];
            //if null values found don't proceed to database
            if(!($userNameVal) || !($passwordVal)){
                $alert = "alert-info";
                $message = "All Fields Are Required";
            }else{
                $password = $_POST["password"];
                $userName = $_POST["userName"];
                try{
                    $sql = "SELECT `password`,`name` FROM `users` WHERE `userName` = ? and active = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$userName]);
                    if($stmt->rowCount() > 0){
                        $result = $stmt->fetch();
                        $hash = $result["password"];
                        $name = $result["name"];
                        $verify = password_verify($password, $hash);
                        if($verify){
                        $_SESSION["logged"] = true;
                        $_SESSION["name"] = $name;
                        //open into same page before logging
                            if(isset($_SESSION["page"])){
                                $page=$_SESSION["page"];
                            }else{
                                $page="users.php";
                            }
                            header("Location: ".$page);
                            die();
                        }else{
                            $alert = "alert-warning";
                            $message = "Password is incorrect.";
                            //echo "Password is incorrect.";
                        }
                    }else{
                        $alert = "alert-danger";
                        $message = "Not Found.";
                        //echo "Not Found.";
                    }  
                }catch(PDOException $e){
                    $alert = "alert-danger";
                    $message = $e->getMessage();
                    //echo "Connection failed:  ".$e->getMessage();
                }
            }
        }
        //end login
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rent Car Admin | Login/Register</title>

        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">

        <!-- activate close alert button -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script>
            function validateForm(){
                var x = document.forms["register"]["fullName"].value;
                if (x == "" || x == null){
                    alert("Name must be filled out");
                    return false;
                }
            }
        </script>
    </head>

    <body class="login">
        <!-- alert section -->
        <?php include_once("includes/alert.php"); ?>

        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
            <section class="login_content">
                <form action="" method="POST" name="login">
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="userName" required="" value="<?php echo $userNameVal; ?>"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="" value="<?php echo $passwordVal; ?>"/>
                    </div>
                    <div>
                        <input type="hidden" name="login" value="login">
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="#" onclick="document.forms['login'].submit();">Log in</a>
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                        <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                        <h1><i class="fa fa-car"></i></i> Rent Car Admin</h1>
                        <p>©2016 All Rights Reserved. Rent Car Admin is a Bootstrap 4 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
            </div>

            <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form action="" method="POST" name="register" onsubmit="return validateForm()" required >
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Fullname" name="fullName" required="" value="<?php echo $fullNameVal; ?>" />
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="userName" required="" value="<?php echo $userNameVal; ?>"/>
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" name="email" required="" value="<?php echo $emailVal; ?>" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="" value="<?php echo $passwordVal; ?>"/>
                    </div>
                    <div>
                        <input type="hidden" name="register" value="register">
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="#" onclick="document.forms['register'].submit();">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                        <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                        <h1><i class="fa fa-car"></i></i> Rent Car Admin</h1>
                        <p>©2016 All Rights Reserved. Rent Car Admin is a Bootstrap 4 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
            </div>
        </div>
        </div>
    </body>
</html>
