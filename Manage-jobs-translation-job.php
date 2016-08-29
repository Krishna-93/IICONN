<?php
$initPageNumber = 1;
$maxPageNumbers = 5;
$maxRecordsPerPage = 4;
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>IICONN - Manage Jobs - Interpretation Job Table</title>
  <script src="js/jquery-2.2.0.js" type="text/javascript"> </script>
        <script language="javascript" type="text/javascript">
        var iPNO = <?php echo $initPageNumber ?>;
        var mPNO = <?php echo $maxPageNumbers ?>;
        var mRPP = <?php echo $maxRecordsPerPage ?>;
    </script>
    <script src="js/jobstable.js" type="text/javascript"> </script>


<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        var text_max = document.getElementById('textarea').maxLength;
        $('#textarea_feedback').html(text_max + ' characters remaining');
        $('#textarea').keyup(function () {
            var text_length = $('#textarea').val().length;
            var text_remaining = text_max - text_length;
            $('#textarea_feedback').html(text_remaining + ' characters remaining');
        });
    });
</script>
<style type="text/css">
    #side-bar {
      width:100%;
      float: left;
      position:fixed;
      padding-left:20px;
      padding-right:20px;
    }
</style>
</head>
<body>
<header>
  <div class="bigimage">
    <div class="container">
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
	</div>
</header>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#featured"> Welcome to Administrator<span class="subhead"></span></a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
       <li><a href="index.php">Home</a></li>
       <li><a href="admindashboard.php">Manage Jobs</a></li>
        <li class="active"><a href="AdminInfo.php">Manage Accounts</a></li>
              <li><a  href="FAQPages.php">FAQ</a>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>
<!-------------------------------------------------------------------------------------- -->
<div id="wrapper">



        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="width:250px;" >

            <ul class="sidebar-nav" >
                <li class="sidebar-brand" >


                    <a href="#">
                        Admin Dashboard
                    </a>
                </li>
             <ul>
                                 <li><a href="AdminInfo.php">Manage Your Account</a></li>
                                <li><a href="StaffRegister.php"> Manage Other Accounts</a></li>
                                <li><a  href="AdminRegister.php">Create new Account</a></li>
                                <li><a href="Aprrove.php">Approve Translator/Interpreter</a></li>
                                <li><a href="ChangePassword.php">Change password</a></li>
                            </ul>

            </div>



        <!-- /#sidebar-wrapper -->

  <div id="page-content-wrapper" style="padding-left:130px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                      <div class="panel panel-default" >
  <div class="panel-heading">
    <h3 class="panel-title-primary">Translation Job Table</h3>

        <div class="centerDiv">            
            <select style = "margin-right : 5px; float : left; padding : 2px; font-size : small;" id = "searchBy">
                <option>All</option>
            </select>
            <input class="floatLeft" type="text" id="searchText" placeholder="Search Jobs" style="display: none;">
            <button id="searchButton" type="button">Search</button>
            <div style="display: none; float: left; margin-left : 10px;" class="ajaxLoad"><img src="images/jobsloader.gif">  Loading...</img></div>           
            <!-- <input type="checkbox" /> Search for completed jobs -->
               </div>       
        <div class="clear"> </div>
        <br/>

        <div id="message" class="centerDiv" style = "background-color : rgba(255, 0, 0, 0.7); color : white; border-top-left-radius : 10px; border-top-right-radius : 10px;"></div> 

        <table class="jobstable">
            <tr class="jobsheader">             
            </tr>
        </table>

        <br />

        <div class="centerDiv">
            <p>
                <span id="totalMessage"></span>
            </p>
        </div>

        <ul class="paginationNav">
            <!-- <li class="bottomNavigation" id="pageless"><a href="#">less</a></li>
            <li class="bottomNavigation"> | 1 | </li>
            <li class="bottomNavigation" id="pagemore"><a href="#">more</a></li> -->
        </ul>

           

    </div>

  
    </div>
  </div></div>
  </div>
</div>
</div>

<div class="container-fluid">

   <!------ panel panel-default --------->
</div><!------ container-fluid --------->
<!-- -------------------------------------------------------------------------------------- -->
<footer>
<hr style="height:3px;border:none;color:#333;background-color:#3083CE; width: 80%;" />
<div class="bigimage">
    <div class="container">
	</div>
</div>
<div class="container">
  	<div class="col-sm-8 col-sm-offset-2 text-center">
      <p>
        670 Clinton Avenue<br>
	    Bridgeport, CT 06605<br>
	    Phone: (203) 336-0141
      </p>
      <p>&copy; The International Institute of Connecticut, Inc.</p>
      <hr>
	</div><!--/col-->
</div><!--/container-->
</footer>


<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
Status 