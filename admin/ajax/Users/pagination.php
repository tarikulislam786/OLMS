<?php
/ Make the script run only if there is a page number posted to this script
if(isset($_POST['pn'])){
	$rpp = preg_replace('#[^0-9]#', '', $_POST['rpp']);
	$last = preg_replace('#[^0-9]#', '', $_POST['last']);
	$pn = preg_replace('#[^0-9]#', '', $_POST['pn']);
	// This makes sure the page number isn't below 1, or more than our $last page
	if ($pn < 1) { 
    	$pn = 1; 
	} else if ($pn > $last) { 
    	$pn = $last; 
	}
	// Connect to our database here
	include_once("db_connection.php");
	// This sets the range of rows to query for the chosen $pn
	$limit = 'LIMIT ' .($pn - 1) * $rpp .',' .$rpp;
	// This is your query again, it is for grabbing just one page worth of rows by applying $limit
	$sql = "SELECT id, category_name, parent, status FROM categories ORDER BY id DESC $limit";
	$query = mysqli_query($db_conx, $sql);
	$dataString = '';
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$id = $row["id"];
		$categoryname = $row["category_name"];
		$parent = $row["parent"];
		$status = strftime("%b %d, %Y", strtotime($row["status"]));
		$dataString .= $id.'|'.$categoryname.'|'.$parent.'|'.$status.'||';
	}
	// Close your database connection
    mysqli_close($db_conx);
	// Echo the results back to Ajax
	echo $dataString;
	exit();
}
?>