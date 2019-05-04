<?php
//include('../connect.php');

try {
    session_start();
    //unset($_SESSION['id']);
    //unset($_SESSION['username']);
    session_destroy();
    header("location:../login.php");
    //exit();
   // $conn = null;        // Disconnect
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>