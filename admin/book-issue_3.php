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

if(isset($_POST["stid"])) {
    $stid = $_POST["stid"];

    if (!empty($stid)) {
        // $stid = $_POST["stid"];
        $message_error == "";
    } else {
        $message_error = "field is required*";
    }
    if ($message_error == "") {
        $issue_date=$_POST["issue_date"];
        $stid=$_POST["stid"];
        $studentname = $_POST["studentname"];
        $userid = $_POST["userid"];//print_r($userid);exit;
        //check if no. of book is issued already
        $stmt = $conn->prepare("SELECT issue_details FROM book_issues WHERE student_id =" . $stid);
        $stmt->execute();
        $row = $stmt->fetch();
        $PrevBookIssueDetails = $row['issue_details'];
        $unserializedPrevBookIssueDetails = unserialize(base64_decode($PrevBookIssueDetails));
        //print_r($unserializedPrevBookIssueDetails);exit;
        // Is the book already issued

        //Count total already  issued books
        $totalPrevIssuedBooks = count(array_filter($unserializedPrevBookIssueDetails["isbnnumber"]));

        // print_r($totalBooks);exit();
        // check if maximum or 3 number of books is already issued
        if($totalPrevIssuedBooks== 3){
            header("Location:book-issue.php?book-issue-available-no=1");
        }elseif ($totalPrevIssuedBooks== 2) { //print_r("tot: ".$totalBooks);exit();//if 2 number of books is already issued
            // so you have 1 left
            // now check how much book he/she wants
            $attemptIssueBooks = count(array_filter($_POST["isbnnumber"]));//print_r($attemptIssueBooks);exit();

            if($attemptIssueBooks>=2) { // IF Want 2/3 book since I've 1 left
                header("Location:book-issue.php?book-issue-available-1=1");
            } else {
                //print_r($unserializedIssueDetails);exit();
                // 2 item already issued and allowing issue final item
                //print_r($_POST);exit();
                //$UnserializeBookIssueDetailss = unserialize(base64_decode($serializeds));print_r($UnserializeBookIssueDetailss);exit();
                // Arr push to the Previous book issue array
                // print_r($_POST["isbnnumber"]);exit();
                //print_r($unserializedPrevBookIssueDetails["isbnnumber"]);exit;
                // before update just 1 step checking to restrict issue same book
                $matchedCount = count(array_filter(array_intersect($_POST["isbnnumber"],$unserializedPrevBookIssueDetails["isbnnumber"])));
                if($matchedCount>0){//print_r("matched");exit;
                    header("Location:book-issue.php?duplicate=1");
                } else {
                    //print_r("yes one left");exit();
                    //print_r($unserializedPrevBookIssueDetails);exit();
                    // book issue restrict if previous book issued time cross 7 days/ late charge isn't paid
                    // late fine code
                    $issuedDateArray = $unserializedPrevBookIssueDetails["book_issue_date"];//print_r($issuedDateArray);exit();
                    //print_r($issuedDateArray);exit();

                   // print_r(count($issuedDateArray));exit();
                    for($i=0;$i<count($issuedDateArray);$i++)
                    {
                        $countChargedIssued = 0;
                        $issuedDate = strtotime($issuedDateArray[$i]);
                        $submitDate = strtotime(date('Y-m-d'));

                        $days_between = ceil(abs($submitDate - $issuedDate) / 86400);//print_r($days_between);
                        if($days_between>7) {
                            $countChargedIssued++;
                            $charged[] = ($countChargedIssued * 5);
                            //print_r($charged);
                            $lateFine = array_sum($charged);
                           // print_r($lateFine);exit();
                        }
                    }

                    if($lateFine>=5){//print_r($lateFine);exit();
                        header("Location:book-issue.php?penalty=1");
                    } else {

                        // updating stock for book table
                        for($i=0;$i<count($_POST['isbnnumber']);$i++) {
                        $stmt = $conn->prepare("Select piece_of_books from books where isbn_number='".$_POST['isbnnumber'][$i]."'");
                        $stmt->execute();
                        $row = $stmt->fetch();
                        $piece_of_books = $row['piece_of_books'];
                        $updatePieceOfBooks = $piece_of_books-1;
                        //print_r($piece_of_books);exit();
                        $sql = "UPDATE books SET piece_of_books='$updatePieceOfBooks' WHERE isbn_number = '".$_POST['isbnnumber'][$i]."'";//print_r($sql);exit;
                        $count = $conn->exec($sql);
                        }
                        //print_r("good to go for one");exit;
                        $FirstArrKeyVal = 0;
                        array_push($unserializedPrevBookIssueDetails["isbnnumber"], $_POST["isbnnumber"][$FirstArrKeyVal]);
                        array_push($unserializedPrevBookIssueDetails["bookname"], $_POST["bookname"][$FirstArrKeyVal]);
                        array_push($unserializedPrevBookIssueDetails["bookname_book_id"], $_POST["bookname_book_id"][$FirstArrKeyVal]);
                        array_push($unserializedPrevBookIssueDetails["book_issue_date"], $_POST["book_issue_date"][$FirstArrKeyVal]);
                        //print_r($unserializedPrevBookIssueDetails);exit();
                        $serializedPushedData = base64_encode(serialize($unserializedPrevBookIssueDetails));//print_r($serialized);exit();
                        $sql = "UPDATE book_issues SET user_id='$userid', issue_details='$serializedPushedData' WHERE student_id = '$stid'";//print_r($sql);exit;
                        $count = $conn->exec($sql);
                        header("Location:bookissue-manage.php?success=1");
                    }



                    }

            }

        }elseif($totalPrevIssuedBooks== 1){ // 2 left
//print_r($totalPrevIssuedBooks);exit();
            // now check how much book he/she wants
            $attemptIssueBooks = count(array_filter($_POST["isbnnumber"]));//print_r($attemptIssueBooks);exit();

            if($attemptIssueBooks== 3){ // IF Want 3 book since I've 2 left
                header("Location:book-issue.php?book-issue-available-2=1");
            }elseif($attemptIssueBooks== 2){
                // attempt issue for 2 item since have 2 left
//print_r($_POST["isbnnumber"][1]);exit;
                // print_r($unserializedPrevBookIssueDetails["isbnnumber"]);exit();

                // before update just 1 step checking to restrict issue same book
                $matchedCount = count(array_filter(array_intersect($_POST["isbnnumber"],$unserializedPrevBookIssueDetails["isbnnumber"])));
                if($matchedCount>0){
                    header("Location:book-issue.php?duplicate=1");
                } else {
                    // book issue restrict if previous book issued time cross 7 days/ late charge isn't paid

                    /* $issuedDate = strtotime($unserializedPrevBookIssueDetails["issue_date"]);//print_r($issuedDate);exit;
                     $submitDate = strtotime(date('Y-m-d'));

                     $days_between = ceil(abs($submitDate - $issuedDate) / 86400);//print_r($days_between);exit;
                     if($days_between>7){//print_r("Greater");exit;
                         $charged = ($totalPrevIssuedBooks*5);
                         //print_r($charged);
                         header("Location:book-issue.php?penalty=1");
                     }*/


                    // late fine code
                     $issuedDateArray = $unserializedPrevBookIssueDetails["book_issue_date"];//print_r($issuedDateArray);exit();
                    // print_r(count($issuedDateArray));exit();
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
                    }
                    if ($lateFine >= 5) {
                        header("Location:book-issue.php?penalty=1");
                    } else {

                    // I don't know Why array pushing not sequencing
                    for ($i = 0; $i < $attemptIssueBooks; $i++) {//print_r($_POST["isbnnumber"][$i]);exit;
                        //print_r($i);exit;

                        array_push($unserializedPrevBookIssueDetails["isbnnumber"], $_POST["isbnnumber"][$i]);
                        array_push($unserializedPrevBookIssueDetails["bookname"], $_POST["bookname"][$i]);
                        array_push($unserializedPrevBookIssueDetails["bookname_book_id"], $_POST["bookname_book_id"][$i]);
                        array_push($unserializedPrevBookIssueDetails["book_issue_date"], $_POST["book_issue_date"][$i]);
                        //update stock for book table
                        $stmt = $conn->prepare("Select piece_of_books from books where isbn_number='".$_POST['isbnnumber'][$i]."'");
                        $stmt->execute();
                        $row = $stmt->fetch();
                        $piece_of_books = $row['piece_of_books'];
                        $updatePieceOfBooks = $piece_of_books-1;
                        //print_r($piece_of_books);exit();
                        $sql = "UPDATE books SET piece_of_books='$updatePieceOfBooks' WHERE isbn_number = '".$_POST['isbnnumber'][$i]."'";//print_r($sql);exit;
                        $count = $conn->exec($sql);
                    }
                    //print_r($unserializedPrevBookIssueDetails);exit;
                    // Re-index an array
                    $isbnArray = array_values(array_filter($unserializedPrevBookIssueDetails["isbnnumber"]));
                    $booknameArray = array_values(array_filter($unserializedPrevBookIssueDetails["bookname"]));
                    $booknameBookIdArray = array_values(array_filter($unserializedPrevBookIssueDetails["bookname_book_id"]));
                    $book_issue_date = array_values(array_filter($unserializedPrevBookIssueDetails["book_issue_date"]));
                    //print_r($unserializedPrevBookIssueDetails);exit;
                    // Replacing the arr and key with unique value
                    $unserializedPrevBookIssueDetails["isbnnumber"] = array_unique(array_replace($unserializedPrevBookIssueDetails["isbnnumber"], $isbnArray));
                    $unserializedPrevBookIssueDetails["bookname"] = array_unique(array_replace($unserializedPrevBookIssueDetails["bookname"], $booknameArray));
                    $unserializedPrevBookIssueDetails["bookname_book_id"] = array_unique(array_replace($unserializedPrevBookIssueDetails["bookname_book_id"], $booknameBookIdArray));
                    // issue date shouldn't be unique to calculate late fine properly
                    $unserializedPrevBookIssueDetails["book_issue_date"] = $book_issue_date;
                    //print_r($unserializedPrevBookIssueDetails);exit;
                    $serializedNextPushedData = base64_encode(serialize($unserializedPrevBookIssueDetails));//print_r($serialized);exit();
                    $unserializedNextPushedData = unserialize(base64_decode($serializedNextPushedData));
                    // print_r($unserializedNextPushedData);exit;
                    // updating stock for book table
                       
                    $sql = "UPDATE book_issues SET user_id='$userid', issue_details='$serializedNextPushedData' WHERE student_id = '$stid'";//print_r($sql);exit;
                    $count = $conn->exec($sql);
                    header("Location:bookissue-manage.php?success=1");

                }
                }
            }else{
                //print_r($unserializedPrevBookIssueDetails["isbnnumber"]);
                // attempt issue for 1 item since have 2 left
                //print_r($_POST["isbnnumber"]);exit;
                // before update just 1 step checking to restrict issue same book
                $matchedCount = count(array_filter(array_intersect($_POST["isbnnumber"],$unserializedPrevBookIssueDetails["isbnnumber"])));
                //print_r($intersect);exit;
                if($matchedCount>0){//print_r("matched");exit;
                    header("Location:book-issue.php?duplicate=1");
                }else{
                    //print_r("good to go for one item");exit();
                    // book issue restrict if previous book issued time cross 7 days/ late charge isn't paid


                    // late fine code
                    $issuedDateArray = $unserializedPrevBookIssueDetails["book_issue_date"];//print_r($issuedDateArray);exit();
                   // print_r(count($issuedDateArray));exit();
                    for($i=0;$i<count($issuedDateArray);$i++)
                    {
                        $countChargedIssued = 0;
                        $issuedDate = strtotime($issuedDateArray[$i]);
                        $submitDate = strtotime(date('Y-m-d'));

                        $days_between = ceil(abs($submitDate - $issuedDate) / 86400);//print_r($days_between);
                        if($days_between>7) {
                            $countChargedIssued++;
                            $charged[] = ($countChargedIssued * 5);
                            //print_r($charged);
                            $lateFine = array_sum($charged);
                        }
                    }
                    if($lateFine>=5){
                        header("Location:book-issue.php?penalty=1");
                    }else{
                        // updating stock for book table
                        $FirstArrKeyVal = 0;
                        
                        $stmt = $conn->prepare("Select piece_of_books from books where isbn_number='".$_POST['isbnnumber'][$FirstArrKeyVal]."'");
                        $stmt->execute();
                        $row = $stmt->fetch();
                        $piece_of_books = $row['piece_of_books'];
                        $updatePieceOfBooks = $piece_of_books-1;
                        //print_r($piece_of_books);exit();
                        $sql = "UPDATE books SET piece_of_books='$updatePieceOfBooks' WHERE isbn_number = '".$_POST['isbnnumber'][$FirstArrKeyVal]."'";//print_r($sql);exit;
                        $count = $conn->exec($sql);
                        
                        array_push($unserializedPrevBookIssueDetails["isbnnumber"], $_POST["isbnnumber"][$FirstArrKeyVal]);
                        array_push($unserializedPrevBookIssueDetails["bookname"], $_POST["bookname"][$FirstArrKeyVal]);
                        array_push($unserializedPrevBookIssueDetails["bookname_book_id"], $_POST["bookname_book_id"][$FirstArrKeyVal]);
                        array_push($unserializedPrevBookIssueDetails["book_issue_date"], $_POST["book_issue_date"][$FirstArrKeyVal]);

                        //print_r($unserializedPrevBookIssueDetails);exit;
                        // Re-index an array
                        $isbnArray = array_values(array_filter($unserializedPrevBookIssueDetails["isbnnumber"]));
                        $booknameArray = array_values(array_filter($unserializedPrevBookIssueDetails["bookname"]));
                        $booknameBookIdArray = array_values(array_filter($unserializedPrevBookIssueDetails["bookname_book_id"]));

                        $book_issue_dateArray = array_values(array_filter($unserializedPrevBookIssueDetails["book_issue_date"]));
                        //print_r($unserializedPrevBookIssueDetails);exit;
                        // Replacing the arr and key with unique value
                        $unserializedPrevBookIssueDetails["isbnnumber"] = array_unique(array_replace($unserializedPrevBookIssueDetails["isbnnumber"], $isbnArray));
                        $unserializedPrevBookIssueDetails["bookname"] = array_unique(array_replace($unserializedPrevBookIssueDetails["bookname"], $booknameArray));
                        $unserializedPrevBookIssueDetails["bookname_book_id"] = array_unique(array_replace($unserializedPrevBookIssueDetails["bookname_book_id"], $booknameBookIdArray));
                        // issue date shouldn't be unique to calculate late fine properly
                        $unserializedPrevBookIssueDetails["book_issue_date"] = $book_issue_dateArray;
                        //print_r($unserializedPrevBookIssueDetails);exit;

                        $serializedNextPushedData = base64_encode(serialize($unserializedPrevBookIssueDetails));//print_r($serialized);exit();
                        $unserializedNextPushedData = unserialize(base64_decode($serializedNextPushedData));
                        //print_r($unserializedNextPushedData);exit;
                        $sql = "UPDATE book_issues SET user_id='$userid', issue_details='$serializedNextPushedData' WHERE student_id = '$stid'";//print_r($sql);exit;
                        $count = $conn->exec($sql);
                        header("Location:bookissue-manage.php?success=1");
                    }
                }
            }
        }else{
            // not prev issued. 3 Left
            // make sure you'r not permitted to issue same book twice at a time
            //print_r(count(array_filter($_POST["isbnnumber"])));exit;
            //print_r(count(array_filter(array_unique($_POST["isbnnumber"]))));exit;
            // before update just 1 step checking to restrict issue same book
            /* $matchedCount = count(array_filter(array_intersect($_POST["isbnnumber"],$unserializedPrevBookIssueDetails["isbnnumber"])));
             if($matchedCount>0){
                 header("Location:book-issue.php?duplicate=1");
             }else{*/
            //No book issued yet. Good to go for insertion
            $serialized = base64_encode(serialize($_POST));//print_r($serialized);exit();
            //$UnserializeBookIssueDetailss = unserialize(base64_decode($serialized));print_r($UnserializeBookIssueDetailss);exit();
            //print_r($_POST['isbnnumber']);exit();
            // updating stock for book table
            for($i=0;$i<count($_POST['isbnnumber']);$i++) {
            $stmt = $conn->prepare("Select piece_of_books from books where isbn_number='".$_POST['isbnnumber'][$i]."'");
            $stmt->execute();
            $row = $stmt->fetch();
            $piece_of_books = $row['piece_of_books'];
            $updatePieceOfBooks = $piece_of_books-1;
            //print_r($piece_of_books);exit();
            $sql = "UPDATE books SET piece_of_books='$updatePieceOfBooks' WHERE isbn_number = '".$_POST['isbnnumber'][$i]."'";//print_r($sql);exit;
            $count = $conn->exec($sql);
            }
            $sql = "INSERT INTO `book_issues` (`issue_date`, `student_id`, `user_id`, `name`, `issue_details`, `created_at`, `updated_at`)VALUES('$issue_date','$stid', '$userid', '$studentname','$serialized', now(), now())";//print_r($sql);exit;
            $count = $conn->exec($sql);
            header("Location:bookissue-manage.php?success=1");
            /* }*/
        }
    }
}
//print_r($status);
//}
?>


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Issue book</a>
            </li>
        </ul>
    </div>
