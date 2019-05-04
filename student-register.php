<?php
$no_visible_elements = true;
error_reporting(1);
//include('admin/header.php'); 
include('admin/dbconnect.php');
require_once "phpmailer/class.phpmailer.php";

?>
<?php
//session_start(); // session started from connect.php
if(isset($_SESSION["email"])){
    header("location:index.php");
    exit();
}
?>
<?php
// class message also loaded from connect.php.
//------------------------------------------------------------------------------
// A session is required for the messages to work
//------------------------------------------------------------------------------
//if( !session_id() ) session_start();

//------------------------------------------------------------------------------
// Include the Messages class and instantiate it
//------------------------------------------------------------------------------
//require_once('../class.messages.php');
//$msg = new Messages();
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
    foreach($_POST as $key=>$value) {
    if(empty($_POST[$key])) {
    $message = ucwords($key) . " field is required";
    break;
    }
    }
    /* Password Matching Validation */
    if($_POST['password'] != $_POST['password_confirmation']){ 
    $message = 'Passwords should be same<br>'; 
    }

    /* Email Validation */
    if(!isset($message)) {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $message = "Invalid Email";
    }
    }

    /* Validation to check if gender is selected */
    // if(!isset($message)) {
    // if(!isset($_POST["gender"])) {
    // $message = " Gender field is required";
    // }
    // }

    /* Validation to check if Terms and Conditions are accepted */
    if(!isset($message)) {
    if(!isset($_POST["terms"])) {
    $message = "Accept Terms and conditions before submit";
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
        
        $InsertQueryUser = "INSERT INTO users (password, email, first_name, last_name, role, phone, status, created_at, updated_at) VALUES
        ('" . md5($_POST["password"]) . "', '" . $_POST["email"] . "', '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '" . $_POST["role"] . "', '" . $_POST["phone"] . "',0, now(), now())";
        $result = $conn->query($InsertQueryUser);
        $lastInsertId = $conn->lastInsertId();//print_r($lastInsertId);exit();
       $InsertQueryStudent = "INSERT INTO students (user_id, discipline_id, session_id, roll_no, created_at, updated_at) VALUES
        ('" . $lastInsertId . "', '" . $_POST["discipline"] . "', '" . $_POST["session"] . "', '" . $_POST["rollno"] . "',  now(), now())";//print_r($InsertQueryStudent);exit();
        $result = $conn->query($InsertQueryStudent);
        if(!empty($result)) {
            //$message = "You have registered successfully!";
            //unset($_POST);
            $email = $_POST['email'];
            $message = '<html><head>
                <title>Email Verification</title>
                </head>
                <body>';
            $message .= '<h1>Hi ' . $name . '!</h1>';
            $message .= '<p><a href="'.SITE_URL.'activate.php?id=' . base64_encode($lastID) . '">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
            $message .= "</body></html>";


            // php mailer code starts
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            //$mail->IsSMTP(); // telling the class to use SMTP

            $mail->CharSet = 'utf-8';
            $mail->SMTPDebug  = 0;              // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port = 587; // or 587                  // set the SMTP port for the GMAIL server
            $mail->isHTML(true);
            $mail->Username = 'youremail@gmail.com';
            $mail->Password = 'yourpassword';
            $mail->SMTPKeepAlive = true;
            $mail->SetFrom('youremail@gmail.com', 'Your Name',0);
            $mail->AddAddress($email);

            $mail->Subject = trim("Email Verifcation - www.thesoftwareguy.in");
            $mail->MsgHTML($message);
            try {//print_r($mail->MsgHTML($message));exit();
                $from    = 'from@domain.com';
                $to      = $email;
                $subject = 'subject';
                $body    = 'Hello!';

                $mail->send($to, $subject, $body);
                $msg = "An email has been sent for verfication.";
                $msgType = "success";
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msgType = "warning";
            }
        } else {
            $message = "Problem in registration. Try Again!";   
        }
    }
}
?>
<div class = "bg">
        <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php if(isset($message)){?>
                <div class="message"><?php echo $message; ?></div>
                <?php }?>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Student Registration Form</div>
                    <div class="panel-body">
                        <form class="form form-horizontal" role="form" method="POST" action="student-register.php">
                        <div class="form-group">
                            <label class="col-md-4 control-label">First Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                            </div>
            
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                            </div>
                            <?php echo $error_msg;?>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Roll</label>
                            <div class="col-md-6">
                                <input type="text" value="<?php if(isset($_POST['rollno'])) echo $_POST['rollno']; ?>" name="rollno" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Discipline</label>
                            <div class="col-md-6">
                                <select name="discipline" class="form-control">
                                    <option>Select Discipline</option>
                                    <?php echo $disciplineOps;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Session</label>
                            <div class="col-md-6">
                                <select name="session" class="form-control">
                                    <option>Select Session</option>
                                    <?php echo $sessionOps;?>
                                </select>
                            </div>
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
                                <input type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Mobile No </label>
                            <div class="col-md-6" style="position: relative;">
                                <input type="text" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>" class="form-control" name="phone" id="phone">
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
                                    <input value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" id="myPassword" type="password" class="form-control txtNewPassword password_pop"
                                           
                                           name="password" value="">
                                </div>
                                <div class="clearfix"></div>
                                <div id="sixchartor"></div>
                                <p class="text-info mar-0px">(Use combination of A-Z,a-z,1-9, symbols and minimum 9 character to strong your password.)</p>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <div style="position: relative;">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           value="" id="txtConfirmPassword" onChange="checkPasswordMatch();"
                                           >

                                    <div class="registrationFormAlert divCheckPasswordMatch"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group" style="text-align: center"><p style="margin-right: 65px;
">
                        <input type="checkbox" name="terms"> I accept Terms and Conditions</p>
                        </div>
                        <div>
                            <input type="hidden" name="role" value="2">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btnCreateMyAccount">
                                    Register
                                </button>
                            </div>
                        </div>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('ready', function () {
        $("#input-file").fileinput({
            previewFileType: "image",
        });
    });
</script>
<script src="admin/js/fileinput.min.js"></script>

<?php require('footer.php'); ?>