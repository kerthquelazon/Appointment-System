<?php
session_start();
require 'connection.php';
require 'checker.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
      <link rel="icon" href="/assets/images/favicon.ico"/>
    <link rel="stylesheet" href="assets/CSS/ADMIN/subappointment.css">
    <!-- BOXICON -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="./assets/CSS/datatables.min.css" rel="stylesheet">
 

  </head>
  <body>

  <!-- SIDEBAR -->
  <section id="sidebar" class="side-menu">
    <div class="menu">
      <a href="dashboard.php"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
      <a href="sub-appointment.php" class="active"><span class="material-symbols-outlined">edit_calendar</span>Appointment</a>
      <a href="student-user.php"><span class="material-symbols-outlined">group</span>Users</a>
      <a href="administrator.php"><span class="material-symbols-outlined">admin_panel_settings</span>​Admin</a>
      <a href="reports.php"><span class="material-symbols-outlined">monitoring</span>Reports</a>
      <a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>
    </div>
  </section>
  <!-- SIDEBAR -->
 
  <!-- CONTENT -->
  <section id="content" class="content-top">
    <!-- NAVBAR -->
    <nav>
      <i class="bx bx-menu"></i>
      <img src="assets/images/LOGO.png" alt="">
      <a href="#" class="nav-link">Colegio De Santo Cristo De Burgos</a>
    </nav>

    <!-- CONTAINER -->
    <main>
    <div class="modal" id="appointment_modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Now assisting</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                
                <div class="container">
                  <div class="form-signup">
                    <form action="#" method="POST" autocomplete="" id="form_appointment">
                      <div class="form-group pt-3">
                        <input type="hidden" name="action" id="action" value="updateAssist" />
                        <input class="form-control hidden" type="text" id="appointment_id" name="appointment_id" placeholder="" value="" hidden>
                      </div>
                      <div class="form-group pt-3">
                        <div class="btn">
                          <input class="button form-control bg-danger text-white" id="insert" type="submit" name="submit"  value="Finish" data-bs-dismiss="modal">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    
   <div class="modal" id="remarks_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Remarks</h4>
      </div>
      <div class="container">
        <div class="form-signup">
          <form action="#" method="post" autocomplete="" id="form_remarks" name="form_remarks">
              <input class="form-control hidden" type="text" name="action" id="action" value="save_remarks" hidden>
              <input class="form-control hidden" type="text" name="appointment_id" id="appointment_id_1" value="0" hidden>
              <div class="form-group pt-3">
              <input class="form-control disabled" type="text" name="user_id" id="user_id" value="" style="" disabled>
            </div>
            <div class="form-group pt-3">
              <input class="form-control disabled" type="text" name="name" id="fullname" value="" disabled>
            </div>
            <div class="form-group pt-3">
              <input class="form-control disabled" type="email" name="email" id="email" value="" disabled>
            </div>
            <div class="form-group pt-3">
              <input class="form-control disabled" type="text" name="phonenumber" id="phonenumber" required="" disabled>
            </div>
            <div class="form-group pt-3">
              <input class="form-control disabled" type="text" name="Year" id="Year" value="" required="" disabled>
            </div>
            <div class="form-group pt-3">
              <input class="form-control disabled" type="text" name="Course" id="Course" value="" required="" disabled>
            </div>
            <div class="form-group pt-3">
              <select class="form-select" name="Purpose" id="purpose_select" disabled>
                <option value="" selected>
                  Purpose
                </option>
                <option value="Filing Documents">
                  Filing Documents
                </option>
                <option value="Enrollment">
                  Enrollment
                </option>
                <option value="Evaluation">
                  Evaluation
                </option>
                <option value="Completion">
                  Completion
                </option>
                <option value="TES Claim">
                  TES Claim
                </option>
              </select>
            </div>
            <div class="form-floating mt-3">
              <textarea class="form-control disabled" type="text" name="remarks" id="remarks" value="" required=""></textarea>
              <label for="remarks">Remarks</label>
            </div>
            <div class="form-group pt-3">
              <div class="btn hidden">
                <input class="button form-control bg-danger text-white" id="submit" type="submit" name="submit" value="Submit"data-bs-dismiss="modal">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
    

      <div class="container mt-3" style="overflow-y: auto;margin-left:10px;">
        <div id="message"></div>
          <div class="row d-flex justify-content-center">
            <div class="col-md-12">
              <div class="card-header mt-4">
                <h4>List of Appointment</h4>
              </div>
              <div class="card-body" id="waiting_appointments">
              </div>
              <div class="card-header mt-5">
                <h4>List of Accepted Appointment</h4>
              </div>
              <div class="" id="accepted_appointments">
              </div>
              <div class="card-header mt-5">
                <h4>List of Pending Appointment</h4>
              </div>
              <div class="" id="pending_appointments">
              </div>
            </div>
          </div>
        </div>
      </main>
    </section>
  <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="assets/js/jquery-3.5.1.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function () {
      fetch_waiting_appointments();
      fetch_pending_appointments();
      fetch_accepted_appointments();
      setInterval(fetch_waiting_appointments, 3000);
      setInterval(fetch_pending_appointments, 3000);
      setInterval(fetch_accepted_appointments, 3000);
      function fetch_waiting_appointments() {
        var action = "fetch_waiting_appointments";
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { action: action },
          success: function (data) {
            $('#waiting_appointments').html(data);
          }
        })
      }
      function fetch_pending_appointments() {
        var action = "fetch_pending_appointments";
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { action: action },
          success: function (data) {
            $('#pending_appointments').html(data);
          }
        })
      }
      function fetch_accepted_appointments() {
        var action = "fetch_accepted_appointments";
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { action: action },
          success: function (data) {
            $('#accepted_appointments').html(data);
          }
        })
      }

      $('#form_appointment').submit(function (event) {
        event.preventDefault();
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (data) {
            $('#message').html(data);
            $('#form_appointment')[0].reset();
            fetch_waiting_appointments();
            fetch_pending_appointments();
            fetch_accepted_appointments();
          }
        });
      });
      $(document).on('click', '.accept', function () {
        var appointment_id = $(this).attr("id");
        var action = "acceptAppointment";
        $('#appointment_id').val(appointment_id);
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { appointment_id:appointment_id, action:action },
          dataType: "json",
          success: function (data) {
            $('#message').html(data);
            fetch_waiting_appointments();
            fetch_pending_appointments();
            fetch_accepted_appointments();
          }
        })
      });
      $(document).on('click', '.decline', function () {
        var appointment_id = $(this).attr("id");
        var action = "declineAppointment";
        $('#appointment_id').val(appointment_id);
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { appointment_id:appointment_id, action:action },
          dataType: "json",
          success: function (data) {
            $('#message').html(data);
            fetch_waiting_appointments();
            fetch_pending_appointments();
            fetch_accepted_appointments();
          }
        })
      });
      $(document).on('click', '.assist', function () {
        var appointment_id = $(this).attr("id");
        var action = "getAppointment";
        $('#appointment_id').val(appointment_id);
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { appointment_id:appointment_id, action:action },
          dataType: "json",
          success: function (data) {
            $('#message').html(data);
            $('#action').val('updateAssist');
            $('#insert').val('Finish');
          }
        })
      });
      $(document).on('click', '.transfer', function () {
        var appointment_id = $(this).attr("id");
        var action = "assistAppointment";
        $('#appointment_id').val(appointment_id);
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { appointment_id:appointment_id, action:action },
          dataType: "json",
          success: function (data) {
            $('#message').html(data);
            $('#action').val('updateAssist');
            $('#insert').val('Finish');
          }
        })
      });
      $(document).on('click', '.edit', function () {
        var appointment_id = $(this).attr("id");
        var action = "edit_remarks";
        $('#form_remarks #appointment_id_1').val(appointment_id);
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { appointment_id:appointment_id, action:action },
          dataType: "json",
          success: function (data) {
            $('#user_id').val(data.user_id);
            $('#fullname').val(data.name);
            $('#email').val(data.email);
            $('#phonenumber').val(data.phone_number);
            $('#Year').val(data.year);
            $('#Course').val(data.course);
            $('#purpose_select').val(data.purpose);
            $('#remarks').val(data.remarks);
            $('#form_remarks #appointment_id_1').val(data.appointment_id);
          }
        })
      });
      $('#form_remarks').submit(function (event) {
        event.preventDefault();
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (data) {
            $('#form_remarks')[0].reset();
            fetch_waiting_appointments();
            fetch_pending_appointments();
            fetch_accepted_appointments();
          }
        });
      });
    });
  </script>
  </body>
</html>