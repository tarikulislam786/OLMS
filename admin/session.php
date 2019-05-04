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
    if($role>1) // if student
    {
    //echo "Un authorized access.";
    header('Location:error.php');
    }
    }
?>

<?php
function check_user_input($input_data) {
   $output = trim($input_data);
   $output = stripslashes($output);
   $output = htmlspecialchars($output);
   return $output;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $session="";
        if($_POST["session"])
        {
        $session = check_user_input($_POST["session"]);
        if (!preg_match("/^\d{4}-\d{4}$/",$session)) {
          $session_error = "Only years and hyphened allowed";
        }   
        }else{
        $session_error = "Session field is required*";
        }
    if(@$session_error=="")
    {
        $session=$_POST["session"];
        // Define an insert query
        $sql = "INSERT INTO `sessions` (`session_name`, `created_at`, `updated_at`)VALUES('$session', now(), now())";//print_r($sql);//exit;
        $count = $conn->exec($sql);//print_r($count);exit;
        //echo 'Added Successful.';
        header("Location:session-manage.php?success=1");
    }
    //print_r($status);
}
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Session</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;Add session</h2>
            </div>
            <div class="box-content">
                <form role="form" action="session.php" method="post">
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Session Name</label>
                        <input type="text" name="session" class="form-control" id="exampleInputEmail1" placeholder="ex: 2010-2011">
                        <span style="color:red;"><?php echo @$session_error;?></span>
                    </div>
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                    <a href="session-manage.php"><button type="button" class="btn btn-default" name="submit">Cancel</button></a>
                </form>
            </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row-->  
<?php include('footer.php'); ?>