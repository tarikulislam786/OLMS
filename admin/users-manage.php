<script type='text/javascript'>
    function confirmDelete()
    {
        return confirm("Are you sure you want to delete this?");
    }
</script>
<?php
session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}
?>
<?php
ob_start(); // redirecting problem solved
include('header.php');
include('dbconnect.php');
?>
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
//pagination
if(isset($_GET["page"])){
    $page = $_GET["page"];

    if($page== "" || $page=="1"){
        $page1=0;
    }else{
        $page1=($page*10)-10;
    }
}
?>
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
<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <a href="users.php"><button class="btn btn-success" data-toggle="modal" data-target="">Add New User</button></a>

        </div>
    </div>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> Users Listing</h2>
            </div>
            <div class="container-fluid">

                <div class="row">
                    <form class="form-inline" style="margin:20px 20px" method="GET" action="search.php">
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">Name</span>
                            <input type="text" class="form-control" placeholder="" name="txtuser">
                        </div>
                        <button onclick="" id="searchByName"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                </div>

            </div>
            <?php
            if(isset($_GET["page"])){
                ?>
                <div class="records_content">
                    <?php
                    $data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';
                    $query = "SELECT id, first_name,last_name, email, role,phone FROM users ORDER BY first_name ASC LIMIT $page1, 10";
                    //SELECT books.book_name,isbn_number, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id =categories.id INNER JOIN authors ON books.author_id = authors.id ORDER BY book_name ASC
                    //$query = "SELECT `id`, `author_name` FROM authors";
                    $result= $conn->query($query);
                    //exit(mysql_error());
                    $result->setFetchMode(PDO::FETCH_ASSOC);
                    $numrows =$result->rowCount();
                    //print_r($numrows);

                    //for pagination count page
                    $queryCountRows = "SELECT * from users";
                    $queryCountResult = $conn->query($queryCountRows);
                    $queryCountResult->setFetchMode(PDO::FETCH_ASSOC);
                    $countnumrows =$queryCountResult->rowCount();

                    // if query results contains rows then featch those rows
                    if($numrows > 0)
                    {
                        $number = 0;
                        if(isset($_GET["page"])){
                            $pageNo = $_GET["page"];
                            $number = 1;
                            for($i=2;$i<=$pageNo;$i++){
                                $number+=10;
                            }
                        }
                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            if($row['role']== '2'){
                                $role = "Student";
                            }elseif($row['role']== '3'){
                                $role = "Teacher";
                            }elseif($row['role']== '1'){
                                $role = "Admin";
                            }else{
                                $role= "Librarian";
                            }
                            $data .= '<tr class="eachrow">
                <td class="text-center">'.$number.'</td>
                <td class="text-center">'.$row['first_name'].' '.$row['last_name'].'</td>
                <td class="text-center">'.$row['email'].'</td>
                <td class="text-center">'.$role.'</td>
                <td class="text-center">'.$row['phone'].'</td>

                <td class="text-center">
					<a class="btn btn-info" href="user-edit.php?id='.$row["id"].'">
		                <i class="glyphicon glyphicon-edit icon-white"></i>
		                Edit
            		</a>
				</td>
				<td class="text-center">
					<!--<a class="btn btn-danger" href="#" onclick="DeleteUser('.$row['id'].')">
		                <i class="glyphicon glyphicon-trash icon-white"></i>
		                Delete
            		</a>-->
            		<a class="btn btn-danger" onclick="return confirmDelete()" href="delete-user.php?id='.$row["id"].'">
		                <i class="glyphicon glyphicon-trash icon-white"></i>
		                Delete
            		</a>
				</td>
            </tr>';
                            $number++;
                        }
                    }
                    else
                    {
                        // records now found
                        $data .= '<tr class="eachrow"><td colspan="6">Records not found!</td></tr>';
                    }
                    $data .= '</table>';
                    // pagination

                    $totalpage =$countnumrows/10;
                    $totalpage =ceil($totalpage);
                    $currentpage    = (isset($_GET['page']) ? $_GET['page'] : 1);
                    $firstpage      = 1;
                    $lastpage       = $totalpage;
                    $loopcounter = ( ( ( $currentpage + 2 ) <= $lastpage ) ? ( $currentpage + 2 ) : $lastpage );
                    $startCounter =  ( ( ( $currentpage - 2 ) >= 3 ) ? ( $currentpage - 2 ) : 1 );

                    if($totalpage > 1)
                    {
                        $data .= '<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">';
                        $data .= '<ul class="pagination">';
                        $data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="users-manage.php?page=1">First</a> </li>';
                        for($i = $startCounter; $i <= $loopcounter; $i++)
                        {
                            if($i== $_GET["page"]){
                                $data .= '<li class="pagination-item is-active"> <a class="pagination-link" href="users-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                            }else{
                                $data .= '<li class="pagination-item"> <a class="pagination-link" href="users-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                            }
                        }
                        $data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="users-manage.php?page='.$totalpage.'">Last</a> </li>';
                        $data  .= '</ul>';
                        $data .= '</div>';
                    }
                    echo $data ;
                    ?>
                </div>
            <?php }elseif(isset($_GET["fkeyconstraint"])){
                ?>
                <div class="records_content">
                    <?php
                    $data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';
                    $query = "SELECT id, first_name,last_name, email, role,phone FROM users ORDER BY first_name ASC LIMIT 1, 10";
                    //SELECT books.book_name,isbn_number, price, category_name,author_name FROM books INNER JOIN categories ON books.category_id =categories.id INNER JOIN authors ON books.author_id = authors.id ORDER BY book_name ASC
                    //$query = "SELECT `id`, `author_name` FROM authors";
                    $result= $conn->query($query);
                    //exit(mysql_error());
                    $result->setFetchMode(PDO::FETCH_ASSOC);
                    $numrows =$result->rowCount();
                    //print_r($numrows);

                    //for pagination count page
                    $queryCountRows = "SELECT * from users";
                    $queryCountResult = $conn->query($queryCountRows);
                    $queryCountResult->setFetchMode(PDO::FETCH_ASSOC);
                    $countnumrows =$queryCountResult->rowCount();

                    // if query results contains rows then featch those rows
                    if($numrows > 0)
                    {
                        $number = 0;
                        if(isset($_GET["page"])){
                            $pageNo = $_GET["page"];
                            $number = 1;
                            for($i=2;$i<=$pageNo;$i++){
                                $number+=10;
                            }
                        }
                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            if($row['role']== '2'){
                                $role = "Student";
                            }elseif($row['role']== '3'){
                                $role = "Teacher";
                            }elseif($row['role']== '1'){
                                $role = "Admin";
                            }else{
                                $role= "Librarian";
                            }
                            $data .= '<tr class="eachrow">
                <td class="text-center">'.$number.'</td>
                <td class="text-center">'.$row['first_name'].' '.$row['last_name'].'</td>
                <td class="text-center">'.$row['email'].'</td>
                <td class="text-center">'.$role.'</td>
                <td class="text-center">'.$row['phone'].'</td>

                <td class="text-center">
                    <a class="btn btn-info" href="user-edit.php?id='.$row["id"].'">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Edit
                    </a>
                </td>
                <td class="text-center">
                    <!--<a class="btn btn-danger" href="#" onclick="DeleteUser('.$row['id'].')">
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        Delete
                    </a>-->
                    <a class="btn btn-danger" onclick="return confirmDelete()" href="delete-user.php?id='.$row["id"].'">
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        Delete
                    </a>
                </td>
            </tr>';
                            $number++;
                        }
                    }
                    else
                    {
                        // records now found
                        $data .= '<tr class="eachrow"><td colspan="6">Records not found!</td></tr>';
                    }
                    $data .= '</table>';
                    // pagination

                    $totalpage =$countnumrows/10;
                    $totalpage =ceil($totalpage);
                    $currentpage    = (isset($_GET['page']) ? $_GET['page'] : 1);
                    $firstpage      = 1;
                    $lastpage       = $totalpage;
                    $loopcounter = ( ( ( $currentpage + 2 ) <= $lastpage ) ? ( $currentpage + 2 ) : $lastpage );
                    $startCounter =  ( ( ( $currentpage - 2 ) >= 3 ) ? ( $currentpage - 2 ) : 1 );

                    if($totalpage > 1)
                    {
                        $data .= '<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">';
                        $data .= '<ul class="pagination">';
                        $data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="users-manage.php?page=1">First</a> </li>';
                        for($i = $startCounter; $i <= $loopcounter; $i++)
                        {
                            if($i== $_GET["fkeyconstraint"]){
                                $data .= '<li class="pagination-item is-active"> <a class="pagination-link" href="users-manage.php?page=1">'."1".'</a> </li>';
                            }else{
                                $data .= '<li class="pagination-item"> <a class="pagination-link" href="users-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                            }
                        }
                        $data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="users-manage.php?page='.$totalpage.'">Last</a> </li>';
                        $data  .= '</ul>';
                        $data .= '</div>';
                    }
                    echo $data ;
                    ?>
                </div>
            <?php }else{?>
                <div class="records_content"></div>
            <?php } ?>

        </div>
    </div>
    <!--/span-->
