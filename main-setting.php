<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setting</title>
    <link rel="icon" href="/assets/images/favicon.ico"/>
  <link rel="stylesheet" href="assets/CSS/main-setting.css">
  <!-- BOXICON -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <!-- SIDEBAR -->
  <section id="sidebar" class="side-menu">
    <div class="menu">
      <a href="appoint.php"><i class="bx bxs-home"></i>Home</a>
      <a href="main-setting.php" class="active"><i class="bx bxs-cog"></i>Setting</a>
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
    
    <main class="d-flex justify-content-center">
        <div class="container mt-5">
          <div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header">
                  <h4>Manage Account</h4>
                </div>
                <div class="card-body">
                  <div id="message"></div>
                  <form action="#" >
                    <div class="mb-3">
                      <input type="hidden" name="action" id="action" value="save_settings">
                      <label>Student Name</label>
                      <input type="text" name="name" id="name" required value="" class="form-control">
                    </div>
                    <div class="mb-3">
                      <label>Student No.</label>
                      <input type="text"  name="stdnum" id="stdnum" required value=""  class="form-control">
                    </div>
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="text" name="email" id="email" required value="" class="form-control">
                    </div>
                    <div class="mb-3">
                      <label>Phone number</label>
                      <input type="text" name="phone_number" id="phone_number" required value="" class="form-control"  maxlength="11">
                    </div>
                    <div class="mb-3">
                      <label>year</label>
                      <select name="year" class="form-control" id="year" required value="">
                          <option value="Grade 11 Senior-High"selected>Grade 11 Senior-High</option>
                          <option value="Grade 12 Senior-High">Grade 12 Senior-High</option>
                          <option value="1st Year">1st Year </option>
                          <option value="2nd Year">2nd Year</option>
                          <option value="3rd Year">3rd Year</option>
                          <option value="4th Year">4th Year</option>
                     </select>
                    </div>
                    <div class="mb-3">
                      <label>Course</label>
                      <select name="course" class="form-control" id="course" required value="">
                          <option value="Accountancy and Business Management"selected>Accountancy and Business Management</option>
                          <option value="General Academics">General Academics</option>
                          <option value="Home Economics">Home Economics</option>
                          <option value="Humanities and Social Sciences">Humanities and Social Sciences</option>
                          <option value="Information and Communication Technology">Information and Communication Technology</option>
                          <option value="Science, Technology, Engineering and Mathematics">Science, Technology, Engineering and Mathematics</option>
                          <option value="B.S. Business Administration">B.S. Business Administration</option>
                          <option value="B.S. Computer Science">B.S. Computer Science</option>
                          <option value="B.S. Hospitality Management">B.S. Hospitality Management</option>
                          <option value="B.S. Information Technology">B.S. Information Technology</option>
                          <option value="B.S. Psychology">B.S. Psychology</option>
                          <option value="B.S. Tourism Management">B.S. Tourism Management</option>
                    </select>
                    </div>
                    <div class="mb-3">
                      <label>password</label>
                      <input type="password" name="password"  id="password" required value="" class="form-control">
                    </div>
                    <div class="mb-1 float-end">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
  </section>


  
    <script src="assets/js/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="assets/js/app.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script>
    $(document).ready(function () {
       fetch_settings_profile();
      function fetch_settings_profile() {
        var action = "fetch_settings_profile";
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: { action: action },
          dataType: "json",
          success: function (data) {
            $('#name').val(data.name);
            $('#stdnum').val(data.stdnum);
            $('#email').val(data.email);
            $('#phone_number').val(data.phone_number);
            $('#year').val(data.year);
            $('#course').val(data.course);
            $('#password').val(data.password)
            
          }
        })
      }

      $('form').submit(function (event) {
        event.preventDefault();
        $.ajax({
          url: "functions.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (data){
            $('#message').html(data);
            $('form')[0].reset();
            fetch_settings_profile();
          }
        });
      });

    });
  </script>
</body>
</html>