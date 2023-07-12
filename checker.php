<?php
 $ses_id =  $_SESSION['id'];
 if(!isset($ses_id)){
  header("Location: logout.php");
 }
?>