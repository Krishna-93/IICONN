<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>

<?php require_once("includes/vendor/swiftmailer/swiftmailer/lib/swift_required.php"); ?>
<?php
$translatorInterpreterId = $_SESSION["user_id"];
 //Should get the value from session state.

$query = "SELECT * FROM `translator_interpreter_table` WHERE `translator_interpreter_id` = $translatorInterpreterId";
$result = mysqli_query($connection, $query);
$Row = (mysqli_fetch_assoc($result));
$firstName = $Row['first_name'];
$lastName = $Row['last_name'];
$emailAddress = $Row['email'];
$Gender = $Row['gender'];
$Phone = $Row['phone_number'];
$Address = $Row['address'];
$City = $Row['city'];
$State = $Row['state'];
$Zipcode = $Row['zip_code'];
$Resume = $Row['resume'];
$ConfidentialityForm = $Row['confidentiality_form'];
$Certification = $Row['certificate'];
$Other = $Row['other'];
?>

<?php
 if(isset($_POST['submit']))
 {
   $unique = uniqid() . ' - ';
   $uniqueOther = $unique;
   $name = $_FILES['resume']['name'];
   $name1 = $_FILES['confform']['name'];
   $name2 = $_FILES['certification']['name'];
   $name3 = $_FILES['other']['name'];
   $directoryResume = '/var/www/html/uploads/Resume/';
   $directoryConfidentialityForm = '/var/www/html/uploads/confidentialityF/';
   $directoryCertifications = '/var/www/html/uploads/certifications/';
   $directoryOther = '/var/www/html/uploads/Other/';
   $sourceResume = "http://iiconn.club/uploads/Resume/";
   $sourceConfidentialityForm = "http://iiconn.club/uploads/confidentialityF/";
   $sourceCertifications = "http://iiconn.club/uploads/certifications/";
   $sourceOther = "http://iiconn.club/uploads/Other/";
   if (empty($name3))
     {
        $uniqueOther = '';
        $directoryOther = '';
        $sourceOther = "";
     }
   $firstName = mysqli_real_escape_string($connection,trim($_POST['firstname']));
   $lastName = mysqli_real_escape_string($connection,trim($_POST['lastname']));
   $emailAddress = mysqli_real_escape_string($connection,trim($_POST['email']));
   $Gender = mysqli_real_escape_string($connection,trim($_POST['gender']));
   $Phone = mysqli_real_escape_string($connection,trim($_POST['phone']));
   $Address = mysqli_real_escape_string($connection,trim($_POST['address']));
   $City = mysqli_real_escape_string($connection,trim($_POST['city']));
   $State = mysqli_real_escape_string($connection,trim($_POST['state']));
   $Zipcode = mysqli_real_escape_string($connection,trim($_POST['zipcode']));
   $Resume = addslashes($sourceResume . $unique . $name);
   $ConfidentialityForm = addslashes($sourceConfidentialityForm . $unique . $name1);
   $Certification = addslashes($sourceCertifications . $unique . $name2);
   $Other = addslashes($sourceOther . $uniqueOther . $name3);
   $updateQuery = "UPDATE `translator_interpreter_table`
   SET `first_name` = '$firstName', `last_name` = '$lastName',
    `email` = '$emailAddress', `gender` = '$Gender', `phone_number` = '$Phone',
     `address` = '$Address',  `city` = '$City',  `state` = '$State',  `zip_code` = '$Zipcode',
     `resume` = '$Resume',  `confidentiality_form` = '$ConfidentialityForm',
      `certificate` = '$Certification',  `other` = '$Other'
          WHERE `translator_interpreter_id` = $translatorInterpreterId ";

          if (uploadResume('resume', $directoryResume, $unique) === true) {
              if (uploadConfidentialityForms('confform',$directoryConfidentialityForm, $unique) === true) {
                  if (uploadCertifications('certification', $directoryCertifications, $unique) === true) {
                      if (uploadOther('other', $directoryOther, $uniqueOther) === true) {
                        $result2 = mysqli_query($connection, $updateQuery);
                        if($result2){
                          echo " <script type=\"text/javascript\">
                          alert('Account information Updated successfully.'); </script>";
                         
                  
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
   ->setSubject('Successfully updated your Account information.')
    ->setFrom(['iiconnproject@gmail.com' => 'Claudia Connor'])
    ->addBcc('iiconnproject@gmail.com', 'Claudia Connor')
    // ->setTo(['$email' => '$firstname $lastname'])
    ->addTo($email, $firstname." ".$lastname)
    ->setBody(
    '<html>' .
    ' <head></head>' .
    ' <body>' .
    'Sincerely,<br/>' .
    'Claudia Connor, <br/ >' .
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
                        else {
                          // die("Registration Failed with error " . mysqli_error($connection));
                          echo " <script type=\"text/javascript\">
                          alert('Account information update failure.'); </script>";
                        }
                      }
                      else {
                        echo " <script type=\"text/javascript\">
                        alert('Account information update failure.'); </script>";
                      }

                  }
                  else {
                    echo " <script type=\"text/javascript\">
                    alert('Account information update failure.'); </script>";
                  }
              }
              else {
                echo " <script type=\"text/javascript\">
                alert('Account information update failure.'); </script>";
              }
          }
          else {
            echo "
            <script type=\"text/javascript\">
            alert('Account information update failure.');
          </script>
              ";
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
  <title>IICONN - Update your information</title>
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
    <h3 class="panel-title-primary">Update Information</h3>
  </div>
  <div class="panel-body">
    <p>Your current information is shown below. Make changes to the ones that need updating and then click update.</p>
  </div>

  <!-- Form -->
  <form method="post" action="trans_interp_info.php" enctype="multipart/form-data" >
  <div class="container-fluid">
    <div class="form-group">
      <label for="firstname">First Name</label>
      <input value = "<?php echo $firstName ?>" type="text" class="form-control" name="firstname" placeholder="First Name" maxlength="50" required pattern="[a-zA-Z\s]+" title="No Numbers" value="">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name</label>
      <input value = "<?php echo $lastName ?>" type="text" class="form-control" name="lastname" placeholder="Last Name" maxlength="50" required pattern="[a-zA-Z\s]+" title="No Numbers" value="">
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input value = "<?php echo $emailAddress ?>" type="email" class="form-control" name="email" placeholder="Email" required value="">
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
         <!-- <div class="radio-inline" >
          <label class="radio-inline"><input type="radio" name="gender" id="gender">Male</label>
          <label class="radio-inline"><input type="radio" name="gender" id="gender">Female</label>
         </div> -->
         <select class="form-control" name="gender" required >
             <option value="<?php echo $Gender ?>"><?php echo $Gender ?></option>
             <option value="">Select Gender</option>
             <option value="Male"> Male</option>
             <option value="Female"> Female </option>
         </select>
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input value = "<?php echo $Phone ?>" type="text" class="form-control" name="phone" placeholder="Telephone" pattern="\d{3}[\-]\d{3}[\-]\d{4}" title="Example: 203-655-1234 (dashes required)" required value="">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input value = "<?php echo $Address ?>" type="text" class="form-control" name="address" placeholder="Address" required value="">
    </div>
    <div class="form-group">
      <label for="city">City</label>
      <input value = "<?php echo $City ?>" type="text" class="form-control" name="city" placeholder="City" pattern="[a-zA-Z\s]+" title="No Numbers" required value="">
    </div>
    <div class="form-group">
      <label for="city">State</label>
      <select class="form-control" required name="state" >
        <option value="<?php echo $State ?>"><?php echo $State ?></option>
        <option value="">Select state</option>
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
      </select>
    </div>
    <div class="form-group">
      <label for="zipcode">Zip Code</label>
      <input value = "<?php echo $Zipcode ?>" type="text" class="form-control" name="zipcode" placeholder="Zip Code" pattern="[0-9]{5}" title="Five digit zip code (numbers only)" required value="">
    </div>
<div class="form-group">
      <label for="resume">Resume &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $Resume ?>">Download current resume</a> </label>
      <input type="file" name="resume" required>
      <p class="help-block">Please upload your resume.</p>
    </div>
    <div class="form-group">
      <label for="confform">Confidentiality Form &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $ConfidentialityForm ?>">Download current confidentiality form</a> </label>
      <input type="file" name="confform" required>
      <p class="help-block">Please download the <a href="Forms/ConfidentialityAgreementSample.docx">form </a>and upload it.</p>
    </div>
    <div class="form-group">
      <label for="certification">Certifications &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $Certification ?>">Download current certifications</a> </label></label>
      <input type="file" name="certification" required>
      <p class="help-block">Please upload your certifications.</p>
    </div>
    <div class="form-group">
      <label for="other">Other &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $Other ?>">Download current other</a> </label>
      <input type="file" name="other">
      <p class="help-block">Upload other necessary documents. </p>
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
