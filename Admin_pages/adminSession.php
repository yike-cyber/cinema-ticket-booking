 <?php
    @session_start();

    // $_SESSION['log']='';
    if (!isset($_SESSION['adminemail'], $_SESSION['adminfname'])) {
        echo "<script>alert('You are not logged in as admin!')
         window.location='../client_pages/loginPage.php'</script>
         ";
        exit;
    }
    if (empty($_SESSION['adminemail'] || $_SESSION['adminfname'])) {
        echo "<script>alert('You are not logged in as admin!')
         window.location='../client_pages/loginPage.php'</script>
         ";
        exit;
    }

    $adminfname = $_SESSION['adminfname'];
    $adminemail = $_SESSION['adminemail'];

    if (!isset($conn)) require '../common/connection.php';

    ?>