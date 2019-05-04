<?php
    session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}
?>

<?php 
error_reporting(1);
ob_start(); // redirecting problem solved
include('header.php');
include('dbconnect.php');
?>
<?php
$email=$_SESSION["email"];

$query = "SELECT role from users where email="."'$email'";//print_r($query);

$result= $conn->query($query);//print_r($result);
//exit(mysql_error());
$result->setFetchMode(PDO::FETCH_ASSOC);
$countmach =$result->rowCount();
//echo $countmach;
if($countmach ==1) {//print_r("login successful");exit;
    $row = $result->fetch();//print_r($row);exit;
    $role = $row['role'];//print_r($role);
    if($role>1 && $role<4) // if student/ teacher
    {
        //echo "Un authorized access.";
        header('Location:error.php');
    }
}
?>
<?php
function check_user_input($input_data) {
   $output = trim($input_data);
   $output = stripslashes($output);
   $output = htmlspecialchars($output);
   return $output;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book="";
    $category="";
    $author="";
    $isbn="";
    $price="";
    // discipline name
        if($_POST["book"])
        {//print_r($_POST["discipline"]);exit;
            $book = check_user_input($_POST["book"]);
            if (!preg_match("/^[a-z0-9 .\-]+$/i",$book)) {
              $message_error = "Only alpha numeric spaces dashes period are allowed";
            } 
              
        }elseif($_POST["price"]){//print_r($_POST["short_name"]);exit;
                $price = check_user_input($_POST["price"]);
                if (!preg_match("/^[0-9\]+$/i",$price)) {
                  $message_error = "Only numeric is allowed";
                }else{
                $message_error = "Price field is required*";
                }
            }elseif(empty($_POST["author"]) && !empty($_POST["author_name"])) {//print_r($_POST["short_name"]);exit;
                $author = check_user_input($_POST["author_name"]);
                if (!preg_match("/^[a-z0-9 .\-]+$/i",$author)) {
                  $message_error = "Only alpha numeric spaces dashes period are allowed";
                }else{
                $message_error = "Author field is required*";
                }
            }else{
            $message_error = "field is required*";
        }
    if($message_error=="")
    {//print_r('good to go');exit;
        //print_r($discipline_error.'+'.$short_name_error);exit();
        $book=$_POST["book"];
        $category=$_POST["category"];
        $author= $_POST["author"];
        $author_name = $_POST["author_name"];
        $isbn = $_POST["isbn"];
        $price = $_POST["price"];
        $piece_of_books = $_POST["piece_of_books"];


            if(isset($author_name) && !empty($author_name))
            { // adding book with new author
                $sqlAuthor = "INSERT INTO `authors` (`author_name`,  `created_at`, `updated_at`)
        VALUES('$author_name', now(), now())";
                $count = $conn->exec($sqlAuthor);
                $authorLastInsertId = $conn->lastInsertId(); // If use the new author

                // Define an insert query
                $sqlBooks = "INSERT INTO `books` (`book_name`, `category_id`, `isbn_number`, `price`, `piece_of_books`, `created_at`, `updated_at`)
        VALUES('$book','$category', '$isbn', '$price', '$piece_of_books', now(), now())";//print_r($sql);exit;
                $count = $conn->exec($sqlBooks);//print_r($count);exit;
                $book_lastInsertId = $conn->lastInsertId(); // book last insert id
                $sqlBooksAuthor = "INSERT INTO `books_author` (`book_id`, `author_id`)
        VALUES('$book_lastInsertId','$authorLastInsertId')";
                $count = $conn->exec($sqlBooksAuthor);
                //echo 'Added Successful.';
                header("Location:books-manage.php?success=1");


            } else{ // adding book with existing author
                // Define an insert query
                $sqlBooks = "INSERT INTO `books` (`book_name`, `category_id`, `isbn_number`, `price`, `piece_of_books`, `created_at`, `updated_at`)
        VALUES('$book','$category', '$isbn', '$price', '$piece_of_books', now(), now())";//print_r($sqlBooks);exit;
                $count = $conn->exec($sqlBooks);//print_r($count);exit;
                $book_lastInsertId = $conn->lastInsertId(); // book last insert id
                $sqlBooksAuthor = "INSERT INTO `books_author` (`book_id`, `author_id`)
        VALUES('$book_lastInsertId','$author')";
                $count = $conn->exec($sqlBooksAuthor);
                //echo 'Added Successful.';
                header("Location:books-manage.php?success=1");
            }




    }
    //print_r($status);
}
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Books</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;Add book</h2>
            </div>
            <div class="box-content">
                <form role="form" action="books.php" method="post">
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Book Name</label>
                        <input type="text" name="book" class="form-control" id="exampleInputEmail1" placeholder="Book name">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option>Select</option>
                        <?php
                        $names = $conn->query("select `id`, `category_name` from `categories`");
                        foreach($names as $name) { ?>
                        <option value="<?= $name['id'] ?>"><?= $name['category_name'] ?></option>
                        <?php }?>
                        </select>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail">Author</label>
                        <select name="author" id="author" class="form-control">
                            <option>Select</option>
                        <?php
                        $authors = $conn->query("select `author_id`, `author_name` from `authors`");
                        foreach($authors as $author) { ?>
                        <option value="<?= $author['author_id'] ?>"><?= $author['author_name'] ?></option>
                        <?php }?>
                        </select>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                        <span for="exampleInputEmail">Select from above OR Add new</span>
                        <input type="text" name="author_name" class="form-control" id="exampleInputEmail1" placeholder="Author name">
                        <!-- <span style="color:red;"><?php //echo @$message_error;?></span> -->
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">ISBN Number</label>
                        <input type="number" name="isbn" class="form-control" id="exampleInputEmail1" placeholder="ISBN Number">
                        <span for="exampleInputEmail">ISBN Number must be a unique number</span>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Price</label>
                        <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Price">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Piece Of Books</label>
                        <input type="number" name="piece_of_books" class="form-control" id="exampleInputEmail1" placeholder="Piece of books">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                    <a href="books-manage.php"><button type="button" class="btn btn-default" name="submit">Cancel</button></a>
                </form>
            </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row-->  
<?php include('footer.php'); ?>