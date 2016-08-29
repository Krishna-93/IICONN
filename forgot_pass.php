 <?php require_once("includes/session.php"); ?>
 <?php require_once("includes/db.php"); ?>
 <?php require_once("includes/functions.php"); ?>
 <?php require_once("includes/validation_functions.php"); ?>

 <?php
 if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $employee_query = "SELECT * FROM `employee_table` WHERE `email` = '".$email."' LIMIT 1";
   $translator_query = "SELECT * FROM `translator_interpreter_table` WHERE `email` = '".$email."' LIMIT 1";

   $employee_result = mysqli_query($connection,$employee_query);
   $translator_result = mysqli_query($connection, $translator_query);
  //  echo $employee_result;
  //  echo "<br />";
  //  echo $translator_result;

   if($employee_result && mysqli_num_rows($employee_result)>0)
   { $row = mysqli_fetch_assoc($employee_result);
     $_SESSION['user'] = $row;
     $_SESSION['account_type'] = 'Staff';
     redirect_to('forgot_pass_submission.php');
   }elseif ($translator_result && mysqli_num_rows($translator_result)>0)
   { $row = mysqli_fetch_assoc($translator_result);
     $_SESSION['user'] = $row;
     $_SESSION['account_type'] = 'Translator/Interpreter';
     redirect_to('forgot_pass_submission.php');
   }
   else
   {
     $message = "Please make sure to enter the
     correct e-mail address or your account
     doesn't exist.  Please contact the IICONN administrator";
   }

 }

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
  <title>IICONN - Forgot Password</title>
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
        <a class="navbar-brand" href="#featured">IICONN <span class="subhead">Online Management</span></a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Home</a></li>
          <li><a href="http://iiconn.org/about/our-vision-and-mission/">Mission</a></li>
          <li><a href="http://iiconn.org/refugees-4/">Services</a></li>
          <li><a href="http://iiconn.org/about/board-staff/">Staff</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>
<!---------------------------------------------------------------------------------------->
<div id="wrapper">

  <div id="page-content-wrapper" style="padding-left:130px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                      <div class="panel panel-default" >

  <!-- Default panel contents -->
  <div class="panel-heading">
    <h3 class="panel-title-primary">Forgot Password</h3>
  </div>
  <div class="panel-body">
  </div>

  <!-- Form -->
  <form method="post" action="forgot_pass.php">
  <div class="container-fluid">
     <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" name="email" placeholder="Email" required>
      <div><?php echo "<br/>";
      echo "<ul style=\"color:red;\">";
      //foreach(array $message as $value){
      if(!empty($message)){
      echo "<li>";
      echo $message;
      echo "</li>";}
      echo "</ul>";  ?>
    </div>


    <!-- <div class="checkbox">
      <label>
        <input type="checkbox"> Check me out
      </label>
    </div> -->
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <button type="cancel" name="cancel" class="btn btn-danger">Cancel</button>
  </div> <!--- container-fluid inside the form --->
  </form>
</div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="container-fluid">

   <!---panel panel-default --------->
</div><!--container-fluid --------->



<!-- ---------------------------------------------------------------------------------------->
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
