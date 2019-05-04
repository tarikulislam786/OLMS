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
<?php
if(isset($_GET["id"])) {
    $userId = $_GET["id"];
    if (!empty($userId)) {
        // detect this user id is contained in student, teacher or librarian entity
        $sqlStudent = 'SELECT id from students WHERE user_id = ? LIMIT 1';
        $stmtStudent = $conn->prepare($sqlStudent);
        $stmtStudent->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmtStudent->execute();

        $sqlTeacher = 'SELECT id from teachers WHERE user_id = ? LIMIT 1';
        $stmtTeacher = $conn->prepare($sqlTeacher);
        $stmtTeacher->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmtTeacher->execute();

        $sqlLibrarian = 'SELECT id from librarians WHERE user_id = ? LIMIT 1';
        $stmtLibrarian = $conn->prepare($sqlLibrarian);
        $stmtLibrarian->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmtLibrarian->execute();

        if ($stmtStudent->fetchColumn()){
            // query from student entity
            $stmt = $conn->prepare("select users.id, first_name, last_name, email, phone,role, password, discipline_id, session_id,roll_no from users INNER JOIN students ON students.user_id=users.id WHERE user_id=".$userId);//print_r($query);

        }elseif($stmtTeacher->fetchColumn()){
            // query from teacher entity
            $stmt = $conn->prepare("select users.id, first_name, last_name, email, phone,role, password, discipline_id, designation from users INNER JOIN teachers ON teachers.user_id=users.id WHERE user_id=".$userId);
        }elseif($stmtLibrarian->fetchColumn()){
            // query from librarian entity
            $stmt = $conn->prepare("select users.id, first_name, last_name, email, phone,role, password from users INNER JOIN librarians ON librarians.user_id=users.id WHERE user_id=".$userId);
        }else{
            die('not found');
        }
        $stmt->execute();
        $row = $stmt->fetch();
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $password = $row['password'];
        $role = $row['role'];print_r($role);
        if(!empty($row['discipline_id']))
        {
            $discipline = $row['discipline_id'];
        }
        if(!empty($row['session_id']))
        {
            $session = $row['session_id'];
        }
        if(!empty($row['roll_no']))
        {
            $roll_no = $row['roll_no'];
        }

        if(!empty($row['designation'])){
            $designation = $row['designation'];
        }

    }
}
?>









