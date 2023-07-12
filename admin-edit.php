<?php
session_start();
require 'connection.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="assets/CSS/ADMIN/admin-edit.css">
    <!-- BOXICON -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>

  <!-- SIDEBAR -->
  <section id="sidebar" class="side-menu">
    <div class="menu">
      <a href="dashboard.php"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
      <a href="sub-appointment.php"><span class="material-symbols-outlined">edit_calendar</span>Appointment</a>
      <a href="student-user.php"><span class="material-symbols-outlined">group</span>Users</a>
      <a href="administrator.php" class="active"><span class="material-symbols-outlined">admin_panel_settings</span>​Admin</a>
      <a href="reports.php"><span class="material-symbols-outlined">monitoring</span>Reports</a>
      <a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>
    </div>
  </section>
  <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
      <!-- NAVBAR -->
      <nav>
        <i class="bx bx-menu"></i>
        <img src="assets/images/LOGO.png" alt="">
        <a href="#" class="nav-link">Colegio De Santo Cristo De Burgos</a>
      </nav>

      <!-- ADMIN EDIT -->
      <main class="d-flex justify-content-center">
        <div class="container mt-5">
          <div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header">
                  <h4>Administrator Edit<a href="administrator.php" class="btn btn-danger float-end">BACK</a></h4>
                </div>
                <div class="card-body">
                  <?php
                  if(isset($_GET['id'])){

                    $student_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM admin_user WHERE id='$student_id' ";
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
                          <input type="text" name="admnum" value="<?=$student['admnum'];?>" class="form-control">
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
                          <button type="submit" name="update_admin" class="btn btn-primary">Update</button>
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
      </main>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>