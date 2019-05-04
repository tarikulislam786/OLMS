<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../dbconnect.php");

    // get user id
    $author_id = $_POST['id'];

    // delete User
    $query = "DELETE FROM authors WHERE author_id = '$author_id'";
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $conn->query($query);
}
?>