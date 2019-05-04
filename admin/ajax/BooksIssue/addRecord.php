<?php
	if(isset($_POST['author_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values
		$author_name = $_POST['author_name'];
		$book_name=$_POST["book_name"];
        $category_name=$_POST["category_name"];
        $author= $_POST["author"];
        $author_name = $_POST["author_name"];
        $isbn = $_POST["isbn"];
        $price = $_POST["price"];
        $piece_of_books = $_POST["piece_of_books"];
		if(isset($author_name) && !empty($author_name))
        {
            $sqlAuthor = "INSERT INTO `authors` (`author_name`,  `created_at`, `updated_at`)
        VALUES('$author_name', now(), now())";
        $count = $conn->exec($sqlAuthor);
        $author = $conn->lastInsertId(); // If use the new author
        }
        // Define an insert query
        $sql = "INSERT INTO `books` (`book_name`, `category_id`, `author_id`, `isbn_number`, `price`, `piece_of_books`,   `created_at`, `updated_at`)
        VALUES('$book_name','$category_name', '$author', '$isbn', '$price', '$piece_of_books', now(), now())";//print_r($sql);exit;
        $count = $conn->exec($sql);//print_r($count);exit;
        
        //echo 'Added Successful.';
	    echo "1 Record Added!";
	}



?>