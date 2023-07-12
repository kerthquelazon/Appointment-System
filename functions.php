<?php
session_start();
require 'connection.php';
$ses_id =  $_SESSION['id'];

//User Profile//
if ($_POST['action'] == "getSessionUser") {
  $query = "SELECT *,id as user_id from tb_user where id = $ses_id ORDER BY id";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}

//Fetch Appointments
if ($_POST["action"] == "fetch_appointments") {
  //User Query to populate the Table
  $query = "SELECT *, appointment.status as status, appointment.id as appointment_id FROM appointment LEFT JOIN tb_user on (appointment.user_id = tb_user.id) where tb_user.id = $ses_id ORDER BY appointment.id DESC";
  $result = mysqli_query($con, $query);
  $output = '
<table id="table_appointment" class="table table-sm table-hover table-striped">
  <thead>
          <tr>
              <th>Appointment ID</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Phonenumber</th>
              <th>Course</th>
              <th>Year</th>
              <th>Purpose</th>
              <th>Remarks</th>
              <th>Status</th>
          </tr>
      </thead>
  <tbody>
';
  while ($row = mysqli_fetch_array($result)) {
    $output .= '
  <tr>
   <td>' . $row["appointment_id"] . '</td>
   <td>' . $row["name"] . '</td>
   <td>' . $row["email"] . '</td>
   <td>' . $row["phone_number"] . '</td>
   <td>' . $row["course"] . '</td>
   <td>' . $row["year"] . '</td>
   <td>' . $row["purpose"] . '</td>
   <td>' . $row["remarks"] . '</td>
   <td>' . $row["status"] . '</td>
  </tr>
 ';
  }
  $output .= '
  </tbody>
</table>';
  echo $output;
}
//Fetch Current Appointments
if ($_POST["action"] == "fetch_current_appointments") {
  //User Query to populate the Table
  $query = "SELECT *, appointment.status as status,appointment.id as appointment_id FROM appointment LEFT JOIN tb_user on (appointment.user_id = tb_user.id) where appointment.status = 'Waiting' or appointment.status = 'In Progress' order by appointment.status desc";
  $result = mysqli_query($con, $query);
  $output = '
<table id="table_current_appointment" class="table table-sm table-hover table-striped">
  <thead>
          <tr>
              <th>Appointment ID</th>
              <th>Status</th>
          </tr>
      </thead>
  <tbody>
';
  while ($row = mysqli_fetch_array($result)) {
    $output .= '
  <tr>
   <td>' . $row["appointment_id"] . '</td>
   <td>' . $row["status"] . '</td>
   </tr>
 ';
  }
  $output .= '
  </tbody>
</table>';
  echo $output;
}

//Fetch waiting Appointments
if ($_POST["action"] == "fetch_waiting_appointments") {
  //User Query to populate the Table
  $query = "SELECT *, appointment.status as status, tb_user.id as id, appointment.id as appointment_id FROM appointment LEFT JOIN tb_user on (appointment.user_id = tb_user.id) where appointment.status = 'Waiting' or appointment.status = 'In Progress' LIMIT 5";
  $result = mysqli_query($con, $query);
  $output = '
<table id="table_waiting_appointment" class="table table-sm table-hover table-striped">
  <thead>
          <tr>
              <th>Fullname</th>
              <th>Email</th>
              <th>Phonenumber</th>
              <th>Course</th>
              <th>Year</th>
              <th>Purpose</th>
              <th>Remarks</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
  <tbody>
';
  while ($row = mysqli_fetch_array($result)) {
    $output .= '
  <tr>
   <td>' . $row["name"] . '</td>
   <td>' . $row["email"] . '</td>
   <td>' . $row["phone_number"] . '</td>
   <td>' . $row["course"] . '</td>
   <td>' . $row["year"] . '</td>
   <td>' . $row["purpose"] . '</td>
   <td>' . $row["remarks"] . '</td>
   <td>' . $row["status"] . '</td>
   <td class="d-print-none">
   <div class="btn-group">
   <a href="#"name="assist" class="btn btn-success btn-circle btn-sm assist"id="' . $row["appointment_id"] . '"data-bs-toggle="modal" data-bs-target="#appointment_modal">
     Assist
   </a>
   </div>
   </td>
  </tr>
 ';
  }
  $output .= '
  </tbody>
</table>';
  echo $output;
}

