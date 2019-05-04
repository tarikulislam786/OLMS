<?php 
include('dbconnect.php');
include('config.php');
//include 'config.php' ;

?>

<?php 
$email =$_SESSION["email"];//print_r($email);
 $query = "SELECT first_name, last_name, role from users where email="."'$email'";//print_r($query);

$result= $conn->query($query);//print_r($result);
//exit(mysql_error());
$result->setFetchMode(PDO::FETCH_ASSOC);
$countmach =$result->rowCount();
//echo $countmach;
if($countmach ==1) {//print_r("login successful");exit;
    $row = $result->fetch();//print_r($row);exit;
    $role = $row['role'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    //print_r($role);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Online Library Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/message.css" media="all" />
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='css/pagination.css' rel='stylesheet'>
    <!-- sweetalert css and js -->
    <link rel="stylesheet" href="css/sweetalert/sweetalert.css">
    <!-- jQuery -->
    <script src="js/sweetalert/sweetalert-dev.js"></script>
    <script src="bower_components/jquery/jquery.min.js"></script>
    <!-- Ajax script -->
     <script src="js/script.js"></script>
     <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>

<!-- following 2 scriptfor datatable pagination -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="code.jquery.com/jquery-1.12.4.js"></script> -->
     <!--for paginaion-->
    
     <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
     
    <!-- The fav icon -->
    


</head>
<body class="bg">
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                <span>Charisma</span></a>
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> 
                    <?php 
                    if($role=='1'){echo 'admin';
                    }elseif ($role=='2') {
                        echo $first_name.' '.$last_name;
                    }
                    else{echo $first_name.' '.$last_name;}?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                   <?php if ($role=='2' || $role=='3') {?>
                       <li><a href="issue-details.php">Book Issue Details</a></li>
                       <li class="divider"></li>
                    <?php }?>


                    <li><a href="profile-manage.php">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->
            <!-- theme selector starts -->
<!--            --><?php //if($role== '1'){?>
<!--            <div class="btn-group pull-right theme-container animated tada">-->
<!--                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">-->
<!--                    <i class="glyphicon glyphicon-tint"></i><span-->
<!--                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>-->
<!--                    <span class="caret"></span>-->
<!--                </button>-->
<!--                <ul class="dropdown-menu" id="themes">-->
<!--                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>-->
<!--                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>-->
<!--                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>-->
<!--                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>-->
<!--                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>-->
<!--                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>-->
<!--                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>-->
<!--                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>-->
<!--                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            --><?php //}?>
            <!-- theme selector ends -->
            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-globe"></i> Home</a></li>
                <?php if($role== '1'){ // if admin ?>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Modules <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="users-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage User</a></li>
                        <li><a href="users.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add User</a></li>
                        <li class="divider"></li>
                        <li><a href="session-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Session</a></li>
                        <li><a href="session.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Session</a></li>
                        <li class="divider"></li>
                        <li><a href="authors-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Authors</a></li>
                        <li><a href="authors.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Authors</a></li>
                        <li class="divider"></li>
                        <li><a href="books-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Books</a></li>
                        <li><a href="books.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Books</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i>&nbsp; Issue Books <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="bookissue-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Books Issued</a></li>
                        <li><a href="book-issue.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; New Book Issue</a></li>
                    </ul>
                </li>
                <?php }elseif($role== '4'){ // if librarian?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Modules <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">

                            <li><a href="books-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Books</a></li>
                            <li><a href="books.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Books</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i>&nbsp; Issue Books <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="bookissue-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Books Issued</a></li>
                            <li><a href="book-issue.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; New Book Issue</a></li>
                        </ul>
                    </li>
                <?php }?>
                <!-- <li>
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li> -->
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
<?php } ?>
<div class="ch-container">
    <div class="row">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">
                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="home.php"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                        </li>
                        <!-- <li><a class="ajax-link" href="ui.php"><i class="glyphicon glyphicon-eye-open"></i><span> UI Features</span></a>
                        </li>
                        <li><a class="ajax-link" href="form.php"><i
                                    class="glyphicon glyphicon-edit"></i><span> Forms</span></a></li>
                        
                        <li><a class="ajax-link" href="gallery.php"><i class="glyphicon glyphicon-picture"></i><span> Gallery</span></a>
                        </li> -->
                <?php if($role== '1'){ ?>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Disciplines</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                
                                <li><a href="discipline-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Discipline</a></li>
                                <li><a href="discipline.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Discipline</a></li>
                            </ul>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Sessions</span></a>
                            <ul class="nav nav-pills nav-stacked">

                                <li><a href="session-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Session</a></li>
                                <li><a href="session.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Session</a></li>
                            </ul>
                        </li>

                    <li class="accordion">
                        <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Books</span></a>
                        <ul class="nav nav-pills nav-stacked">

                            <li><a href="books-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Books</a></li>
                            <li><a href="books.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Books</a></li>
                        </ul>
                    </li>


                    <li class="accordion">
                        <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Authors</span></a>
                        <ul class="nav nav-pills nav-stacked">

                            <li><a href="authors-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Authors</a></li>
                            <li><a href="authors.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Author</a></li>
                        </ul>
                    </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Users</span></a>
                            <ul class="nav nav-pills nav-stacked">

                                <li><a href="users-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage User</a></li>
                                <li><a href="users.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add User</a></li>
                            </ul>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Book Issues</span></a>
                            <ul class="nav nav-pills nav-stacked">

                                <li><a href="bookissue-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Books Issued</a></li>
                                <li><a href="book-issue.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;New Book Issue</a></li>
                            </ul>
                        </li>
                        <!-- <li><a class="ajax-link" href="icon.php"><i
                                    class="glyphicon glyphicon-star"></i><span> Icons</span></a></li> -->
                        <!-- <li><a href="error.php"><i class="glyphicon glyphicon-ban-circle"></i><span> Error Page</span></a>
                        </li> -->
                        <?php }else{?>
                    <li><a href="issue-details.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Book Issue Details</a></li>
                    <li><a href="profile-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Profile</a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <!-- <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript> -->
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <?php } ?>
