<?php

include_once 'connection.php';
$id=$_GET['updateid'];
$sql = "SELECT * FROM test1 WHERE id=$id";
$result = mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
$email=$row['email'];
$mobile=$row['mobile'];
$password=$row['password'];
$status=$row['status'];
$remarks=$row['remarks'];

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $status = $_POST['status'];
  $remarks = $_POST['remarks'];

  $sql = "UPDATE test1 set id=$id, name='$name', email='$email', mobile='$mobile', password='$password', status='$status', remarks='$remarks' WHERE id=$id";
  $result=mysqli_query($con, $sql);
  if($result)
  {
    //echo "Updated!";
    header('location:display.php');
  }
  else {
    echo mysqli_error($con);
    exit;
  }
}

 ?>


 <!doctype html>
 <html lang="en">
   <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="css/style.css">
     <title>Hello, world!</title>
   </head>
   <body>

     <div class="container" id="center">
       <div class="row">
         <div class="col-sm-4"></div>
         <div class="col-sm-4">
             <form method="post">
               <div class="form-group">
                 <label for="exampleInputEmail1">Name</label>
                 <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="<?php echo $name; ?>">
               </div>
               <div class="form-group">
                 <label for="exampleInputEmail1">Email</label>
                 <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="<?php echo $email; ?>">
               </div>
               <div class="form-group">
                 <label for="exampleInputEmail1">Mobile</label>
                 <input type="text" class="form-control" name="mobile" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="<?php echo $mobile; ?>">
               </div>
               <div class="form-group">
                 <label for="exampleInputEmail1">Password</label>
                 <input type="text" class="form-control" name="password" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name"value="<?php echo $password; ?>">
               </div>
               <div class="form-group">
                 <label for="exampleInputEmail1">Status</label>
                 <select name="status">
                      <option selected>Status</option>
                      <option value="Approved">Approved</option>
                      <option value="Rejected">Rejected</option>
                    </select>
               </div>
               <div class="form-group">
                 <label for="exampleInputEmail1">Remarks</label>
                 <label for="exampleFormControlTextarea1">Enter Message</label>
                <textarea class="form-control" name="remarks" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
               <button type="submit" name="submit" class="btn btn-primary">Update</button>
             </form>
         </div>
         <div class="col-sm-4"></div>
       </div>
     </div>

     <!-- Optional JavaScript; choose one of the two! -->

     <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

     <!-- Option 2: Separate Popper and Bootstrap JS -->
     <!--
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
     -->
   </body>
 </html>
