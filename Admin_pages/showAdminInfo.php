<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";






if (isset($_POST['updateAdmin'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $gender = $_POST['inlineRadioOptions'];
  $role = "admin";
  $adminId = $_POST['adminId'];

  if (!isset($fname, $email, $phone, $lname, $password, $gender, $role, $adminId)) { ?>
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
    if ($res > 1) {
    ?>
      <script>
        alert("Email already exists!");
      </script>
      <?php

    } else {

      $stmt = $conn->prepare("UPDATE  admin SET fname=?, lname=?,email=?, password=?, phone=?,gender=?,role=?  WHERE adminId=$adminId");
      $stmt->bind_param("ssssiss", $fname, $lname, $email, $password, $phone, $gender, $role);
      if ($stmt->execute()) {
      ?>
        <script>
          alert("Congratulations.\nYou successfully updated admin.");
          window.location = "adminPannel.php?page=showAdmin";
        </script>
<?php
      }
    }
  }
}


# to delete admin
if (isset($_POST['del_admin'], $_POST['delete'])) {
  $delId = $_POST['del_admin'];
  if ($conn->query("DELETE FROM admin WHERE adminId=$delId")) {
    echo " <script>  alert('sucessfully deleted !');    </script>";
  } else {
    echo " <script>  alert(' not deleted !');    </script>";
  }
}






$sql = $conn->prepare("SELECT * FROM admin");
$sql->execute();
$result = $sql->get_result();
?>
<div class="table-responsive-sm">
  <table class="table table-bordered table-hover table-sm table-striped">
    <thead class="thead-dark">
      <tr>
        <td colspan="10" style="text-align:center;" class="bg-dark text-white">Admin information</td>
      </tr>

      <tr>
        <th>admin Id</th>
        <th>first name</th>
        <th>last name Id</th>
        <th>email</th>
        <th>phone</th>
        <th>gender</th>
        <th>password</th>
        <th>role</th>
        <th colspan="2">operation</th>
      </tr>
    </thead>

    <tbody>
      <?php

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>

          <tr>
            <td><?php echo $row['adminId'];  ?> </td>
            <td><?php echo $row['fname'];  ?> </td>
            <td><?php echo $row['lname'];  ?> </td>
            <td><?php echo $row['email'];  ?> </td>
            <td><?php echo $row['phone'];  ?> </td>
            <td><?php echo $row['gender'];  ?> </td>
            <td><?php echo $row['password'];  ?> </td>
            <td><?php echo $row['role'];  ?> </td>
            <form method="POST">
              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['adminId'] ?>">
                  Edit
                </button>
              </td>

              <td> <input type="hidden" class="form-control" name="del_admin" value="<?php echo $row['adminId'] ?>" required id="">
                <button type="submit" name="delete" onclick="return confirm('Are you sure about this?')" class="btn btn-danger">
                  Delete
                </button>

              </td>
            </form>
          </tr>

          <div class="modal fade" id="edit<?php echo $row['adminId'] ?>">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Editing <?php echo $row['fname'];


                                                  ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="" class="align-middle row g-3">

                    <div class="mb-3 row">
                      <label for="fname" class="col-sm-2 col-form-label">first name</label>
                      <div class="col-sm-10"> <input type="text" class="form-control" id="fname" value="<?php echo $row['fname']   ?>" name="fname">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-sm-10"> <input type="number" class="form-control" id="adminId" value="<?php echo $row['adminId']   ?>" name="adminId" hidden>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="lname" class="col-sm-2 col-form-label">Last name</label>
                      <div class="col-sm-10"> <input type="text" class="form-control" id="lname" value="<?php echo $row['lname']   ?>" name="lname">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="email" class="col-sm-2 col-form-label">Email </label>
                      <div class="col-sm-10"> <input type="email" class="form-control" id="email" value="<?php echo $row['email']   ?>" name="email">
                      </div>
                    </div>

                    <div class=" mt-3 container-md">
                      <label for="phone" class="col-sm-2 col-form-label">sex </label>

                      <div class="form-check form-check-inline"> <input class="form-check-input" type="radio" <?php if ($row['gender'] == 'male') { ?> checked <?php }  ?>name="inlineRadioOptions" id="inlineRadio1" value="female"> <label class="form-check-label" for="inlineRadio1">male</label> </div>

                      <div class="form-check form-check-inline"> <input class="form-check-input" type="radio" <?php if ($row['gender'] == 'female') { ?> checked <?php }  ?> name="inlineRadioOptions" id="inlineRadio2" value="female"> <label class="form-check-label" for="inlineRadio2">female</label> </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="phone" class="col-sm-2 col-form-label">Phone number </label>
                      <div class="col-sm-10"> <input type="number" class="form-control" id="staticEmail" value="<?php echo $row['phone']   ?>" name="phone">
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                      <div class=" col-sm-10"> <input type="password" class="form-control" id="inputPassword" required value="<?php echo $row['password']   ?>" name="password">
                        <small style="display: none;">password do not match</small>
                      </div>

                    </div>


                    <div class="row mb-3">
                      <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="updateAdmin">update admin info </button> </div>

                      <div class="col-auto "> <button type="reset" class="btn btn-danger mb-3 ">clear form</button> </div>


                    </div>
                  </form>

                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>



              <?php
            }


              ?>
    </tbody>
  <?php
      }

  ?>

  </table>
  <div class="row mb-3">
    <div class=" col-auto "><a href="adminPannel.php?page=addAdmin"> <button class="btn btn-link">add admin </button></a> </div>
  </div>
</div>