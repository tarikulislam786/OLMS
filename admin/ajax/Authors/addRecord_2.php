<?php
	if(isset($_POST['author_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$author_name = $_POST['author_name'];
		$queryUnique = "Select author_name from authors where author_name='{$author_name}'";
		$uniqueResult = $conn->query($queryUnique);
		$data = array();
		if($uniqueResult->fetch(PDO::FETCH_OBJ)){
			$data['uniqueResult'] = "name is already exists please choose another name.";
			echo json_encode($data['uniqueResult']);
			exit;
		}else{
		$query = "INSERT INTO authors(author_name, created_at, updated_at) VALUES('$author_name', now(), now())";
		$conn->query($query);
	        //exit(mysql_error());
	    }
	}



?>