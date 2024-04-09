<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";





if (isset($_POST['send'])) {
    if (empty($_POST["message"])) {
?>
        <script>
            alert('add your reply!!');
        </script>
        <?php
    } else {
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $text = $_POST['message'];
        $userId = $_POST['userId'];
        $date = date('y,m,d');
        if (!empty($email && $text && $userId && $date && $subject)) {
            $check = $conn->prepare("SELECT * FROM user WHERE email=?");
            $check->bind_param("s", $email);
            if ($check->execute()) {
                $result = $check->get_result();

                if ($result->num_rows > 0) {
                    // $row = $result->fetch_assoc();
                    // $userId = $row['userId'];
                    $status = "seen";
                    $sql = $conn->prepare("INSERT INTO  notification (email,subject,message,sentDate) VALUES(?,?,?,?)");
                    $sql->bind_param("ssss", $email, $subject, $text, $date);
                    if ($sql->execute()) {
                        $conn->query("UPDATE comment SET status='$status' WHERE userId=$userId ");
        ?>
                        <script>
                            alert("you reply is sent!!");
                        </script>

                    <?php   } else {
                    ?>
                        <script>
                            alert(" faile to excute !!");
                        </script>

                    <?php


                    }
                } else {
                    ?>
                    <script>
                        alert(" email  not exist !!");
                    </script>

            <?php
                }
            }
        } else {
            ?>
            <script>
                alert(" fill correctly !!");
            </script>

<?php
        }
    }
}


if (isset($_POST['see'])) {
    $userId = $_POST['see'];
    $conn->query("UPDATE comment SET status='seen' WHERE userId=$userId ");
}





$sql = $conn->prepare("SELECT comment.commentId, user.userId,user.email,user.fname, comment.description,comment.sentDate,comment.status
FROM comment
INNER JOIN user ON comment.userId = user.userId");

$sql->execute();
$result = $sql->get_result();
?>
<div class="table-responsive-sm">
    <table class="table table-bordered table-hover table-sm table-striped">
        <thead class="thead-dark">
            <tr>
                <td colspan="10" style="text-align:center;" class="bg-dark text-white">Feedback information</td>
            </tr>

            <tr>
                <th>comment Id</th>
                <th>user id</th>
                <th>user name</th>
                <th>email </th>
                <th>sent Date</th>
                <th>description</th>
                <th>status</th>
                <th colspan="2">operation</th>
            </tr>
        </thead>

        <tbody>
            <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>

                    <tr>
                        <td><?php echo $row['commentId'];  ?> </td>
                        <td><?php echo $row['userId'];  ?> </td>
                        <td><?php echo $row['fname'];  ?> </td>
                        <td><?php echo $row['email'];  ?> </td>
                        <td><?php echo $row['sentDate'];  ?> </td>
                        <td><?php echo $row['description'];  ?> </td>

                        <td><?php echo $row['status'];  ?> </td>
                        <form method="POST">
                            <td>
                                <button type="submit" class="btn btn-primary" name="see" value="<?php echo $row['userId'] ?>">
                                    see
                                </button>
                            </td>

                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $row['commentId'] ?>">
                                    reply
                                </button>
                            </td>

                        </form>
                    </tr>

                    <div class="modal fade" id="edit<?php echo $row['commentId'] ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">sending to : <?php echo $row['email'];


                                                                            ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" class="align-middle row g-3">

                                        <div class="mb-3 row">
                                            <label for="fname" class="col-sm-2 col-form-label">subject</label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="subject" name="subject" placeholder="subject...">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-10"> <input type="number" class="form-control" id="userId" value="<?php echo $row['userId']   ?>" name="userId" hidden>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="lname" class="col-sm-2 col-form-label">message</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="description" name="message" placeholder="reply here..." rows="3" required></textarea>

                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-sm-2 col-form-label">Email </label>
                                            <div class="col-sm-10"> <input type="email" class="form-control" id="email" value="<?php echo $row['email']   ?>" name="email" placeholder="email">
                                            </div>
                                        </div>





                                        <div class="row mb-3">
                                            <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="send"> send</button> </div>

                                            <div class="col-auto "> <button type="reset" class="btn btn-danger mb-3 ">clear form</button> </div>


                                        </div>
                                    </form>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                                </tr>
                            <?php
                        }
                            ?>
        </tbody>

    <?php


            }
    ?>


    </table>
</div>