<!--<link id="bs-css" href="admin/css/bootstrap-cerulean.min.css" rel="stylesheet">-->
<!--<link href="admin/css/charisma-app.css" rel="stylesheet">-->
<!--<link rel="stylesheet" type="text/css" href="admin/css/message.css" media="all" />-->
<!--<link rel="stylesheet" href="admin/css/fileinput.min.css">-->
<?php
//$disciplineOps='';
//$result = $conn->query("SELECT id, name from disciplines");
////$stmt = $pdo->execute();
//while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//    $disciplineOps.= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
//}
//?>
<?php
//$sessionOps='';
//$result = $conn->query("SELECT id, session_name from sessions");
////$stmt = $pdo->execute();
//while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//    $sessionOps.= "<option value='" . $row['id'] . "'>" . $row['session_name'] . "</option>";
//}
//?>

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
    if (!isset($message)) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid Email";
        }
    }

    /* Validation to check email exists */
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
       // $query = $conn->query("SELECT `email` FROM `users` WHERE `email` = '" . $_POST['email'] . "'");//print_r($query->rowCount());exit;

        $query = $conn->query("SELECT `email` FROM `users` WHERE `email` = '" . $_POST['email']."'  AND `id` != '".$userId."'");


        if ($query->rowCount() > 0) { # If rows are found for query
            $message = "Email already exists!";
        }
    }

    /* Validation to check phone exists */
    if (!empty($_POST['phone'])) {
        $query = $conn->query("SELECT `phone` FROM `users` WHERE `phone` = '" . $_POST['phone'] . "'AND `id` != '".$userId."'");
        if ($query->rowCount() > 0) { # If rows are found for query
            $message = "phone already exists!";
        }
    } /* Validation to check roll exists */
    if (!empty($_POST['rollno'])) {
        $query = $conn->query("SELECT `roll_no` FROM `students` WHERE `roll_no` = '" . $_POST['rollno'] . "' AND `user_id` != '".$userId."'");
        if ($query->rowCount() > 0) { # If rows are found for query
            $message = "roll already exists!";
        }
    }
    if(!isset($message)) { // bad dile self roll update e roll exist bole nah
    if (isset($_POST)) {
        // for all type user
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        if (!empty($_POST["password"])) {
            $password = md5($_POST["password"]);
        } else {
            $password = $password;
        }
        // for students and teacher entity except for librarian
        if(!empty($_POST['discipline']))
        {
            $discipline = $_POST['discipline'];
        }

        $roll_no = $_POST['rollno'];
        $session = $_POST['session'];
        $designation = $_POST['designation'];
        //print_r($password);exit;
        if ($_POST['role'] == 2) // student
        {
            //print_r("student");exit;
            $UpdateQueryUser = "Update users set first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', password='$password' WHERE id=" . $userId;//print_r($UpdateQueryUser);exit;
            $result = $conn->query($UpdateQueryUser);

            $UpdateQueryStudent = "Update students set discipline_id='$discipline', session_id='$session', roll_no='$roll_no' WHERE user_id=" . $userId;//print_r($UpdateQueryStudent);exit();
            $result = $conn->query($UpdateQueryStudent);
        } elseif ($_POST['role'] == 3) // teacher
        {
            //print_r("teacher");exit;
            $UpdateQueryUser = "Update users set first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', password='$password' WHERE id=" . $userId;
            $result = $conn->query($UpdateQueryUser);
            $UpdateQueryTeacher = "Update teachers set discipline_id='$discipline',  designation='$designation' WHERE user_id=" . $userId;//print_r($UpdateQueryTeacher);exit();
            $result = $conn->query($UpdateQueryTeacher);
        } else { // librarian
            //print_r("librarian");exit;
            $_POST['role'] = 4;
            $UpdateQueryUser = "Update users set first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', password='$password' WHERE id=" . $userId;
            $result = $conn->query($UpdateQueryUser);
        }

        if (!empty($result)) {
            $message = "updated successfully!";
            //unset($_POST);
        } else {
            $message = "Problem in updating.!";
        }
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
                        <form class="form form-horizontal" role="form" method="POST" action="user-edit.php?id=<?php echo $userId;?>">
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
                                    <input type="email"  value="<?php echo $email;?>" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile No </label>
                                <div class="col-md-6" style="position: relative;">
                                    <input type="text" value="<?php echo $phone;?>" class="form-control" name="phone" id="phone">
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
  <input value="" id="myPassword" type="password" class="form-control" name="password">
<!--  <input value="--><?php //echo $password;?><!--" id="myPassword" type="hidden" class="form-control" name="password">-->
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
                                            <option <?php if($role== 2){echo "selected ";}else{echo "disabled";}?>                                                value="2">Student</option>
                                            <option <?php if($role== 3){echo                                                         "selected ";}else{echo "disabled ";}?>value="3">Teacher</option>
                                            <option <?php if($role== 4){echo                                                         "selected ";}else{echo "disabled   ";}?>value="4">Librarian</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <?php if($role>1 && $role<4){?>
                            <div class="form-group">
                                <label class="col-md-4 control-label discipline">Discipline</label>
                                <div class="col-md-6">
                                    <select name="discipline" class="form-control">
                                        <option>Select Discipline</option>
                 <?php
                      $stmt = $conn->query("SELECT id, name from disciplines");
                           //$stmt = $pdo->execute();
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
                           <option <?php if($discipline== $row["id"])echo "selected"?> value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                 <?php }
                 ?>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
                            <div class="student" style="display:none">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Roll</label>
                                    <div class="col-md-6">
                                        <input type="text" value="<?php echo $roll_no; ?>" name="rollno" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Session</label>
                                    <div class="col-md-6">
                                        <select name="session" class="form-control">
                                            <option>Select Session</option>
                                            <?php
                                            $stmt = $conn->query("SELECT id, session_name from sessions");
                                            //$stmt = $pdo->execute();
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
                                                <option <?php if($session== $row["id"])echo "selected"?> value="<?php echo $row["id"]; ?>"><?php echo $row["session_name"]; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="teacher" style="display: none">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Designation</label>
                                    <div class="col-md-6">
                                        <select name="designation" class="form-control">
                                            <option>Choose designation</option>
                                            <option value="Lecturer" <?php if($designation== "Lecturer")echo "selected";?>>Lecturer</option>
                                            <option value="Assistant Professor" <?php if($designation== "Assistant Professor")echo "selected";?>>Assistant Professor</option>
                                            <option <?php if($designation== "Associate Professor")echo "selected";?> value="Associate Professor">Associate Professor</option>
                                            <option <?php if($designation== "Professor")echo "selected";?> value="Professor">Professor</option>
                                            <option <?php if($designation== "Other")echo "selected";?> value="Other">Other</option>
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

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              