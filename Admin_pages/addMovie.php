<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";
?>

<?php

if (isset($_POST['addMovie'])) {

  $targetDir = "movies/"; // Specify the folder where files will be stored
  $fileName = $_FILES["fileToUpload"]["name"];
  $targetFilePath = $targetDir . $fileName;
  $fileType = $_FILES["fileToUpload"]["type"];



  $title = $_POST['title'];
  $actor = $_POST['actor'];
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
  if (file_exists($targetFilePath)) { ?>
    <script>
      alert("file exist in movie/folder.");
    </script>
  <?php
    $uploadOk = 0;
  } else if (!isset($title, $actor, $director, $country, $duration, $releaseDate, $description, $trailer, $language, $director, $rating, $fileName, $fileType, $targetFilePath)) { ?>
    <script>
      alert("Ensure you fill the form properly.");
    </script>
    <?php
  } else 

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {



    //Check if email exists
    $check_email = $conn->prepare("SELECT * FROM movie WHERE title = ? ");
    $check_email->bind_param("s", $title);
    $check_email->execute();
    $res = $check_email->store_result();
    $res = $check_email->num_rows();
    if ($res > 0) {
    ?>
      <script>
        alert("movie already exists!");
      </script>
      <?php

    } else {

      // $Date = date_create($releaseDate);
      $date = $releaseDate;
      $gener = intval($gener);

      $stmt = $conn->prepare("INSERT INTO movie (title, actor,director,country , duration,filename, filepath, filetype,Date,language,generId,rating,description,trailer) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("ssssssssssisss", $title, $actor, $director, $country, $duration, $fileName, $targetFilePath, $fileType, $date, $language, $gener, $rating, $description, $trailer);


      if ($stmt->execute()) {
      ?>
        <script>
          alert("Congratulations.\nYou successfully added movie <?php echo $title ?>.");
          window.location = "adminPannel.php?page=addMovie";
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
}


?>




<!-- film upload -->
<div class="container-lg mt-4 ">
  <div class="align-middle bg-light pt-4">
    <h4 class="text-center fw-bold text-primary"> upload movie</h4>
    <h3 class="mb-5 text-center text-warning fw-bold "></h3>
    <form class="align-middle row g-3" method="post" action="" enctype="multipart/form-data">

      <div class="mb-3 row">
        <label for="title" class="col-sm-2 col-form-label">Movie Title</label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="mTitle" placeholder="enter movie title" name="title">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="rname" class="col-sm-2 col-form-label">Release Date</label>
        <div class="col-sm-10"> <input type="date" class="form-control" id="release-date" placeholder="enter release date" name="releaseDate">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="director" class="col-sm-2 col-form-label">Director </label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="director" placeholder="enter Director's name" name="director">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="director" class="col-sm-2 col-form-label">Actors </label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="actor" placeholder="enter actors .." name="actor">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="director" class="col-sm-2 col-form-label">Country </label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="country" placeholder="enter country..." name="country">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="director" class="col-sm-2 col-form-label">rating </label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="rating" placeholder="movie rating..." name="rating">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="director" class="col-sm-2 col-form-label">language</label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="language" placeholder="language of film" name="language">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="genere" class="col-sm-2 col-form-label">Genere </label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="gener">
            <option>Action</option>
            <option value="1">comedy</option>
            <option value="2">Romantic</option>
            <option value="3">comedy</option>
            <option value="3">tragedy</option>
            <option value="3">Drama</option>
          </select>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="duration" class="col-sm-2 col-form-label">Duration </label>
        <div class="col-sm-10"> <input type="text" class="form-control" id="duration" placeholder="enter movie's length in hours " name="duration">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="trailerlink" class="col-sm-2 col-form-label">Trailer link</label>
        <div class=" col-sm-10"> <input type="url" class="form-control" id="trailerlink" placeholder="traler's youtube link " name="trailer">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="movieposture" class="col-sm-2 col-form-label">Movie posture</label>
        <div class="mb-5 col-sm-10"><input type="file" name="fileToUpload" id="fileToUpload">
        </div>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" placeholder="Description about the movie" rows="3" required></textarea>
      </div>

      <div class="row">

        <div class=" col-auto "> <button type="submit" class="btn btn-primary mb-3 " name="addMovie">Add movie </button> </div>

        <div class="col-auto "> <button type="reset" class="btn btn-danger mb-3 ">clear form</button> </div>

      </div>
    </form>
    <div class="row mb-3">
      <div class=" col-auto "><a href="adminPannel.php?page=seeMovie"> <button class="btn btn-link">see movie </button></a> </div>
      <div class=" col-auto "><a href="adminPannel.php?page=addShow"> <button class="btn btn-link">add show </button></a> </div>
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