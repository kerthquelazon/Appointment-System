<?php
session_start();
require 'connection.php';
if(!empty($_SESSION["id"])){
  header("Location: appoint.php");
}

// Function to authenticate the user
function login($stdnum, $password) {
require 'connection.php';
// Perform your authentication logic here
  $result = mysqli_query($con, "SELECT * FROM tb_user WHERE stdnum = '$stdnum'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($row['status']==="unverified"){
      echo
      "<script> alert('You are not yet verified, please follow up your registration in the registrars office.'); </script>";
      return false;
    }
    if($password === $row['password']){
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['course'] = $row['Course'];
      $_SESSION['year'] = $row['Year'];
      return true;
    }
    else{
      return false;
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
}

// FUNCTIONAL LOGIN OF STUDENT
if(isset($_POST["submit"])){
  $stdnum = $_POST["stdnum"];
  $password = $_POST["password"];
    // Call the login function
  if (login($stdnum, $password)) {
      // Redirect to the dashboard or any other protected page
      header("Location: appoint.php");
      exit();
  } else {
      // Authentication failed
      echo
    "<script> alert('User Not Registered'); </script>";
  }
}

// FUNCTIONAL REGISTRATION OF STUDENT
// if(!empty($_SESSION["id"])){
//   header("Location: appoint.php");
// }
if(isset($_POST["resubmit"])){
  $name = $_POST["name"];
  $stdnum = $_POST["stdnum"];
  $email = $_POST["email"];
  $phone_number = $_POST["phone_number"];
  $course = $_POST["course"];
  $year = $_POST["year"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($con, "SELECT * FROM tb_user WHERE stdnum = '$stdnum'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Student Number or Email Has Already Taken'); </script>";
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO tb_user(stdnum,name,email,phone_number,year,course,password,status) VALUES('$stdnum','$name','$email','$phone_number','$year','$course','$password','unverified')";
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
    <title>Student Login</title>
    <link rel="stylesheet" href="assets/CSS/stdlogin.css">
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    
    
    <!-- LOGIN FORM -->
    <section>
      <div class="stu">
        <img src="assets/images/LOGO.png" alt="" srcset="">
        <h1>Student Login</h1>
        <form class="stud" action="" method="post" autocomplete="off">
          <div class="shesh">
            <label for="stdnum">Student Number</label>
            <input type="text" name="stdnum" id = "stdnum" required value="">
          </div>
          <div class="shesh">
            <label for="password">Password</label>
            <input type="password" name="password" id = "password" required value="">
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
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <form class="" action="" method="post" autocomplete="off">
                  <div class="form-group pt-3">
                    <input type="text" class="form-control" name="name" id = "name" required value="" placeholder="Name">
                  </div> 
                  <div class="form-group pt-3">
                    <input type="text" class="form-control" name="stdnum" id = "stnum" required value="" placeholder="Student No.">
                  </div> 
                  <div class="form-group pt-3">
                    <input type="email" class="form-control" name="email" id = "email" required value="" placeholder="Email">
                  </div>
                  <div class="form-group pt-3">
                    <input type="text" class="form-control" name="phone_number" id = "phone_number" required value="" placeholder="Phone Number" maxlength="11">
                  </div>
                  <div class="form-group pt-3">
                  <select name="year" class="form-control" id="inputGroupSelect02">
                          <option value="Grade 11 Senior-High"selected>Grade 11 Senior-High</option>
                          <option value="Grade 12 Senior-High">Grade 12 Senior-High</option>
                          <option value="1st Year">1st Year </option>
                          <option value="2nd Year">2nd Year</option>
                          <option value="3rd Year">3rd Year</option>
                          <option value="4th Year">4th Year</option>
                          <option value="Alumni">Alumni</option>
                  </select>
                </div>
                  <div class="form-group pt-3">
                  <select name="course" class="form-control" id="inputGroupSelect02">
                          <option value="Accountancy and Business Management"selected>Accountancy and Business Management</option>
                          <option value="General Academics">General Academics</option>
                          <option value="Home Economics">Home Economics</option>
                          <option value="Humanities and Social Sciences">Humanities and Social Sciences</option>
                          <option value="Information and Communication Technology">Information and Communication Technology</option>
                          <option value="Science, Technology, Engineering and Mathematics">Science, Technology, Engineering and Mathematics</option>
                          <option value="B.S. Business Administration">B.S. Business Administration</option>
                          <option value="B.S. Computer Science">B.S. Computer Science</option>
                          <option value="B.S. Hospitality Management">B.S. Hospitality Management</option>
                          <option value="B.S. Information Technology">B.S. Information Technology</option>
                          <option value="B.S. Psychology">B.S. Psychology</option>
                          <option value="B.S. Tourism Management">B.S. Tourism Management</option>
                  </select>
                  </div>
                  <div class="form-group pt-3">
                    <input type="password" class="form-control" name="password" id = "password" required value="" placeholder="Password">
                  </div> 
                  <div class="form-group pt-3">
                    <input type="password" class="form-control" name="confirmpassword" id = "confirmpassword" required value="" placeholder="Confirm Password">
                  </div>
                  <div class="pt-3">
                      <h2 class="enrollment-form-section-header">Data Privacy Compliance</h2>
                      <p class="text-sm">I hereby certify that foregoing statements are true and correct. Any misinformation or withholding of information will automatically disqualify me from my registration in the institution. I am willing to obey and abide the policies on refund and penalty being implemented by the institution. I hereby express my consent for the Colegio de Sto. Cristo de Burgos, Corporation to collect, record, organize, update or modify, retrieve, consult, use consolidate, block, erase or destruct my personal data as part of my information. I hereby affirm my right to be informed, object to processing, access and rectify, suspend or withdraw my personal data and be indemnified in case of damages pursuant to the provisions of the Republic Act No. 10173 of Philippines, Data Privacy Act of 2012 and its corresponding Implementing Rules and Regulations.<span tyle="color: red;">*</span></p>

                      <div class="my-4 mr-2 pr-2 italic"><input type="checkbox" id="dataprivacy" class="mr-2">
                      <label for="dataprivacy" class="text-gray-500" style="margin-left: 11px; color: red;">I have read and fully understand the contents of this document. I agree to the terms and conditions stated above.</label>
                      </div>
                  </div>
                  <div class="form-group pt-3">
                    <button type="submit" class="form-control bg-success text-white" name="resubmit" id="register" disabled>Register</button>
                  </div>
                  <div class="form-group text-center pt-4 fs-5 text-uppercase">
                    <a href="stdlogin.php">Login Now!</a>
                  </div>
                </form>
              </div>
            </div>
          </div>   
        </div>
      </div>
    </div>
    <!-- The Modal -->
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