</div><!--row-->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <?php if(isset($message)){?>
            <div class="message"><?php echo $message; ?></div>
        <?php }?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span class="required">*</span><label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="update_first_name" placeholder="First name">
                    <span style="color:red;"><?php echo @$message_error;?></span>
                </div>
                <div class="form-group">
                    <span class="required">*</span><label for="exampleInputEmail1">Last Name</label>
                    <input type="text" class="form-control" name="lastname" id="update_last_name" placeholder="Last name">
                    <span style="color:red;"><?php echo @$message_error;?></span>
                </div>

                <div class="form-group">
                    <span class="required">*</span><label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="update_email" placeholder="Email" name="email">
                    <span style="color:red;"><?php echo @$message_error;?></span>
                </div>
                <div class="form-group">
                    <span class="required">*</span><label for="exampleInputEmail1">Mobile No</label>
                    <input type="text" name="phone" class="form-control" id="update_phone" placeholder="Mobile">
                    (<span style="color:#5383C1; font-size:smaller">example 8801XXXXXXXXX</span>)
                    <div class="phonemessage"></div>
                    <span style="color:red;"><?php echo @$message_error;?></span>
                </div>
                <div class="form-group">
                    <span class="required">*</span><label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control txtNewPassword password_pop" id="update_password" placeholder="password">
                    <span style="color:red;"><?php echo @$message_error;?></span>
                </div>
                <div class="form-group">
                    <span class="required">*</span><label for="exampleInputEmail">Role</label>
                    <select name="role" id="update_role_name" class="form-control">
                        <option value="choose">Select Role</option>
                        <option value="2">Student</option>
                        <option value="3">Teacher</option>
                        <option value="4">Librarian</option>
                    </select>
                    <span style="color:red;"><?php echo @$message_error;?></span>
                </div>
                <div class="form-group discipline">
                    <span class="required">*</span><label for="">Discipline</label>
                    <select id="update_discipline" name="update_discipline" class="form-control">
                        <option>Select Discipline</option>
                        <?php echo $disciplineOps;?>
                    </select>
                    <span style="color:red;"><?php echo @$message_error;?></span>
                </div>
                <div class="student" style="display:none">
                    <div class="form-group">
                        <span class="required">*</span><label for="">Roll</label>
                            <input id="update_rollno" type="text" value="<?php if(isset($_POST['rollno'])) echo $_POST['rollno']; ?>" name="update_rollno" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="required">*</span><label for="">Session</label>
                            <select id="update_session" name="update_session" class="form-control">
                                <option>Select Session</option>
                                <?php echo $sessionOps;?>
                            </select>
                    </div>
                </div>
                <div class="teacher" style="display: none">
                    <div class="form-group">
                        <span class="required">*</span><label for="">Designation</label>
                            <select id="update_designation" name="update_designation" class="form-control">
                                <option>Choose designation</option>
                                <option value="Lecturer">Lecturer</option>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Professor">Professor</option>
                                <option value="Other">Other</option>
                            </select>
                    </div>
                </div>
                <div class="librarian">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onsubmit="UpdateUserDetails()" >Save Changes</button>
                    <input type="hidden" id="hidden_user_id">
                </div>
            </div>
        </div>
    </div>
    <!--  Pagination current page selection and first item class add -->
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            var javaScriptVar = "<?php //if(!empty($_GET["page"])){echo $_GET["page"];}else{echo 0;} ?>";
            var i=0;
            $("ul.pagination li.pagination-item").each(function(){
                i++;//alert(i);
                if(i== javaScriptVar){
                    $(this).addClass("is-active");
                }
            });
        });
    </script> -->
