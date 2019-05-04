<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $update_session_name = $_POST['update_session_name'];

    // Updaste User details
    $query = "UPDATE sessions SET session_name = '$update_session_name', updated_at = now() WHERE id = '$id'";
    if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }
}