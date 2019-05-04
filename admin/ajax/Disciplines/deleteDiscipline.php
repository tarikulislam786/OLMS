<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../dbconnect.php");

    // get user id
    $discipline_id = $_POST['id'];

    // delete User
    $query = "DELETE FROM disciplines WHERE id = '$discipline_id'";
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $conn->query($query);
}
?>