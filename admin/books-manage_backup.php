
<?php
    session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}
?>
<?php 
include('header.php');
include('dbconnect.php'); 
?>
<?php
if(isset($_GET["page"])){
    $page = $_GET["page"];

    if($page== "" || $page=="1"){
$page1=0;
}else{
    $page1=($page*10)-10;
}
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
        <?php echo $msg->display();?>
<div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
            </div>
        </div>
    </div>

<div class="row">
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
                            <option label=" select author"></option>
                            <?php
                            $names = $conn->query("select `id`, `author_name` from `authors`");
                            foreach($names as $name) { ?>
                            <option value="<?= $name['id'] ?>"><?= $name['author_name'] ?></option>
                            <?php }?>
                        </select>
                </div>
                <div class="input-group col-md-1"></div>
                <div class="input-group col-md-3">
                        
                       <select name="category_id" id="category_id" class="form-control">
                                <option label=" select category"></option>
                            <?php
                            $categories = $conn->query("select `id`, `category_name` from `categories`");
                            foreach($categories as $category) { ?>
                            <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                            <?php }?>
                            </select>
                </div>
                <button onclick="" id="searchByName"><i class="glyphicon glyphicon-search"></i></button>
            </form>
            
        </div>
        
    </div>
    <?php 
    if(isset($_GET["page"])){
        //$a=0;
        //$b=0;
    ?>
    <div class="records_content">
        <?php
$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                        <tr>
                            
                            <th class="text-center">Book Name</th>
                            <th class="text-center">Author</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">ISBN</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';

    $query = "SELECT books.id,book_name,isbn_number, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN authors ON books.author_id=authors.id ORDER BY book_name ASC LIMIT $page1, 10";
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
       // $number = 1;
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $data .= '<tr class="eachrow">
                
                <td class="text-center">'.$row['book_name'].'</td>
                <td class="text-center">'.$row['author_name'].'</td>
                <td class="text-center">'.$row['category_name'].'</td>
                <td class="text-center">'.$row['isbn_number'].'</td>
                <td class="text-center">'.$row['price'].'</td>
                <td class="text-center">
                    <a class="btn btn-info" href="#" onclick="GetBookDetails('.$row['id'].')">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Edit
                    </a>
            
                </td>
                <td class="text-center">
                    <a class="btn btn-danger" href="#" onclick="DeleteBook('.$row['id'].')">
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        Delete
                    </a>
                </td>
            </tr>';
            //$number++;
        }
    }
    else
    {
        // records now found 
        $data .= '<tr class="eachrow"><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';
   $a =$countnumrows/10;
    $a =ceil($a);
    //$data.= $b;

$data .= '<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">';
    $data .= '<ul class="pagination">';
    $data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="#">Previous</a> </li>';
        for($b=1;$b<=$a;$b++){
     $data .= '<li class="pagination-item"> <a class="pagination-link" href="books-manage.php?page='.$b.'">'.$b." ".'</a> </li>';       
   //$data .='<a href="books-manage.php?page='.$b.'" style="text-decoration:none">'.$b." ".'</a>';
    }
 
    $data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a> </li>';
    $data .= '</ul>';
    $data .= '</div>';
    echo $data;

    ?>
    </div>
    <?php }else{?>
    <div class="records_content"></div>
    <?php } ?>
    
    </div>
    </div>
    <!--/span-->
    </div><!--row-->


<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Book Name</label>
                        <input type="text" name="book" class="form-control" id="book" placeholder="Book name">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option label="select"></option>
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
                            <option label="select"></option>
                        <?php
                        $authors = $conn->query("select `id`, `author_name` from `authors`");
                        foreach($authors as $author) { ?>
                        <option value="<?= $author['id'] ?>"><?= $author['author_name'] ?></option>
                        <?php }?>
                        </select>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                        <span for="exampleInputEmail">Select from above OR Add new</span>
                        <input type="text" name="author_name" class="form-control" id="author_name" placeholder="Author name">
                        <!-- <span style="color:red;"><?php //echo @$message_error;?></span> -->
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">ISBN Number</label>
                        <input type="number" name="isbn" class="form-control" id="isbn" placeholder="ISBN Number">
                        <span for="exampleInputEmail">ISBN Number must be a unique number</span>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Price</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Piece Of Books</label>
                        <input type="number" name="piece_of_books" class="form-control" id="piece_of_books" placeholder="Piece of books">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addBookRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Book Name</label>
                        <input type="text" name="book" class="form-control" id="update_book_name" placeholder="Book name">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail">Category</label>
                        <select name="category" id="update_category_name" class="form-control">
                            <option label="select"></option>
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
                        <select name="author" id="update_author" class="form-control">
                           <option label="select"></option>
                        <?php
                        $authors = $conn->query("select `id`, `author_name` from `authors`");
                        foreach($authors as $author) { ?>
                        <option value="<?= $author['id'] ?>"><?= $author['author_name'] ?></option>
                        <?php }?>
                        </select>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                        <!-- span for="exampleInputEmail">Select from above OR Add new</span>
                        <input type="text" name="author_name" class="form-control" id="update_author_name" placeholder="Author name"> -->
                        <!-- <span style="color:red;"><?php //echo @$message_error;?></span> -->
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">ISBN Number</label>
                        <input type="number" name="isbn" class="form-control" id="update_isbn" placeholder="ISBN Number">
                        <span for="exampleInputEmail">ISBN Number must be a unique number</span>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Price</label>
                        <input type="text" name="price" class="form-control" id="update_price" placeholder="Price">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Piece Of Books</label>
                        <input type="number" name="piece_of_books" class="form-control" id="update_piece_of_books" placeholder="Piece of books">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateBookDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Pagination current page selection and first item class add -->
 <script type="text/javascript">
     $(document).ready(function(){
        var javaScriptVar = "<?php echo $_GET["page"]; ?>";
        var i=0;
        $("ul.pagination li.pagination-item").each(function(){
            i++;//alert(i);
            if(i== javaScriptVar){
                $(this).addClass("is-active");
            }
        });
     });
 </script>


<?php include('footer.php'); ?>
