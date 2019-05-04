<?php
	// include Database connection file 
	include("db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-striped table-bordered" id="example">
						<tr>
							<th>No.</th>
							<th class="text-center">Category Name</th>
							<th class="text-center">Parent</th>
							<th class="text-center">Status</th>
							<th class="text-center">Update</th>
							<th class="text-center">Delete</th>
						</tr>';

	$query = "SELECT * FROM categories";

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
				<td class="text-center">'.$row['category_name'].'</td>
				<td class="text-center">'.$row['parent'].'</td>
				<td class="text-center"><span class="label-success label label-default">'.$row['status'].'</span></td>
				<td class="text-center">
					<a class="btn btn-info" href="#" onclick="GetUserDetails('.$row['id'].')">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
		                Edit
            		</a>
            
				</td>
				<td class="text-center">
					<a class="btn btn-danger" href="#" onclick="DeleteUser('.$row['id'].')">
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

    $data .= '</table><ul class="pagination pagination-centered">
                        <li><a href="#">Prev</a></li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>';

    echo $data;
?>