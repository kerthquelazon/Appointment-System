<?php
session_start();
require 'connection.php';
require 'checker.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Edit</title>
    <!-- BOXICON -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>

  <!-- STUDENT EDIT -->
  <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Student Edit<a href="student-user.php" class="btn btn-danger float-end">BACK</a></h4>
              </div>
              <div class="card-body">
                <?php
                if(isset($_GET['id'])){

                  $student_id = mysqli_real_escape_string($con, $_GET['id']);
                  $query = "SELECT * FROM tb_user WHERE id='$student_id' ";
                  $query_run = mysqli_query($con, $query);

                  if(mysqli_num_rows($query_run) > 0){
                    $student = mysqli_fetch_array($query_run);
                    ?>
                    <form action="code.php" method="POST">
                      <input type="hidden" name="student_id" value="<?= $student['id'] ?> ">
                      <div class="mb-3">
                        <label>Student Name</label>
                        <input type="text" name="name" value="<?=$student['name'];?>" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Student No.</label>
                        <input type="text" name="stdnum" value="<?=$student['stdnum'];?>" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Email</label>
                        <input type="text" name="email" value="<?=$student['email'];?>" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>password</label>
                        <input type="text" name="password" value="<?=$student['password'];?>" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" id="inputGroupSelect02">
                          <option selected><?=$student['status'];?></option>
                          <option value="verified">Verified</option>
                          <option value="unverified">Unverified</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <button type="submit" name="update_student" class="btn btn-primary">Update Student</button>
                      </div>

                    </form>
                    <?php
                  }else{
                    echo "<h4>No Such Id Found</h4>";
                  }
                }
                ?>

              </div>
            </div>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  
</body>
</html>