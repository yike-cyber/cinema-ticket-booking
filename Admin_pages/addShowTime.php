<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";
?>

<?php

if (isset($_POST['addShow'])) {

    $title = $_POST['movieTitle'];
    $showDate = $_POST['showDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $roomType = $_POST['roomType'];



    if (!isset($title, $showDate, $startTime, $endTime, $roomType)) { ?>
        <script>
            alert("Ensure you fill the form properly.");
        </script>
        <?php
    } else {


        $check_movie = $conn->prepare("SELECT * FROM movie WHERE title = ?");
        $check_movie->bind_param("s", $title);
        if ($check_movie->execute()) {

            $res = $check_movie->get_result();

            if ($res->num_rows == 1) {

                $row = $res->fetch_assoc();


                $movieId = $row['movieId'];


                $stmt = $conn->prepare("INSERT INTO movieshow (movieId,roomId,startTime,endTime,showDate) VALUES (?,?,?,?,?)");
                $stmt->bind_param("iisss", $movieId, $roomType, $startTime, $endTime, $showDate);


                if ($stmt->execute()) {
        ?>
                    <script>
                        alert("Congratulations.\nYou successfully added movieshow <?php echo $title ?>.");
                        window.location = "adminPannel.php?page=addShow";
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("fail to add.<?php $movieId ?>");
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



?>




<!-- film upload -->
<div class="container-lg mt-4 ">
    <div class="align-middle bg-light pt-4">
        <h4 class="text-center fw-bold text-primary"> upload movie</h4>
        <h3 class="mb-5 text-center text-warning fw-bold "></h3>
        <form class="align-middle row g-3" method="post" action="" enctype="multipart/form-data">

            <div class="mb-3 row">
                <label for="rname" class="col-sm-2 col-form-label">Movie title</label>
                <div class="col-sm-10"> <input type="text" class="form-control" id="title" placeholder="ente movie title" name="movieTitle">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rname" class="col-sm-2 col-form-label">show Date</label>
                <div class="col-sm-10"> <input type="date" class="form-control" id="release-date" placeholder="enter show date" name="showDate">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="rname" class="col-sm-2 col-form-label">start time</label>
                <div class="col-sm-10"> <input type="text" class="form-control" id="release-date" placeholder="enter starting" name="startTime">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rname" class="col-sm-2 col-form-label">End time</label>
                <div class="col-sm-10"> <input type="text" class="form-control" id="release-date" placeholder="enter end time" name="endTime">
                </div>
            </div>


            <div class="mb-3 row">
                <label for="genere" class="col-sm-2 col-form-label">Room type </label>
                <div class="col-sm-10">
                    <select class="form-select" name="roomType">

                        <option value="1">action room</option>
                        <option value="2">Drama room</option>
                        <option value="3">comedy room</option>
                        <option value="4">tragedy room</option>

                    </select>
                </div>
            </div>


            <div class="row">

                <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="addShow">Add show</button> </div>

                <div class="col-auto "> <button type="reset" class="btn btn-danger mb-3 ">clear form</button> </div>

            </div>
        </form>
        <div class="row mb-3">
            <div class=" col-auto "><a href="adminPannel.php?page=seeMovie"> <button class="btn btn-link">see movie </button></a> </div>
            <div class=" col-auto "><a href="adminPannel.php?page=seeShow"> <button class="btn btn-link">see show </button></a> </div>
        </div>


    </div>
</div>
<!--  -->



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