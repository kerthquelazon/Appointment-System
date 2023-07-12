<?php


$con = mysqli_connect('localhost', 'root', '123456789', 'mysystem');

if($con)
{
   echo "";
}
else {
  echo mysqli_error($con);
}



 ?>
