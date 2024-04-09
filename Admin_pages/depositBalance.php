<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";
if (isset($_POST['add'])) {
  $email = $_POST['email'];
  $balance = $_POST['birr'];
  if (!empty($email && $balance)) {

    $check_email = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $res = $check_email->get_result();

    if ($res->num_rows == 1) {
      $row = $res->fetch_assoc();
      $birr = $row['balance'];
      $name = $row['fname'];
      $birr = intval($birr) + intval($balance);
      $addBal = $conn->prepare("UPDATE user SET balance=$birr WHERE email = ?");
      $addBal->bind_param("s", $email);
      if ($addBal->execute()) {
?>
        <script>
          alert('you successfully added balance to <?php echo   $name ?>');
          window.location = "adminPannel.php?page=deposite";
        </script>
      <?php
      }
    } else {
      ?>

      <script>
        alert('This email is not exist,\n try again');
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert('please fill form');
    </script>
<?php
  }
}

?>


<div class="container-lg mt-4 ">
  <div class="align-middle bg-light pt-4">
    <h4 class="text-center fw-bold text-primary"> Deposit balance to users</h4>
    <h3 class="mb-5 text-center text-warning fw-bold "></h3>
    <form class="align-middle row g-3" method="post" action="">

      <div class="mb-3 row">
        <label for="fname" class="col-sm-2 col-form-label">user email </label>
        <div class="col-sm-10"> <input type="email" class="form-control" id="email" placeholder="enter email address of user" name="email">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="lname" class="col-sm-2 col-form-label">amount</label>
        <div class="col-sm-10"> <input type="number" min="0" class="form-control" id="lname" placeholder="enter amount to deposit" name="birr">
        </div>
      </div>

      <div class="row">


        <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="add">add balance to user</button> </div>

        <div class="col-auto "> <button type="reset" class="btn btn-danger mb-3 ">clear form</button> </div>

        <div class="row mb-3">


        </div>
      </div>
    </form>
    <div class="row mb-3">
      <div class=" col-auto "><a href="adminPannel.php?page=showUser"> <button class="btn btn-link">show user </button></a> </div>
    </div>


  </div>
</div>








</div>
</div>
</main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>


</body>


</html>