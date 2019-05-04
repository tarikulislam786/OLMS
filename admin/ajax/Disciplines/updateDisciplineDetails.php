<?php
// include Database connection file
include("../../dbconnect.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $update_discipline_name = $_POST['update_discipline_name'];
    $update_short_name = $_POST['update_short_name'];

    // Updaste User details
    $query = "UPDATE disciplines SET name = '$update_discipline_name', short_name = '$update_short_name', updated_at = now() WHERE id = '$id'";
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $conn->query($query);
}