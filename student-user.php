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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Users</title>
      <link rel="icon" href="/assets/images/favicon.ico"/>
    <link rel="stylesheet" href="assets/CSS/student-users.css">
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
      <a href="dashboard.php"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
      <a href="sub-appointment.php"><span class="material-symbols-outlined">edit_calendar</span>Appointment</a>
      <a href="student-user.php" class="active"><span class="material-symbols-outlined">group</span>Users</a>
      <a href="administrator.php"><span class="material-symbols-outlined">admin_panel_settings</span>​Admin</a>
      <a href="reports.php"><span class="material-symbols-outlined">monitoring</span>Reports</a>
      <a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>
    </div>
  </section>


  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class="bx bx-menu"></i>
      <img src="assets/images/LOGO.png" alt="">
      <a href="#" class="nav-link">Colegio De Santo Cristo De Burgos</a>
    </nav>

    <!-- CONTAINER -->
    <main>
      <div class="container mt-4" style="overflow-y: auto;margin-left:10px;">
      <?php include('message.php'); ?>
          <div class="row d-flex justify-content-center">
            <div class="col-md-12">
              <div class="card-header mt-4">
                <h4>Student Users</h4>
              </div>
              <div class="card-body">
                
              <table class="table table-bordered text-center table-hover" id="users">
                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Student No.</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * FROM tb_user ORDER BY id ASC";
                  $query_run = mysqli_query($con, $query);
                    
                  if(mysqli_num_rows($query_run) > 0)
                  {
                    foreach($query_run as $student){
                      ?>
                      <tr>
                        <td><?= $student['id']; ?></td>
                        <td><?= ucwords($student['name']); ?></td>
                        <td><?= $student['stdnum']; ?></td>
                        <td><?= $student['email']; ?></td>
                        <td><?= $student['password']; ?></td>
                        <td><?= $student['status']; ?></td>
                        <td>
                          <a href="student-edit.php?id=<?= $student['id'];?>" class="btn btn-success btn-sm">Edit</a>
                          <form action="code.php" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm" name="delete_student" value="<?=$student['id']; ?>">Delete</button>
                          </form>
                        </td>
                      </tr>
                      <?php }
                      }else{
                      echo "<h5>No Record Found </h5>";
                    }?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <script>
    const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});
  </script>

  <script src="assets/js/jquery-3.5.1.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script type="text/javascript" class="hidden">
    $(document).ready(function () {
      $('#users').DataTable({
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
    });
  </script>
</body>
</html>