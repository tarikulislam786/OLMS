<?php
	
	// Discipline name availability
	if(isset($_POST['discipline_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$discipline_name = $_POST['discipline_name'];
		$queryNameUnique = "Select name from disciplines where name='{$discipline_name}'";
		$uniqueNameResult = $conn->query($queryNameUnique);
		//$data = array();
		if($uniqueNameResult->fetch(PDO::FETCH_OBJ)){
			//$data['uniqueResult'] = "name is already exists please choose another name.";
			//echo json_encode($data['uniqueResult']);
			echo '<font color="red">Discipline name <STRONG>'.$discipline_name.'</STRONG> is already in use.</font>';
			//exit;
		}else{
			echo 'OK';
	    }
	}
// Discipline short name availability
	if(isset($_POST['short_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$short_name = $_POST['short_name'];
		$queryShortNameUnique = "Select short_name from disciplines where short_name='{$short_name}'";
		$uniqueShortNameResult = $conn->query($queryShortNameUnique);
		//$data = array();
		if($uniqueShortNameResult->fetch(PDO::FETCH_OBJ)){
			//$data['uniqueResult'] = "name is already exists please choose another name.";
			//echo json_encode($data['uniqueResult']);
			echo '<font color="red">Short name <STRONG>'.$short_name.'</STRONG> is already in use.</font>';
			//exit;
		}else{
			echo 'OK';
	    }
	}



?>