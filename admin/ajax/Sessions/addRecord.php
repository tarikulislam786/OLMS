<?php
	if(isset($_POST['session_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$session_name = $_POST['session_name'];
		$queryUnique = "Select session_name from sessions where session_name='{$session_name}'";
			$uniqueResult = $conn->query($queryUnique);
			$data = array();
			if($uniqueResult->fetch(PDO::FETCH_OBJ)){
				$data['uniqueResult'] = "session is already exists please choose another session.";
				echo json_encode($data['uniqueResult']);
				exit;
			}else{
			$query = "INSERT INTO sessions(session_name, created_at, updated_at) VALUES('$session_name', now(), now())";
		/*if (!$result = mysql_query($query)) {
	        exit(mysql_error());
	    }*/
	    $conn->query($query);
	    //echo "1 Record Added!";
		}
		
		
	}
?>