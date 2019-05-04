<?php
	// include Database connection file
	include("../../dbconnect.php");

	// Design initial table header
	$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
						<tr>
							<th>No.</th>
							<th class="text-center">Book Name</th>
							<th class="text-center">Author</th>
							<th class="text-center">Category</th>
							<th class="text-center">ISBN</th>
							<th class="text-center">Piece of Books</th>
							<th class="text-center">Price</th>
							<th class="text-center">Update</th>
							<th class="text-center">Delete</th>
						</tr>';
	//$query = "SELECT books.book_id,book_name,isbn_number, piece_of_books, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN authors ON books.author_id=authors.id ORDER BY book_name ASC LIMIT 0, 10";
$query = "SELECT books.book_id,book_name,isbn_number, piece_of_books, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN books_author ON books.book_id=books_author.book_id INNER JOIN authors ON books_author.author_id=authors.author_id ORDER BY book_name ASC LIMIT 0, 10";
//SELECT books.book_name,isbn_number, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id =categories.id INNER JOIN authors ON books.author_id = authors.id ORDER BY book_name ASC
//$query = "SELECT `id`, `author_name` FROM authors";
$result= $conn->query($query);
    //exit(mysql_error());
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();
    //print_r($numrows);
//for pagination count page
    $queryCountRows = "SELECT * from books";
    $queryCountResult = $conn->query($queryCountRows);
    $queryCountResult->setFetchMode(PDO::FETCH_ASSOC);
    $countnumrows =$queryCountResult->rowCount();

    // if query results contains rows then featch those rows
    if($numrows > 0)
    {
    	$number = 1;
    	while($row = $result->fetch(PDO::FETCH_ASSOC))
    	{
    		if($row['piece_of_books']<1){
			$data .= '<tr class="eachrow">
				<td class="text-left" style="color:#f00">'.$number.'</td>
				<td class="text-center" style="color:#f00">'.$row['book_name'].'</td>
				<td class="text-center" style="color:#f00">'.$row['author_name'].'</td>
				<td class="text-center" style="color:#f00">'.$row['category_name'].'</td>
				<td class="text-center" style="color:#f00">'.$row['isbn_number'].'</td>
				<td class="text-center" style="color:#f00">'.$row['piece_of_books'].'</td>
				<td class="text-center" style="color:#f00">'.$row['price'].'</td>
				<td class="text-center" style="color:#f00">
					<a class="btn btn-info" href="#" onclick="GetBookDetails('.$row['book_id'].')">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
		                Edit
            		</a>

				</td>
				<td class="text-center" style="color:#f00">
					<a class="btn btn-danger" href="#" onclick="DeleteBook('.$row['book_id'].')">
		                <i class="glyphicon glyphicon-trash icon-white"></i>
		                Delete
            		</a>
				</td>
    		</tr>';
    		}else{
			$data .= '<tr class="eachrow">
				<td class="text-left">'.$number.'</td>
				<td class="text-center">'.$row['book_name'].'</td>
				<td class="text-center">'.$row['author_name'].'</td>
				<td class="text-center">'.$row['category_name'].'</td>
				<td class="text-center">'.$row['isbn_number'].'</td>
				<td class="text-center">'.$row['piece_of_books'].'</td>
				<td class="text-center">'.$row['price'].'</td>
				<td class="text-center">
					<a class="btn btn-info" href="#" onclick="GetBookDetails('.$row['book_id'].')">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
		                Edit
            		</a>

				</td>
				<td class="text-center">
					<a class="btn btn-danger" href="#" onclick="DeleteBook('.$row['book_id'].')">
		                <i class="glyphicon glyphicon-trash icon-white"></i>
		                Delete
            		</a>
				</td>
    		</tr>';
    		}
    		
    		$number++;
    	}
    }
    else
    {
    	// records now found
    	$data .= '<tr class="eachrow"><td colspan="6">Records not found!</td></tr>';
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
	$data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="books-manage.php?page=1">First</a> </li>';
	for($i = $startCounter; $i <= $loopcounter; $i++)
	{
		if($i== 1){
			$defaultActive = "is-active";
		}else{
			$defaultActive = "";
		}
		$data .= '<li class="pagination-item '.$defaultActive.'"> <a class="pagination-link" href="books-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
	}
	$data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="books-manage.php?page='.$totalpage.'">Last</a> </li>';
	$data  .= '</ul>';
	$data .= '</div>';
}
$data .= '</div>';
echo $data ;


    ?>