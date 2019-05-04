<?php
	if(isset($_POST['session_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$session_name = $_POST['session_name'];
		$queryUnique = "Select session_name from sessions where session_name='{$session_name}'";
		$uniqueResult = $conn->query($queryUnique);
		//$data = array();
		if($uniqueResult->fetch(PDO::FETCH_OBJ)){
			//$data['uniqueResult'] = "name is already exists please choose another name.";
			//echo json_encode($data['uniqueResult']);
			echo '<font color="red">The session <STRONG>'.$session_name.'</STRONG> is already in use.</font>';
			//exit;
		}else{
			echo 'OK';
	    }
	}

?>