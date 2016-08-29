<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php require_once("includes/vendor/swiftmailer/swiftmailer/lib/swift_required.php"); ?>
<?php confirm_logged_in(); ?>
 

<?php

$job_id = $_GET['id']; //Should get value from the job table.
$query = "SELECT * From `translation_job_table` Where `translation_Job_id` = $job_id";

  $result = mysqli_query($connection, $query);
  $Row = (mysqli_fetch_assoc($result));
  $jobTitle = $Row['job_title'];
  $jobStatus = $Row['job_status'];
  $jobAssignedTo = $Row['translator_interpreter_id'];
  if ($jobAssignedTo == 0)
  {
    $jobAssignedTo = "No one";
  }
  else
  {
    $query5 = "SELECT * From `translator_interpreter_table` Where `translator_interpreter_id` = $jobAssignedTo";
    $result5 = mysqli_query($connection, $query5);
    $Row5 = (mysqli_fetch_assoc($result5));
    $firstName5 = $Row5['first_name'];
    $lastName5 = $Row5['last_name'];
    $jobAssignedTo = $firstName5 . " " . $lastName5;
  }
  $firstName = $Row['first_name'];
  $lastName = $Row['last_name'];
  $email = $Row['email_address'];
  $address = $Row['address'];
  $city = $Row['city'];
  $state = $Row['state'];
  $zipCode = $Row['zip_code'];
  $gender = $Row['gender'];
  $dateOfSubmission = $Row['date_of_submission'];
  $dateDue = $Row['due_date'];
  $grant = $Row['grant_name'];
  $documentIn = $Row['lang_from'];
  $translationTo = $Row['lang_to'];
  $jobFiles = $Row['job_doc_before_translation/interpretation'];
  $numberOfPages = $Row['number_of_pages'];
  $specialInstructions = $Row['special_instructions'];
  $invoice = $Row['Invoice'];
  $jobFilesTranslated = $Row['job_doc_after_translation/interpretation'];

 ?>

 <?php
 if(isset($_POST['submit']))
 {
   $jobStatus = 'Ongoing';
   $jobAssignedTo = $_SESSION['first_name']." ".$_SESSION['last_name'];


   $updateQuery = "UPDATE `translation_job_table`
   SET `job_status` = '$jobStatus', `translator_interpreter_id` = '$jobAssignedTo'
   WHERE `translation_Job_id` = $job_id ";

   $result2 = mysqli_query($connection, $updateQuery);

   if ($result2) {
     echo " <script type=\"text/javascript\">
     alert('Translation job successfully selected.'); </script>";
   }
   else {
     die("Database query failed. " . mysqli_error($connection));
   }
 }

  ?>

  <?php
 	if(isset($_POST['selectjob']))
 	{	$translator_interpreter_id = $_SESSION['user']['translator_interpreter_id'];
 		$query = "UPDATE `translation_job_table` a,
 		`translator_interpreter_table` b
 		SET a.translator_interpreter_id = $translator_interpreter_id, a.job_status = 'Ongoing'
 		WHERE a.translation_Job_id = $job_id AND b.translator_interpreter_id = $translator_interpreter_id";

 		if ($result = mysqli_query($connection, $query))
    {
      echo "
      <script type=\"text/javascript\">
      alert('Job successfully taken! You will now be redirected to manage your work.');
      window.location = \" managework.php \";
    </script>
        ";
 
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
   ->setSubject('Successfully selected new Translation Job')
    ->setFrom(['iiconnproject@gmail.com' => 'Claudia Connor'])
    ->addBcc('iiconnproject@gmail.com', 'Claudia Connor')
    // ->setTo(['$email' => '$firstname $lastname'])
    ->addTo($email, $firstname." ".$lastname)
    ->setBody(
    '<html>' .
    ' <head></head>' .
    ' <body>' .
    'Sincerely, &nbsp' .
    'Claudia Connor, &nbsp' .
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
      echo "
      <script type=\"text/javascript\">
      alert('Something weird happened. Please try again.');
    </script>
        ";
    }



 // 		if($result)
 // 		{	echo "<pre>";
 // 			print_r($result);
 // 			echo "</pre>";
 // 			echo $translator_interpreter_id. " " . $job_id;
 // 			echo "successfully updated.";
  //
 // 	}
 // 	else{
 // 		echo "failed.";
 // 	}

  $query = "SELECT `job_title`, `job_status`, `translator_interpreter_id`, `first_name`, `last_name`, `email_address`,
   `address`, `city`, `state`, `zip_code`, `gender`, `date_of_submission`,
    `due_date`, `grant_name`, `lang_from`, `lang_to`, `job_doc_before_translation/interpretation`,
    `number_of_pages`, `special_instructions`, `Invoice`  From `translation_job_table` Where `translation_Job_id` = $job_id";

    $result = mysqli_query($connection, $query);
    $Row = (mysqli_fetch_assoc($result));
    $jobTitle = $Row['job_title'];
    $jobStatus = $Row['job_status'];
    $jobAssignedTo = $Row['translator_interpreter_id'];
    $firstName = $Row['first_name'];
    $lastName = $Row['last_name'];
    $email = $Row['email_address'];
    $address = $Row['address'];
    $city = $Row['city'];
    $state = $Row['state'];
    $zipCode = $Row['zip_code'];
    $gender = $Row['gender'];
    $dateOfSubmission = $Row['date_of_submission'];
    $dateDue = $Row['due_date'];
    $grant = $Row['grant_name'];
    $documentIn = $Row['lang_from'];
    $translationTo = $Row['lang_to'];
    $jobFiles = $Row['job_doc_before_translation/interpretation'];
    $numberOfPages = $Row['number_of_pages'];
    $specialInstructions = $Row['special_instructions'];
    $invoice = $Row['Invoice'];

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
  <title>IICONN - Translation Job Overview</title>
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
  <script src="js/jquery-2.2.0.js" type="text/javascript"> </script>
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
      <script language="javascript" type="text/javascript">
          function changePage(url)
          {
              window.location = url;
          }
      </script>
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
      <li class="active"><a href="view_translationjob.php">View Current Job Openings</a></li>
        <li ><a href="trans_interp_info.php">Manage Accounts</a></li>

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

                      <ul> <li>
              <a href="view_translationjob.php">
                <i class="fa fa-tachometer"></i>Dashboard
              </a>
          </li>
          <li><a href="view_translationjob.php">Translation Job table</a></li>
                                <li><a href="view_interpretationjob.php"> Interpretation Job table </a></li>
                                 <li><a href="managework.php"> Manage Work </a></li>
                            </ul>


      </div>



        <!-- /#sidebar-wrapper -->
        <div id="page-content-wrapper" style="padding-left:130px;">
                   <div class="container-fluid">
                       <div class="row">
                           <div class="col-xs-12 col-md-8">
                             <div class="panel panel-default" >
                            <div class="panel-heading"> <div class="centerDiv">
                                      <h3 class="panel-title-primary">Translation Job Overview</h3>

       </div>

       </div>
         <div class="panel-body">
           <p></p>
         </div>

                            <form method="post" action="view_translationjoboverview.php" accept-charset='UTF-8' enctype="multipart/form-data" >
         <div class="container-fluid">
           <div class="form-group">
             <p> Below you can view the information of the current job. You can choose to complete this job by selecting select job. </p>
                               <div class="form-group">
                                     <label for="ft_author">Job number:<br></label>
                                 <input  value="<?php echo $job_id?>"  type="text" class="form-control" placeholder="Job ID" Name="Job_ID" maxlength="50" disabled >
                                </div>
                                <div class="form-group">
                                  <label for="ft_author">Document type: <br></label>
                          <select  name="Job_Title" class="form-control" disabled>
                                  <option value="<?php echo stripslashes($jobTitle); ?>"><?php echo stripslashes($jobTitle); ?></option>
                                  <option value="">Select document type</option>
                                  <option value="Birth Certificate"> Birth Certificate</option>
                                  <option value="Marriage Certificate"> Marriage Certificate </option>
                                  <option value="Death Certificate"> Death Certificate </option>
                                  <option value="Diploma"> Diploma </option>
                                  <option value="Transcript"> Transcript </option>
                                  <option value="Letter or Statement"> Letter or Statement </option>
                                  <option value="Other"> Other </option>
                              </select>
                                 </div>
                                  <div class="form-group">
                                        <label for="ft_author">Job Status:<br></label>
                                        <select class= "form-control" name="Job_Status" required aria-required="true" disabled>
                                             <option value="<?php echo $jobStatus?>"><?php echo $jobStatus?></option>
                                             <option value="">Select Job Status</option>
                                             <option value="Unassigned">Unassigned</option>
                                             <option value="Ongoing">Ongoing</option>
                                             <option value="Completed">Completed</option>
                                        </select>
                                   </div>
                                   <div class="form-group">
                                         <label for="ft_author">Job Assigned to:<br></label>
                                     <input  value="<?php echo $jobAssignedTo?>" type="text" class="form-control" placeholder="Unassigned" Name="Job_Assigned" maxlength="50" disabled>
                                    </div>
                                   <div class="form-group">
                                   <label for="ft_author">Client's First Name: <br></label>
                                   <input  value="<?php echo $firstName?>" type="text"  class="form-control" placeholder="First Name" Name="ClientsFirstName" maxlength="50" pattern="[a-zA-Z\s]+" title="No Numbers" required disabled>
                                   </div>
        							<div class="form-group">
                       			<label for="ft_author">Client's Last Name: <br></label>
                                  <input  value="<?php echo $lastName?>"  type="text" class="form-control" placeholder="Last Name" Name="ClientsLastName" maxlength="50" pattern="[a-zA-Z\s]+" title="No Numbers" required disabled>
                                   </div>
                                   <div class="form-group">
                                   <label for="ft_author">Client's email address: <br></label>
                                   <input  value="<?php echo $email?>" type="email" class="form-control" placeholder="Email address" Name="Email" maxlength="50" required disabled>
                                   </div>
       							<div class="form-group">
       							<label for="ft_author">Location address: <br></label>
                                   <input  value="<?php echo $address?>"  type="text" class="form-control" name="Address" placeholder="Street,Apt or Suite" maxlength="50" required disabled>
                                   </div>
       							<div class="form-group">
       							<label for="ft_author">City: <br></label>
                                   <input   value="<?php echo $city?>" type="text" class="form-control" name="City" placeholder="City" maxlength="50" pattern="[a-zA-Z\s]+" title="No Numbers" required disabled>
                                   </div>
       							<div class="form-group">
       							<label for="ft_author">State: <br></label>
                                   <select required aria-required="true" id="State" name="State" class="form-control" disabled>
                                     <option value="<?php echo $state?>" ><?php echo $state?></option>
                                           <option value="">Select State</option>
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
                                       <label for="ft_author">Zip Code: <br></label>
                                       <input  value="<?php echo $zipCode?>"type="text" class="form-control" name="zipcode" pattern="[0-9]{5}" title="Five digit zip code (numbers only)" placeholder="Five digit zip code" required disabled />
                                   </div>
       							<div class="form-group">
                                   <label for="ft_author">Gender: </label>
                                   <select required name="Gender" class="form-control" disabled>
                                     <option  value="<?php echo $gender?>"><?php echo $gender?></option>
                                           <option value="">Select Gender</option>
                                           <option value="Male"> Male</option>
                                           <option value="Female"> Female </option>
                                       </select>
                                   </div>
  <div class="form-group">
                                   <label for="Gender">Due date: </label>
                                   <input  value="<?php echo $dateDue?>" type="date" class="form-control" name='dueDate' id="dueDate"  required disabled>
                                   </div>
                                    <div class="form-group">
                                       <label for="Gender">Name of grant to be charged:</label>
                                       <select name="grant" class="form-control" disabled>
                                         <option value="<?php echo $grant?>"><?php echo $grant?></option>
                                           <option value="">Name of Grant</option>
                                           <option value="SOT">SOT</option>
                                       </select>
                                   </div>
        							<div class="form-group">
                                   <label for="ft_author">Document in: <br></label>
                                       <select required name="lang_from" class="form-control" disabled>
                                         <option value="<?php echo $documentIn?>"><?php echo $documentIn?></option>
                                         <option value="">Select Language</option>
                                         <option value="Spanish">Spanish</option>
                                         <option value="French">French</option>
                                         <option value="Portuguese">Portuguese</option>
                                         <option value="Albanian">Albanian</option>
                                         <option value="Arabic">Arabic</option>
                                         <option value="Bosnian">Bosnian</option>
                                         <option value="Cambodian">Cambodian</option>
                                         <option value="English">English</option>
                                         <option value="German">German</option>
                                         <option value="Greek">Greek</option>
                                         <option value="Haitian Creole">Haitian Creole</option>
                                         <option value="Italian">Italian</option>
                                         <option value="Kurdish">Kurdish</option>
                                         <option value="Lithuanian">Lithuanian</option>
                                         <option value="Polish">Polish</option>
                                         <option value="Russian">Russian</option>
                                         <option value="Swahili">Swahili</option>
                                         <option value="Thai">Thai</option>
                                         <option value="Tigrinya">Tigrinya</option>
                                         <option value="Turkish">Turkish</option>
                                         <option value="Vietnamese">Vietnamese</option>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                                 <label for="ft_author">Translation to: <br></label>
                                                     <select required name="lang_to" class="form-control" disabled>
                                                       <option  value="<?php echo $translationTo?>"><?php echo $translationTo?></option>
                                                         <option value="">Select Language</option>
                                                         <option value="Spanish">Spanish</option>
                                                         <option value="French">French</option>
                                                         <option value="Portuguese">Portuguese</option>
                                                         <option value="Albanian">Albanian</option>
                                                         <option value="Arabic">Arabic</option>
                                                         <option value="Bosnian">Bosnian</option>
                                                         <option value="Cambodian">Cambodian</option>
                                                         <option value="English">English</option>
                                                         <option value="German">German</option>
                                                         <option value="Greek">Greek</option>
                                                         <option value="Haitian Creole">Haitian Creole</option>
                                                         <option value="Italian">Italian</option>
                                                         <option value="Kurdish">Kurdish</option>
                                                         <option value="Lithuanian">Lithuanian</option>
                                                         <option value="Polish">Polish</option>
                                                         <option value="Russian">Russian</option>
                                                         <option value="Swahili">Swahili</option>
                                                         <option value="Thai">Thai</option>
                                                         <option value="Tigrinya">Tigrinya</option>
                                                         <option value="Turkish">Turkish</option>
                                                         <option value="Vietnamese">Vietnamese</option>
                                                     </select>
                                                 </div>
                                                 <div class="form-group">
                                                       <label for="ft_author">Download Job Files:<br></label>
                                                   <a href="<?php echo $jobFiles?>">Download Job Files </a>
                                                  </div>
                                 <div class="form-group">
                                   <label>Number of pages:  </label>
                                   <input  value="<?php echo $numberOfPages?>" type="number" class="form-control" min="1" max="200" value="1" required name="numberOfPages" disabled>
                                 </div>

        							<div class="form-group">
        							       <label for="ft_author">Special Instructions:</label>
                                           <textarea class="form-control" name="ft_message" id="textarea" placeholder="Special instructions" cols="25" rows="10" maxlength="300" disabled><?php echo $specialInstructions?></textarea>
                                          <div id="textarea_feedback"></div>
                                       </div>
                                       <div class="form-group">


                               </div>
                               <button type="button" class="btn btn-primary" onclick="window.location.href = 'view_translationjob.php'">Back</button>
                               <!-- <button type="submit" class="btn btn-primary"  formaction="view_translationjoboverview.php?id=<?php echo $job_id?>" name="submit">Update existing job</button> -->
                                <button type="submit" class="btn btn-primary"  formaction="view_translationjoboverview.php?id=<?php echo $job_id?>" name="selectjob">Select job</button>

                              </div></form>
       </div>
                   </div>
               </div>
           </div>
         </div>
       </div







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
</script>
</body>
</html>
