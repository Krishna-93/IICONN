
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>

<?php
$username = "";
$email = "";


if (isset($_POST['submit'])) {
  // Process the form
  $account_type = isset($_POST['login_type'])?$_POST['login_type']:'';
  // validations
  $required_fields = array("email", "password");
  validate_presences($required_fields);

  if (empty($errors)) {
    // Attempt Login
    if(!empty($account_type))
    {
      $email = $_POST["email"];
  		$password = $_POST["password"];

  		$found_user = attempt_login($email, $password, $account_type);
      if ($found_user) {
        // Success
  			// Mark user as logged in
        $_SESSION["account_type"] = $account_type;
        $_SESSION["user"] = $found_user;
  			$_SESSION["user_id"] = $found_user["translator_interpreter_id"];
  			$_SESSION["first_name"] = $found_user["first_name"];
        $_SESSION["last_name"] = $found_user["last_name"];

        if($_SESSION['user']['account_type'] == 'Admin') {
        redirect_to("admindashboard.php");}
        elseif($_SESSION['user']['account_type'] == 'Staff'){
          redirect_to('staffdashboard.php');
        }
        else{

          redirect_to('view_translationjob.php');

        }
      } else {
        // Failure
        //$_SESSION["message"] = "Username/password not found.";
        $message = "Username/password/account type not found.";
      }

    }
    else
    {
      $message = "Please select an account type.";
    }



} else {
  // This is probably a GET request

} // end: if (isset($_POST['submit']))
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>IICONN - Language Services System</title>
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
<!--------------------------------------------------------------------------------------------------------->

<div class="backgroundimage">
	<div class="container">
	    <div class="row">
	        <div class="col-md-4 col-md-offset-7">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                  <strong>Login</strong>
	                </div>
	                <div class="panel-body">
	                    <form action="index.php" method="post" class="form-horizontal" role="form">
	                    <div class="form-group">
	                        <label for="inputEmail3" class="col-sm-3 control-label">
	                            Email</label>
	                        <div class="col-sm-9">
	                            <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email" required="">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="inputPassword3" class="col-sm-3 control-label">
	                            Password</label>
	                        <div class="col-sm-9">
	                            <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password" required="">
	                        </div>
	                    </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">
                            Account</label>
                        <div class="col-sm-9">
                          <select name="login_type" class="form-control" required>
                              <option value="">Select account type</option>
                              <option value="employee">Admin/Staff</option>
                              <option value="translator_interpreter">Translator/Interpreter</option>
                          </select>
                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col-sm-offset-3 col-sm-9">
	                           <div>  <a href="forgot_pass.php">Forgot Password?</a></div>
                             <div>Not Registered? <a href="registration.php">Register here</a></div>
	                        </div></div>
	                    </div>
	                    <div class="form-group last">
	                        <div class="col-sm-offset-3 col-sm-9">
	                            <button name="submit" type="submit" class="btn btn-success btn-sm">
	                                Sign in</button>
	                                 <button type="reset" class="btn btn-default btn-sm">
	                                Reset</button>
	                        </div>
	                    </div class="col-sm-offset-3 col-sm-9">

                      <?php
                      echo "<br/>";
                      echo "<br/>";
                      echo "<ul style=\"color:red;\">";
                      //foreach(array $message as $value){
                      if(!empty($message)){
                      echo "<li>";
                      echo $message;
                      echo "</li>";}
                      echo "</ul>"; ?>

	                </div>

	            </div>
              </form>
	        </div>
	    </div>
	</div>
</div>

<!---------------------------------------------------------------------------------------->
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
