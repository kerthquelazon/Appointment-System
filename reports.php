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
  <title>Reports</title>
    <link rel="icon" href="/assets/images/favicon.ico"/>
  <link rel="stylesheet" href="assets/CSS/ADMIN/reports.css">
  <!-- ICON LINK-->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="./assets/CSS/datatables.min.css" rel="stylesheet">
</head>
<body id="body">
  <!-- SIDEBAR -->
  <section id="sidebar" class="side-menu">
    <div class="menu">
      <a href="dashboard.php"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
      <a href="sub-appointment.php"><span class="material-symbols-outlined">edit_calendar</span>Appointment</a>
      <a href="student-user.php"><span class="material-symbols-outlined">group</span>Users</a>
      <a href="administrator.php"><span class="material-symbols-outlined">admin_panel_settings</span>​Admin</a>
      <a href="reports.php" class="active"><span class="material-symbols-outlined">monitoring</span>Reports</a>
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
        <!-- <button type="button" class="btn btn-primary mt-3 ms-4" onclick="printPage()" id="print">Print Report</button> -->
<main style="overflow-y: auto;margin-left:10px;" id="data">
  <div class="container-top mt-4 ms-4">
    <div class="container ms-1">
      <div class="row d-flex justify-content-center">
        <div class="col-md-13 card">
          <div class="card-header mt-4">
            <h4>Today's Appointments</h4>
            <div class="row">
              <form id="filter" method="post" enctype="multipart/form-data" name="filter">
                <div class="col-md-4 relative">
                  <input type="hidden" name="action" id="action" value="fetch_finished_appointments_today">
                  <div class="form-group">
                    <label class="control-label">Date From</label>
                    <div class='input-group date' id='datetimepicker1'>
                      <input type="text" id="datefrom" name="datefrom">
                    </div>
                  </div>
                </div>
                <div class="col-md-4 relative">
                  <div class="form-group">
                    <label class="control-label">Date To</label>
                    <div class='input-group date' id='datetimepicker1'>
                      <input type="text" id="dateto" name="dateto">
                    </div>
                  </div><button type="button" class="btn btn-warning search" id="search">Search</button>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body" id="finished_appointments"></div>
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
      fetch_finished_appointments()
      function fetch_finished_appointments() {        
        var form = document.getElementById('filter');
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: new FormData(filter),
          contentType: false,
          processData: false,
          success: function (data) {
            $('#finished_appointments').html(data);
            $('#table_finished_appointment').DataTable({
              searching: false,
              dom: 'Bfrtip',
              buttons: [
                'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
              ],
              responsive: true,
              sorting: true
            });
          }
        })
      }
      $(document).on('click', '.search', function (e) {
        fetch_finished_appointments();
      });
    });
  </script>
    <script>
    jQuery('#datefrom').datetimepicker({
      format:'Y-m-d H:i:s',
      timepicker:false,
      defaultTime:'00:00:00'
    });
    jQuery('#dateto').datetimepicker({
      format:'Y-m-d H:i:s',
      timepicker:false,
      defaultTime:'12:59:59'
    });
  </script>
</body>
</html>