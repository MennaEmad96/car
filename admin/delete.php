<?php
    include_once("includes/conn.php");
    include_once("includes/logged.php");
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        try{
            if($_SESSION["table"] == "categories"){
                $sql="SELECT `category_id` FROM `cars` INNER JOIN `categories` ON `cars`.`category_id` = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                $count = $stmt->rowCount();
                if($count){
                    //category is used by other cars and can't be deleted
                    session_start();
                    $_SESSION['user'] = "batman";
                    $_SESSION['message'] = "Category can't be deleted. It's being used by cars";
                    $_SESSION['alert'] = "alert-info";
                    header("Location:".$_SESSION["page"]);
                    die();
                }else{
                    //category is not used by other cars and can be deleted
                    $sql = "DELETE FROM `".$_SESSION["table"]."` WHERE id = ?";
                }
            }else{
                //general delete statement
                $sql = "DELETE FROM `".$_SESSION["table"]."` WHERE id = ?";
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            //confirmation deletint alert in testimonials page
            $alert = "alert-success";
			$message = "Data Deleted Successfully.";
			//send variables through header to other pages using session
			session_start();
    		$_SESSION['user'] = "batman";
			$_SESSION['message'] = $message;
			$_SESSION['alert'] = $alert;
    		header("Location:".$_SESSION["page"]);
			die();
        }catch(PDOException $e){
            echo "Connection failed:  ".$e->getMessage();
        }
        
    }else{
        echo "Invalid Access";
    }
?>