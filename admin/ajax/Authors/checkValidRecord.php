<?php
	if(isset($_POST['author_name']))
	{
		// include Database connection file 
		include("../../dbconnect.php");

		// get values 
		$author_name = $_POST['author_name'];
		$queryUnique = "Select author_name from authors where author_name='{$author_name}'";
		$uniqueResult = $conn->query($queryUnique);
		//$data = array();
		if($uniqueResult->fetch(PDO::FETCH_OBJ)){
			//$data['uniqueResult'] = "name is already exists please choose another name.";
			//echo json_encode($data['uniqueResult']);
			echo '<font color="red">The nickname <STRONG>'.$author_name.'</STRONG> is already in use.</font>';
			//exit;
		}else{
			echo 'OK';
	    }
	}



?>