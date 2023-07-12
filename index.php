<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Portal</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/assets/images/favicon.ico"/>
  <!-- CSS STYLE -->
  <link rel="stylesheet" href="portal.css">
  <!-- JAVASCRIPT -->
  <script src="main.js" type="text/javascript"></script>
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
  <header>
    <div class="main">
      <img src="assets/images/LOGO.png" data-aos="fade-down" data-aos-delay="400" data-aos-duration="800">
      <div class="title" data-aos="fade-up" data-aos-delay="900" data-aos-duration="900">LOGIN PORTAL</div>
      <div class="container">
        <form method="POST">
          <div class="form-group" data-aos="fade-zoom-in"data-aos-easing="ease-in-back"data-aos-delay="1500"data-aos-offset="0">
            <a href="stdlogin.php">
              <span class="tooltip">Student</span>
              <span>Student</span>
            </a>
          </div>
          <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="1500" data-aos-offset="0">
            <a href="y_subadmlogin.php">
              <span class="tooltip">Administrator</span>
              <span>Administrator</span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </header>
    
    <script>
    AOS.init();
    </script>

</body>
</html>

