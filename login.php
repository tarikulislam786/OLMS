<?php
$no_visible_elements = true;
error_reporting(1);
//include('admin/header.php'); 
include('admin/dbconnect.php');
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
<?php
try {
    //global $countmach;
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];//print_r($email);
        $password = md5($_POST['password']);
        $sql = 'SELECT id FROM users where email="'.$email.'" and password ="'.$password.'" limit 1';//print_r($sql);exit;
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $countmach =$q->rowCount();
        //echo $countmach;
        if($countmach ==1){//print_r("login successful");exit;
            while($row = $q->fetch()){//print_r($row);exit;
                $id = $row['id'];
            }
            $_SESSION['id']=$id;
            $_SESSION['email']=$email;
            //$_SESSION['name']=$name;
            $_SESSION['password']=$password;
            //print_r($name);
            header("location:admin/home.php");
            exit();
        } else {
            $countmach = 2; // If incorrect login details are given?
            //echo 'that information is incorrect,try again <a href="login.php">click here</a>';
            //exit();
            //header("Location:login.php?credential-error=1");
            $Message = urlencode("Login credential error");
            $msg->add('e', 'The email or password you entered was incorrect. Please try again.');
            header("Location:login.php?Message=".$Message);
            exit();
        }
        // Define an insert query
        //header("Location:login.php");
    }
    $conn = null;        // Disconnect
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
<div class = "bg">
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Online Library</h2>
        </div>
        <!--/span-->
    </div><!--/row-->
    <div class="row">
        <div class="well col-md-5 center login-box">
                <?php echo $msg->display();?>
            <!-- <div class="alert alert-info">
                Please login with your Username and Password.
            </div> -->
            <form class="form-horizontal" action="login.php" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" name="email" class="form-control" placeholder="Username">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" >
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary" style="background: #B94846;">Login</button>
                    </p>
                </fieldset>
            </form>
            <div class="row">
                <h4 class="center">Or</h4>
                <div class="col-md-6"><a href="student-register.php"><button type="button" class="btn btn-primary">Student Register</button></a></div>
                <div class="col-md-6"><a href="teacher-register.php"><button type="button" class="btn btn-primary">Teacher Register</button></a></div>
            </div>

        </div>
        <!--/span-->
        <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
            <p>
                <small class="text-muted">Copyright © 2016 - OLMS.com</small>
            </p>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert"></button>
                     <p>Admin (1)   : admin@gmail.com</p>
                <br>
                <p>Student (2) : sanwar@gmail.com</p>
                <br>
                <p>Teacher (3) :  anisur@gmail.com</p>
                <br>
                    <p>Librarian (4) :  jason-euler@gmail.com</p>
                    <br>
                <h4>Password: 123456</h4>
                </div>
            </div>
        </div>
        
    </div><!--/row-->
    
    </div>

<?php require('footer.php'); ?>