if ($_POST['action'] == "getAppointment") {
  $appointment_id = $_POST['appointment_id'];
  $query = "UPDATE appointment SET status = 'In Progress' WHERE id = '$appointment_id'";
  $output = '';
  if(mysqli_query($con, $query)){
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Appointment is In Progress!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
  }
  else{
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Cannot make appointment to in progress
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
    }
    echo $output;
}
if ($_POST['action'] == "updateAssist") {
  $appointment_id = $_POST['appointment_id'];
  $query = "UPDATE appointment SET status = 'Finished', transaction_date = NOW() WHERE id = '$appointment_id'";
  $output = '';
  if(mysqli_query($con, $query)){
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Appointment Finished!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
    echo $output;
  }
}

//Fetch pending Appointments
if ($_POST["action"] == "fetch_pending_appointments") {
  //User Query to populate the Table
  $query = "SELECT *, appointment.status as status, appointment.id as appointment_id FROM appointment LEFT JOIN tb_user on (appointment.user_id = tb_user.id) where appointment.status = 'Pending' LIMIT 30";
  $result = mysqli_query($con, $query);
  $output = '
<table id="table_pending_appointment" class="table table-sm table-hover table-striped">
  <thead>
          <tr>
              <th>Fullname</th>
              <th>Email</th>
              <th>Phonenumber</th>
              <th>Course</th>
              <th>Year</th>
              <th>Purpose</th>
              <th>Remarks</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
  <tbody>
';
  while ($row = mysqli_fetch_array($result)) {
    $output .= '
  <tr>
   <td>' . $row["name"] . '</td>
   <td>' . $row["email"] . '</td>
   <td>' . $row["phone_number"] . '</td>
   <td>' . $row["course"] . '</td>
   <td>' . $row["year"] . '</td>
   <td>' . $row["purpose"] . '</td>
   <td>' . $row["remarks"] . '</td>
   <td>' . $row["status"] . '</td>
   <td class="d-print-none">
   <div class="btn-group">
   <a href="#"name="Accept" class="btn btn-success btn-circle btn-sm accept"id="' . $row["appointment_id"] . '">
     Accept
   </a>
   <a href="#"name="Edit" class="btn btn-warning btn-circle btn-sm edit"id="' . $row["appointment_id"] . '"data-bs-toggle="modal" data-bs-target="#remarks_modal">
   Edit
 </a>
   <a href="#"name="Decline" class="btn btn-danger btn-circle btn-sm decline"id="' . $row["appointment_id"] . '">
    Decline
   </a>
   </div>
   </td>
  </tr>
 ';
  }
  $output .= '
  </tbody>
</table>';
  echo $output;
}
if ($_POST['action'] == "acceptAppointment") {
  $appointment_id = $_POST['appointment_id'];
  $query = "UPDATE appointment SET status = 'Accepted' WHERE id = '$appointment_id'";
  $output = '';
  if(mysqli_query($con, $query)){
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Appointment is Accepted!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
  }
  else{
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Cannot make appointment to accepted
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
    }
    echo $output;
}
if ($_POST['action'] == "declineAppointment") {
  $appointment_id = $_POST['appointment_id'];
  $query = "UPDATE appointment SET status = 'Declined' WHERE id = '$appointment_id'";
  $output = '';
  if(mysqli_query($con, $query)){
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Appointment is Accepted!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
  }
  else{
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Cannot make appointment to accepted
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
    }
    echo $output;
}
//Fetch accepted Appointments
if ($_POST["action"] == "fetch_accepted_appointments") {
  //User Query to populate the Table
  $query = "SELECT *, appointment.status as status, appointment.id as appointment_id FROM appointment LEFT JOIN tb_user on (appointment.user_id = tb_user.id) where appointment.status = 'Accepted' LIMIT 30";
  $result = mysqli_query($con, $query);
  $output = '
<table id="table_accepted_appointment" class="table table-sm table-hover table-striped">
  <thead>
          <tr>
              <th>Fullname</th>
              <th>Email</th>
              <th>Phonenumber</th>
              <th>Course</th>
              <th>Year</th>
              <th>Purpose</th>
              <th>Remarks</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
  <tbody>
';
  while ($row = mysqli_fetch_array($result)) {
    $output .= '
  <tr>
   <td>' . $row["name"] . '</td>
   <td>' . $row["email"] . '</td>
   <td>' . $row["phone_number"] . '</td>
   <td>' . $row["course"] . '</td>
   <td>' . $row["year"] . '</td>
   <td>' . $row["purpose"] . '</td>
   <td>' . $row["remarks"] . '</td>
   <td>' . $row["status"] . '</td>
   <td class="d-print-none">
   <div class="btn-group">
   <a href="#"name="transfer" class="btn btn-success btn-circle btn-sm transfer"id="' . $row["appointment_id"] . '">
     Transfer to Waiting
   </a>
   </div>
   </td>
  </tr>
 ';
  }
  $output .= '
  </tbody>
</table>';
  echo $output;
}
if ($_POST['action'] == "assistAppointment") {
  $appointment_id = $_POST['appointment_id'];
  $query = "UPDATE appointment SET status = 'Waiting' WHERE id = '$appointment_id'";
  $output = '';
  if(mysqli_query($con, $query)){
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Appointment is updated to waiting.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
  }
  else{
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Cannot make appointment to waiting
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
    }
    echo $output;
}
//Fetch finished Appointments
if ($_POST["action"] == "fetch_finished_appointments_today") {
  $datefrom = $_POST["datefrom"];
  $dateto = $_POST["dateto"];
 if ($datefrom == '') {
    $date_query = "and appointment.transaction_date >= CURDATE()";
  } else if ($dateto == '') {
    $date_query = "and appointment.transaction_date >= CURDATE()";
  } else {
    $date_query = "and appointment.transaction_date >= '" . $datefrom . "' and appointment.transaction_date <= '" . $dateto . "' ";
  }
  //User Query to populate the Table
  $query = "SELECT *, appointment.status as status, appointment.id as appointment_id FROM appointment LEFT JOIN tb_user on (appointment.user_id = tb_user.id) where appointment.status = 'finished' $date_query";
  $result = mysqli_query($con, $query);
  $output = '
<table id="table_finished_appointment" class="table table-sm table-hover table-striped">
  <thead>
          <tr>
              <th>Fullname</th>
              <th>Email</th>
              <th>Phonenumber</th>
              <th>Course</th>
              <th>Year</th>
              <th>Purpose</th>
              <th>Remarks</th>
              <th>Transaction Date</th>
              <th>Status</th>
          </tr>
      </thead>
  <tbody>
';
  while ($row = mysqli_fetch_array($result)) {
    
    $output .= '
  <tr>
   <td>' . $row["name"] . '</td>
   <td>' . $row["email"] . '</td>
   <td>' . $row["phone_number"] . '</td>
   <td>' . $row["course"] . '</td>
   <td>' . $row["year"] . '</td>
   <td>' . $row["purpose"] . '</td>
   <td>' . $row["remarks"] . '</td>
   <td>' . $row["transaction_date"] . '</td>
   <td>' . $row["status"] . '</td>
  </tr>
 ';
  }
  $output .= '
  </tbody>
</table>';
  echo $output;
}
//User settings//

