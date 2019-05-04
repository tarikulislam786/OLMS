<?php
	// include Database connection file 
	include("db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
						<tr>
							<th>No.</th>
							<th class="text-center">Session Name</th>
							<th class="text-center">Update</th>
							<th class="text-center">Delete</th>
						</tr>';

	$query = "SELECT * FROM sessions";

	if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }

    // if query results contains rows then featch those rows 
    if(mysql_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysql_fetch_assoc($result))
    	{
    		$data .= '<tr>
				<td class="text-left">'.$number.'</td>
				<td class="text-center">'.$row['session_name'].'</td>
				<td class="text-center">
					<a class="btn btn-info" href="#" onclick="GetSessionDetails('.$row['id'].')">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
		                Edit
            		</a>
            
				</td>
				<td class="text-center">
					<a class="btn btn-danger" href="#" onclick="DeleteSession('.$row['id'].')">
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

    echo $data;
?>