<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";


$sql = $conn->prepare("SELECT * FROM user");
$sql->execute();
$result = $sql->get_result();
?>
<div class="table-responsive-sm">
  <table class="table table-bordered table-hover table-sm table-striped">
    <thead class="thead-dark">
      <tr>
        <td colspan="8" style="text-align:center;" class="bg-dark text-white">User information</td>
      </tr>

      <tr>
        <th>user Id</th>
        <th>first name</th>
        <th>last name Id</th>
        <th>email</th>
        <th>phone</th>
        <th>gender</th>
        <th>balance</th>
        <th>password</th>

      </tr>
    </thead>

    <tbody>
      <?php

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>

          <tr>
            <td><?php echo $row['userId'];  ?> </td>
            <td><?php echo $row['fname'];  ?> </td>
            <td><?php echo $row['lname'];  ?> </td>
            <td><?php echo $row['email'];  ?> </td>
            <td><?php echo $row['phone'];  ?> </td>
            <td><?php echo $row['gender'];  ?> </td>
            <td><?php echo $row['balance'];  ?> </td>
            <td><?php echo $row['password'];  ?> </td>


          </tr>


        <?php
        }
        ?>
    </tbody>
  <?php
      }



  ?>
  </table>
  <div class="row mb-3">
    <div class=" col-auto "><a href="adminPannel.php?page=deposite"> <button class="btn btn-link">deposite balance </button></a> </div>
  </div>
</div>