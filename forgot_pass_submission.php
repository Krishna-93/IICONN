 <?php require_once("includes/session.php"); ?>
 <?php require_once("includes/db.php"); ?>
 <?php require_once("includes/functions.php"); ?>
 <?php require_once("includes/validation_functions.php"); ?>
 <?php require_once("includes/vendor/swiftmailer/swiftmailer/lib/swift_required.php"); ?>

<?php

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
    ->setSubject('Temporary password from IICONN Administrator')
    ->setFrom(['iiconnproject@gmail.com' => 'Claudia Connor'])
    ->addBcc('iiconnproject@gmail.com', 'Claudia Connor')
    // ->setTo(['$email' => '$firstname $lastname'])
    ->addTo($email, $firstname." ".$lastname)
    ->setBody(
    '<html>' .
    ' <head></head>' .
    ' <body>' .
    '<p>Here is your temporary password: <b>'. $password .'</b></br>' .
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
  <title>IICONN - Forgot Password Submission</title>
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

  <div class="jumbotron">
    <h3><?php echo $account_type." - ".$firstname." ".$lastname; ?></h3>
    <p>You have successfully submitted your request.</p>
    <p>Please check your email for your temporary password.</p>
    <p><a class="btn btn-primary btn-lg" href="index.php" name="gotologin" role="button">Go to Login Page</a></p>
  </div>

            </div>
        </div>
    </div>
  </div>
</div>





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
<?php
  $_SESSION['user'] = null;
	$_SESSION['account_type'] = null;
?>
</body>
</html>
