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
$email =$_SESSION["email"];
$queryStudent = "SELECT first_name, last_name, email, phone, password, roll_no from users INNER JOIN students ON students.user_id= users.id WHERE users.email="."'$email'";//print_r($query);
$queryTeacher = "SELECT first_name, last_name, email, phone, password from users INNER JOIN teachers ON teachers.user_id= users.id WHERE users.email="."'$email'";//print_r($query);
$queryLibrarian = "SELECT first_name, last_name, email, phone, password from users WHERE users.email="."'$email'";//print_r($query);
//$query = "SELECT books.id,book_name,isbn_number, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id=categories.id INNER JOIN authors ON books.author_id=authors.id ORDER BY book_name ASC LIMIT $page1, 10";
$resultStudent= $conn->query($queryStudent);//print_r($result);
$resultTeacher= $conn->query($queryTeacher);//print_r($result);
$resultLibrarian= $conn->query($queryLibrarian);//print_r($result);
//exit(mysql_error());
$resultStudent->setFetchMode(PDO::FETCH_ASSOC);
$resultTeacher->setFetchMode(PDO::FETCH_ASSOC);
$resultLibrarian->setFetchMode(PDO::FETCH_ASSOC);
$countmachStudent =$resultStudent->rowCount();
$countmachTeacher =$resultTeacher->rowCount();
$countmachLibrarian =$resultLibrarian->rowCount();
//echo $countmach;
if($countmachStudent ==1) {//print_r("login successful");exit;
    $row = $resultStudent->fetch();//print_r($row);exit;

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $roll = $row['roll_no'];//print_r($roll);
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    //print_r($role);
}if($countmachTeacher ==1) {//print_r("login successful");exit;
    $row = $resultTeacher->fetch();//print_r($row);exit;

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    //print_r($role);
}if($countmachLibrarian ==1) {//print_r("login successful");exit;
    $row = $resultLibrarian->fetch();//print_r($row);exit;

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    //print_r($role);
}
?>


<?php
if(count($_POST)>0) {//print_r($_POST);exit();
    /* Form Required Field Validation */
//    foreach ($_POST as $key => $value) {
//        if (empty($_POST[$key])) {
//            $message = ucwords($key) . " field is required";
//            break;
//        }
//    }

    /* Email Validation */
    if(!isset($message)) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid Email";
        }
    }
    if(isset($_POST['firstname']) && !empty($_POST['firstname'])) {
        $first_name= $_POST['firstname'];
    }else{
        $first_name= $first_name;
    }
    if(isset($_POST['lastname']) && !empty($_POST['lastname'])) {
        $last_name= $_POST['lastname'];
    }else{
        $last_name= $last_name;
    }
    if(isset($_POST['email']) && !empty($_POST['email'])) {
        $email= $_POST['email'];
    }else{
        $email= $email;
    }
    if(isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone= $_POST['phone'];
    }else{
        $phone= $phone;
    }
    if(isset($_POST['password']) && !empty($_POST['password'])) {
        $password= md5($_POST['password']);//print_r($password);exit;
    }else{
        $password= $password;//print_r($password);exit;
    }
    //print_r($password);
    /* Validation to check email exists */
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $query = $conn->query( "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'" );
        if( $query->rowCount() > 1 ) { # If rows are found for query
            $message =  "Email already exists!";
        }
    }

    /* Validation to check phone exists */
    if(!empty($_POST['phone'])){
        $query = $conn->query( "SELECT `phone` FROM `users` WHERE `phone` = '".$_POST['phone']."'" );
        if( $query->rowCount() > 1 ) { # If rows are found for query
            $message =  "phone already exists!";
        }
    }

    if(!isset($message)) {//print_r("process update");exit;

        $UpdateQueryUser = "Update users set first_name='$first_name'

,last_name='$last_name', phone='$phone', password='$password'
,email='$email' WHERE email='$email'";//print_r($UpdateQueryUser);exit;

        $result = $conn->query($UpdateQueryUser);
        header("Location:profile-manage.php?success-update=1");
    }
}


?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Profile</a>
        </li>
    </ul>
</div>
<?php echo $msg->display();?>
<?php //print_r($_SESSION);?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> Profile</h2>
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
                                        <form class="form form-horizontal" role="form" method="POST" action="profile-manage.php">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">First Name</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="firstname" value="<?php  echo $first_name; ?>">
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Last Name</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="lastname" value="<?php  echo $last_name; ?>">
                                                </div>
                                                <?php //echo $error_msg;?>
                                            </div>
                                            <?php if($role=='2'){ // if student ?>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Roll</label>
                                                <div class="col-md-6">
                                                    <input type="text" disabled value="<?php  echo $roll; ?>" name="rollno" class="form-control">
                                                    <input type="hidden" value="<?php  echo $roll; ?>" name="rollno" class="form-control">
                                                </div>
                                            </div>
                                            <?php } ?>


                                            <!-- <div class="form-group">
                                                <label class="col-md-4 control-label" for="postImage">Profile Picture</label>

                                                <div class="col-md-6">
                                                    <input id="input-file" type="file" name="image"
                                                           accept="image/*" class="file">
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">E-Mail</label>
                                                <div class="col-md-6">
                                                    <input type="email" disabled value="<?php echo $email; ?>" class="form-control" name="email">
                                                    <input type="hidden" value="<?php echo $email; ?>" class="form-control" name="email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Mobile No </label>
                                                <div class="col-md-6" style="position: relative;">
                                                    <input type="text" value="<?php echo $phone; ?>" class="form-control" name="phone" id="phone">
                                                    (<span style="color:#5383C1; font-size:smaller">example 8801XXXXXXXXX</span>)
                                                    <div class="phonemessage"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Password</label>
                                                <div class="col-md-6">
                                                    <div style="color:#d84315" id="passwordmessage"></div>
                                                    <div id="myform">
                                                        <input value="" id="myPassword" type="password" class="form-control txtNewPassword password_pop" name="password">

                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div id="sixchartor"></div>
                                                    <p class="text-info mar-0px">(Use combination of A-Z,a-z,1-9, symbols and minimum 9 character to strong your password.)</p>
                                                </div>

                                                <div class="clearfix"></div>
                                            </div>


                                            <div>
                                                <input type="hidden" name="role" value="2">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary btnCreateMyAccount">
                                                        Update
                                                    </button>
                                                    <a href="home.php"><button type="button" class="btn btn-primary" name="submit">Cancel</button></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
            </div>
        </div>
    </div>
</div><!--/row-->
<!-- script for removing the duplicate update successful message -->
<script type="text/javascript">
    var seen = {};
    $('.messages.success p').each(function() {
        var txt = $(this).text();
        if (seen[txt])
            $(this).remove();
        else
            seen[txt] = true;
    });
</script>
<?php include('footer.php'); ?>

