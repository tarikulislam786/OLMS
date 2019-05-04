<?php
	if(isset($_POST['name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$discipline_name = $_POST['name'];
		$short_name = $_POST['short_name'];
		$data = array();
		$queryNameUnique = "Select name from disciplines where name='{$discipline_name}'";
		$uniqueNameResult = $conn->query($queryNameUnique);
		$queryShortNameUnique = "Select short_name from disciplines where short_name='{$short_name}'";
		$uniqueShortNameResult = $conn->query($queryShortNameUnique);
		
		if($uniqueNameResult->fetch(PDO::FETCH_OBJ)){
			$data['uniqueNameResult'] = "name is already exists please choose another name.";
			echo json_encode($data['uniqueNameResult']);
			exit;
		}

		if($uniqueShortNameResult->fetch(PDO::FETCH_OBJ)){
			$data['uniqueShortNameResult'] = "short name is already exists please choose another short name.";
			echo json_encode($data['uniqueShortNameResult']);
			exit;
		}

		$query = "INSERT INTO disciplines(name, short_name, created_at, updated_at) VALUES('$discipline_name', '$short_name', now(), now())";
		$conn->query($query);
	
	    echo "Discipline added successful.";
	}



?>