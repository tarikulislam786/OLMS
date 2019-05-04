
<?php
    session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}
?>
<?php
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
//pagination
if(isset($_GET["page"])){
    $page = $_GET["page"];

    if($page== "" || $page=="1"){
$page1=0;
}else{
    $page1=($page*10)-10;
}
}
?>
<style type="text/css">
.object_ok
{
border: 1px solid green; 
color: #333333; 
}

.object_error
{
border: 1px solid #AC3962; 
color: #333333; 
}

/* Input */
input
{
margin: 5 5 5 0;
padding: 2px; 

border: 1px solid #999999; 
border-top-color: #CCCCCC; 
border-left-color: #CCCCCC; 

color: #333333; 

font-size: 13px;
-moz-border-radius: 3px;
}
</style>
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
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Book</button>
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
                            $names = $conn->query("select `author_id`, `author_name` from `authors`");
                            foreach($names as $name) { ?>
                            <option value="<?= $name['author_id'] ?>"><?= $name['author_name'] ?></option>
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
    ?>
    <div class="records_content">
        <?php
$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                        <tr>
                            
                            <th class="text-center">No.</th>
                            <th class="text-center">Book Name</th>
                            <th class="text-center">Author</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">ISBN</th>
                            <th class="text-center">Piece of Books</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';

    //$query = "SELECT books.book_id,book_name,isbn_number, piece_of_books, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN authors ON books.author_id=authors.author_id ORDER BY book_name ASC LIMIT $page1, 10";
        $query = "SELECT books.book_id,book_name,isbn_number, piece_of_books, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN books_author ON books.book_id=books_author.book_id INNER JOIN authors ON books_author.author_id=authors.author_id ORDER BY book_name ASC LIMIT $page1, 10";
//SELECT books.book_name,isbn_number, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id =categories.id INNER JOIN authors ON books.author_id = authors.author_id ORDER BY book_name ASC
//$query = "SELECT `author_id`, `author_name` FROM authors";
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
        $number = 0;
        if(isset($_GET["page"])){
            $pageNo = $_GET["page"];
            $number = 1;
            for($i=2;$i<=$pageNo;$i++){
                $number+=10;
            }
        }
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            if($row['piece_of_books']<1){
            $data .= '<tr class="eachrow">
                <td class="text-center" style="color:#f00">'.$number.'</td>
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
                <td class="text-center">'.$number.'</td>
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
   // pagination

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
                if($i== $_GET["page"]){
                    $data .= '<li class="pagination-item is-active"> <a class="pagination-link" href="books-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                }else{
                    $data .= '<li class="pagination-item"> <a class="pagination-link" href="books-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                }
            }

            $data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="books-manage.php?page='.$totalpage.'">Last</a> </li>';
            $data  .= '</ul>';
            $data .= '</div>';
        }
        echo $data ;
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
            <div class="modal-body" style="padding: 20px 20px 50px 20px;">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Book Name<span class="required" style="font-size:15px;">*</span></label>
                        <input type="text" style="float:left;width: 96%;" name="book" class="form-control" id="book" placeholder="Book name"><span id="bookstatus" style="float:left"></span>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <label for="exampleInputEmail">Category<span class="required" style="font-size:15px;">*</span></label>
                        <select name="category" style="float:left;width: 96%;" id="category" class="form-control">
                            <option label="select"></option>
                        <?php
                        $names = $conn->query("select `id`, `category_name` from `categories`");
                        foreach($names as $name) { ?>
                        <option value="<?= $name['id'] ?>"><?= $name['category_name'] ?></option>
                        <?php }?>
                        </select>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <label for="exampleInputEmail">Author<span class="required" style="font-size:15px;">*</span></label>
                        <select name="author" style="float:left;width: 96%;" id="author" class="form-control">
                            <option label="select"></option>
                        <?php
                        $authors = $conn->query("select `author_id`, `author_name` from `authors`");
                        foreach($authors as $author) { ?>
                        <option value="<?= $author['author_id'] ?>"><?= $author['author_name'] ?></option>
                        <?php }?>
                        </select>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                        <span for="exampleInputEmail" style="float: left;">Select from above OR Add new</span>
                        <br /><br />
                        <input type="text" style="float:left;width: 96%;" name="author_name" class="form-control" id="author_name" placeholder="Author name"><span id="authorstatus" style="float:left"></span>
                        <!-- <span style="color:red;"><?php //echo @$message_error;?></span> -->
                    </div>
                    <br /><br /><br /><br />
                    <div class="form-group">
                        <label style="float: left;"for="exampleInputEmail1">ISBN Number<span class="required" style="font-size:15px;">*</span></label>
                        <input type="number" style="float:left;width: 96%;" name="isbn" class="form-control" id="isbn" placeholder="ISBN Number"><span id="isbnstatus" style="float:left"></span>
                        <br /><br />
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
<br /><br />
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="float:left">Price<span class="required" style="font-size:15px;">*</span></label>
                        <input style="float:left;width: 96%;" type="text" name="price" class="form-control" id="price" placeholder="Price">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <br /><br /><br />
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="float:left">Piece Of Books<span class="required" style="font-size:15px;">*</span></label>
                        <input style="float:left;width: 96%;" type="number" name="piece_of_books" class="form-control" id="piece_of_books" placeholder="Piece of books">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <br /><br />
                    
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
<!--                    <div class="form-group">-->
<!--                        <span class="required">*</span><label for="exampleInputEmail">Category</label>-->
<!--                        <select name="category" id="update_category_name" class="form-control">-->
<!--                             <option label="select"></option> -->
                            <?php
//                        $names = $conn->query("select `id`, `category_name` from `categories`");
//                        foreach($names as $name) { ?>
<!--                        <option value="--><?//= $name['id'] ?><!--">--><?//= $name['category_name'] ?><!--</option>-->
<!--                        --><?php //}?>
<!--                        </select>-->
<!--                        <span style="color:red;">--><?php //echo @$message_error;?><!--</span>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <span class="required">*</span><label for="exampleInputEmail">Author</label>-->
<!--                        <select name="author" id="update_author" class="form-control">-->
<!--                           <option label="select"></option>-->
                            <?php
//                        $authors = $conn->query("select `author_id`, `author_name` from `authors`");
//                        foreach($authors as $author) { ?>
<!--                        <option value="--><?//= $author['author_id'] ?><!--">--><?//= $author['author_name'] ?><!--</option>-->
<!--                        --><?php //}?>
<!--                        </select>-->
<!--                        <span style="color:red;">--><?php //echo @$message_error;?><!--</span>-->
<!--                        <!-- span for="exampleInputEmail">Select from above OR Add new</span>-->
<!--                        <input type="text" name="author_name" class="form-control" id="update_author_name" placeholder="Author name"> -->
<!--                         <span style="color:red;">--><?php ////echo @$message_error;?><!--</span> -->
<!--                    </div>-->
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">ISBN Number</label>
                        <input type="number" name="isbn" class="form-control" id="update_isbn" placeholder="ISBN Number">
                        <span for="exampleInputEmail">ISBN Number must be a unique number</span>
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Price</label>
                        <input type="text" name="update_price" class="form-control" id="update_price" placeholder="Price">
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
 <!-- <script type="text/javascript">
     $(document).ready(function(){
        var javaScriptVar = "<?php //echo $_GET["page"]; ?>";
        var i=0;
        $("ul.pagination li.pagination-item").each(function(){
            i++;//alert(i);
            if(i== javaScriptVar){
                $(this).addClass("is-active");
            }
        });
     });
 </script> -->
<SCRIPT type="text/javascript">

$(document).ready(function(){
// for book name availability
$("#book").change(function() { 

var book = $("#book").val();

if(book.length >= 4)
{
$("#bookstatus").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "ajax/Books/checkValidRecord.php",  
    data: "book_name="+ book,  
    success: function(data){  //alert(data);
   
   //$("#status").ajaxComplete(function(event, request, settings){ 

    if(data == 'OK')
    {  //alert("ok");
        $("#book").removeClass('object_error'); // if necessary
        $("#book").addClass("object_ok");
        $("#bookstatus").html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
    }  
    else  
    {  //alert("not ok.");
        $("#book").removeClass('object_ok'); // if necessary
        $("#book").addClass("object_error");
       // $(this).html(data);
        $("#bookstatus").html('<font color="red">The book <STRONG>'+book+'</STRONG> is already in use.</font>');
        
    }  
   
  // });

 } 
   
  }); 

}
else
    {
    $("#bookstatus").html('<font color="red">The name should have at least <strong>4</strong> characters.</font>');
    $("#book").removeClass('object_ok'); // if necessary
    $("#book").addClass("object_error");
    }

});

// for author name availability

$("#author_name").change(function() { 

var author_name = $("#author_name").val();

if(author_name.length >= 4)
{
$("#authorstatus").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "ajax/Books/checkValidRecord.php",  
    data: "author_name="+ author_name,  
    success: function(data){  //alert(data);
   
   //$("#status").ajaxComplete(function(event, request, settings){ 

    if(data == 'OK')
    {  //alert("ok");
        $("#author_name").removeClass('object_error'); // if necessary
        $("#author_name").addClass("object_ok");
        $("#authorstatus").html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
    }  
    else  
    {  //alert("not ok.");
        $("#author_name").removeClass('object_ok'); // if necessary
        $("#author_name").addClass("object_error");
       // $(this).html(data);
        $("#authorstatus").html('<font color="red">The author <STRONG>'+author_name+'</STRONG> is already in use.</font>');
        
    }  
   
  // });

 } 
   
  }); 

}
else
    {
    $("#authorstatus").html('<font color="red">The name should have at least <strong>4</strong> characters.</font>');
    $("#author_name").removeClass('object_ok'); // if necessary
    $("#author_name").addClass("object_error");
    }

});
// for isbn availability

$("#isbn").change(function() { 

var isbn = $("#isbn").val();

$("#isbnstatus").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "ajax/Books/checkValidRecord.php",  
    data: "isbn_number="+ isbn,  
    success: function(data){  //alert(data);
   
   //$("#status").ajaxComplete(function(event, request, settings){ 

    if(data == 'OK')
    {  //alert("ok");
        $("#isbn").removeClass('object_error'); // if necessary
        $("#isbn").addClass("object_ok");
        $("#isbnstatus").html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
    }  
    else  
    {  //alert("not ok.");
        $("#isbn").removeClass('object_ok'); // if necessary
        $("#isbn").addClass("object_error");
       // $(this).html(data);
        $("#isbnstatus").html('<font color="red">The isbn <STRONG>'+isbn+'</STRONG> is already in use.</font>');
        
    }  
   
  // });

 } 
   
  }); 



});
});

//-->
</SCRIPT>


<?php include('footer.php'); ?>
