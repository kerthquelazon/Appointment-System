<?php
session_start();
require 'connection.php';
require 'checker.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
    <link rel="icon" href="/assets/images/favicon.ico"/>
  <link rel="stylesheet" href="assets/CSS/ADMIN/dashboard.css">
  <!-- BOXICON -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="./assets/CSS/datatables.min.css" rel="stylesheet">
</head>
<body>

  <!-- SIDEBAR -->
  <section id="sidebar" class="side-menu">
    <div class="menu">
      <a href="dashboard.php" class="active"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
      <a href="sub-appointment.php"><span class="material-symbols-outlined">edit_calendar</span>Appointment</a>
      <a href="student-user.php"><span class="material-symbols-outlined">group</span>Users</a>
      <a href="administrator.php"><span class="material-symbols-outlined">admin_panel_settings</span>​Admin</a>
      <a href="reports.php"><span class="material-symbols-outlined">monitoring</span>Reports</a>
      <a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>
    </div>
  </section>
  
  <!-- CONTENT -->
  <section id="content">
    <!-- navbar -->
    <nav>
      <i class="bx bx-menu"></i>
      <img src="assets/images/LOGO.png" alt="">
      <a href="#" class="nav-link">Colegio De Santo Cristo De Burgos</a>
    </nav>

    <!-- MAIN -->
    <main>
      <h3 class="mt-4 ms-3">Dashboard</h3>
      <div class="container-fluid px-4">
        <h5 class="text-muted fs-8">Users & Appointments</h5>
        <div class="row">
          <div class="col-xl-2 col-md-6 hover">
            <div class="card bg-primary text-white mb-4">
              <div class="card-body">Total Appointments
                <?php 
                  $dash_appoint_query = "SELECT * FROM appointment";
                  $dash_appoint_query_run = mysqli_query($con, $dash_appoint_query);

                  if($appoint_total = mysqli_num_rows($dash_appoint_query_run)){
                    echo '<h4 class="mb-0"> '.$appoint_total.'</h4>';
                  }else{
                    echo '<h4 class="mb-0"> No Data </h4>';
                  }
                ?>
              </div>
              <div class="card-footer d-flex align-items justify-content-between">
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-md-6 hover">
            <div class="card bg-success text-white mb-4">
              <div class="card-body">Total Users
                <?php 
                  $dash_users_query = "SELECT * FROM tb_user";
                  $dash_users_query_run = mysqli_query($con, $dash_users_query);

                  if($users_total = mysqli_num_rows($dash_users_query_run)){
                    echo '<h4 class="mb-0"> '.$users_total.'</h4>';
                  }else{
                    echo '<h4 class="mb-0"> No Data </h4>';
                  }
                ?>
                </div>
              <div class="card-footer d-flex align-items justify-content-between">
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid appointment-list px-4 mt-3">
        <h5 class="text-muted">Types of Appointment</h5>
        <div class="row">
          <div class="col-xl-2 col-md-6 hover ">
            <div class="card bg-success text-white mb-4">
              <div class="card-body">Total Pending
              <?php 
                  $dash_appoint_query = "SELECT * FROM appointment WHERE status = 'Pending'";
                  $dash_appoint_query_run = mysqli_query($con, $dash_appoint_query);

                  if($appoint_total = mysqli_num_rows($dash_appoint_query_run)){
                    echo '<h4 class="mb-0"> '.$appoint_total.'</h4>';
                  }else{
                    echo '<h4 class="mb-0"> No Data </h4>';
                  }
                ?>
              </div>
              <div class="card-footer d-flex align-items justify-content-between">
                <a href="#" class="small text-white stretched-link">VIew Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-md-6 hover">
            <div class="card bg-danger text-white mb-4">
              <div class="card-body">Total Accepted
              <?php 
                  $dash_appoint_query = "SELECT * FROM appointment WHERE status = 'Accepted'";
                  $dash_appoint_query_run = mysqli_query($con, $dash_appoint_query);

                  if($appoint_total = mysqli_num_rows($dash_appoint_query_run)){
                    echo '<h4 class="mb-0"> '.$appoint_total.'</h4>';
                  }else{
                    echo '<h4 class="mb-0"> No Data </h4>';
                  }
                ?>
              </div>
              <div class="card-footer d-flex align-items justify-content-between">
                <a href="#" class="small text-white stretched-link">VIew Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-md-6 hover">
            <div class="card bg-info text-white mb-4">
              <div class="card-body">Total Declined
              <?php 
                  $dash_appoint_query = "SELECT * FROM appointment WHERE status = 'Declined'";
                  $dash_appoint_query_run = mysqli_query($con, $dash_appoint_query);

                  if($appoint_total = mysqli_num_rows($dash_appoint_query_run)){
                    echo '<h4 class="mb-0"> '.$appoint_total.'</h4>';
                  }else{
                    echo '<h4 class="mb-0"> No Data </h4>';
                  }
                ?>
              </div>
              <div class="card-footer d-flex align-items justify-content-between">
                <a href="#" class="small text-white stretched-link">VIew Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-md-6">
            <div class="card bg-warning text-white mb-4">
              <div class="card-body">Total Waiting
              <?php 
                  $dash_appoint_query = "SELECT * FROM appointment WHERE status = 'Waiting'";
                  $dash_appoint_query_run = mysqli_query($con, $dash_appoint_query);

                  if($appoint_total = mysqli_num_rows($dash_appoint_query_run)){
                    echo '<h4 class="mb-0"> '.$appoint_total.'</h4>';
                  }else{
                    echo '<h4 class="mb-0"> No Data </h4>';
                  }
                ?>
              </div>
              <div class="card-footer d-flex align-items justify-content-between">
                <a href="#" class="small text-white stretched-link">VIew Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>

  </section>

  <!-- SCRIPT -->
  <script src="assets/js/jquery-3.5.1.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/datatables.min.js"></script>
</body>
</html>