<?php echo $msg->display();?>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a href="bookissue-teacher.php"><button class="btn btn-success">Book issue to teacher</button></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;Issue book  to student</h2>

                </div>
                <div class="box-content">
                    <form role="form" action="book-issue.php" method="post">
                        <div class="form-group">
                            <span class="required">*</span><label for="exampleInputEmail1">Issue Date</label>
                            <input type="text" name="issue_date" class="form-control" id="issue_date" value="<?php echo date('Y-m-d')?>" style="width:20%">
                            <!-- <span style="color:red;"><?php //echo @$message_error;?></span> -->
                        </div>
                        <div class="form-group">
                            <span class="required">*</span><label for="exampleInputEmail">Student ID</label>
                            <input type="text" name="" class="auto  form-control" id="stid" placeholder="Student ID" style="width:20%">
                            <input type="hidden" id="hidden_auto_complete_stid"  name="stid">
                            <span style="color:red;"><?php echo @$message_error;?></span>

                        </div>
                        <div class="form-group">
                            <span class="required">*</span><label for="exampleInputEmail">Student Name</label>
                            <input type="text" class="form-control studentname" placeholder="Student Name" name="studentname" style="width:20%">
                            <input type="hidden" class="form-control userid" name="userid" style="width:20%">
                            <span style="color:red;"><?php echo @$message_error;?></span>
                        </div>
                        <?php /*if(isset($_POST['stid'])){
                        $return_arr = array();
                        $stid = $_POST['stid'];
 $stmt = $conn->prepare("SELECT id,first_name,last_name,roll_no FROM users INNER JOIN students ON users.id=students.user_id WHERE roll_no=".$stid);
        $stmt->execute(array('stid'=>$stid));
        while($row = $stmt->fetch()) {
            $return_arr['first_name'] =  $row['first_name'];
            $return_arr['last_name'] =  $row['last_name'];
        }
         //echo json_encode(array('first_name'=>$return_arr['first_name'], 'last_name'=>$return_arr['last_name']));
    }*/
                        ?>
                        <!-- <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail">Student Name</label>
                      <input type="text" name="stname" class="form-control" id="stname" placeholder="Student Name" style="width:40%">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div> -->
                        <div class="alert alert-info form-inline">
                            <a href="#" id="" class="addAnother" style="margin-left: 280px;"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add another</a>
                            <div class="input-group col-md-12 visibleRow">

                                <div class="row copyitem">
                                    <div class="input-group col-md-4" style=" margin-left: 130px;">
                                        <span class="input-group-addon">ISBN</span>
                                        <input type="text" class="form-control isbnnumber" placeholder="" name="isbnnumber[]" id="" value="">
                                        <span style="color:red;"><?php echo @$message_error;?></span>
                                    </div>

                                    <div class="input-group col-md-4">
                                        <span class="input-group-addon fetch"  style="background: #aaeebb;border: 1px solid #eeccdd;" id="" >Fetch</span>
                                        <input type="text" class="form-control bookname" placeholder="" name="bookname[]" id="" value="">
                                        <input type="hidden" name="bookname_book_id[]" class="bookname_book_id" value="">
                                        <input type="hidden" name="book_issue_date[]" class="book_issue_date1" value="<?php echo date('Y-m-d');?>">
                                        <span style="color:red;"><?php echo @$message_error;?></span>
                                    </div>
                                    <button type="button" style="float:none" class="close" data-dismiss="alert"><span class="deleteItem" style="font-size: 19px;color:#2fa4e7">× Delete</span></button>
                                </div>

                            </div>
                            <div class="input-group col-md-12 visibleOne" style="display:none">

                                <div class="row copyitem">
                                    <div class="input-group col-md-4" style=" margin-left: 130px;">
                                        <span class="input-group-addon">ISBN</span>
                                        <input type="text" class="form-control isbnnumber1" value="" placeholder="" name="isbnnumber[]" id="">
                                    </div>

                                    <div class="input-group col-md-4">
                                        <span class="input-group-addon fetch1"  style="background: #aaeebb;border: 1px solid #eeccdd;" id="" >Fetch</span>
                                        <input type="text" class="form-control bookname1" value="" placeholder="" name="bookname[]" id="">
                                        <input type="hidden"  value="" name="bookname_book_id[]" class="bookname1_book_id">
                                        <input type="hidden"  disabled name="book_issue_date[]" class="book_issue_date2" value="<?php echo date('Y-m-d');?>">
                                    </div>
                                    <button type="button" style="float:none" class="close" data-dismiss="alert"><span class="deleteItem" style="font-size: 19px;color:#2fa4e7">× Delete</span></button>
                                </div>

                            </div>
                            <div class="input-group col-md-12 visibleTwo" style="display:none">

                                <div class="row copyitem">
                                    <div class="input-group col-md-4" style=" margin-left: 130px;">
                                        <span class="input-group-addon">ISBN</span>
                                        <input type="text" value="" class="form-control isbnnumber2" placeholder="" name="isbnnumber[]" id="">
                                    </div>

                                    <div class="input-group col-md-4">
                                        <span class="input-group-addon fetch2"  style="background: #aaeebb;border: 1px solid #eeccdd;" id="" >Fetch</span>
                                        <input type="text" value="" class="form-control bookname2" placeholder="" name="bookname[]" id="">
                                        <input type="hidden" id=""  value="" name="bookname_book_id[]" class="bookname2_book_id">
                                        <input type="hidden" disabled id=""  name="book_issue_date[]" class="book_issue_date3" value="<?php echo date('Y-m-d');?>">
                                    </div>
                                    <button type="button" style="float:none" class="close" data-dismiss="alert"><span class="deleteItem" style="font-size: 19px;color:#2fa4e7">× Delete</span></button>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-default" name="submit">Submit</button>
                        <a href="bookissue-manage.php"><button type="button" class="btn btn-default" name="submit">Cancel</button></a>
                    </form>
                </div>
            </div>
        </div>
        <!--/span-->
    </div><!--/row-->
    <script type="text/javascript">
        //$("a#addAnother").on('click', function(){
        $(function() {
            //autocomplete
            $(".auto.form-control").autocomplete({
                source: "student-search.php",
                minLength: 1,
                select: function(event, ui) {
                    //alert(ui.item.value);
                    $("#hidden_auto_complete_stid").val(ui.item.value);
                    var stid = ui.item.value;


                    $.get('student-search.php?stid=' + stid,
                        function(res) {//alert("firstname:"+res.fname+" lastname:"+res.lname);
                            $(".studentname").val(res.fname+" "+res.lname)
                            $(".userid").val(res.user_id)

                        },
                        'json');

                }

            });

            // For appending row
            var count=0;
            $("a.addAnother").click(function()
            {

                count++;//alert(count);
                if(count== 1){
                    $(".visibleOne").css('display','block');
                    $(".book_issue_date2").removeAttr('disabled');


                }if(count== 2){
                $(".visibleTwo").css('display','block');
                $(".book_issue_date3").removeAttr('disabled');

            }if(count>2){
                alert("Not more than 3.");

                return false;
            }
                //$(".isbnnumber").addClass('count');
                /*var new_row='<div class="row copyitem">'+
                 '<div class="input-group col-md-4" style=" margin-left: 130px">'+
                 '<span class="input-group-addon">ISBN</span>'+
                 '<input type="text" class="form-control isbnnumber'+count+'" placeholder="" name="isbnnumber" id="" >'+
                 '</div>'+

                 '<div class="input-group col-md-4">'+
                 '<span class="input-group-addon fetch'+count+'" id="" style="background: #aaeebb;border: 1px solid #eeccdd">Fetch</span>'+
                 '<input type="text" class="form-control bookname'+count+'" placeholder="" name="bookname" id="">'+
                 '</div>'+
                 '<button type="button" style="float:none" class="close" data-dismiss="alert">'+'<span style="font-size: 19px">× Delete</span>'+'</button>'+
                 '</div>';
                 //alert(new_row);
                 $(".input-group.col-md-12").append(new_row);
                 return false;
                 */


            });


// for fetch bookname by isbn number


            $('.fetch').on('click', function(){//alert('fetch');
//fetchCount++;
                var isbnnumber = $(".isbnnumber").val();//alert(isbnnumber);

                $.ajax({
                    type: "POST",
                    url: "bookByIsbnNumber.php",
                    data : {isbn: isbnnumber}, // add if using post
                    dataType : 'json', //text
                    /*error: function(data){
                     $('#content').text('Update unsuccessful!').
                     slideDown('slow');
                     console.log(data);
                     },*/
                    success: function(data){//alert("id:"+data.book_id+ "name:"+data.book_name)
                        $('.bookname').val(data.book_name);
                        $('.bookname_book_id').val(data.book_id);
                        //$(this).next('.bookname').val(data.book_name);
                        //bname.val(data.book_name);

                        console.log(data);
                        //somewhere over here use the $.getJSON() function
                    },
                    /*complete: function(data){
                     setTimeout(function(){
                     $('#content').slideUp('slow');
                     }, 3000);
                     }*/
                });

            });

            $('.fetch1').on('click', function(){//alert('fetch1');
//fetchCount++;
                var isbnnumber1 = $(".isbnnumber1").val();//alert(isbnnumber1);
                //var bname = $(this).next('.bookname');
                $.ajax({
                    type: "POST",
                    url: "bookByIsbnNumber.php",
                    data : {isbn: isbnnumber1}, // add if using post
                    dataType : 'json', //text
                    /*error: function(data){
                     $('#content').text('Update unsuccessful!').
                     slideDown('slow');
                     console.log(data);
                     },*/
                    success: function(data){//alert(data)
                        $('.bookname1').val(data.book_name);
                        $('.bookname1_book_id').val(data.book_id);
                        console.log(data);
                        //somewhere over here use the $.getJSON() function
                    },
                    /*complete: function(data){
                     setTimeout(function(){
                     $('#content').slideUp('slow');
                     }, 3000);
                     }*/
                });

            });

            $('.fetch2').on('click', function(){//alert('fetch2');
//fetchCount++;
                var isbnnumber2 = $(".isbnnumber2").val();//alert(isbnnumber2);
                //var bname = $(this).next('.bookname');
                $.ajax({
                    type: "POST",
                    url: "bookByIsbnNumber.php",
                    data : {isbn: isbnnumber2}, // add if using post
                    dataType : 'json', //text
                    /*error: function(data){
                     $('#content').text('Update unsuccessful!').
                     slideDown('slow');
                     console.log(data);
                     },*/
                    success: function(data){//alert(data)
                        $('.bookname2').val(data.book_name);
                        $('.bookname2_book_id').val(data.book_id);
                        //console.log(data);
                        //somewhere over here use the $.getJSON() function
                    },
                    /*complete: function(data){
                     setTimeout(function(){
                     $('#content').slideUp('slow');
                     }, 3000);
                     }*/
                });

            });



        });
    </script>
    <!-- script for removing the duplicate update successful message -->
    <script type="text/javascript">
        var seen = {};
        $('.messages.warning p,.messages.success p,.messages.info p').each(function() {
            var txt = $(this).text();
            if (seen[txt])
                $(this).remove();
            else
                seen[txt] = true;
        });
    </script>
<?php include('footer.php'); ?>