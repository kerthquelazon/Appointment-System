<?php
require 'connection.php';
if(!empty($_SESSION["id"])){
  header("Location: appoint.php");
}
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $stdnum = $_POST["stdnum"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($con, "SELECT * FROM tb_user WHERE stdnum = '$stdnum'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Student Number or Email Has Already Taken'); </script>";
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO tb_user VALUES('','$name','$stdnum','$password','$email')";
      mysqli_query($con, $query);
      echo
      "<script> alert('Registration Successful'); </script>";
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="/assets/images/favicon.ico"/>
    <title>Registration</title>
    <link rel="stylesheet" href="assets/CSS/registration.css">
  </head>
  <body>
    <header>
      <div class="signup">
        <h2>Registration</h2>
        <form class="" action="" method="post" autocomplete="off">
          <div class="space">
            <label for="name">Name : </label>
            <input type="text" name="name" id = "name" required value="">
          </div> 
          <div class="space">
            <label for="stdnum">Student Number : </label>
            <input type="text" name="stdnum" id = "stnum" required value="">
          </div> 
          <div class="space">
            <label for="email">Email : </label>
            <input type="email" name="email" id = "email" required value="">
          </div> 
          <div class="space">
            <label for="password">Password : </label>
            <input type="password" name="password" id = "password" required value="">
          </div> 
          <div class="space">
            <label for="confirmpassword">Confirm Password : </label>
            <input type="password" name="confirmpassword" id = "confirmpassword" required value="">
          </div>
          <div class="space">
            <button type="submit" name="submit" class="button">Register</button>
          </div>
          <div class="space">
            <a href="stdlogin.php">Login</a>
          </div>
        </form>
      </div>
    </header>

  </body>
</html>