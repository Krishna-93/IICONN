 <?php require_once("includes/session.php"); ?>
 <?php require_once("includes/db.php"); ?>
 <?php require_once("includes/functions.php"); ?>
 <?php require_once("includes/validation_functions.php"); ?>
  <?php require_once("includes/vendor/swiftmailer/swiftmailer/lib/swift_required.php"); ?>


  <?php
 if($_SESSION["account_type"]=='translator_interpreter')
 {$translator_interpreter_id = $_SESSION["user"]["translator_interpreter_id"];}
 else{
   $translator_interpreter_id = 1;
 } //Should get the value from session state.
 $query = "SELECT `password` FROM `translator_interpreter_table` WHERE `translator_interpreter_id` = $translator_interpreter_id ";
 $result = mysqli_query($connection, $query);
 // echo $query;
 // echo "<br/>";

$Row = (mysqli_fetch_assoc($result));
$password = $Row['password'];
// echo $password;
//  echo "<br/>";
// echo $password;
//  echo "<br/>";
// echo $password;
//  echo "<br/>";
// echo $password;
//
//  echo "<br/>";




 // printf("Select returned %d rows.\n", mysqli_num_rows($result));

 if(isset($_POST['submit']))
 {
   $PasswordUserTypedInOnPage = mysqli_real_escape_string($connection,trim($_POST['currentpassword']));
   $newpassword = mysqli_real_escape_string($connection,trim($_POST['newpassword']));
   $retypeNewPassword = mysqli_real_escape_string($connection,trim($_POST['retypepassword']));

if ($password === $PasswordUserTypedInOnPage)
{
  echo " <script type=\"text/javascript\">
  alert('Correct current password.'); </script>";
        if ($newpassword === $retypeNewPassword)
        {
          $NewPasswordQuery = "UPDATE `translator_interpreter_table`
          SET `password` = '$newpassword'
          WHERE `translator_interpreter_id` = $translator_interpreter_id ";

        $result2 = mysqli_query($connection, $NewPasswordQuery);

        if ($result2) {
          echo " <script type=\"text/javascript\">
          alert('Password changed successfully.'); </script>";
          
         

    $firstname = $_SESSION['user']['first_name'];
    $lastname = $_SESSION['user']['last_name'];
    $email = $_SESSION['user']['email'];
    $password = $_SESSION['user']['password'];
    $account_type = $_SESSION['account_type'];


    $smtp_server = "smtp.gmail.com";
    $username = "iiconnproject@gmail.com";
    $emailpassword = "SohailSyed";
    // $from = [];
    // $test1 = [];
    // $testing = "";
    // $testing = "";
    // $testing = "";
    // $screte = "";
    // $private = "";

  try {
    $message = Swift_Message::newInstance()
   ->setSubject('Successfully updated your password')
    ->setFrom(['iiconnproject@gmail.com' => 'Claudia Connor'])
    ->addBcc('iiconnproject@gmail.com', 'Claudia Connor')
    // ->setTo(['$email' => '$firstname $lastname'])
    ->addTo($email, $firstname." ".$lastname)
    ->setBody(
    '<html>' .
    ' <head></head>' .
    ' <body>' .
    'Sincerely,<br/>' .
    'Claudia Connor,<br/>' .
    'Administrator</p>' .
   ' </body>' .
   '</html>',
   'text/html'
  );
    //->addPart($text, 'text/plain');

    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
    -> setUsername($username)
    -> setPassword($emailpassword);

    $mailer = Swift_Mailer::newInstance($transport);
    $result = $mailer->send($message);
  

  }
  catch (Exception $e){
    echo $e->getMessage();
  }
 

        }
        else
        {
          die("Database query failed. " . mysqli_error($connection));
        }


        }
        else
        {
          echo " <script type=\"text/javascript\">
          alert('New passwords do not match. Password update failed.'); </script>";
        }
}
else
{
  echo " <script type=\"text/javascript\">
  alert('Incorrect current password. Password update failed.'); </script>";
}


 ?>

 <?php

 $result = mysqli_query($connection, $query);


   if($result){
    //Success
    //redirect_to("somepage.php");
    //echo "successfully added";




   }
   else{
    die("Database query failed. " . mysqli_error($connection));
   }
   }
   ?>
   <?php
   // 5. Close database conenction
   mysqli_close($connection);

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
  <title>Bootstrap</title>
</head>
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
    function comparePassword(form) {
        var newPassword = document.getElementById("NewPasswordBox").value;
        var retypeNewPassword = document.getElementById("RetypeNewPasswordBox").value;
        if (newPassword.length < 6)
        {
            alert("Please make sure your new password is at least 6 characters in length.")
        }
        else if (retypeNewPassword.length < 6) {
            alert("Please make sure your new password is at least 6 characters in length.")
        }
        else if (newPassword === retypeNewPassword) {
            alert("password update successful.");
        }
        else {
            alert("Passwords do not match!");
        }
    }
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
        <a class="navbar-brand" href="#featured"><?php echo "Welcome, ".$_SESSION['first_name']." ".$_SESSION['last_name'];?><span class="subhead"></span></a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
       <li><a href="index.php">Home</a></li>
      <li><a href="view_translationjob.php">View Current Job Openings</a></li>
        <li  class="active"><a href="trans_interp_info.php">Manage Accounts</a></li>
         
        <li><a href="FAQpages2.php">FAQ</a>
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
                        Translation/Interpretation Dashboard
                    </a>
                </li>
             <ul>
                                <li><a href="trans_interp_info.php">Manage Your Account</a></li>
                                <li><a href="trans_interp_changepassword.php">Change password</a></li>
                            </ul>

            </div>

        <!-- /#sidebar-wrapper -->

  <div id="page-content-wrapper" style="padding-left:130px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                      <div class="panel panel-default" >

  <!-- Default panel contents -->
  <div class="panel-heading">
    <h3 class="panel-title-primary">Update Password</h3>
  </div>
  <div class="panel-body">
  </div>

  <!-- Form -->
  <form method="post" action="trans_interp_changepassword.php">
  <div class="container-fluid">
    <div class="form-group">
      <label for="current password">Current Password:</label>
      <input type="password" class="form-control" name="currentpassword" placeholder="Current password" maxlength="50" required pattern=".{6,}" title="Has to to be six or more characters.">
    </div>
    <div class="form-group">
      <label for="new password">New Password:</label>
      <input id="NewPasswordBox" type="password" class="form-control" name="newpassword" placeholder="New password" maxlength="50" required pattern=".{6,}" title="Has to to be six or more characters.">
    </div>
    <div class="form-group">
      <label for="retype password">Re-type New Password:</label>
      <input id="RetypeNewPasswordBox" type="password" class="form-control" name="retypepassword" placeholder="Re-type new password" maxlength="50" required pattern=".{6,}" title="Has to to be six or more characters.">
    </div>


    <!-- <div class="checkbox">
      <label>
        <input type="checkbox"> Check me out
      </label>
    </div> -->
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
  </div> <!--- container-fluid inside the form --->
  </form>
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
