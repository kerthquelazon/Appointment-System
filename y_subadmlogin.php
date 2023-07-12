<?php
session_start();
require 'connection.php';
if(!empty($_SESSION["id"])){
  header("Location: sub-appointment.php");
}
// FUNCTIONAL LOGIN OF ADMIN
if(isset($_POST["submit"])){
  $admnum = $_POST["admnum"];
  $password = $_POST["password"];
    // Call the login function
  if (login($admnum, $password)) {
      // Redirect to the dashboard or any other protected page
      header("Location: sub-appointment.php");
      exit();
  } else {
      // Authentication failed
      echo
    "<script> alert('User Not Registered'); </script>";
  }
}
// Function to authenticate the user
function login($admnum, $password) {
  require 'connection.php';
  // Perform your authentication logic here
    $result = mysqli_query($con, "SELECT * FROM admin_user WHERE admnum = '$admnum'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
      if($password === $row['password']){
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        return true;
      }
      else{
        return false;
        echo
        "<script> alert('Wrong Password'); </script>";
      }
    }
  }
if(isset($_POST["admsubmit"])){
  $name = $_POST["name"];
  $admnum = $_POST["admnum"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $masterpassword = $_POST["masterpassword"];
  $duplicate = mysqli_query($con, "SELECT * FROM admin_user WHERE admnum = '$admnum'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Student Number or Email Has Already Taken'); </script>";
  }
  else{
    if($masterpassword == "@CDSCDB2023"){
      $query = "INSERT INTO admin_user VALUES('','$name','$admnum','$email','$password')";
      mysqli_query($con, $query);
      echo
      "<script> alert('Registration Successful'); </script>";
    }
    else{
      echo
      "<script> alert('Master Password that you provided is wrong.'); </script>";
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
    <title>Admin Login</title>
    <link rel="icon" href="/assets/images/favicon.ico"/>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/CSS/sub-admlogin.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  </head>
  <body>

    <!-- ADMIN LOGIN -->
        <section>
          <div class="stu">
            <img src="assets/images/LOGO.png" alt="" srcset="">
            <h1>Admin Login</h1>
            <form class="stud" action="" method="post" autocomplete="off">
              <div class="shesh">
                <label for="admnum">Admin Number</label>
                <input type="text" name="admnum" id = "admnum" required value="">
              </div>
              <div class="shesh">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required value="">
              </div>
              <div class="shesh">
                <input class="button" type="submit" name="submit" value="login">
              </div>
            </form>
            <a href="#" data-bs-toggle="modal" data-bs-target="#myModal">Register Now!</a>
          </div>
        </section>

    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down">
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
                  <input type="password" name="masterpassword" id = "masterpassword" required value="" class="form-control" placeholder="Master Password">
                </div> 
                <div class="form-group pt-3">
                    <div class="pt-3">
                      <h2 class="enrollment-form-section-header">Data Privacy Compliance</h2>
                      <p class="text-sm">I hereby certify that foregoing statements are true and correct. Any misinformation or withholding of information will automatically disqualify me from my registration in the institution. I am willing to obey and abide the policies on refund and penalty being implemented by the institution. I hereby express my consent for the Colegio de Sto. Cristo de Burgos, Corporation to collect, record, organize, update or modify, retrieve, consult, use consolidate, block, erase or destruct my personal data as part of my information. I hereby affirm my right to be informed, object to processing, access and rectify, suspend or withdraw my personal data and be indemnified in case of damages pursuant to the provisions of the Republic Act No. 10173 of Philippines, Data Privacy Act of 2012 and its corresponding Implementing Rules and Regulations.<span style="color: red;">*</span></p>

                      <div class="my-4 mr-2 pr-2 italic"><input type="checkbox" id="dataprivacy" class="mr-2">
                      <label for="dataprivacy" class="text-gray-500" style="margin-left: 11px; color: red;">I have read and fully understand the contents of this document. I agree to the terms and conditions stated above.</label>
                      </div>
                </div>
                  <button type="submit" class="form-control bg-success text-white" name="admsubmit" class="button" id="register" disabled>Register</button>
                </div>
                <div class="form-group pt-4 text-center fs-5 text-uppercase">
                  <a href="#" data-bs-dismiss="modal">Login Now!</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataprivacy').change(function () {
                    if ($(this).is(':checked')) {
                        $('#register').prop('disabled', false);
                    } else {
                        $('#register').prop('disabled', true);
                    }
                });
            });
    </script>
  </body>
</html>