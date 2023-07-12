<?php
session_start();
require 'connection.php';
// STUDENT
if(isset($_POST['delete_student'])){
  $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);
  $query = "DELETE FROM tb_user WHERE id='$student_id' ";
  $query_run = mysqli_query($con, $query);

  if($query_run){
    $_SESSION['message'] = "Student Deleted Successfully";
    header("Location: student-user.php");
    exit(0);
  }else{
    $_SESSION['message'] = "Student Not Deleted";
    header("Location: student-user.php");
    exit(0);
  }
}
if(isset($_POST['update_student'])){
  $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $stdnum = mysqli_real_escape_string($con, $_POST['stdnum']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $status = mysqli_real_escape_string($con, $_POST['status']);
  
  $query = "UPDATE tb_user SET name='$name', stdnum='$stdnum', email='$email',password='$password',status='$status' WHERE id='$student_id' ";
  $query_run = mysqli_query($con, $query);
  
  if($query_run){
    $_SESSION['message'] = "Student Updated Successfully";
    header("Location: student-user.php");
    exit(0);
  }else{
    $_SESSION['message'] = "Student Not Updated Successfully";
    header("Location: student-user.php");
    exit(0);
  }
}
if(isset($_POST['save_student'])){
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $stdnum = mysqli_real_escape_string($con, $_POST['stdnum']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  
  $query = "INSERT INTO tb_user (name,stdnum,email,password	
  ) VALUES ('$name','$stdnum','$email','$password')";
  $query_run = mysqli_query($con, $query);
  if($query_run)
  {
    $_SESSION['message'] = "Student Created Successfully";
    header("Location: student-create.php");
    exit(0);
  }else{
    $_SESSION['message'] = "Student Not Created";
    header("Location: student-create.php");
    exit(0);
  }
}


// ADMIN
if(isset($_POST['delete_admin'])){
  $student_id = mysqli_real_escape_string($con, $_POST['delete_admin']);
  $query = "DELETE FROM admin_user WHERE id='$student_id' ";
  $query_run = mysqli_query($con, $query);
  
  if($query_run){
    $_SESSION['message'] = "Admin Deleted Successfully";
    header("Location: administrator.php");
    exit(0);
  }else{
    $_SESSION['message'] = "Admin Not Deleted";
    header("Location: administrator.php");
    exit(0);
  }
}
if(isset($_POST['update_admin'])){
  $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $admnum = mysqli_real_escape_string($con, $_POST['admnum']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  
  $query = "UPDATE admin_user SET name='$name', admnum='$admnum', email='$email',password='$password' WHERE id='$student_id' ";
  $query_run = mysqli_query($con, $query);
  
  if($query_run){
    $_SESSION['message'] = "Admin Updated Successfully";
    header("Location: administrator.php");
    exit(0);
  }else{
    $_SESSION['message'] = "Admin Not Updated Successfully";
    header("Location: administrator.php");
    exit(0);
  }
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
    header("Location: administrator.php");
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO admin_user VALUES('','$name','$admnum','$email','$password')";
      mysqli_query($con, $query);
      echo
      $_SESSION['message'] = "Registration Successful"; 
      header("Location: administrator.php");
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
      header("Location: administrator.php");
    }
  }
}

// APPOINTMENT
if(isset($_POST['update_appointment'])){
  $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
  $Year = mysqli_real_escape_string($con, $_POST['Year']);
  $Course = mysqli_real_escape_string($con, $_POST['Course']);
  $status = mysqli_real_escape_string($con, $_POST['status']);
  $remarks = mysqli_real_escape_string($con, $_POST['remarks']);
  $query = "UPDATE appointment SET name='$name', email='$email', phonenumber='$phonenumber', Year='$Year', Course='$Course', status='$status', remarks='$remarks' WHERE id='$student_id' ";
  $query_run = mysqli_query($con, $query);
  
  if($query_run){
    $_SESSION['message'] = "Appointment Updated Successfully";
    header("Location: sub-appointment.php");
    exit(0);
  }else{
    $_SESSION['message'] = "Appointment Not Updated Successfully";
    header("Location: sub-appointment.php");
    exit(0);
  }
}
if(isset($_POST['delete_appointment'])){
  $student_id = mysqli_real_escape_string($con, $_POST['delete_appointment']);
  $query = "DELETE FROM appointment WHERE id='$student_id' ";
  $query_run = mysqli_query($con, $query);

  if($query_run){
    $_SESSION['message'] = "Appointment Deleted Successfully";
    header("Location: sub-appointment.php");
    exit(0);
  }else{
    $_SESSION['message'] = "Appointment Not Deleted";
    header("Location: sub-appointment.php");
    exit(0);
  }
}
?>