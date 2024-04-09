<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";






if (isset($_POST['updateShow'])) {

    // $targetDir = "movies/"; 
    // $fileName = $_FILES["fileToUpload"]["name"];
    // $targetFilePath = $targetDir . $fileName;
    // $fileType = $_FILES["fileToUpload"]["type"];



    $title = $_POST['movieTitle'];
    $showDate = $_POST['showDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $roomType = $_POST['roomType'];
    $showId = $_POST['showId'];



    if (!isset($title, $showDate, $startTime, $endTime, $roomType, $showId)) { ?>
        <script>
            alert("Ensure you fill the form properly.");
        </script>
        <?php
    } else {


        $check_email = $conn->prepare("SELECT * FROM movie WHERE title = ?");
        $check_email->bind_param("s", $title);
        if ($check_email->execute()) {

            $res = $check_email->get_result();

            if ($res->num_rows == 1) {

                $row = $res->fetch_assoc();

                // $date = $showDate;
                $room = intval($roomType);
                $movieId = $row['movieId'];

                $stmt = $conn->prepare("UPDATE  movieshow SET movieId=?,roomId=?,startTime=?,endTime=?,showDate=? WHERE showId=?");
                $stmt->bind_param("iisssi", $movieId, $room, $startTime, $endTime, $showDate, $showId);


                if ($stmt->execute()) {
        ?>
                    <script>
                        alert("Congratulations.\nYou successfully updated movieshow <?php echo $title ?>.");
                        window.location = "adminPannel.php?page=seeShow";
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("fail to update .<?php $showId  ?>");
                        window.location = "adminPannel.php?page=addShow";
                    </script>
                <?php
                }
            } else { ?>
                <script>
                    alert("movie doesn't exists!");
                    window.location = "adminPannel.php?page=addShow";
                </script>

<?php
            }
        }
    }
}



# to delete show
if (isset($_POST['del_show'], $_POST['delete'])) {
    $delId = $_POST['del_show'];
    if ($conn->query("DELETE FROM movieshow WHERE showId=$delId")) {
        echo " <script>  alert('sucessfully deleted !');    </script>";
    } else {
        echo " <script>  alert(' not deleted !');    </script>";
    }
}









$sql = $conn->prepare("SELECT movie.title, movieshow.showId,movieshow.showDate,movieshow.startTime,movieshow.endTime,movieshow.movieId,movieshow.roomId, room.roomName
FROM( movie
INNER JOIN movieshow ON movie.movieId = movieshow.movieId  )INNER JOIN  room ON movieshow.roomId=room.roomId");

$sql->execute();
$result = $sql->get_result();

?>
<div class="table-responsive-sm">
    <table class="table table-bordered table-hover table-sm table-striped">
        <thead class="thead-dark">
            <tr>
                <td colspan="10" style="text-align:center;" class="bg-dark text-white">Movie show information</td>
            </tr>

            <tr>
                <th>Show Id</th>
                <th>movie title</th>
                <th>movie Id</th>
                <th>Show date</th>
                <th>Start time</th>
                <th>End time</th>
                <th>room name</th>
                <th>room Id</th>
                <th colspan="2">operation</th>

            </tr>
        </thead>

        <tbody>
            <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>

                    <tr>
                        <td><?php echo $row['showId'];  ?> </td>
                        <td><?php echo $row['title'];  ?> </td>
                        <td><?php echo $row['movieId'];  ?> </td>
                        <td><?php echo $row['showDate'];  ?> </td>
                        <td><?php echo $row['startTime'];  ?> </td>
                        <td><?php echo $row['endTime'];  ?> </td>
                        <td><?php echo $row['roomName'];  ?> </td>
                        <td><?php echo $row['roomId'];  ?> </td>
                        <form method="POST">
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['showId'] ?>">
                                    Edit
                                </button>
                            </td>

                            <td> <input type="hidden" class="form-control" name="del_show" value="<?php echo $row['showId'] ?>" required id="">
                                <button type="submit" name="delete" onclick="return confirm('Are you sure about this?')" class="btn btn-danger">
                                    Delete
                                </button>

                            </td>
                        </form>
                    </tr>

                    <div class="modal fade" id="edit<?php echo $row['showId'] ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editing <?php echo $row['title'];


                                                                    ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="align-middle row g-3" method="post" action="" enctype="multipart/form-data">

                                        <div class="mb-3 row">
                                            <label for="rname" class="col-sm-2 col-form-label">Movie title</label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="title" value="<?php echo $row['title'] ?>" name="movieTitle">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">

                                            <div class="col-sm-10"> <input type="text" class="form-control" id="title" value="<?php echo $row['showId'] ?>" hidden name="showId">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="rname" class="col-sm-2 col-form-label">show Date</label>
                                            <div class="col-sm-10"> <input type="date" class="form-control" id="release-date" value="<?php echo $row['showDate'] ?>" name="showDate">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="rname" class="col-sm-2 col-form-label">start time</label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="release-date" value="<?php echo $row['startTime'] ?>" name="startTime">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="rname" class="col-sm-2 col-form-label">End time</label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="release-date" value="<?php echo $row['endTime'] ?>" name="endTime">
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="genere" class="col-sm-2 col-form-label">Room type </label>
                                            <div class="col-sm-10">
                                                <select class="form-select" name="roomType">

                                                    <option <?php if ($row['roomId'] == 1) { ?> selected <?php  }  ?> value="1">action room</option>
                                                    <option <?php if ($row['roomId'] == 2) { ?> selected <?php  }  ?> value="2">Drama room</option>
                                                    <option <?php if ($row['roomId'] == 3) { ?> selected <?php  }  ?> value="3">Adventure room</option>
                                                    <option <?php if ($row['roomId'] == 4) { ?> selected <?php  }  ?> value="4">tragedy room</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="updateShow">updatae show</button> </div>

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
        <div class=" col-auto "><a href="adminPannel.php?page=addShow"> <button class="btn btn-link">add show </button></a> </div>
        <div class=" col-auto "><a href="adminPannel.php?page=addMovie"> <button class="btn btn-link">add movie </button></a> </div>
        <div class=" col-auto "><a href="adminPannel.php?page=seeMovie"> <button class="btn btn-link">see movie </button></a> </div>
    </div>


</div>