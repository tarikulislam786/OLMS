
<?php
ob_start(); // redirecting problem solved
require "dbconnect.php";
include('header.php');
try
{
    $data='';
    if(isset($_GET["txtbook"]) && !empty($_GET["txtbook"]))
    {//print_r($_GET["txtbook"]);exit();
        //$name="%".$_GET["txtbook"]."%";
        $data = '<div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Books</a>
                </li>
            </ul>
        </div>';


        $data .= '<div class="row">
            <div class="box col-md-12">
            <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> Books Listing</h2>
            </div>
            <div class="container-fluid">

                <div class="row">
                    <form class="form-inline" style="margin:20px 20px" method="GET" action="search.php">
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">Name</span>
                            <input type="text" class="form-control" placeholder="" name="txtbook" value="">
                        </div>
                        <div class="input-group col-md-1"></div>
                        <div class="input-group col-md-3">

                                <select class="form-control" name="author_id">
                                    <option label="select author"></option>';

        $names = $conn->query("select `author_id`, `author_name` from `authors`");//print_r($names);//exit();
        foreach($names as $name) {
            $data .= '<option value="'.$name["author_id"].'">'.$name["author_name"].'</option>';
        }
        $data .= '</select>
                        </div>';
        $data .= '<div class="input-group col-md-1"></div>
                        <div class="input-group col-md-3">

                               <select name="category_id" id="category_id" class="form-control">
                                        <option label="select category"></option>';

        $categories = $conn->query("select `id`, `category_name` from `categories`");
        foreach($categories as $category) {
            $data .= '<option value="'.$category["id"].'">'.$category["category_name"].'</option>';
        }
        $data .= '</select>
                        </div>
                        <button onclick="" id="searchByName"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                </div>

            </div>';
        $data .= '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                    <tr>
                      <th>No.</th>
                      <th class="text-center">Book Name</th>
                      <th class="text-center">Author</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">ISBN</th>
                      <th class="text-center">Price</th>
                      <th class="text-center">Update</th>
                      <th class="text-center">Delete</th>
                    </tr>';

        //$stmt = $conn->prepare("SELECT id, book_name FROM books where book_name LIKE ?");
        $name="%".$_GET["txtbook"]."%";
       /* $stmt = $conn->prepare("SELECT books.book_id,book_name, category_id, isbn_number, price, piece_of_books, category_name,author_name FROM books
            INNER JOIN categories ON books.category_id=categories.id
            INNER JOIN authors ON books.author_id=authors.id WHERE book_name LIKE ?"); */
        $stmt = $conn->prepare("SELECT books.book_id,book_name,isbn_number,price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN books_author ON books.book_id=books_author.book_id INNER JOIN authors ON books_author.author_id=authors.author_id WHERE book_name LIKE ?");
        $stmt->execute(array($name));

        $result = $stmt->fetchAll();

        if( ! $result)
        {//print_r("no data");exit();
            //$data .= '<tr><td colspan="6">Records not found!</td></tr>';
           //echo $data;
            header("Location: error.php");
        }else{ //print_r("data");exit();
            /*
            $cc=$stmt->columnCount(); // count total number of columns
            $rc=$stmt->rowCount();  // count total number of rows
            echo "row count = $rc";
            echo "Column count = $cc";
            */

            $number=1;
            foreach($result as $row)
            {

                $data .= '<tr>
                <td class="text-left">'.$number.'</td>
                <td class="text-center">'.$row['book_name'].'</td>
                <td class="text-center">'.$row['author_name'].'</td>
                <td class="text-center">'.$row['category_name'].'</td>
                <td class="text-center">'.$row['isbn_number'].'</td>
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
                $number++;
            }


            $data .= '</table>';

            echo $data;
        }
    }elseif(isset($_GET["author_id"]) && !empty($_GET["author_id"])) {
    $author = $_GET["author_id"];
    //print_r($_GET["author_id"]);exit();
    $data = '<div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Books</a>
                </li>
            </ul>
        </div>';



    $data .= '<div class="row">
            <div class="box col-md-12">
            <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> Books Listing</h2>
            </div>
            <div class="container-fluid">

                <div class="row">
                    <form class="form-inline" style="margin:20px 20px" method="GET" action="search.php">
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">Name</span>
                            <input type="text" class="form-control" placeholder="" name="txtbook">
                        </div>
                        <div class="input-group col-md-1"></div>
                        <div class="input-group col-md-3">

                                <select class="form-control" name="author_id">
                                    <option label="select author"></option>';

    $names = $conn->query("select `author_id`, `author_name` from `authors`");//print_r($names);//exit();
    foreach($names as $name) {
        $data .= '<option value="'.$name["author_id"].'">'.$name["author_name"].'</option>';
    }
    $data .= '</select>
                        </div>';
    $data .= '<div class="input-group col-md-1"></div>
                        <div class="input-group col-md-3">

                               <select name="category_id" id="category_id" class="form-control">
                                        <option label="select cattegory"></option>';

    $categories = $conn->query("select `id`, `category_name` from `categories`");
    foreach($categories as $category) {
        $data .= '<option value="'.$category["id"].'">'.$category["category_name"].'</option>';
    }
    $data .= '</select>
                        </div>
                        <button onclick="" id="searchByName"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                </div>

            </div>';

    $data .= '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
            <tr>
              <th>No.</th>
              <th class="text-center">Book Name</th>
              <th class="text-center">Author</th>
              <th class="text-center">Category</th>
              <th class="text-center">ISBN</th>
              <th class="text-center">Price</th>
              <th class="text-center">Update</th>
              <th class="text-center">Delete</th>
            </tr>';
   /* $query = "SELECT books.id,book_name, author_id, category_id, isbn_number, price, piece_of_books, category_name,author_name FROM books
    INNER JOIN categories ON books.category_id=categories.id
    INNER JOIN authors ON books.author_id=authors.id WHERE author_id=".$author; */
        $query = "SELECT books.book_id,book_name,isbn_number,price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN books_author ON books.book_id=books_author.book_id INNER JOIN authors ON books_author.author_id=authors.author_id WHERE books_author.author_id=".$author;
    $result= $conn->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();//print_r($numrows);
    //print_r($numrows);

    // if query results contains rows then featch those rows
    if($numrows > 0)
    {
        $number = 1;
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $data .= '<tr>
        <td class="text-left">'.$number.'</td>
        <td class="text-center">'.$row['book_name'].'</td>
        <td class="text-center">'.$row['author_name'].'</td>
        <td class="text-center">'.$row['category_name'].'</td>
        <td class="text-center">'.$row['isbn_number'].'</td>
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
            $number++;
        }
        $data .= '</table>';

        echo $data;
    }
    else
    {
        // records now found
      //  $data .= '<tr><td colspan="6">Records not found!</td></tr>';
        //echo $data;
        header("Location: error.php");
    }



}elseif(isset($_GET["category_id"]) && !empty($_GET["category_id"])) {
    $category_id = $_GET["category_id"];//print_r($category_id);exit();
    $data = '<div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Books</a>
                </li>
            </ul>
        </div>';



    $data .= '<div class="row">
            <div class="box col-md-12">
            <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> Books Listing</h2>
            </div>
            <div class="container-fluid">

                <div class="row">
                    <form class="form-inline" style="margin:20px 20px" method="GET" action="search.php">
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">Name</span>
                            <input type="text" class="form-control" placeholder="" name="txtbook">
                        </div>
                        <div class="input-group col-md-1"></div>
                        <div class="input-group col-md-3">

                                <select class="form-control" name="author_id">
                                    <option label="select author"></option>';

    $names = $conn->query("select `author_id`, `author_name` from `authors`");//print_r($names);//exit();
    foreach($names as $name) {
        $data .= '<option value="'.$name["author_id"].'">'.$name["author_name"].'</option>';
    }
    $data .= '</select>
                        </div>';
    $data .= '<div class="input-group col-md-1"></div>
                        <div class="input-group col-md-3">

                               <select name="category_id" id="category_id" class="form-control">
                                        <option label="select category"></option>';

    $categories = $conn->query("select `id`, `category_name` from `categories`");
    foreach($categories as $category) {
        $data .= '<option value="'.$category["id"].'">'.$category["category_name"].'</option>';
    }
    $data .= '</select>
                        </div>
                        <button onclick="" id="searchByName"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                </div>

            </div>';

    $data .= '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
            <tr>
              <th>No.</th>
              <th class="text-center">Book Name</th>
              <th class="text-center">Author</th>
              <th class="text-center">Category</th>
              <th class="text-center">ISBN</th>
              <th class="text-center">Price</th>
              <th class="text-center">Update</th>
              <th class="text-center">Delete</th>
            </tr>';
   /* $query = "SELECT books.book_id,book_name, category_id, isbn_number, price, piece_of_books, category_name,author_name FROM books
    INNER JOIN categories ON books.category_id=categories.id
    INNER JOIN authors ON books.author_id=authors.author_id WHERE category_id=".$category_id; */
        $query = "SELECT books.book_id,book_name,isbn_number,price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN books_author ON books.book_id=books_author.book_id INNER JOIN authors ON books_author.author_id=authors.author_id WHERE books.category_id=".$category_id;
    $result= $conn->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();//print_r($numrows);
    //print_r($numrows);

    // if query results contains rows then featch those rows
    if($numrows > 0)
    {
        $number = 1;
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $data .= '<tr>
        <td class="text-left">'.$number.'</td>
        <td class="text-center">'.$row['book_name'].'</td>
        <td class="text-center">'.$row['author_name'].'</td>
        <td class="text-center">'.$row['category_name'].'</td>
        <td class="text-center">'.$row['isbn_number'].'</td>
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
            $number++;
        }
        $data .= '</table>';

        echo $data;
    }
    else
    {
        header("Location: error.php");
        // records now found
        //$data .= '<tr><td colspan="6">Records not found!</td></tr>';
        //echo $data;
    }



}elseif(isset($_GET["stid"]) && !empty($_GET["stid"])) {
    $student_id = $_GET["stid"];//print_r($student_id);exit();
    $data = '<div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Book Issued Listing</a>
                </li>
            </ul>
        </div>';



    $data .= '<div class="row">
            <div class="box col-md-12">
            <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> Book Issued Listing</h2>
            </div>
            <div class="container-fluid">

                <div class="row">
                    <form class="form-inline" style="margin:20px 20px" method="GET" action="search.php">
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">Name</span>
                            <input type="text" class="form-control" placeholder="" name="stid">
                        </div>
                        <button onclick="" id="searchById"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                </div>

            </div>';

    $data .= '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                        <tr>
                            <th class="text-center">#SID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Issued Date</th>
                            <th class="text-center">Total Books</th>
                            <th class="text-center">Submitted Date</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';

    $query = "SELECT id, student_id, name, issue_date, issue_details, submitted_date FROM book_issues WHERE student_id=".$student_id;
    $result= $conn->query($query);
    //exit(mysql_error());
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();

    if($numrows > 0)
    {//print_r($numrows);
        //$number = 1;
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            //print_r(unserialize(base64_decode($row['issue_details'])));
            $BookIssueDetails = $row['issue_details'];//print_r($BookIssueDetails);
            $UnserializeBookIssueDetails = unserialize(base64_decode($BookIssueDetails));//print_r($UnserializeBookIssueDetails);

            //Count total already  issued books
            $totalPrevIssuedBooks = count(array_filter($UnserializeBookIssueDetails["isbnnumber"]));
            if($row['submitted_date'] == '0000-00-00'){
                $submitted_date = "Not Submitted";
            }else{
                $submitted_date = $row['submitted_date'];
            }

            $data .= '<tr>

                <td class="text-center">'.$row['student_id'].'</td>
                <td class="text-center">'.$row['name'].'</td>
                <td class="text-center">'.$row['issue_date'].'</td>
                <td class="text-center">'.$totalPrevIssuedBooks.'</td>
                <td class="text-center">'.$submitted_date.'</td>
                <td class="text-center">
                    <a class="btn btn-info" href= "bookissue-edit.php?id='.$row['id'].'" onclick="GetBookIssueDetails('.$row['id'].')">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Receive
                    </a>

                </td>
                <td class="text-center">
                    <a class="btn btn-danger" href="#" onclick="DeleteBookIssueDetails('.$row['id'].')">
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        Delete
                    </a>
                </td>
            </tr>';
            //$number++;
        }
    }else{//print_r($numrows);
        //$data .= '<tr><td colspan="7">Records not found!</td></tr>';
        //$data .= '</table>';
        //echo $data;exit();
        header("Location: error.php");
    }
    $data .= '</table>';
    echo $data;
}elseif(isset($_GET["txtuser"]) && !empty($_GET["txtuser"])) {
        $user = $_GET["txtuser"];//print_r($user);//exit();
        $data = '<div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">User Listing</a>
                </li>
            </ul>
        </div>';



        $data .= '<div class="row">
            <div class="box col-md-12">
            <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> User Listing</h2>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <form class="form-inline" style="margin:20px 20px" method="GET" action="search.php">
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">Name</span>
                            <input type="text" class="form-control" placeholder="" name="txtuser">
                        </div>
                        <button onclick="" id="searchById"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                </div>

            </div>';

        $data .= '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';

        //$query = "SELECT id, student_id, student_name, issue_date, issue_details, submitted_date FROM book_issues WHERE student_id=".$student_id;
        $query = "SELECT id, first_name,last_name, email, role,phone FROM users WHERE first_name like "."'%$user%'";
        $result= $conn->query($query);
        //exit(mysql_error());
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $numrows =$result->rowCount();

        if($numrows > 0)
        {//print_r($numrows);
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
                $data .= '<tr class="eachrow">
                <td class="text-center">'.$number.'</td>
                <td class="text-center">'.$row['first_name'].' '.$row['last_name'].'</td>
                <td class="text-center">'.$row['email'].'</td>
                <td class="text-center">'.$role.'</td>
                <td class="text-center">'.$row['phone'].'</td>

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
        }else{//print_r($numrows);
            //$data .= '<tr><td colspan="7">Records not found!</td></tr>';
            //$data .= '</table>';
            //echo $data;//exit();
            header("Location: error.php");
        }
        $data .= '</table>';
        echo $data;
    }else{
    // records now found
    //$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    //echo $data;//exit;
        header('Location:error.php');
}
}catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";








?>