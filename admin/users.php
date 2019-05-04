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
<!--<link id="bs-css" href="admin/css/bootstrap-cerulean.min.css" rel="stylesheet">-->
<!--<link href="admin/css/charisma-app.css" rel="stylesheet">-->
<!--<link rel="stylesheet" type="text/css" href="admin/css/message.css" media="all" />-->
<!--<link rel="stylesheet" href="admin/css/fileinput.min.css">-->
<?php
$disciplineOps='';
$result = $conn->query("SELECT id, name from disciplines");
//$stmt = $pdo->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $disciplineOps.= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}
?>
<?php
$sessionOps='';
$result = $conn->query("SELECT id, session_name from sessions");
//$stmt = $pdo->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $sessionOps.= "<option value='" . $row['id'] . "'>" . $row['session_name'] . "</option>";
}
?>

<?php
if(count($_POST)>0) {//print_r($_POST);exit();
    /* Form Required Field Validation */
   /* foreach($_POST as $key=>$value) {
        if(empty($_POST[$key])) {
            $message = ucwords($key) . " field is required";
            break;
        }
    }*/

    /* Email Validation */
    if(!isset($message)) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid Email";
        }
    }

    /* Validation to check email exists */
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $query = $conn->query( "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'" );
        if( $query->rowCount() > 0 ) { # If rows are found for query
            $message =  "Email already exists!";
        }
    }

    /* Validation to check phone exists */
    if(!empty($_POST['phone'])){
        $query = $conn->query( "SELECT `phone` FROM `users` WHERE `phone` = '".$_POST['phone']."'" );
        if( $query->rowCount() > 0 ) { # If rows are found for query
            $message =  "phone already exists!";
        }
    }
    /* Validation to check roll exists */
    if(!empty($_POST['rollno'])){
        $query = $conn->query( "SELECT `roll_no` FROM `students` WHERE `roll_no` = '".$_POST['rollno']."'" );
        if( $query->rowCount() > 0 ) { # If rows are found for query
            $message =  "roll already exists!";
        }
    }
    if(!isset($message)) {
        if($_POST['role']== 2) // student
        {
            //print_r("student");exit;
            $InsertQueryUser = "INSERT INTO users (password, email, first_name, last_name, role, phone, status, created_at, updated_at) VALUES
        ('" . md5($_POST["password"]) . "', '" . $_POST["email"] . "', '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '" . $_POST["role"] . "', '" . $_POST["phone"] . "',0, now(), now())";
            $result = $conn->query($InsertQueryUser);
            $lastInsertId = $conn->lastInsertId();//print_r($lastInsertId);exit();
            $InsertQueryStudent = "INSERT INTO students (user_id, discipline_id, session_id, roll_no, created_at, updated_at) VALUES
        ('" . $lastInsertId . "', '" . $_POST["discipline"] . "', '" . $_POST["session"] . "', '" . $_POST["rollno"] . "',  now(), now())";//print_r($InsertQueryStudent);exit();
            $result = $conn->query($InsertQueryStudent);
        }elseif($_POST['role']== 3) // teacher
        {
            //print_r("teacher");exit;
            $InsertQueryUser = "INSERT INTO users (password, email, first_name, last_name, role, phone, status, created_at, updated_at) VALUES
        ('" . md5($_POST["password"]) . "', '" . $_POST["email"] . "', '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '" . $_POST["role"] . "', '" . $_POST["phone"] . "',0, now(), now())";
            $result = $conn->query($InsertQueryUser);
            $lastInsertId = $conn->lastInsertId();//print_r($lastInsertId);exit();
            $InsertQueryTeacher = "INSERT INTO teachers (user_id, discipline_id, designation, created_at, updated_at) VALUES
        ('" . $lastInsertId . "', '" . $_POST["discipline"] . "', '" . $_POST["designation"] . "', now(), now())";//print_r($InsertQueryStudent);exit();
            $result = $conn->query($InsertQueryTeacher);
        }else{ // librarian
            //print_r("librarian");exit;
            $_POST['role']= 4;
            $InsertQueryUser = "INSERT INTO users (password, email, first_name, last_name, role, phone, status, created_at, updated_at) VALUES
        ('" . md5($_POST["password"]) . "', '" . $_POST["email"] . "', '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '" . $_POST["role"] . "', '" . $_POST["phone"] . "',0, now(), now())";
            $result = $conn->query($InsertQueryUser);
            $lastInsertId = $conn->lastInsertId();//print_r($lastInsertId);exit();
            $InsertQueryLibrarian = "INSERT INTO librarians (user_id, created_at, updated_at) VALUES
        ('" . $lastInsertId . "', now(), now())";//print_r($InsertQueryStudent);exit();
            $result = $conn->query($InsertQueryLibrarian);
        }

        if(!empty($result)) {
            $message = "registered successfully!";
            unset($_POST);
        } else {
            $message = "Problem in registration. Try Again!";
        }
    }
}
?>
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




<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Users</a>
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
                        <form class="form form-horizontal" role="form" method="POST" action="users.php">
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
                                        <input type="text" required value="" name="rollno" class="form-control">

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
                                    <input type="email"  value="" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile No </label>
                                <div class="col-md-6" style="position: relative;">
                                    <input type="text" value="" class="form-control" name="phone" id="phone">
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
                            <div class="form-group">
                                <label class="col-md-4 control-label">Role</label>
                                <div class="col-md-6">
                                    <div id="myform">
                                        <select id="role" class="form-control" name="role">
                                            <option value="choose">Select Role</option>
                                            <option value="2">Student</option>
                                            <option value="3">Teacher</option>
                                            <option value="4">Librarian</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label discipline">Discipline</label>
                                <div class="col-md-6">
                                    <select name="discipline" class="form-control">
                                        <option value="">Select Discipline</option>
                                        <?php echo $disciplineOps;?>
                                    </select>
                                </div>
                            </div>

                            <div class="student" style="display:none">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Roll</label>
                                    <div class="col-md-6">
                                        <input type="text" value="<?php if(isset($_POST['rollno'])) echo $_POST['rollno']; ?>" name="rollno" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Session</label>
                                    <div class="col-md-6">
                                        <select name="session" class="form-control">
                                            <option value="">Select Session</option>
                                            <?php echo $sessionOps;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="teacher" style="display: none">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Designation</label>
                                    <div class="col-md-6">
                                        <select name="designation" class="form-control">
                                            <option value="">Choose designation</option>
                                            <option value="Lecturer">Lecturer</option>
                                            <option value="Assistant Professor">Assistant Professor</option>
                                            <option value="Associate Professor">Associate Professor</option>
                                            <option value="Professor">Professor</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="librarian">

                            </div>
                            <div class="form-inline">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btnCreateMyAccount">
                                        Save User
                                    </button>
                                    <a href="users-manage.php">
                                        <div class="btn btn-primary">
                                            Cancel
                                        </div>
                                    </a>
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
<script type="text/javascript">
    $(document).ready(function(){
        $("select#role").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="2"){ //student
                    //$('.teacher select[name="discipline"]').attr('disabled','disabled');
                    $(".teacher").hide();
                    $(".librarian").hide();
                    $(".student").show();
                    $('select[name="discipline"]').attr('disabled',false);
                    $('select[name="discipline"]').attr('required',true);
                    $('select[name="session"]').attr('required',true);
                    $('input[name="rollno"]').attr('required',true);
                    $('select[name="discipline"]').css('display','block');
                    $('.control-label.discipline').css('display','block');
                }
                if($(this).attr("value")=="3"){ //teacher
                    //$('.student select[name="discipline"]').attr('disabled','disabled');
                    //$('.teacher select[name="discipline"]').removeAttr('disabled');
                    $(".student").hide();
                    $(".librarian").hide();
                    $(".teacher").show();
                    $('select[name="discipline"]').attr('disabled',false);
                    $('select[name="discipline"]').attr('required',true);
                    $('select[name="designation"]').attr('required',true);
                    $('select[name="discipline"]').css('display','block');
                    $('.control-label.discipline').css('display','block');
                }
                if($(this).attr("value")=="4"){ //librarian
                    //$('input[name="rollno"]').attr('disabled','disabled');
                    //$("input").removeAttr('disabled');
                    $(".student").hide();
                    $(".teacher").hide();
                    $(".librarian").show();
                    $('select[name="discipline"]').attr('disabled','disabled');
                    $('select[name="discipline"]').css('display','none');
                    $('.control-label.discipline').css('display','none');
                }
                /*if($(this).attr("value")=="choose"){
                    $(".box").hide();
                    $(".choose").show();
                }*/
            });
        }).change();
    });
</script>
<?php include('footer.php'); ?>

