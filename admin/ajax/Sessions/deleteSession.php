<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../dbconnect.php");

    // get user id
    $session_id = $_POST['id'];

    // delete User
    $query = "DELETE FROM sessions WHERE id = '$session_id'";
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $conn->query($query);
}
?>