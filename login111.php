<?php
error_reporting(1);
include('dbconnect.php');
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
<?php

try {
    //global $countmach;
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];//print_r($email);
        $password = md5($_POST['password']);
        $sql = 'SELECT id FROM users where username="'.$username.'" and password ="'.$password.'" limit 1';//print_r($sql);
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $countmach =$q->rowCount();
        echo $countmach;
        if($countmach ==1){//print_r("login successful");exit;

            while($row = $q->fetch()){//print_r($row);
                $id = $row['id'];
            }
            $_SESSION['id']=$id;
            $_SESSION['email']=$email;
            //$_SESSION['name']=$name;
            $_SESSION['password']=$password;
            //print_r($name);
            header("location:index.php");
            exit();
        } else {
            $countmach = 2; // If incorrect login details are given?
            //echo 'that information is incorrect,try again <a href="login.php">click here</a>';
            //exit();
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







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Login to</title>
    <meta name="description" content="Angularjs, Html5, Music, Landing, 4 in 1 ui kits package"/>
    <meta name="keywords"
          content="AngularJS, angular, bootstrap, admin, dashboard, panel, app, charts, components,flat, responsive, layout, kit, ui, route, web, app, widgets"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="public/bower_components/animate.css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="public/bower_components/simple-line-icons/css/simple-line-icons.css"
          type="text/css"/>

    <link rel="stylesheet" href="public/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="public/css/app.css" type="text/css"/>

</head>
<body style="background-image: url('img/header-bg.png')">
<div class="app app-header-fixed">
    <div class="container w-xxl w-auto-xs" ng-controller="SigninFormController"
         ng-init="app.settings.container = false;">
        <h2 class="navbar-brand block m-t" style="font-weight: 500;font-size: 25px;">Welcome Admin</h2>
        <hr width="100%" align="center" style="margin-top: 0px;color:blue;border-bottom: 2px solid #00b3ee">
                    <?php if ($countmach==2){?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Incorrect admin details.
        </div>
        <?php }?>
        <div class="m-b-lg">
            <form action="login.php" method="post">

            <div class="list-group list-group-sm">
                <div class="list-group-item">
                    <input type="text" placeholder="Username" class="form-control no-border" name="username" required>
                </div>
                <div class="list-group-item">
                    <input type="password" placeholder="Password" class="form-control no-border" name="password"
                           required>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Log in</button>
            <div class="form-group text-right">
                <a href="#">Forgot Your Password?</a>
            </div>

            </form>
        </div>
        <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
            <p>
                <small class="text-muted">Copyright &copy; <?php echo date("Y");?> - {{env('APP_NAME')}}.com</small>
            </p>
        </div>
    </div>


</div>


<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
<script src="public/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="public/js/ui-load.js"></script>
<script src="public/js/ui-jp.config.js"></script>
<script src="public/js/ui-jp.js"></script>
<script src="public/js/ui-nav.js"></script>
<script src="public/js/ui-toggle.js"></script>

</body>
</html>
