<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>


<?php
if(isset($_POST['submit']))
{
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$active = 'Inactive';
$password = randomPassword();
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
//If the user doesn't upload a file to other
//then we set the directory of other to nothing
//and unique to nothing
// so that the database won't have a file path that doesn't exist.
if (empty($name3))
  {
     $uniqueOther = '';
     $directoryOther = '';
     $sourceOther = "";
  }


?>

<?php

$query = "INSERT INTO `translator_interpreter_table`(`first_name`, `last_name`,
 `email`, `password`, `phone_number`, `address`, `city`, `state`, `zip_code`, `gender`, `resume`,
  `confidentiality_form`, `certificate`, `other`, `comments`,
   `active`)
 VALUES ('".mysqli_real_escape_string($connection,trim($_POST['firstname']))."', '".
            mysqli_real_escape_string($connection,trim($_POST['lastname']))."', '".
            mysqli_real_escape_string($connection,trim($_POST['email']))."', '".
            $password ."', '".
            mysqli_real_escape_string($connection,trim($_POST['phone']))."', '".
            mysqli_real_escape_string($connection,trim($_POST['address']))."', '".
            mysqli_real_escape_string($connection,trim($_POST['city']))."', '".
            mysqli_real_escape_string($connection,$_POST['state'])."', '".
            mysqli_real_escape_string($connection,$_POST['zipcode'])."', '".
            mysqli_real_escape_string($connection,trim($_POST['gender']))."', '".
            addslashes($sourceResume . $unique . $name) . "', '".
            addslashes($sourceConfidentialityForm . $unique . $name1) . "', '".
            addslashes($sourceCertifications . $unique . $name2) . "', '".
            addslashes($sourceOther . $uniqueOther . $name3) . "', '".
            mysqli_real_escape_string($connection,trim($_POST['comments']))."', '".
            $active ."')" ;




  if (uploadResume('resume', $directoryResume, $unique) === true) {
      if (uploadConfidentialityForms('confform',$directoryConfidentialityForm, $unique) === true) {
          if (uploadCertifications('certification', $directoryCertifications, $unique) === true) {
              if (uploadOther('other', $directoryOther, $uniqueOther) === true) {
                $result = mysqli_query($connection, $query);
                if($result){
                  send_mail_registration($firstname,$lastname,$email,$password);
                  echo "
                  <script type=\"text/javascript\">
                  alert('Registration successful. Please check your email.');
                  window.location = \" index.php \";
                </script>
                    ";
                }
                else {
                  // die("Registration Failed with error " . mysqli_error($connection));
                  echo "
                  <script type=\"text/javascript\">
                  alert('Registration Failed. Please try again.');
                  window.location = \" registration.php \";
                </script>
                    ";
                }
              }
              else {
                echo "
                <script type=\"text/javascript\">
                alert('Registration Failed. Please try again.');
                window.location = \" registration.php \";
              </script>
                  ";
              }

          }
          else {
            echo "
            <script type=\"text/javascript\">
            alert('Registration Failed. Please try again.');
            window.location = \" registration.php \";
          </script>
              ";
          }
      }
      else {
        echo "
        <script type=\"text/javascript\">
        alert('Registration Failed. Please try again.');
        window.location = \" registration.php \";
      </script>
          ";
      }
  }
    else {
      echo "
      <script type=\"text/javascript\">
      alert('Registration Failed. Please try again.');
      window.location = \" registration.php \";
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
  <title>IICONN - Registration</title>
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
<!-- -------------------------------------------------------------------------------------- -->
<div class="container-fluid">
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    <h3 class="panel-title-primary">Registration</h3>
  </div>
  <div class="panel-body">
    <p></p>
  </div>

  <!-- Form -->
  <form method="post" action="registration.php" enctype="multipart/form-data">
  <div class="container-fluid">
    <div class="form-group">
      <label for="firstname">First Name</label>
      <input type="text" class="form-control" name="firstname" placeholder="First Name" maxlength="50" required pattern="[a-zA-Z\s]+" title="No Numbers">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name</label>
      <input type="text" class="form-control" name="lastname" placeholder="Last Name" maxlength="50" required pattern="[a-zA-Z\s]+" title="No Numbers">
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
         <!-- <div class="radio-inline" >
          <label class="radio-inline"><input type="radio" name="gender" id="gender">Male</label>
          <label class="radio-inline"><input type="radio" name="gender" id="gender">Female</label>
         </div> -->
         <select class="form-control" name="gender" required>
             <option value="">Select Gender</option>
             <option value="Male"> Male</option>
             <option value="Female"> Female </option>
         </select>
    </div>
    <div class="form-group">
      <label for="phone">Telephone</label>
      <input type="text" class="form-control" name="phone" placeholder="Telephone" pattern="\d{3}[\-]\d{3}[\-]\d{4}" title="Example: 203-655-1234 (dashes required)" required>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" class="form-control" name="address" placeholder="Address" required>
    </div>
    <div class="form-group">
      <label for="city">City</label>
      <input type="text" class="form-control" name="city" placeholder="City" pattern="[a-zA-Z\s]+" title="No Numbers" required>
    </div>
    <div class="form-group">
      <label for="city">State</label>
      <select class="form-control" required name="state">
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
      <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" pattern="[0-9]{5}" title="Five digit zip code (numbers only)" required>
    </div>
    <div class="form-group">
      <label for="comment">Comment</label>
      <textarea row="3" class="form-control" name="comments" maxlength="300" placeholder="300 characters maximum"></textarea>
    </div>
    <div class="form-group">
      <label for="resume">Resume</label>
      <input type="file" name="resume" required>
      <p class="help-block">Please upload your resume.</p>
    </div>
    <div class="form-group">
      <label for="confform">Confidentiality Form</label>
      <input type="file" name="confform" required>
      <p class="help-block">Please download the <a href="Forms/ConfidentialityAgreementSample.docx">form </a>and upload it.</p>
    </div>
    <div class="form-group">
      <label for="certification">Certifications</label></label>
      <input type="file" name="certification" required>
      <p class="help-block">Please upload your certifications.</p>
    </div>
    <div class="form-group">
      <label for="other">Other</label>
      <input type="file" name="other">
      <p class="help-block">Upload other necessary documents. </p>
    </div>
    <!-- <div class="checkbox">
      <label>
        <input type="checkbox"> Check me out
      </label>
    </div> -->
    <button type="button" class="btn btn-danger">Cancel</button>
    <button type="submit" name="submit" class="btn btn-primary">Register</button>
  </div> <!--- container-fluid inside the form --->
  </form>
</div> <!------ panel panel-default --------->
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
