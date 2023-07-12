<?php
session_start();
require 'connection.php';
$email = "";
$name = "";
$errors = array();

if(isset($_POST['submit']))
{
  $user_id = $_SESSION['id'];
  $Purpose = $_POST['purpose'];
  $chk=""; 

  foreach($Purpose as $chk1)  
   {  
      $chk .= $chk1.",";  
   }  
$in_ch=mysqli_query($con,"INSERT INTO appointment (user_id, Purpose) VALUES ('$user_id', '$chk')");  
if($in_ch==1)  
   {  
    $_SESSION['message'] = "Reservation inserted";
    header("Location: appoint.php");
    exit(0); 
   }  
else  
   {  
    $_SESSION['message'] = "Not Inserted";
    header("Location: appoint.php");
    exit(0);
   }  
}
?>
