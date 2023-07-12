<?php
require 'connection.php';
if(!empty($_SESSION["id"])){
  header("Location: sub-appointment.php");
}
if(isset($_POST["submit"])){
  $admnum = $_POST["admnum"];
  $password = $_POST["password"];
  $result = mysqli_query($con, "SELECT * FROM admin_user WHERE admnum = '$admnum'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: sub-appointment.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
if(!empty($_SESSION["id"])){
  header("Location: sub-appointment.php");
}
if(isset($_POST["admsubmit"])){
  $name = $_POST["name"];
  $admnum = $_POST["admnum"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($con, "SELECT * FROM admin_user WHERE admnum = '$admnum'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Student Number or Email Has Already Taken'); </script>";
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO admin_user VALUES('','$name','$admnum','$email','$password')";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/images/favicon.ico"/>
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/CSS/ADMIN/adminlogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
  </head>
  <body>

    <!-- ADMIN LOGIN -->
    <section>
      <header>
        <div class="main">
        <img src="assets/images/LOGO.png" >
          <h2>Admin Login</h2>
          <form class="admins" action="" method="post" autocomplete="off">
            <label for="admnum">Admin Number : </label>
            <input type="text" name="admnum" id = "admnum" required value=""> <br>
            <label for="password">Password : </label>
            <input type="password" name="password" id = "password" required value=""> <br>
            <button type="submit" name="submit" class="adm bg-primary text-white">Login</button>
          </form>
          <br>
          <a href="#" data-bs-toggle="modal" data-bs-target="#adminModal" class="admi">Registration</a>
        </div>
     </header>
    </section>

    <!-- The Modal -->
    <div class="modal" id="adminModal">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
        <div class="modal-content">
              
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Registration</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          
          <!-- Modal body -->
          <div class="container">
            <div class="form-signup">
              <form class="" action="" method="post" autocomplete="off">
                <div class="form-group pt-3">
                  <input type="text" name="name" id = "name" required value="" class="form-control" placeholder="Name">
                </div> 
                <div class="form-group pt-3">
                  <input type="text" name="admnum" id = "admnum" required value="" class="form-control" placeholder="Admin Number">
                </div> 
                <div class="form-group pt-3">
                  <input type="email" name="email" id = "email" required value="" class="form-control" placeholder="Email">
                </div> 
                <div class="form-group pt-3">
                  <input type="password" name="password" id = "password" required value="" class="form-control" placeholder="Password">
                </div> 
                <div class="form-group pt-3">
                  <input type="password" name="confirmpassword" id = "confirmpassword" required value="" class="form-control" placeholder="Confirm Password">
                </div> 
                <div class="form-group pt-3">
                  <button type="submit" class="form-control bg-danger text-white" name="admsubmit" class="button">Register</button>
                </div>
                <div class="form-group pt-4 text-center fs-5 text-uppercase">
                  <a href="adminlogin.php">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  
</body>
</html>