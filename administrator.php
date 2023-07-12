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
    <title>Administrator</title>
    <link rel="stylesheet" href="assets/CSS/administrator.css">
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
      <a href="student-user.php"><span class="material-symbols-outlined">group</span>Users</a>
      <a href="administrator.php" class="active"><span class="material-symbols-outlined">admin_panel_settings</span>​Admin</a>
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

    <!-- LIST OF ADMIN USERS -->
    <main>
      <div class="container mt-4" style="overflow-y: auto;margin-left:10px;">
        <?php include('message.php'); ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card-header mt-4">
                <h4>Administrator
                  <a href="#" class="btn btn-primary float-end mb-1" data-bs-toggle="modal" data-bs-target="#admin">Add User</a>
                </h4>
              </div>
              <div class="card-body">

              <table class="table table-bordered text-center table-hover" id="administrator">
                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Admintrator</th>
                    <th>Admin No.</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i = 1;
                  $admin = $con->query("SELECT * FROM admin_user order by id DESC");
                  while($row=$admin->fetch_assoc()):
                  ?>
                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo ucwords($row['name']); ?></td>
                    <td><?php echo $row['admnum']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td>
                      <a href="admin-edit.php?id=<?php echo $row['id'];?>" class="btn btn-success btn-sm">Edit</a>
                      <form action="code.php" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger btn-sm" name="delete_admin" value="<?php echo $row['id']; ?>">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </section>

  <!-- The Modal -->
  <div class="modal" id="admin">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
        <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Sign Up</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

          <!-- Modal body -->
          <div class="container">
            <div class="form-signup">
              <form class="" action="code.php" method="post" autocomplete="off">
                <div class="form-group pt-3">
                  <input type="text" name="name" id = "name" required value="" class="form-control" placeholder="Name">
                </div> 
                <div class="form-group pt-3">
                  <input type="text" name="admnum" id = "admnum" required value="" class="form-control" placeholder="Admin Number">
                </div> 
                <div class="form-group pt-3">
                  <input type="email" name="email" id = "email" required value="" class="form-control" placeholder="Email">
                </div> 
                <div class="form-group pt-3">
                  <input type="password" name="password" id = "password" required value="" class="form-control" placeholder="Password">
                </div> 
                <div class="form-group pt-3">
                  <input type="password" name="confirmpassword" id = "confirmpassword" required value="" class="form-control" placeholder="Confirm Password">
                </div> 
                
                <div class="form-group pt-3 pb-3">
                  <button type="submit" class="form-control bg-success text-white" name="admsubmit" class="button">Register</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- JAVASCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="assets/js/app.js"></script>

  <script src="assets/js/jquery-3.5.1.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script type="text/javascript" class="hidden">
    $(document).ready(function () {
      $('#administrator').DataTable({
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