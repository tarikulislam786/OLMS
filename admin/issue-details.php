<?php
ob_start(); // redirecting problem solved
include('dbconnect.php');
include('config.php');
//include 'config.php' ;

?>


<?php
//session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}

?>
<?php
include('header.php');
?>
<link id="bs-css" href="admin/css/bootstrap-cerulean.min.css" rel="stylesheet">
<link href="admin/css/charisma-app.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="admin/css/message.css" media="all" />
<link rel="stylesheet" href="admin/css/fileinput.min.css">
<style type="text/css">
    .message {
        color: #333;
        padding: 2px 10px;
        background: #E1F9D9;
        border: #DBECD5 1px solid;
    }
    .message {color: #FF0000;font-weight: bold;text-align: center;width: 100%;padding: 10;}
    .fileinput-upload, .fileinput-remove { display: none; }
    .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
        color: #ffffff !important;
        background-color: #6254b2;
        border-color: #5a4daa;
    }
</style>

<?php
//print_r($_SESSION);
$user_id =$_SESSION["id"];
$queryBookIssue = "SELECT issue_date, first_name, last_name, issue_details from users INNER JOIN book_issues ON book_issues.user_id= users.id WHERE users.id="."'$user_id'";//print_r($queryBookIssue);
//$query = "SELECT books.id,book_name,isbn_number, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN authors ON books.author_id=authors.id ORDER BY book_name ASC LIMIT $page1, 10";
$resultBookIssue= $conn->query($queryBookIssue);//print_r($resultBookIssue);
//exit(mysql_error());
$resultBookIssue->setFetchMode(PDO::FETCH_ASSOC);
$countmachBookIssue =$resultBookIssue->rowCount();
if($countmachBookIssue ==1) {
    $row = $resultBookIssue->fetch();//print_r($row);exit;
    $issue_date = $row['issue_date'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $PrevBookIssueDetails = $row['issue_details'];
    $unserializedPrevBookIssueDetails = unserialize(base64_decode($PrevBookIssueDetails));
   // print_r($unserializedPrevBookIssueDetails);
    //Count total already  issued books
    $totalPrevIssuedBooks = count(array_filter($unserializedPrevBookIssueDetails["isbnnumber"]));//print_r($totalPrevIssuedBooks);

    // Late Charge $5 per book if issued date beyond seven days
    /*$issuedDate = strtotime($unserializedPrevBookIssueDetails["issue_date"]);
    $submitDate = strtotime(date('Y-m-d'));

    $days_between = ceil(abs($submitDate - $issuedDate) / 86400);//print_r($days_between);
    if($days_between>7){
        $charged = ($totalPrevIssuedBooks*5);
        //print_r($charged);
    } else {
        $charged =0;

    }*/
    
} else {
    $totalPrevIssuedBooks=0;
}
?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Book Issue Details</a>
        </li>
    </ul>
</div>
<?php echo $msg->display();?>
<?php //print_r($_SESSION);?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> Book Issue Details</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- put your content here -->
                <?php if(isset($message)){?>
                    <div class="message"><?php echo $message; ?></div>
                <?php }?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php
                        if($totalPrevIssuedBooks>0) { $number = 1;?>
                        <table class="table table-striped table-bordered bootstrap-datatable" id="example">
                            <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center" style="width: 280px;">Book Name</th>
                                <th class="text-center">Issued At</th>
                                <th class="text-center">Late Fine</th>
                            </tr>
                            </thead>
                            <tbody>

<?php 
// late fine code
                     $issuedDateArray = $unserializedPrevBookIssueDetails["book_issue_date"];//print_r($issuedDateArray);exit();
                    // print_r(count($issuedDateArray));exit();
                     $lateFine =0;
                     $countCharged =0;
                    for ($i = 0; $i < count($issuedDateArray); $i++) {
                        $countChargedIssued = 0;
                        $issuedDate = strtotime($issuedDateArray[$i]);
                        $submitDate = strtotime(date('Y-m-d'));

                        $days_between = ceil(abs($submitDate - $issuedDate) / 86400);//print_r($days_between);
                        if ($days_between > 7) {
                            $countChargedIssued++;
                            $charged[] = ($countChargedIssued * 5);
                            //print_r($charged);
                            $lateFine = array_sum($charged);
                        }
                        ?>
                        <tr>
                                        <td><?php echo $number; ?></td>
                                        <td><?php echo $unserializedPrevBookIssueDetails["bookname"][$i]; ?></td>
                                        
                                        <?php if($days_between>7){
                                             $countCharged++;
                                        ?>
                                        <td>
                                                <span style="color: #F00"><?php echo $unserializedPrevBookIssueDetails["book_issue_date"][$i];?></span>
                                        </td> 
                                     
                                        <td><?php 
                                       // print_r($countChargedIssued);
                                        echo ($lateFine/$countCharged);?>
                                        </td>     
                                            <?php } else{?>
                                        <td>
                                                <span><?php echo $unserializedPrevBookIssueDetails["book_issue_date"][$i];?></span>
                                        </td>
                                        <td>
                                        <?php echo "0";?>
                                        </td>
                                            <?php }?>
                                        </td>
                                        
                        </tr>
                                <?php $number++;}?>
                                <tr><td colspan="4"><span style="float: right;margin-right: 195px;">Total= <?php echo '$'.$lateFine;?></span></td></tr>
                   <?php }?>
                                    
                            </tbody>
                        </table>
                        <?php
                            if($totalPrevIssuedBooks>0 && $totalPrevIssuedBooks<2){
                         ?>
                            <h2 align="center" style="color: #000;"><?php echo $first_name.' '.$last_name.' has  issued '.$totalPrevIssuedBooks.  ' number of book.'; ?></h2>
                        <?php }elseif ($totalPrevIssuedBooks>1) {?>
                            <h2 align="center" style="color: #000;"><?php echo $first_name.' '.$last_name.' has  issued '.$totalPrevIssuedBooks.  ' number of books.'; ?></h2>
                        <?php }else {?>
                            <h2 align="center" style="color: #000;"><?php echo $first_name.' '.$last_name.' has not issued a book yet.'; ?></h2>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/row-->

<?php include('footer.php'); ?>

