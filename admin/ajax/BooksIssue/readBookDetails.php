<?php
// include Database connection file
include("../../dbconnect.php");

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $book_id = $_POST['id'];

    // Get User Details
    $query = "SELECT books.id,book_name, author_id, category_id, isbn_number, price, piece_of_books, category_name,author_name FROM books 
    INNER JOIN categories ON books.category_id=categories.id 
    INNER JOIN authors ON books.author_id=authors.id WHERE books.id='$book_id'";
    /*if (!$result = $conn->query($query)) {
        //exit(mysql_error());
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