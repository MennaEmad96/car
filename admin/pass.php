<?php
    include 'session.php';
    $db = new mysqli('localhost', 'root', '', 'alumni');
    if(isset($_POST['submit'])){
        extract($_POST);
        //data from form --> userName, old pass, new pass and cofirm new pass
        $user_check=$_SESSION['login_user'];
        $old_pwd=$_POST['old_password'];
        $pwd=$_POST['password'];
        $c_pwd=$_POST['confirm_pwd'];
        //new pass hash
        $new_pw = password_hash($c_pwd, PASSWORD_DEFAULT);
        //all data entered
        if($old_pwd!="" && $pwd!="" && $c_pwd!=""){
            //new pass == confirm new pass
            if($pwd == $c_pwd){
                //password changed through confirmation
                if($pwd!=$old_pwd){

                    $sql = "SELECT * FROM `users` WHERE `userName`=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$userName]);
                    $result = $stmt->fetch();
			        $password=$result["password"];
                    if(password_verify($old_pwd,$password)){
                        $sql = "UPDATE `users` SET `name`=?,`userName`=?,`email`=?,`active`=? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$name, $userName, $email, $active, $id]);
                        $old_pwd='';
                        $pwd ='';
                        $c_pwd = '';
                        $msg_sucess = "Password successfully updated!";
                    }

                    /*$sql=("SELECT * FROM alumni WHERE username='$user_check'");
                    $db_check=$db->query($sql);
                    if(password_verify($old_pwd,$db_check->fetch_assoc()['password'])){
                        $fetch=$db->query("UPDATE `alumni` SET `password` = '$new_pw' WHERE username`='$user_check'");
                        $old_pwd='';
                        $pwd ='';
                        $c_pwd = '';
                        $msg_sucess = "Password successfully updated!";
                    }*/
                    
                    else{
                        $error = "Old password is incorrect. Please try again.";
                    }
                }else{
                    $error = "Old password and new password are the same. Please try again.";
                }
            }else{
                $error = "New password and confirm password do not match.";
            }
        }else{
            $error = "Please fill all the fields";
        }
    }
?> 