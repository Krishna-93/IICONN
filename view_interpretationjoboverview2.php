<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php

// $job_id = $_GET['id'];
$job_id = $_GET['id'];
$query = "SELECT `job_title`, `job_status`, `translator_interpreter_id`, `first_name`, `last_name`, `email`,
 `address`, `city`, `state`, `zip_code`, `gender`, `date of submission`,
  `date_of_interpretation`, `time_of_interpretation`, `length_of_interpretation`,
`Grant_name`, `lang_to`, `special_instructions`, `invoice`  From `interpretation_job_table` Where `interpretation_job_id` = $job_id ";

  $result = mysqli_query($connection, $query);
  $Row = (mysqli_fetch_assoc($result));
  $jobTitle = $Row['job_title'];
  $jobStatus = $Row['job_status'];
  $jobAssignedTo = $Row['translator_interpreter_id'];
  $firstName = $Row['first_name'];
  $lastName = $Row['last_name'];
  $email = $Row['email'];
  $address = $Row['address'];
  $city = $Row['city'];
  $state = $Row['state'];
  $zipCode = $Row['zip_code'];
  $gender = $Row['gender'];
  $dateOfSubmission = $Row['date of submission'];
  $dateOfInterpretation = $Row['date_of_interpretation'];
  $timeOfInterpretation = $Row['time_of_interpretation'];
  $lengthOfInterpretation = $Row['length_of_interpretation'];
  $grant = $Row['Grant_name'];
  $InterpretationTo = $Row['lang_to'];
  $specialInstructions = $Row['special_instructions'];
  $invoice = $Row['invoice'];

 ?>

 <?php
 if(isset($_POST['submit']))
 {

   $unique = uniqid() . ' - ';
   $name = $_FILES['invoice']['name'];
   $filepath = '/var/www/html/uploads/Other/';
   $source = "http://iiconn.club/uploads/Other/";
   $Invoice =   addslashes($source . $unique . $name);
   $updateQuery = "UPDATE `interpretation_job_table`
   SET `invoice` = '$Invoice',
   `job_status` = 'Completed'
   WHERE `interpretation_job_id` = $job_id ";

   if (uploadOther('invoice', $filepath, $unique) === true)
   {
      $result2 = mysqli_query($connection, $updateQuery);
      if ($result2) {
        echo " <script type=\"text/javascript\">
        alert('Invoice uploaded successfully.');
        window.location = \" managework.php \";
        </script>";
      }
      else {
        die("Database query failed. " . mysqli_error($connection));
      }
   }








   else {
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
  <title>IICONN - Interpretation Job Overview</title>
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
       <script language="javascript" type="text/javascript">
          $(document).ready(function () {
              var now = new Date(+new Date + 864e5);

              var day = ("0" + now.getDate()).slice(-2);
              var month = ("0" + (now.getMonth() + 1)).slice(-2);

              var today = now.getFullYear() + "-" + (month) + "-" + (day);

              $("#dueDate").attr({
                  "min": today
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
          <li ><a href="AdminInfo.php">Manage work</a></li>
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
                            </ul>

      </div>



        <!-- /#sidebar-wrapper -->
        <div id="page-content-wrapper" style="padding-left:130px;">
                   <div class="container-fluid">
                       <div class="row">
                           <div class="col-xs-12 col-md-8">
                             <div class="panel panel-default" >
                            <div class="panel-heading"> <div class="centerDiv">
                                      <h3 class="panel-title-primary">Interpretation Job Overview</h3>

       </div>

       </div>
         <div class="panel-body">
           <p></p>
         </div>

                            <form method="post" action="view_interpretationjoboverview2.php" accept-charset='UTF-8' enctype="multipart/form-data" >
         <div class="container-fluid">
           <div class="form-group">
             <p> Below you can view the information of the current job. You can upload your invoice to this job when it is complete. </p>
                               <p> An <span class="required">*</span> indicates that the field is required.</p><br />
                               <div class="form-group">
                                     <label for="ft_author">Job number:<br></label>
                                 <input  value="<?php echo $job_id?>" type="text" class="form-control" placeholder="Job ID" Name="Job_ID" maxlength="50" disabled >
                                </div>
                                  <div class="form-group">
                                        <label for="ft_author">Job Status: <br></label>
                                        <select class= "form-control" name="Job_Status" required aria-required="true" disabled>
                                             <option  value="<?php echo $jobStatus?>"><?php echo $jobStatus?></option>
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
                                  <input value="<?php echo $lastName?>" type="text" class="form-control" placeholder="Last Name" Name="ClientsLastName" maxlength="50" pattern="[a-zA-Z\s]+" title="No Numbers" required disabled>
                                   </div>
                                   <div class="form-group">
                                   <label for="ft_author">Client's email address: <br></label>
                                   <input  value="<?php echo $email?>" type="email" class="form-control" placeholder="Email address" Name="Email" maxlength="50" required disabled>
                                   </div>
       							<div class="form-group">
       							<label for="ft_author">Location address: <br></label>
                                   <input  value="<?php echo $address?>" type="text" class="form-control" name="Address" placeholder="Street,Apt or Suite" maxlength="50" required disabled>
                                   </div>
       							<div class="form-group">
       							<label for="ft_author">City: <br></label>
                                   <input  value="<?php echo $city?>" type="text" class="form-control" name="City" placeholder="City" maxlength="50" pattern="[a-zA-Z\s]+" title="No Numbers" required disabled>
                                   </div>
       							<div class="form-group">
       							<label for="ft_author">State: <br></label>
                                   <select required aria-required="true" id="State" name="State" class="form-control" disabled>
                                     <option value="<?php echo $state?>"><?php echo $state; ?></option>
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
                                       <input  value="<?php echo $zipCode?>" type="text" class="form-control" name="zipcode" pattern="[0-9]{5}" title="Five digit zip code (numbers only)" placeholder="Five digit zip code" required disabled/>
                                   </div>
       							<div class="form-group">
                                   <label for="ft_author">Gender: </label>
                                   <select required name="Gender" class="form-control" disabled>
                                     <option value="<?php echo $gender?>"><?php echo $gender; ?></option>
                                           <option value="">Select Gender</option>
                                           <option value="Male"> Male</option>
                                           <option value="Female"> Female </option>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                   <label for="Gender">Date of submission:</label>
                                   <input value="<?php echo $dateOfSubmission; ?>" type="text" class="form-control" name="sub_date" id="datePicker" disabled >
                                   </div>

                                   <div class="form-group">
                                   <label for="Gender">Date of Interpretation: </label>
                                   <input value="<?php echo $dateOfInterpretation; ?>" type="date" class="form-control" name='dateOfInterpretation' id="dueDate"  required disabled>
                                   </div>
                                   <div class="form-group">
                                   <label for="Gender">Time of Interpretation: </label>
                                   <input value="<?php echo $timeOfInterpretation; ?>" type="time" class="form-control" name='timeOfInterpretation' id="dueDate"  required disabled>
                                   </div>
                                   <div class="form-group">
                                   <label for="Gender">Estimated length of Interpretation: (in minutes) </label>
                                   <input value="<?php echo $lengthOfInterpretation; ?>" type="number" class="form-control" name='lengthOfInterpretation' id="dueDate" min="15" max="300" value="15" step="15" required disabled>
                                   </div>
                                    <div class="form-group">
                                       <label for="Gender">Name of grant to be charged:</label>
                                       <select name="grant" class="form-control" disabled>
                                         <option value="<?php echo $grant; ?>"><?php echo $grant; ?></option>
                                           <option value="">Name of Grant</option>
                                           <option value="SOT">SOT</option>
                                       </select>
                                   </div>


        							<div class="form-group">
                                   <label for="ft_author">Language: <br></label>
                                       <select required name="lang_from" class="form-control" disabled>
                                         <option value="<?php echo $InterpretationTo?>"><?php echo $InterpretationTo?></option>
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
        							       <label for="ft_author">Special Instructions:</label>
                                           <textarea class="form-control" name="ft_message" id="textarea" placeholder="Special instructions" cols="25" rows="10" maxlength="300" disabled><?php echo $specialInstructions?></textarea>
                                          <div id="textarea_feedback"></div>
                                       </div>
                                       <div class="form-group">
                                                     <label for="ft_autho">Upload Invoice: <span class="required">* </span> <br></label>
                                                       <input type="file" class="form-control" name="invoice" required>
                                                     </div>



                               </div>
                               <button type="button" class="btn btn-primary" onclick="window.location.href = 'managework.php'">Back</button>
                               <button type="submit" class="btn btn-primary"  formaction="view_interpretationjoboverview2.php?id=<?php echo $job_id?>" name="submit">Upload Invoice</button>

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
      <p>&copy; The Internationall Institute of Connecticut, Inc.</p>
      <hr>
	</div><!--/col-->
</div><!--/container-->
</footer>
</script>
</body>
</html>
