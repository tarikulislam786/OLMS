<?php
	if(isset($_POST['session_name']))
	{
		// include Database connection file 
		include("db_connection.php");

		// get values 
		$session_name = $_POST['session_name'];

		$query = "INSERT INTO sessions(session_name, created_at, updated_at) VALUES('$session_name', now(), now())";
		if (!$result = mysql_query($query)) {
	        exit(mysql_error());
	    }
	    echo "1 Record Added!";
	}
?>