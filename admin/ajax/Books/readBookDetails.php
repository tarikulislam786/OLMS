<?php
// include Database connection file
include("../../dbconnect.php");

// check request
if(isset($_POST['book_id']) && isset($_POST['book_id']) != "")
{
    // get User ID
    $book_id = $_POST['book_id'];

    // Get User Details
  /*  $query = "SELECT books.book_id,book_name, category_id, isbn_number, price, piece_of_books, category_name,author_name FROM books
    INNER JOIN categories ON books.category_id=categories.id 
    INNER JOIN authors ON books.author_id=authors.id WHERE books.id='$book_id'"; */

    $query = "SELECT books.book_id,books.category_id, books_author.author_id, book_name,isbn_number,price, piece_of_books, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN books_author ON books.book_id=books_author.book_id INNER JOIN authors ON books_author.author_id=authors.author_id WHERE books.book_id='$book_id'";

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