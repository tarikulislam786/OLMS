
<?php
    session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}

?>
<?php 
include('header.php'); 
?>
<!-- <link rel="stylesheet" href="http://joncom.be/static/screen/css/screen.css" type="text/css" /> -->

<style type="text/css">
div.jumbotron p{color:#2fa4e7;}
div.col2 { /*float: left; width: 970px; */}
div.col2Right { /*float: left; width: 736px; */}
#cssclock { height: 270px; }
#clockanalog { background: #012345 url("img/css-clocks/analog.gif") no-repeat 0 0; float: left; height: 250px; margin: 0; overflow: hidden; position: relative; width: 250px; }
#clockanalog img { border: 0; left: 0px; position: absolute; top: 0px; }
#clockdigital { background: #012345 url("img/css-clocks/digital.gif") no-repeat 162px 99px; /*float: right;*/ height: 250px; margin: 0; overflow: hidden; padding: 0; position: relative; width: 485px; }
#clockdigital div { background: #012345; height: 88px; position: absolute; width: 485px; }
#clockdigital div:last-child { bottom: 0; }
#clockdigital img { border: 0; display: block; height: 2000px; left: -1553px; margin: 0; padding: 0; position: absolute; top: -867px; width: 2000px; }
</style>
<script type="text/javascript">
    bDOMLoaded = true;
    ClockInit();
</script>
<script type="text/javascript">
    // this strange block of code exists to make sure the clocks are started as soon as
    // possible as the page loads, rather than always waiting for a
    // $(document).ready() as I normally do...
    var bScriptLoaded       = false;
    var bDOMLoaded          = false;
    var bClocksInitialised  = false;

    function ClockInit() {
        if ((bClocksInitialised != true) && (bDOMLoaded == true) && (bScriptLoaded == true)) {
            bClocksInitialised = true;
            oClockAnalog.fInit();
            oClockDigital.fInit();
        }
    }
</script>

<script type="text/javascript" src="js/css-clocks.js"></script>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Blank</a>
        </li>
    </ul>
</div>

<?php //print_r($_SESSION);?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> Admin Dashboard</h2>

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
                <!-- <img src="img/library.jpg" width="100%"> -->
                <div class="jumbotron" style="text-align:center">
                  <h1 style="color: maroon;text-align: center;font-size: 40px;;">Welcome to eLibrary</h1> 
                  <p>The Online Library Management System [OLMS]</p>
                  <p>More than <strong>10000</strong> books, <strong>1500</strong> members</p>

            <div class="col2">
                <div class="col2Right">
                    <div id="cssclock">
                        <div id="clockanalog" style="margin-left: 135px;">
                        <img src="img/css-clocks/analogseconds.png" id="analogsecond" alt="Clock second-hand" />
                        <img src="img/css-clocks/analogminutes.png" id="analogminute" alt="Clock minute-hand" />
                        <img src="img/css-clocks/analoghours.png" id="analoghour"  alt="Clock hour-hand" />
                        </div>
                        <div id="clockdigital">
                            <img src="img/css-clocks/digitalhours.gif" id="digitalhour" alt="Clocks hours" />
                            <img src="img/css-clocks/digitalminutes.gif" id="digitalminute" alt="Clocks minutes" />
                            <img src="img/css-clocks/digitalseconds.gif" id="digitalsecond" alt="Clocks seconds" />
                            <div>&nbsp;</div><div>&nbsp;</div></div>

                    </div>
                </div>
            </div>

                </div>
            </div>
        </div>
    </div>
</div><!--/row-->

<?php include('footer.php'); ?>
