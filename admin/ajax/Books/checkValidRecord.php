<?php
	// book name availability
	if(isset($_POST['book_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$book_name = $_POST['book_name'];
		$queryBookUnique = "Select book_name from books where book_name='{$book_name}'";
		$uniqueBookResult = $conn->query($queryBookUnique);
		//$data = array();
		if($uniqueBookResult->fetch(PDO::FETCH_OBJ)){
			//$data['uniqueResult'] = "name is already exists please choose another name.";
			//echo json_encode($data['uniqueResult']);
			echo '<font color="red">The book name <STRONG>'.$book_name.'</STRONG> is already in use.</font>';
			//exit;
		}else{
			echo 'OK';
	    }
	}

	// author name availability
	if(isset($_POST['author_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$author_name = $_POST['author_name'];
		$queryAuthorUnique = "Select author_name from authors where author_name='{$author_name}'";
		$uniqueAuthorResult = $conn->query($queryAuthorUnique);
		//$data = array();
		if($uniqueAuthorResult->fetch(PDO::FETCH_OBJ)){
			//$data['uniqueResult'] = "name is already exists please choose another name.";
			//echo json_encode($data['uniqueResult']);
			echo '<font color="red">The author name <STRONG>'.$author_name.'</STRONG> is already in use please select from above.</font>';
			//exit;
		}else{
			echo 'OK';
	    }
	}

	// isbn number availability
	if(isset($_POST['isbn_number']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$isbn_number = $_POST['isbn_number'];
		$queryIsbnUnique = "Select isbn_number from books where isbn_number='{$isbn_number}'";
		$uniqueIsbnResult = $conn->query($queryIsbnUnique);
		//$data = array();
		if($uniqueIsbnResult->fetch(PDO::FETCH_OBJ)){
			//$data['uniqueResult'] = "name is already exists please choose another name.";
			//echo json_encode($data['uniqueResult']);
			echo '<font color="red">The isbn <STRONG>'.$book_name.'</STRONG> is already in use.</font>';
			//exit;
		}else{
			echo 'OK';
	    }
	}



?>