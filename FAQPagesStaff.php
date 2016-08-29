<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>IICONN - New Staff Registration</title>
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
<script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $(".toggle").click(function () {
                if ($(this).next().is(":hidden")) {
                    $(this).next().slideDown("fast");
                } else {
                    $(this).next().hide();
                }
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
        <a class="navbar-brand" href="#featured"> Welcome to Staff Account<span class="subhead"></span></a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
       <li><a href="index.html">Home</a></li>
      <li><a href="Staffdashboard.php">Manage Jobs</a></li>
        <li ><a href="Staffinfo.php">Manage Accounts</a></li>
                <li class="active"><a  href="FAQPages.php">FAQ</a>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>
<!-------------------------------------------------------------------------------------- -->
<div id="wrapper">



     
 <div id="page-content-wrapper" style="padding-left:130px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                      <div class="panel panel-default" >
                     <div class="panel-heading">
          <div class="margins">
                
                <span class="toggle">
                    <h3><a href="#" style="cursor:pointer;"> Staff FAQ</a></h3>

                </span>

                <div class="hiddenDiv">
                    <ul>
                        <li>Q: What is <span>Create New Job? </span> </li>
                        <li>A: This option is used to create a new job for translators/interpreters.</li>
                        <br />
                        <li>Q: What is <span>Manage Jobs?</span></li>
                        <li>A: This option is used to manage the jobs for translators/interpreters.</li>
                        <br />
                        <li>Q: What is <span>Manage Account?</span></li>
                        <li>A: This option is used to manage your account, staff accounts, and translator/interpreter accounts.</li>
                        <br />
                        <li>Q: What is <img src="images/FAQ Images/Search for an Account.png" /></li>
                        <li>A: This search option is used to search for staff accounts, translator/interpreter accounts, and clients. You can search by first name, last name, or email address. </li>
                        <br />
                        <li>Q: What is <img src="images/FAQ Images/Search Jobs.png" /></li>
                        <li>A: This search option is used to search for a job. </li>
                        <br />
                        <li>Q: What is <img src="images/FAQ Images/Search for translators or interpreters.png" /></li>
                        <li>
                            A: This search option is used to search for translators/interpreters that have signed up for language services. This feature is only
                            used when approving or rejecting a new translator/interpreter. You can search by first name, last name, or email address.
                        </li>
                    </ul>
                </div>
                <br />

                
                </div>
            </div>

            

    </div>
</div>
</div>
                </div>
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
      <p>&copy; The Internationall Institute of Connecticut, Inc.</p>
      <hr>
	</div><!--/col-->
</div><!--/container-->
</footer>
</script>
<script src="layout/scripts/jquery.min.js"></script>
    <script src="layout/scripts/jquery.backtotop.js"></script>
    <script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>

