
<script type='text/javascript'>
	function confirmDelete()
	{
		return confirm("Are you sure you want to delete this?");
	}
</script>

<?php
	// include Database connection file
	include("../../dbconnect.php");

	// Design initial table header
	$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
						<tr>
							<th>No.</th>
							<th class="text-center">Name</th>
							<th class="text-center">Email</th>
							<th class="text-center">Role</th>
							<th class="text-center">Phone</th>
							<th class="text-center">Update</th>
							<th class="text-center">Delete</th>
						</tr>';

	$query = "SELECT `id`, `first_name`, `last_name`, `email`, `role`, `phone` FROM users ORDER BY first_name ASC LIMIT 0, 10";

	$result= $conn->query($query);
    //exit(mysql_error());
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();
    //print_r($numrows);

//for pagination count page
$queryCountRows = "SELECT * from users";
$queryCountResult = $conn->query($queryCountRows);
$queryCountResult->setFetchMode(PDO::FETCH_ASSOC);
$countnumrows =$queryCountResult->rowCount();


    // if query results contains rows then featch those rows
    if($numrows > 0)
    {
    	$number = 1;
    	while($row = $result->fetch(PDO::FETCH_ASSOC))
    	{
			if($row['role']== '2'){
				$role = "Student";
			}elseif($row['role']== '3'){
				$role = "Teacher";
			}elseif($row['role']== '1'){
				$role = "Admin";
			}else{
					$role= "Librarian";
			}

    		$data .= '<tr>
				<td class="text-left">'.$number.'</td>
				<td class="text-center">'.$row['first_name'].' '.$row['last_name'].'</td>
				<td class="text-center">'.$row['email'].'</td>
				<td class="text-center">'.$role.'</td>
				<td class="text-center">'.$row['phone'].'</td>
				<td class="text-center">
					<a class="btn btn-info" href="user-edit.php?id='.$row["id"].'">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
		                Edit
            		</a>
				</td>
				<td class="text-center">
					<!--<a class="btn btn-danger" href="#" onclick="DeleteUser('.$row['id'].')">
		                <i class="glyphicon glyphicon-trash icon-white"></i>
		                Delete
            		</a>-->
            		<a  class="btn btn-danger" onclick="return confirmDelete()" href="delete-user.php?id='.$row["id"].'">
		                <i class="glyphicon glyphicon-trash icon-white"></i>
		                Delete
            		</a>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';

// pagination start
$totalpage =$countnumrows/10;
$totalpage =ceil($totalpage);
$currentpage    = (isset($_GET['page']) ? $_GET['page'] : 1);
$firstpage      = 1;
$lastpage       = $totalpage;
$loopcounter = ( ( ( $currentpage + 2 ) <= $lastpage ) ? ( $currentpage + 2 ) : $lastpage );
$startCounter =  ( ( ( $currentpage - 2 ) >= 3 ) ? ( $currentpage - 2 ) : 1 );

if($totalpage > 1)
{
	$data .= '<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">';
	$data .= '<ul class="pagination">';
	$data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="users-manage.php?page=1">First</a> </li>';
	for($i = $startCounter; $i <= $loopcounter; $i++)
	{
		//print_r($startCounter);exit;
		if($i==1){
			$defaultActive = "is-active";
		}else{
			$defaultActive = "";
		}
			$data .= '<li class="pagination-item '.$defaultActive.'"> <a class="pagination-link" href="users-manage.php?page='.$i.'">'.$i." ".'</a> </li>';

	}
	$data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="users-manage.php?page='.$totalpage.'">Last</a> </li>';
	$data  .= '</ul>';
	$data .= '</div>';
}
$data .= '</div>';
echo $data ;
?>