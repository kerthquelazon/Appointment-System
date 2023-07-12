<?php
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();


    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $sql = "SELECT * FROM usertable WHERE email = '$email' AND password = '$password'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) == 1){
			$row = $fetch = mysqli_fetch_assoc($res);
            if ($row['email'] == $email && $row['password'] == $password) {
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
				// alert($_SESSION['email']);
            	header("Location: appoint.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect User name or password");
                $errors['email'] = "Incorrect email or password!";
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}
	

    




?>
