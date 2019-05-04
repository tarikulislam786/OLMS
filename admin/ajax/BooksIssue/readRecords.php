<?php
	// include Database connection file
	include("../../dbconnect.php");

	// Design initial table header
	$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">#SID/TEID</th>
							<th class="text-center">Name</th>
							<th class="text-center">Issued Date</th>
							<th class="text-center">Total Books</th>
							<th class="text-center">Submitted Date</th>
							<th class="text-center">Update</th>
							<th class="text-center">Delete</th>
						</tr>';

	$query = "SELECT id, student_id, issue_date, name, issue_details, submitted_date FROM book_issues ORDER BY student_id ASC LIMIT 0, 10";
$result= $conn->query($query);
    //exit(mysql_error());
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();
   // print_r($numrows);
//for pagination count page
    $queryCountRows = "SELECT * from book_issues";
    $queryCountResult = $conn->query($queryCountRows);
    $queryCountResult->setFetchMode(PDO::FETCH_ASSOC);
    $countnumrows =$queryCountResult->rowCount();

    // if query results contains rows then featch those rows
    if($numrows > 0)
    {
		$number = 1;
    	while($row = $result->fetch(PDO::FETCH_ASSOC))
    	{
    		//print_r(unserialize(base64_decode($row['issue_details'])));
    		//$id = $row['id'];print_r($id);
    		$BookIssueDetails = $row['issue_details'];//print_r($BookIssueDetails);
    		 $UnserializeBookIssueDetails = unserialize(base64_decode($BookIssueDetails));//print_r($UnserializeBookIssueDetails);

 			//Count total issued books
			$totalBooks = count(array_filter($UnserializeBookIssueDetails["isbnnumber"]));

			if($row['submitted_date'] == '0000-00-00'){
				$submitted_date = "Not Submitted";
			}else{
				$submitted_date = $row['submitted_date'];
			}

    		$data .= '<tr>
				<td class="text-center">'.$number.'</td>';
				if($row['student_id']== 0){
					$data .= '<td class="text-center">'.$UnserializeBookIssueDetails['teacherEmail'].'</td>';
				}else{

					$data .= '<td class="text-center">'.$row['student_id'].'</td>';
				}
				
				$data .= '<td class="text-center">'.$row['name'].'</td>
				<td class="text-center">'.$row['issue_date'].'</td>
				<td class="text-center">'.$totalBooks.'</td>
				<td class="text-center">'.$submitted_date.'</td>';
				if($row['student_id']!= 0){
				$data .= '<td class="text-center">
					<a class="btn btn-info" href="bookissue-edit.php?id='.$row['id'].'" onclick="">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
					Receive
            		</a>

				</td>';
				}else{
					$data .= '<td class="text-center">
					<a class="btn btn-info" href="bookissueteacher-edit.php?id='.$row['id'].'" onclick="">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
					Receive
            		</a>

				</td>';
				}



			$data .= '<td class="text-center">
					<a class="btn btn-danger" href="#" onclick="DeleteBookIssueDetails('.$row['id'].')">
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
    	$data .= '<tr><td colspan="7">Records not found!</td></tr>';
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
	$data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="bookissue-manage.php?page=1">First</a> </li>';
	for($i = $startCounter; $i <= $loopcounter; $i++)
	{
		if($i==1){
			$defaultActive = "is-active";
		}else{
			$defaultActive = "";
		}
		$data .= '<li class="pagination-item '.$defaultActive.'"> <a class="pagination-link" href="bookissue-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
	}
	$data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="bookissue-manage.php?page='.$totalpage.'">Last</a> </li>';
	$data  .= '</ul>';
	$data .= '</div>';
}
$data .= '</div>';
echo $data ;
    ?>