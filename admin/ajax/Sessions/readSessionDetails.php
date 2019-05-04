<?php
// include Database connection file
include("../../dbconnect.php");

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $session_id = $_POST['id'];

    // Get User Details
    $query = "SELECT * FROM sessions WHERE id = '$session_id'";
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $result = $conn->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();
    
    $response = array();
    if($numrows > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    // display JSON data
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}