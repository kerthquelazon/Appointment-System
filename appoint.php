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
  <title>Appointment</title>
    <link rel="icon" href="/assets/images/favicon.ico"/>
  <link rel="stylesheet" href="./assets/CSS/appoint.css">
  <!-- BOXICON -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="./assets/CSS/datatables.min.css" rel="stylesheet">
</head>
<body>
  <!-- SIDEBAR -->
  <section id="sidebar" class="side-menu">
    <div id="sessionUserDiv" class="text-center mx-auto my-auto">
      <ul class=" mx-auto my-auto">
        <li> <img src="./assets/images/account.svg" alt="img_user" style="width:40px"></li>
        <li id="session_name"></li>
        <li id="session_year"></li>
        <li id="session_course"></li>
      </ul>
    </div>
    <div class="menu">
      <a href="appoint.php" class="active"><i class="bx bxs-home"></i>Home</a>
      <!--<a href="main-setting.php"><i class="bx bxs-cog" ></i>Setting</a>-->
      <a href="logout.php"><i class="bx bx-log-out"></i>Logout</a>
    </div>
  </section>
  <!-- SIDEBAR -->

  <!-- CONTENT-->
  <section id="content" class="content-top">
    <!-- HEADER -->
    <nav>
      <i class="bx bx-menu"></i>
      <img src="./assets/images/LOGO.png" alt="">
      <a href="#" class="nav-link">Colegio De Santo Cristo De Burgos</a>
    </nav>
    <!-- HEADER -->

    <!-- APPOINTMENT FORM -->
    <main>
      <div class="container pt-5" style="margin-left:10px;">
      <?php include('message.php'); ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mymodal">Set Appointment</button>
      </div>

      <div class="modal" id="mymodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Set Appointment</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                
                <div class="container">
                  <div class="form-signup">
                    <form action="appserver.php" method="POST" autocomplete="" id="form_appointment">
                    <div class="form-group pt-3">
                        <input class="form-control disabled" type="text" name="user_id" id="user_id"  value="" style=""disabled>
                      </div>
                      <div class="form-group pt-3">
                        <input class="form-control disabled" type="text" name="name" id="fullname"  value="" disabled>
                      </div>
                      <div class="form-group pt-3">
                        <input class="form-control disabled" type="email" name="email" id="email" value="" disabled>
                      </div>
                      <div class="form-group pt-3">
                        <input class="form-control disabled" type="text" name="phonenumber" id="phonenumber" required disabled>
                      </div>
                      <div class="form-group pt-3">
                        <input class="form-control disabled" type="text" name="Year" id="Year" value="" required disabled>
                      </div>
                      <div class="form-group pt-3">
                      <input class="form-control disabled" type="text" name="Course" id="Course" value="" required disabled>

                      </div>
                      <div class="form-group pt-3">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="Filing Documents" name="purpose[]"aria-label="Checkbox for following text input">
                          <span class="input-group-text">Filing Documents</span>
                        </div>
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="Enrollment" name="purpose[]"aria-label="Checkbox for following text input">
                          <span class="input-group-text">Enrollment</span>
                        </div>
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="Evaluation" name="purpose[]"aria-label="Checkbox for following text input">
                          <span class="input-group-text">Evaluation</span>
                        </div>
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="Completion" name="purpose[]"aria-label="Checkbox for following text input">
                          <span class="input-group-text">Completion</span>
                        </div>
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="TES Claim" name="purpose[]"aria-label="Checkbox for following text input">
                          <span class="input-group-text">TES Claim</span>
                        </div>
                      </div>
                      <div class="form-group pt-3">

                        <div class="btn hidden">

                          <input class="button form-control bg-danger text-white" id="submit" type="submit" name="submit"  value="Submit">
                        </div>
                      </div
        </div>
      </main>
    <!-- APPOINTMENT FORM -->
    
    
    
   
    
    <!-- RESULT -->
    <div class="container" style="overflow-y: auto;margin-left:10px;">
      <br>
      <h3 class="center">Appointment</h3><br/>
        <div class=""id="appointment">
        </div>
    </div>
  <!-- RESULT -->
      <!-- RESULT -->
      <div class="container" style="overflow-y: auto;margin-left:10px;">
      <br>
      <h3 class="center">Current Assisting</h3><br/>
        <div class=""id="current_appointments">
        </div>
      </div>
  <!-- RESULT -->

</section>
<!-- CONTENT -->

  <script src="assets/js/jquery-3.5.1.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script type="text/javascript" class="hidden">
    $(document).ready(function () {
      $('#table_appointment').DataTable({
        searching: false,
        responsive: true,
        sorting: true
      });
      $('#table_current_appointment').DataTable({
        searching: false,
        responsive: true,
        sorting: true
      });
    });
  </script>

  <script>
        getSessionUser();
        fetch_appointments();
        fetch_current_appointments();
        setInterval(fetch_appointments, 3000);
        setInterval(fetch_current_appointments, 3000);
      function getSessionUser() {
        var action = "getSessionUser";
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { action: action },
          dataType: "json",
          success: function (data) {
            $('#user_id').val(data.user_id);
            $('#fullname').val(data.name);
            $('#email').val(data.email);
            $('#phonenumber').val(data.phone_number);
            $('#Year').val(data.year);
            $('#Course').val(data.course);
            $('#session_name').html(data.name);
            $('#session_year').html(data.year);
            $('#session_course').html(data.course);
          }
        })
      }
      function fetch_appointments() {
        var action = "fetch_appointments";
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { action: action },
          success: function (data) {
            $('#appointment').html(data);
          }
        })
      }
      function fetch_current_appointments() {
        var action = "fetch_current_appointments";
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { action: action },
          success: function (data) {
            $('#current_appointments').html(data);
          } 
        })
      }
  </script>
</body>
</html>