if ($_POST['action'] == "fetch_settings_profile") {
  $query = "SELECT * from tb_user where id = $ses_id";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}
if ($_POST['action'] == "save_settings") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $stdnum = $_POST['stdnum'];
  $phone_number = $_POST['phone_number'];
  $year = $_POST['year'];
  $course = $_POST['course'];
  $query = "UPDATE tb_user SET name = '$name',email = '$email', stdnum = '$stdnum',phone_number = '$phone_number',year = '$year',course = '$course',password = '$password' WHERE id = '$ses_id'";
  $output = '';
  if(mysqli_query($con, $query)){
    $output .='<div class="alert alert-success alert-dismissible" role="alert"> Changes has been saved!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
  }
  else{
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Changes cannot be save.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
    }
    echo $output;
}
if ($_POST['action'] == "edit_remarks") {
  $appointment_id = $_POST['appointment_id'];
  $query = "SELECT *,appointment.id as appointment_id FROM appointment LEFT JOIN tb_user on (appointment.user_id = tb_user.id) where appointment.id = $appointment_id";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}
if ($_POST['action'] == "save_remarks") {
  $remarks = $_POST['remarks'];
  $appointment_id = $_POST['appointment_id'];
  $query = "UPDATE appointment SET remarks = '$remarks'WHERE id = '$appointment_id'";
  $output = '';
  if(mysqli_query($con, $query)){
    $output .='<div class="alert alert-success alert-dismissible" role="alert"> Changes has been saved!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
  }
  else{
    $output .='<div class="alert alert-warning alert-dismissible" role="alert"> Changes cannot be save.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div>';
    }
    echo $output;
}
?>

