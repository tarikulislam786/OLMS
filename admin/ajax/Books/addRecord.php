<?php
	if(isset($_POST['book_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

    		// get values
        $book_name=$_POST["book_name"];
        $category_name=$_POST["category_name"];
        $author= $_POST["author"]; // existing author
        $author_name = $_POST["author_name"]; // newly added author
        $isbn = $_POST["isbn"];
        $price = $_POST["price"];
        $piece_of_books = $_POST["piece_of_books"];

        $data = array();
        
        $queryUniqueBookName = "Select book_name from books where book_name='{$book_name}'";
        $queryUniqueBookISBN = "Select isbn_number from books where isbn_number='{$isbn}'";
        
        $uniqueBookNameResult = $conn->query($queryUniqueBookName);
        $uniqueBookISBNResult = $conn->query($queryUniqueBookISBN);
        //$data = array();
        if($uniqueBookNameResult->fetch(PDO::FETCH_OBJ)){
           $data['uniqueBookNameResult'] = "book is already exists please choose another book.";
           echo json_encode($data['uniqueBookNameResult']);
           exit;
        }
        
        if($uniqueBookISBNResult->fetch(PDO::FETCH_OBJ)){
           $data['uniqueBookISBNResult'] = "isbn is already exists please choose another isbn.";
           echo json_encode($data['uniqueBookISBNResult']);
           exit;
        }

        if(isset($author_name) && !empty($author_name))
        {
            $queryUniqueAuthorName = "Select author_name from authors where author_name='{$author_name}'";
            $uniqueAuthorNameResult = $conn->query($queryUniqueAuthorName);
            if($uniqueAuthorNameResult->fetch(PDO::FETCH_OBJ)){
               $data['uniqueAuthorNameResult'] = "author is already exists please select from above dropdown.";
               echo json_encode($data['uniqueAuthorNameResult']);
               exit;
            }else{
              $sqlAuthor = "INSERT INTO `authors` (`author_name`,  `created_at`, `updated_at`)
              VALUES('$author_name', now(), now())";
              $count = $conn->exec($sqlAuthor);
              $author = $conn->lastInsertId(); // If use the new author
            } 
        }
        // Define an insert query
        $sql = "INSERT INTO `books` (`book_name`, `category_id`, `author_id`, `isbn_number`, `price`, `piece_of_books`,   `created_at`, `updated_at`)
        VALUES('$book_name','$category_name', '$author', '$isbn', '$price', '$piece_of_books', now(), now())";//print_r($sql);exit;
        $count = $conn->exec($sql);//print_r($count);exit;
        
        //echo 'Added Successful.';
	       echo "Book added successful!";
	}



?>