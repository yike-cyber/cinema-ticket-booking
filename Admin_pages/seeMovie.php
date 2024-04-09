<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";





if (isset($_POST['updateMovie'])) {

    $status = 0;

    if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload'])) {
        $targetDir = "movies/";

        $fileName = $_FILES["fileToUpload"]["name"];
        $targetFilePath = $targetDir . $fileName;
        $fileType = $_FILES["fileToUpload"]["type"];
        $status = 1;


        $fileName = $_FILES["fileToUpload"]["name"];
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath);

        if (empty($fileName && $fileType)) {


            $fileName = $_POST['fileName'];
            $targetFilePath = $_POST['filePath'];
            $fileType = $_POST['fileType'];
            $status == 0;
        }
    }

    $title = $_POST['title'];
    $actor = $_POST['actor'];
    $movieId = $_POST['movieId'];
    $director = $_POST['director'];
    $releaseDate = $_POST['releaseDate'];
    // $posture = $_POST['posture'];
    $duration = $_POST['duration'];
    $gener = $_POST['gener'];
    $description = $_POST['description'];
    $country = $_POST['country'];
    $trailer = $_POST['trailer'];
    $language = $_POST['language'];
    $rating = $_POST['rating'];
    // if ($status == 1) {

    // }
    if (!isset($title, $actor, $director, $country, $duration, $releaseDate, $description, $trailer, $language, $director, $rating, $fileName, $fileType, $targetFilePath)) { ?>
        <script>
            alert("Ensure you fill the form properly.");
        </script>
        <?php
    } else  if ($status == 0 || $status == 1) {



        //Check if email exists
        $check_email = $conn->prepare("SELECT * FROM movie WHERE title = ? ");
        $check_email->bind_param("s", $title);
        $check_email->execute();
        $res = $check_email->store_result();
        $res = $check_email->num_rows();
        if ($res > 1) {
        ?>
            <script>
                alert("movie already exists!");
            </script>
            <?php

        } else {

            // $Date = date_create($releaseDate);
            $date = $releaseDate;
            $gener = intval($gener);

            $stmt = $conn->prepare("UPDATE movie SET title=?, actor=?,director=?,country=? , duration=?,filename=?, filepath=?, filetype=?,Date=?,language=?,generId=?,rating=?,description=?,trailer=? WHERE movieId=?");
            $stmt->bind_param("ssssssssssisssi", $title, $actor, $director, $country, $duration, $fileName, $targetFilePath, $fileType, $date, $language, $gener, $rating, $description, $trailer, $movieId);


            if ($stmt->execute()) {
            ?>
                <script>
                    alert("Congratulations.\nYou successfully updated movie <?php echo $title ?>.");
                    // window.location = "adminPannel.php?page=seeMovie";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("fail to add.");
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script>
            alert("unable to add posture !!");
        </script>
<?php

    }
} else {
    echo "<script>
            alert('error !!);
        </script>";
}


#to delete movie form the database

if (isset($_POST['del_movie'], $_POST['delete'])) {
    $delId = $_POST['del_movie'];
    if ($conn->query("DELETE FROM movie WHERE movieId=$delId")) {
        echo " <script>  alert('sucessfully deleted !');    </script>";
    } else {
        echo " <script>  alert(' not deleted !');    </script>";
    }
}






$sql = $conn->prepare("SELECT movie.movieId,movie.country, movie.title,movie.language,movie.director,movie.actor,movie.duration,movie.rating,movie.description,movie.Date,movie.filename,movie.filepath,movie.filetype,movie.trailer,movie.generId , gener.generName
FROM movie
INNER JOIN gener ON  movie.generId=gener.generId");

// $sql->execute();
// $result = $sql->get_result();

$sql->execute();
$result = $sql->get_result();


?>
<div class="table-responsive-sm table-responsive-lg table-responsive-xl">
    <table class="table table-bordered table-hover table-sm table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <td colspan="19" style="text-align:center;" class="bg-dark text-white">Movie information</td>
            </tr>

            <tr>
                <th>Movie Id</th>
                <th>Title</th>
                <th>language</th>
                <th>directors</th>
                <th>country</th>
                <th>actors</th>
                <th>duration</th>
                <th>rating(/10)</th>
                <th>Desctiption</th>
                <th>Released date</th>
                <th>file name</th>
                <th>file path</th>
                <th>file type</th>
                <th>trailer</th>
                <th>gener Id</th>
                <th>gener name</th>
                <th colspan="2">operation</th>
            </tr>
        </thead>

        <tbody>
            <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>

                    <tr>
                        <td><?php echo $row['movieId'];  ?> </td>
                        <td><?php echo $row['title'];  ?> </td>
                        <td><?php echo $row['language'];  ?> </td>
                        <td><?php echo $row['director'];  ?> </td>
                        <td><?php echo $row['country'];  ?> </td>
                        <td><?php echo $row['actor'];  ?> </td>
                        <td><?php echo $row['duration'];  ?> </td>
                        <td><?php echo $row['rating'];  ?> </td>
                        <td><?php echo $row['description'];  ?> </td>
                        <td><?php echo $row['Date'];  ?> </td>
                        <td><?php echo $row['filename'];  ?> </td>
                        <td><?php echo $row['filepath'];  ?> </td>
                        <td><?php echo $row['filetype'];  ?> </td>
                        <td><?php echo $row['trailer'];  ?> </td>
                        <td><?php echo $row['generId'];  ?> </td>
                        <td><?php echo $row['generName'];  ?> </td>
                        <form method="POST">
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['movieId'] ?>">
                                    Edit
                                </button>
                            </td>

                            <td> <input type="hidden" class="form-control" name="del_movie" value="<?php echo $row['movieId'] ?>" required id="">
                                <button type="submit" name="delete" onclick="return confirm('Are you sure about this?')" class="btn btn-danger">
                                    Delete
                                </button>

                            </td>
                        </form>
                    </tr>

                    <div class="modal fade" id="edit<?php echo $row['movieId'] ?>">
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
                                            <label for="title" class="col-sm-2 col-form-label">Movie Title</label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="mTitle" value="<?php echo $row['title'];    ?>" name="title">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-10"> <input type="number" hidden class="form-control" id="movieId" value="<?php echo $row['movieId'];    ?>" name="movieId">
                                            </div>
                                            <div class="col-sm-10"> <input type="text" hidden class="form-control" id="filename" value="<?php echo $row['filename']; ?>" name="fileName">
                                            </div>
                                            <div class="col-sm-10"> <input type="text" hidden class="form-control" id="filepath" value="<?php echo $row['filepath'];    ?>" name="filePath">
                                            </div>
                                            <div class="col-sm-10"> <input type="text" hidden class="form-control" id="filetype" value="<?php echo $row['filetype'];    ?>" name="fileType">
                                            </div>


                                        </div>
                                        <div class="mb-3 row">
                                            <label for="rname" class="col-sm-2 col-form-label">Release Date</label>
                                            <div class="col-sm-10"> <input type="date" class="form-control" id="release-date" value="<?php echo $row['Date']; ?>" name="releaseDate">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="director" class="col-sm-2 col-form-label">Director </label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="director" value="<?php echo $row['director'];    ?>" name="director">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="director" class="col-sm-2 col-form-label">Actors </label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="actor" value="<?php echo $row['actor'];    ?>" name="actor">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="director" class="col-sm-2 col-form-label">Country </label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="country" value="<?php echo $row['country']; ?>" name="country">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="director" class="col-sm-2 col-form-label">rating </label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="rating" value="<?php echo $row['rating'];    ?>" name="rating">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="director" class="col-sm-2 col-form-label">language</label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="language" value="<?php echo $row['language'];    ?>" name="language">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="genere" class="col-sm-2 col-form-label">Genere </label>
                                            <div class="col-sm-10">
                                                <select class="form-select" name="gener">

                                                    <option <?php if ($row['generId'] == 1) { ?> selected <?php   } ?>value="1">comedy</option>
                                                    <option <?php if ($row['generId'] == 2) { ?> selected <?php   } ?> value="2">Romantic</option>
                                                    <option <?php if ($row['generId'] == 3) { ?> selected <?php   } ?> value="3">comedy</option>
                                                    <option <?php if ($row['generId'] == 4) { ?> selected <?php   } ?> value="4">tragedy</option>
                                                    <option <?php if ($row['generId'] == 5) { ?> selected <?php   } ?> value="3">Drama</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="duration" class="col-sm-2 col-form-label">Duration </label>
                                            <div class="col-sm-10"> <input type="text" class="form-control" id="duration" value="<?php echo $row['duration'];    ?>" name=" duration">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="trailerlink" class="col-sm-2 col-form-label">Trailer link</label>
                                            <div class=" col-sm-10"> <input type="url" class="form-control" id="trailerlink" value="<?php echo $row['trailer']; ?>" name="trailer">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="movieposture" class="col-sm-2 col-form-label">Movie posture</label>
                                            <div class="mb-5 col-sm-10"><input type="file" name="fileToUpload" id="fileToUpload">

                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="3"><?php echo $row['description']; ?> </textarea>
                                        </div>

                                        <div class="row">

                                            <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="updateMovie">Update movie </button> </div>

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
        <div class=" col-auto "><a href="adminPannel.php?page=addMovie"> <button class="btn btn-link">add movie </button></a> </div>
        <div class=" col-auto "><a href="adminPannel.php?page=addShow"> <button class="btn btn-link">add show </button></a> </div>
        <div class=" col-auto "><a href="adminPannel.php?page=seeShow"> <button class="btn btn-link">see show </button></a> </div>

    </div>

</div>