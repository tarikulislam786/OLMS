
<?php
ob_start();
include('header.php');
include('dbconnect.php');
?>

<?php

    //session_start();//print_r($_SESSION);exit;

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
<style type="text/css">
.object_ok
{
border: 1px solid green; 
color: #333333; 
}

.object_error
{
border: 1px solid #AC3962; 
color: #333333; 
}

/* Input */
input
{
margin: 5 5 5 0;
padding: 2px; 

border: 1px solid #999999; 
border-top-color: #CCCCCC; 
border-left-color: #CCCCCC; 

color: #333333; 

font-size: 13px;
-moz-border-radius: 3px;
}
</style>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Categories</a>
        </li>
    </ul>
</div>
        <?php echo $msg->display();?>
<div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Session</button>
            </div>
            <div class="pull-left" id="content"></div>
        </div>
    </div>

<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-cog"></i> Session Listing</h2>
    </div>
        <?php
        if(isset($_GET["page"])){
        ?>
    <div class="records_content">
        <?php
        $data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Session Name</th>
                <th class="text-center">Update</th>
                <th class="text-center">Delete</th>
            </tr>';
            $query = "SELECT * FROM sessions ORDER BY session_name ASC LIMIT $page1, 10";

            /*if (!$result = mysql_query($query)) {
            exit(mysql_error());
            }*/
            $result= $conn->query($query);
            //exit(mysql_error());
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $numrows =$result->rowCount();

        //for pagination count page
        $queryCountRows = "SELECT * from sessions";
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
            $data .= '<tr>
                <td class="text-center">'.$number.'</td>
                <td class="text-center">'.$row['session_name'].'</td>
                <td class="text-center">
                    <a class="btn btn-info" href="#" onclick="GetSessionDetails('.$row['id'].')">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Edit
                    </a>

                </td>
                <td class="text-center">
                    <a class="btn btn-danger" href="#" onclick="DeleteSession('.$row['id'].')">
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
            $data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="session-manage.php?page=1">First</a> </li>';
            for($i = $startCounter; $i <= $loopcounter; $i++)
            {

                if($i== $_GET["page"]){
                    $data .= '<li class="pagination-item is-active"> <a class="pagination-link" href="session-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                }else{
                    $data .= '<li class="pagination-item"> <a class="pagination-link" href="session-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                }
            }

            $data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="session-manage.php?page='.$totalpage.'">Last</a> </li>';
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


<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body" style="padding: 20px 20px 50px 20px;">

                <div class="form-group">
                    <label for="session_name">Session Name</label>
                    <input type="text" style="float:left;width: 96%;" id="session_name" placeholder="Session Name" class="form-control"/><span id="status" style="float:left"></span>
                    <div id="status"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addSessionRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_session_name">Session Name</label>
                    <input name="update_session_name" type="text" id="update_session_name" placeholder="Session Name" class="form-control"/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateSessionDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Pagination current page selection and first item class add -->
<!-- <script type="text/javascript">
    $(document).ready(function(){
        var javaScriptVar = "<?php //echo $_GET["page"]; ?>";
        var i=0;
        $("ul.pagination li.pagination-item").each(function(){
            i++;//alert(i);
            if(i== javaScriptVar){
                $(this).addClass("is-active");
            }
        });
    });
</script> -->
<SCRIPT type="text/javascript">
<!--
/*
Credits: Bit Repository
Source: http://www.bitrepository.com/web-programming/ajax/username-checker.html 
*/

//pic1 = new Image(16, 16); 
//pic1.src = "loader.gif";

$(document).ready(function(){

$("#session_name").change(function() { 

var session_name = $("#session_name").val();

if(session_name.length > 8 || session_name.length < 8)
{
$("#status").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "ajax/Sessions/checkValidRecord.php",  
    data: "session_name="+ session_name,  
    success: function(data){  //alert(data);
   
   //$("#status").ajaxComplete(function(event, request, settings){ 

    if(data == 'OK')
    { // alert("ok");
        $("#session_name").removeClass('object_error'); // if necessary
        $("#session_name").addClass("object_ok");
        $("#status").html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
    }  
    else  
    {  //alert("not ok.");
        $("#session_name").removeClass('object_ok'); // if necessary
        $("#session_name").addClass("object_error");
       // $(this).html(data);
        $("#status").html('<font color="red">The session <STRONG>'+session_name+'</STRONG> is already in use.</font>');
    }  
   
  // });

 } 
   
  }); 

}
else
    {
    $("#status").html('<font color="red">The session should have <strong>9</strong> characters.</font>');
    $("#session_name").removeClass('object_ok'); // if necessary
    $("#session_name").addClass("object_error");
    }

});

});

//-->
</SCRIPT>
<?php include('footer.php'); ?>
