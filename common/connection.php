<?php
$server = "localhost";
$username = "root";
$pass = "";
$dbase = "cinema";
$conn = new mysqli($server, $username, $pass, $dbase);
if ($conn->connect_error) {
?><script>
        alert("couldn't connect to database");
    </script>

<?php
}


?>