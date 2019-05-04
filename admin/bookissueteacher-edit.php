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
if(isset($_GET["id"]))
{
    $bookIssueId = $_GET["id"];
    if(!empty($bookIssueId)) {
        //$sql = "SELECT issue_details FROM book_issues WHERE id =" . $bookIssueId;
        //$result = $conn->query($sql);
        //$result->setFetchMode(PDO::FETCH_ASSOC);print_r($result);
        $stmt = $conn->prepare("SELECT student_id, issue_details FROM book_issues WHERE id =" . $bookIssueId);
        $stmt->execute();
        $row = $stmt->fetch();
        $bookIssueDetails = $row['issue_details'];
        $stid = $row['student_id'];
        $unserializedIssueDetails = unserialize(base64_decode($bookIssueDetails));
        //print_r($unserializedIssueDetails);//exit;
        // this arr isn't indexed properly.

        // Re-index an array
        $isbnArray = array_values(array_filter($unserializedIssueDetails["isbnnumber"]));
        $booknameArray = array_values(array_filter($unserializedIssueDetails["bookname"]));
        $booknameBookIdArray = array_values(array_filter($unserializedIssueDetails["bookname_book_id"]));
        $book_issue_dateArray = array_values(array_filter($unserializedIssueDetails["book_issue_date"]));
        //print_r($unserializedPrevBookIssueDetails);exit;
        // Replacing the arr and key with unique value
        $unserializedIssueDetails["isbnnumber"] = array_unique(array_replace($unserializedIssueDetails["isbnnumber"], $isbnArray));
        $unserializedIssueDetails["bookname"] = array_unique(array_replace($unserializedIssueDetails["bookname"], $booknameArray));
        $unserializedIssueDetails["bookname_book_id"] = array_unique(array_replace($unserializedIssueDetails["bookname_book_id"], $booknameBookIdArray));
        // issue date shouldn't be unique to calculate late fine properly
        $unserializedIssueDetails["book_issue_date"] = $book_issue_dateArray;
        // Now arr is okay
        //print_r($unserializedIssueDetails);//exit;

        //Count total already  issued books
        $totalPrevIssuedBooks = count(array_filter($unserializedIssueDetails["isbnnumber"]));
        //print_r($totalPrevIssuedBooks);
        // Late Charge $5 per book if issued date beyond seven days
       /* $issuedDate = strtotime($unserializedIssueDetails["issue_date"]);
        $submitDate = strtotime(date('Y-m-d'));

        $days_between = ceil(abs($submitDate - $issuedDate) / 86400);//print_r($days_between);
        if($days_between>7){
            $charged = ($totalPrevIssuedBooks*5);
            //print_r($charged);
        } */

        $issuedDateArray = $unserializedIssueDetails["book_issue_date"];//print_r($issuedDateArray);
        //print_r($issuedDateArray[0]);
        for($i=0;$i<count($issuedDateArray);$i++)
        {
            $countChargedIssued = 0;
            $issuedDate = strtotime($issuedDateArray[$i]);
            $submitDate = strtotime(date('Y-m-d'));

            $days_between = ceil(abs($submitDate - $issuedDate) / 86400);//print_r($days_between);
            if($days_between>7){
                $countChargedIssued++;
                $charged[] = ($countChargedIssued*5);

            }
        }
       // print_r($issuedDate);
        //print_r($charged);
        $lateFine = array_sum($charged);
        //print_r($lateFine);
    }
}

    if(isset($_POST["teacherEmail"]))
    {//print_r($_POST);exit();
        $emailid = $_POST["teacherEmail"];//print_r($emailid);exit();
        $issuedate = $_POST["issue_date"];
        $teachername= $_POST["teachername"];
        $userid= $_POST["userid"];
        // check if all book is received
        if (array_key_exists('isbnnumber', $_POST)) {
            // if not all books deleted/received
            // updating stock for book table
            $stmt = $conn->prepare("Select issue_details from book_issues where user_id = '$userid'");
            $stmt->execute();
            $row = $stmt->fetch();

            $PrevBookIssueDetails = $row['issue_details'];
            $unserializedPrevBookIssueDetails = unserialize(base64_decode($PrevBookIssueDetails));
            //print_r($unserializedPrevBookIssueDetails['isbnnumber']);exit;
            $receivedBook =  array_diff($unserializedPrevBookIssueDetails['isbnnumber'], $_POST['isbnnumber']);//print_r($receivedBook);exit();
            // re-index the received book arr
            $reIndexedreceivedBookArray = array_values(array_filter($receivedBook));//print_r($reIndexedreceivedBookArray);exit();
            if(!empty($reIndexedreceivedBookArray)){//;exit();
                //print_r("array diff found");exit();
               
               // update stock in book table
               for($i=0;$i<count($reIndexedreceivedBookArray);$i++) { 
                    $stmt = $conn->prepare("Select piece_of_books from books where isbn_number='".$reIndexedreceivedBookArray[$i]."'");
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $piece_of_books = $row['piece_of_books'];
                    $updatePieceOfBooks = $piece_of_books+1;
                    //print_r($piece_of_books);exit();
                    $sql = "UPDATE books SET piece_of_books='$updatePieceOfBooks' WHERE isbn_number = '".$reIndexedreceivedBookArray[$i]."'";//print_r($sql);exit;
                    $count = $conn->exec($sql);
                }

                $sql = "DELETE  FROM book_issues WHERE user_id = '$userid'";//print_r($sql);exit;
                $count = $conn->exec($sql);

                //print_r($_POST);exit;
                $serialized = base64_encode(serialize($_POST));//print_r($serialized);exit();
                //$UnserializeBookIssueDetailss = unserialize(base64_decode($serialized));print_r($UnserializeBookIssueDetailss);exit();
                $sql = "INSERT INTO `book_issues` (`issue_date`, `user_id`, `name`, `issue_details`, `created_at`, `updated_at`)VALUES('$issuedate', '$userid', '$teachername','$serialized', now(), now())";//print_r($sql);exit;
                $count = $conn->exec($sql);
                header("Location:bookissue-manage.php?success=1");
            }else{
                // when no book is received
                header("Location:bookissue-manage.php");
            }
            // delete all prev record then insert instead of update
            $sql = "DELETE  FROM book_issues WHERE user_id = '$userid'";//print_r($sql);exit;
            $count = $conn->exec($sql);

            //print_r($_POST);exit;
            $serialized = base64_encode(serialize($_POST));//print_r($serialized);exit();
           // $UnserializeBookIssueDetailss = unserialize(base64_decode($serialized));print_r($UnserializeBookIssueDetailss);exit();
            $sql = "INSERT INTO `book_issues` (`issue_date`, `user_id`, `name`, `issue_details`, `created_at`, `updated_at`)VALUES('$issuedate', '$userid', '$teachername','$serialized', now(), now())";//print_r($sql);exit;
            $count = $conn->exec($sql);
            header("Location:bookissue-manage.php?success=1");

        }else{
            // if deleted/received all books
            // updating stock for book table
        
            $stmt = $conn->prepare("Select issue_details from book_issues where user_id = '$userid'");
            $stmt->execute();
            $row = $stmt->fetch();

            $PrevBookIssueDetails = $row['issue_details'];
            $unserializedPrevBookIssueDetails = unserialize(base64_decode($PrevBookIssueDetails));
            //print_r($unserializedPrevBookIssueDetails);exit;
            for($i=0;$i<count($unserializedPrevBookIssueDetails['isbnnumber']);$i++) {

            $stmt = $conn->prepare("Select piece_of_books from books where isbn_number='".$unserializedPrevBookIssueDetails['isbnnumber'][$i]."'");
            $stmt->execute();
            $row = $stmt->fetch();
            $piece_of_books = $row['piece_of_books'];
            $updatePieceOfBooks = $piece_of_books+1;
            //print_r($piece_of_books);exit();
            $sql = "UPDATE books SET piece_of_books='$updatePieceOfBooks' WHERE isbn_number = '".$unserializedPrevBookIssueDetails['isbnnumber'][$i]."'";//print_r($sql);exit;
            $count = $conn->exec($sql);
            }
            $sql = "DELETE  FROM book_issues WHERE user_id = '$userid'";//print_r($sql);exit;
            $count = $conn->exec($sql);
            header("Location:bookissue-manage.php");
        }
}


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
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;Issue book</h2>
                </div>
                <div class="box-content">
                    <form role="form"  action="" method="post">
                        <div class="form-group">
                            <span class="required">*</span><label for="exampleInputEmail1">Issue Date</label>
                            <input type="text" name="issue_date" class="form-control" id="issue_date" value="<?php echo $unserializedIssueDetails["issue_date"];?>" style="width:20%">
                            <!-- <span style="color:red;"><?php //echo @$message_error;?></span> -->
                        </div>
                            <div class="form-group">
                                <span class="required">*</span><label for="exampleInputEmail">Teacher's Email ID</label>
                                <input type="text" name="teacherEmail" value="<?php echo $unserializedIssueDetails["teacherEmail"];?>" disabled class="auto  form-control" id="emailid" style="width:20%">
                                <!-- here we do same thing except disabled feature because disabled field value not posted -->
                                <input type="hidden" name="teacherEmail" value="<?php echo $unserializedIssueDetails["teacherEmail"];?>" class="auto  form-control" id="emailid" style="width:20%">
                                <span style="color:red;"><?php echo @$message_error;?></span>

                            </div>
                            <div class="form-group">
                                <span class="required">*</span><label for="exampleInputEmail">Teacher Name</label>
                                <input type="text" value="<?php echo $unserializedIssueDetails["teachername"];?>" disabled class="form-control teachername" name="teachername" style="width:20%">
                                <input type="hidden" value="<?php echo $unserializedIssueDetails["teachername"];?>"  class="form-control teachername" name="teachername" style="width:20%">
                                <input type="hidden" value="<?php echo $unserializedIssueDetails["userid"];?>" class="form-control userid" name="userid" style="width:20%">
                                <span style="color:red;"><?php echo @$message_error;?></span>
                            </div>

                        <?php /*if(isset($_POST['stid'])){
                            $return_arr = array();
                            $stid = $_POST['stid'];
                            $stmt = $conn->prepare("SELECT users.id,first_name,last_name,roll_no FROM users INNER JOIN students ON users.id=students.user_id WHERE roll_no=".$stid);
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

                            <?php if($totalPrevIssuedBooks== 3) {// if 3 book is issued 
                               // print_r($unserializedIssueDetails);
                            ?>
                                <?php for ($i = 0; $i < 3; $i++) { ?>
                                    <div class="input-group col-md-12">

                                        <div class="row copyitem">
                                            <div class="input-group col-md-4" style=" margin-left: 130px;">
                                                <span class="input-group-addon">ISBN</span>
                                                <input type="text"
                                                       value="<?php echo $unserializedIssueDetails["isbnnumber"][$i] ?>"
                                                       class="form-control isbnnumber" placeholder=""
                                                       name="isbnnumber[]" id="">
                                                <span style="color:red;"><?php echo @$message_error; ?></span>
                                            </div>

                                            <div class="input-group col-md-4">
                                                <span class="input-group-addon fetch"
                                                      style="background: #aaeebb;border: 1px solid #eeccdd;"
                                                      id="">Fetch</span>
                                                <input type="text"
                                                <?php
                                                    $issuedDate = strtotime($unserializedIssueDetails["book_issue_date"][$i]);print_r("date of issue "+ $issuedDate);
                                                    $submitDate = strtotime(date('Y-m-d'));
                                                    $days_between = ceil(abs($submitDate - $issuedDate) / 86400);print_r($days_between);
                                                    if($days_between>7){echo 'style="color:red"';}
                                                    ?>
                                                       value="<?php echo $unserializedIssueDetails["bookname"][$i] ?>"
                                                       class="form-control bookname" placeholder="" name="bookname[]"
                                                       id="">
                                                <input type="hidden"
                                                       value="<?php echo $unserializedIssueDetails["bookname_book_id"][$i] ?>"
                                                       id="" name="bookname_book_id[]" class="bookname_book_id">
                                                <input type="hidden" id=""  name="book_issue_date[]" class="book_issue_date1" value="<?php echo $unserializedIssueDetails["book_issue_date"][$i];?>">
                                                <span style="color:red;"><?php echo @$message_error; ?></span>
                                            </div>
                                            <button type="button" style="float:none" class="close" data-dismiss="alert">
                                                <span class="deleteItem"
                                                      style="font-size: 19px;color:#2fa4e7">× Delete</span></button>
                                        </div>
                                    </div>
                                <?php }
                            }elseif($totalPrevIssuedBooks== 2) {// if 2 book is issued 
                           // print_r($unserializedIssueDetails);
                            ?>
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <div class="input-group col-md-12">

                                        <div class="row copyitem">
                                            <div class="input-group col-md-4" style=" margin-left: 130px;">
                                                <span class="input-group-addon">ISBN</span>
                                                <input type="text"
                                                       value="<?php echo $unserializedIssueDetails["isbnnumber"][$i] ?>"
                                                       class="form-control isbnnumber" placeholder=""
                                                       name="isbnnumber[]" id="">
                                                <span style="color:red;"><?php echo @$message_error; ?></span>
                                            </div>

                                            <div class="input-group col-md-4">
                                                                        <span class="input-group-addon fetch"
                                                                              style="background: #aaeebb;border: 1px solid #eeccdd;"
                                                                              id="">Fetch</span>
                                                <input type="text"
                                                <?php
                                                    $issuedDate = strtotime($unserializedIssueDetails["book_issue_date"][$i]);
                                                    $submitDate = strtotime(date('Y-m-d'));
                                                    $days_between = ceil(abs($submitDate - $issuedDate) / 86400);print_r($days_between);
                                                    if($days_between>7){echo 'style="color:red"';}
                                                    ?>
                                                       value="<?php echo $unserializedIssueDetails["bookname"][$i] ?>"
                                                       class="form-control bookname" placeholder="" name="bookname[]"
                                                       id="">
                                                <input type="hidden"
                                                       value="<?php echo $unserializedIssueDetails["bookname_book_id"][$i] ?>"
                                                       id="" name="bookname_book_id[]" class="bookname_book_id">
                                                <input type="hidden" id=""  name="book_issue_date[]" class="book_issue_date2" value="<?php echo $unserializedIssueDetails["book_issue_date"][$i];?>">
                                                <span style="color:red;"><?php echo @$message_error; ?></span>
                                            </div>
                                            <button type="button" style="float:none" class="close" data-dismiss="alert">
                                                                        <span class="deleteItem"
                                                                              style="font-size: 19px;color:#2fa4e7">× Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                <?php }
                            }else{
                              //  print_r($unserializedIssueDetails);
                                ?>
                                <div class="input-group col-md-12">
                                    <div class="row copyitem">
                                        <div class="input-group col-md-4" style=" margin-left: 130px;">
                                            <span class="input-group-addon">ISBN</span>
                                            <input type="text" value="<?php echo $unserializedIssueDetails["isbnnumber"][0];?>" class="form-control isbnnumber" placeholder="" name="isbnnumber[]" id="">
                                            <span style="color:red;"><?php echo @$message_error;?></span>
                                        </div>

                                        <div class="input-group col-md-4">
                                            <span class="input-group-addon fetch"  style="background: #aaeebb;border: 1px solid #eeccdd;" id="" >Fetch</span>
                                            <input type="text" value="<?php echo $unserializedIssueDetails["bookname"][0];?>" class="form-control bookname" placeholder="" name="bookname[]" id="">
                                            <input type="hidden" value="<?php echo $unserializedIssueDetails["bookname_book_id"][0];?>" id=""  name="bookname_book_id[]" class="bookname_book_id">
                                            <input type="hidden" name="book_issue_date[]" class="book_issue_date3" value="<?php echo $unserializedIssueDetails["book_issue_date"][0];?>">
                                            <span style="color:red;"><?php echo @$message_error;?></span>
                                        </div>
                                        <button type="button" style="float:none" class="close" data-dismiss="alert"><span class="deleteItem" style="font-size: 19px;color:#2fa4e7">× Delete</span></button>
                                    </div>
                                </div>
    <?php }?>
<!--                            <a href="#" id="" class="addAnother" style="margin-left: 280px;"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add another</a>-->
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <span class="required">*</span><label for="exampleInputEmail">Submitted Date</label>
                                <input type="text" value="<?php echo date('Y-m-d')?>" class="form-control submitdate" placeholder="" name="submitdate" style="">
                                <span style="color:red;"><?php echo @$message_error;?></span>
                            </div>
                            <div class="form-group">
                                <span class="required">*</span><label for="exampleInputEmail">Late Charge</label>
                                <input type="text" disabled value="<?php echo $lateFine; ?>" class="form-control latecharge" placeholder="" name="latecharge" style="">
                                <input type="hidden" value="<?php echo $lateFine; ?>" class="form-control latecharge" placeholder="" name="latecharge" style="">
                                <span style="color:red;"><?php echo @$message_error;?></span>
                            </div>

                        </div>
                        <div style="margin-top: 10px;">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <a href="bookissue-manage.php"><button type="button" class="btn btn-default" name="submit">Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/span-->
    </div><!--/row-->

<?php include('footer.php'); ?>