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
    $discipline="";
    $short_name="";
    // discipline name
        if($_POST["discipline"])
        {//print_r($_POST["discipline"]);exit;
            $discipline = check_user_input($_POST["discipline"]);
            if (!preg_match("/^[a-z0-9 .\-]+$/i",$discipline)) {
              $message_error = "Only alpha numeric spaces dashes period are allowed";
            } 
              
        }elseif($_POST["short_name"]){//print_r($_POST["short_name"]);exit;
                $short_name = check_user_input($_POST["short_name"]);
                if (!preg_match("/^[a-z0-9.\-]+$/i",$short_name)) {
                  $message_error = "Only alpha numeric spaces dashes period are allowed";
                }else{
                $message_error = "Short Name field is required*";
                }
            }else{
            $message_error = "field is required*";
        }
    if($message_error=="")
    {//print_r('good to go');exit;
        //print_r($discipline_error.'+'.$short_name_error);exit();
        $discipline=$_POST["discipline"];
        $short_name=$_POST["short_name"];
        // Define an insert query
        $sql = "INSERT INTO `disciplines` (`name`, `short_name`, `created_at`, `updated_at`)VALUES('$discipline','$short_name', now(), now())";//print_r($sql);exit;
        $count = $conn->exec($sql);//print_r($count);exit;
        //echo 'Added Successful.';
        header("Location:discipline-manage.php?success=1");
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
            <a href="#">Discipline</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;Add discipline</h2>
            </div>
            <div class="box-content">
                <form role="form" action="discipline.php" method="post">
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail1">Discipline Name</label>
                        <input type="text" name="discipline" class="form-control" id="exampleInputEmail1" placeholder="Discipline name">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <div class="form-group">
                        <span class="required">*</span><label for="exampleInputEmail">Short Name</label>
                        <input type="text" name="short_name" class="form-control" id="exampleInputEmail" placeholder="Short name">
                        <span style="color:red;"><?php echo @$message_error;?></span>
                    </div>
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                    <a href="discipline-manage.php"><button type="button" class="btn btn-default" name="submit">Cancel</button></a>
                </form>
            </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row-->  
<?php include('footer.php'); ?>