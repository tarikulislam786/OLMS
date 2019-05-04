<?php
// include Database connection file
include("../../dbconnect.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $update_book_name = $_POST['update_book_name'];
    $update_category_name = $_POST['update_category_name'];
    $update_author = $_POST['update_author'];
    $update_isbn = $_POST['update_isbn'];
    $update_price = $_POST['update_price'];
    $update_piece_of_books = $_POST['update_piece_of_books'];

    // Updaste User details
    $query = "UPDATE books SET book_name='$update_book_name', category_id='$update_category_name',
     author_id = '$update_author', isbn_number = '$update_isbn', price = '$update_price',
     piece_of_books='$update_piece_of_books', updated_at = now() WHERE id = '$id'";
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $conn->query($query);
}