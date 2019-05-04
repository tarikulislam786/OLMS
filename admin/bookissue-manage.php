
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
            <a href="#">Issue Book</a>
        </li>
    </ul>
</div>
        <?php echo $msg->display();?>
<!-- <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
            </div>
        </div>
    </div>
 -->
<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-cog"></i>Book Issued Listing</h2>
    </div>
    <div class="container-fluid">

        <div class="row">
            <form class="form-inline" style="margin:20px 20px" method="GET" action="search.php">
                <div class="input-group col-md-4">
                    <span class="input-group-addon">Student ID#</span>
                    <input type="text" class="form-control" placeholder="" name="stid">
                </div>
                <button onclick="" id="searchBySID"><i class="glyphicon glyphicon-search"></i></button>
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
                            <th class="text-center">#SID/TEID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Issued Date</th>
                            <th class="text-center">Total Books</th>
                            <th class="text-center">Submitted Date</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';

    $query = "SELECT id, student_id, name, issue_date, issue_details, submitted_date FROM book_issues ORDER BY student_id ASC LIMIT $page1, 10";
$result= $conn->query($query);//print_r($result);
    //exit(mysql_error());
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();
    //print_r($numrows);

//for pagination count page
    $queryCountRows = "SELECT * from book_issues";
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
            //print_r(unserialize(base64_decode($row['issue_details'])));
            $BookIssueDetails = $row['issue_details'];//print_r($BookIssueDetails);
             $UnserializeBookIssueDetails = unserialize(base64_decode($BookIssueDetails));//print_r($UnserializeBookIssueDetails);

            //Count total issued books
            $totalBooks = count(array_filter($UnserializeBookIssueDetails["isbnnumber"]));
            if($row['submitted_date'] == '0000-00-00'){
                $submitted_date = "Not Submitted";
            }else{
                $submitted_date = $row['submitted_date'];
            }

            $data .= '<tr>
                <td class="text-left">'.$number.'</td>';
                if($row['student_id']== 0){
                    $data .= '<td class="text-center">'.$UnserializeBookIssueDetails['teacherEmail'].'</td>';
                }else{

                    $data .= '<td class="text-center">'.$row['student_id'].'</td>';
                }
                
                $data .= '<td class="text-center">'.$row['name'].'</td>
                <td class="text-center">'.$row['issue_date'].'</td>
                <td class="text-center">'.$totalBooks.'</td>
                <td class="text-center">'.$submitted_date.'</td>
                <td class="text-center">
                    <a class="btn btn-info" href= "bookissue-edit.php?id='.$row['id'].'">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Receive
                    </a>

                </td>
                <td class="text-center">
                    <a class="btn btn-danger" href="#" onclick="DeleteBookIssueDetails('.$row['id'].')">
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
        $data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';
    //echo $data;
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
    $data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="bookissue-manage.php?page=1">First</a> </li>';
    for($i = $startCounter; $i <= $loopcounter; $i++)
    {

        if($i== $_GET["page"]){
            $data .= '<li class="pagination-item is-active"> <a class="pagination-link" href="bookissue-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
        }else{
            $data .= '<li class="pagination-item"> <a class="pagination-link" href="bookissue-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
        }
    }

    $data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="bookissue-manage.php?page='.$totalpage.'">Last</a> </li>';
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



<!-- // Pagination current page selection and first item class add -->
 <script type="text/javascript">
     $(document).ready(function(){
        var javaScriptVar = "<?php echo $_GET["page"]; ?>";
        var i=0;
        $("ul.pagination li.pagination-item").each(function(){
            i++;//alert(i);
            if(i== javaScriptVar){
                $(this).addClass("is-active");
            }
        });
     });
 </script>
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