<!--    <script type="text/javascript">-->
<!--        $(document).ready(function(){-->
<!--            $("select#update_role_name").change(function(){-->
<!--                $( "select option:selected").each(function(){-->
<!--                    if($(this).attr("value")=="2"){ //student-->
<!--                        //$('.teacher select[name="discipline"]').attr('disabled','disabled');-->
<!--                        $(".teacher").hide();-->
<!--                        $(".librarian").hide();-->
<!--                        $(".student").show();-->
<!--                        $('select[name="update_discipline"]').attr('disabled',false);-->
<!--                        $('select[name="update_discipline"]').css('display','block');-->
<!--                        $('.form-group.discipline span,.form-group.discipline label').css('display','block');-->
<!--                    }-->
<!--                    if($(this).attr("value")=="3"){ //teacher-->
<!--                        //$('.student select[name="discipline"]').attr('disabled','disabled');-->
<!--                        //$('.teacher select[name="discipline"]').removeAttr('disabled');-->
<!--                        $(".student").hide();-->
<!--                        $(".librarian").hide();-->
<!--                        $(".teacher").show();-->
<!--                        $('select[name="update_discipline"]').attr('disabled',false);-->
<!--                        $('select[name="update_discipline"]').css('display','block');-->
<!--                        $('.form-group.discipline span,.form-group.discipline label').css('display','block');-->
<!--                    }-->
<!--                    if($(this).attr("value")=="4"){ //librarian-->
<!--                        //$('input[name="rollno"]').attr('disabled','disabled');-->
<!--                        //$("input").removeAttr('disabled');-->
<!--                        $(".student").hide();-->
<!--                        $(".teacher").hide();-->
<!--                        $(".librarian").show();-->
<!--                        $('select[name="update_discipline"]').attr('disabled','disabled');-->
<!--                        $('select[name="update_discipline"]').css('display','none');-->
<!--                        $('.form-group.discipline span,.form-group.discipline label').css('display','none');-->
<!--                    }-->
<!--                    /*if($(this).attr("value")=="choose"){-->
<!--                     $(".box").hide();-->
<!--                     $(".choose").show();-->
<!--                     }*/-->
<!--                });-->
<!--            }).change();-->
<!--        });-->
<!--    </script>-->
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
