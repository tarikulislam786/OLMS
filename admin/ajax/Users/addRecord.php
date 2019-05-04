<?php
	if(isset($_POST['author_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$author_name = $_POST['author_name'];
		$query = "INSERT INTO authors(author_name, created_at, updated_at) VALUES('$author_name', now(), now())";
		if (!$result = $conn->query($query)) {
	        //exit(mysql_error());
	    }
	    echo "1 Record Added!";
	}



?>