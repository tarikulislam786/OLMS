<?php
// include Database connection file
include("../../dbconnect.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $update_author_name = $_POST['update_author_name'];

    // Updaste User details
    $query = "UPDATE authors SET author_name = '$update_author_name', updated_at = now() WHERE author_id = '$id'";
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $conn->query($query);
}