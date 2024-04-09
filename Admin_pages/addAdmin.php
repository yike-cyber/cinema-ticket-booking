<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";
?>
<?php

if (isset($_POST['register'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $gender = $_POST['inlineRadioOptions'];
  $role = "admin";

  if (!isset($fname, $email, $phone, $lname, $password, $password2, $gender, $role)) { ?>
    <script>
      alert("Ensure you fill the form properly.");
    </script>
    <?php
  } else {
    //Check if email exists
    $check_email = $conn->prepare("SELECT * FROM admin WHERE email = ? OR phone = ?");
    $check_email->bind_param("si", $email, $phone);
    $check_email->execute();
    $res = $check_email->store_result();
    $res = $check_email->num_rows();
    if ($res > 0) {
    ?>
      <script>
        alert("Email already exists!");
      </script>
    <?php

    } else if ($password2 != $password) { ?>
      <script>
        alert("Password does not match.");
      </script>
      <?php
    } else {

      $stmt = $conn->prepare("INSERT INTO admin (fname, lname,email, password, phone,gender,role ) VALUES (?,?,?,?,?,?,?)");
      $stmt->bind_param("ssssiss", $fname, $lname, $email, $password, $phone, $gender, $role);
      if ($stmt->execute()) {
      ?>
        <script>
          alert("Congratulations.\nYou successfully registered admin.");
          window.location = "adminPannel.php?page=addAdmin";
        </script>
<?php
      }
    }
  }
}

?>








<div class="container-lg mt-4 ">
  <div class="align-middle bg-light pt-4">
    <p class="text-center text-success"> <span class="me-5 text-primary">Admin : <?php echo $adminfname ?></span> Register admin here</p>
    <h3 class="mb-5 text-center text-warning fw-bold "></h3>
    <form method="post" action="" class="align-middle row g-3">

      <div class="mb-3 row">
        <label for="fname" class="col-sm-2 col-form-label">first name</label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="fname" placeholder="enter first name" name="fname">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="lname" class="col-sm-2 col-form-label">Last name</label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="lname" placeholder="enter last name" name="lname">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email </label>
        <div class="col-sm-10"> <input type="email" class="form-control" id="email" placeholder="enter email" name="email">
        </div>
      </div>

      <div class=" mt-3 container-md">
        <label for="phone" class="col-sm-2 col-form-label">sex </label>

        <div class="form-check form-check-inline"> <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="female"> <label class="form-check-label" for="inlineRadio1">male</label> </div>

        <div class="form-check form-check-inline"> <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="female"> <label class="form-check-label" for="inlineRadio2">female</label> </div>
      </div>

      <div class="mb-3 row">
        <label for="phone" class="col-sm-2 col-form-label">Phone number </label>
        <div class="col-sm-10"> <input type="number" class="form-control" id="staticEmail" placeholder="enter phone number " name="phone">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class=" col-sm-10"> <input type="password" class="form-control" id="inputPassword" required placeholder="password " name="password">
          <small style="display: none;">password do not match</small>
        </div>

      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">confirm Password</label>
        <div class="mb-5 col-sm-10"> <input type="password" class="form-control" id="confirmPassword" required placeholder="confirm password " name="password2">
          <small style="display: none;">password do not match</small>
        </div>
      </div>

      <div class="row mb-3">
        <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="register">Register </button> </div>

        <div class="col-auto "> <button type="reset" class="btn btn-danger mb-3 ">clear form</button> </div>


      </div>
    </form>
    <div class="row mb-3">
      <div class=" col-auto "><a href="adminPannel.php?page=showAdmin"> <button class="btn btn-link">show admin </button></a> </div>
    </div>

  </div>
</div>