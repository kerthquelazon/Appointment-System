<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Appointment</title>
  <link rel="stylesheet" href="assets/CSS/appointment.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>


  <!-- SIDEBAR -->
  <section id="sidebar">
    <ul class="side-menu top">
      <li class="active">
        <a href="sub-appointment.php">
          <i class='bx bx-spreadsheet'></i>
          <span class="text">Appointment</span>
        </a>
      </li>
      <li>
        <a href="student-user.php">
        <i class='bx bxs-user-account' ></i>
          <span class="text">Users</span>
        </a>
      </li>
      <li>
        <a href="administrator.php">
        <i class='bx bxs-user' ></i>
          <span class="text">Admin</span>
        </a>
      </li>
    </ul>
    <ul class="side-menu">
      <li>
        <a href="appointments.php">
          <i class="bx bxs-cog"></i>
          <span class="text">Settings</span>
        </a>
      </li>
      <li>
        <a href="logout.php" class="logout">
          <i class="bx bxs-log-out-circle"></i>
          <span class="text">Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->


 <!-- CONTENT -->
  <section id="content">
   <!-- NAVBAR -->
    <nav>
      <i class="bx bx-menu"></i>
      <a href="#" class="nav-link"><img src="assets/images/LOGO.png" alt="" srcset=""><span>Colegio De Santo Cristo De Burgos</span></a>
    </nav>
    
    <div class="main">
      <div class="container">
          <br>
          <h3 align="fl-left">Appointment</h3><br />
        <table >
        <div class="table-responsive">
          <table class="table table-bordered text-center">
        <tr>
          <th>Fullname</th>
          <th>Email</th>
          <th>phonenumber</th>
          <th>Year</th>
          <th>Course</th>
          <th>Purpose</th>
          <th>Status</th> 
          <th>Remarks</th>
        </tr>
        <?php
        $con = mysqli_connect("localhost", "root", "123456789", "mysystem");


        $sql = "SELECT * from appointment ORDER BY id DESC";
        $result = $con-> query($sql);

        if ($result-> num_rows > 0){
        while ($row = $result-> fetch_assoc()) {
        echo "</td><td>". $row["name"]. "</td><td>" . $row["email"] . "</td><td>" . $row["phonenumber"] . "</td><td>". $row["Year"]. "</td><td>". $row["Course"]."</td><td>". $row["Purpose"]."</td></tr>";
        }
      }
        else{
          echo "0 result";
        }

        $con-> close();
        ?>
        </table>
      </div>
    </div>

    <script src="assets/js/app.js"></script>

    
</body>
</html>
