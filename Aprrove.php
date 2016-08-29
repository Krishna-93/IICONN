<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
  $order_parameters = isset($_GET['order'])?$_GET['order']:'';
  $sort_parameters = isset($_GET['sort'])?$_GET['sort']:'';
  $pn = isset($_GET['pn'])?$_GET['pn']:'';
  $keywordsearch = isset($_POST['searchquery'])?$_POST['searchquery']:'';

  //$search_keyword = 'abc';

if(!empty($order_parameters))
{   $table_id = "translator_interpreter_id";
    $table = "translator_interpreter_table";
    $page_rows = 5;
    $last = numb_pages ($table_id,$table,$page_rows);
    //$query = "SELECT * FROM `translation_job_table` ".pagination($table_id,$table,$page_rows,$pn);
    $query = "SELECT * FROM `translator_interpreter_table`
    WHERE `active` LIKE 'Inactive' order by `".$order_parameters .
     "` ". $sort_parameters. " ".pagination($table_id,$table,$page_rows,$pn);
}else if(!empty($keywordsearch))
{
  $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $keywordsearch);
  $table_id = "translator_interpreter_id";
  $table = "translator_interpreter_table";
  $page_rows = 5;
  $last = numb_pages($table_id,$table,$page_rows);
  if($_POST['filter']=="due_date" || $_POST['filter']=="date_of_submission")
  {
    $time = strtotime($searchquery);
    $newformat = date('Y-m-d',$time);
    $query = "SELECT * FROM `translator_interpreter_table`
    WHERE `".$_POST['filter']."` LIKE '%".$newformat."%' AND `active` LIKE 'Inactive' ORDER BY `translator_interpreter_id` "
    .pagination($table_id,$table,$page_rows,$pn);
  }else{
  $query = "SELECT * FROM `translator_interpreter_table`
  WHERE `".$_POST['filter']."` LIKE '%".$searchquery."%' AND `active` LIKE 'Inactive' ORDER BY `translator_interpreter_id` "
  .pagination($table_id,$table,$page_rows,$pn);}

//$query = "select * from `translation_job_table` where `first_name` like '%".$search_keyword."%'";
}elseif (!empty($pn))
{
  $row_count = "Select COUNT(`translator_interpreter_id`) FROM `translator_interpreter_table` WHERE `active` LIKE 'Inactive'";
  $row_result = mysqli_query($connection, $row_count);
  $row = mysqli_fetch_row($row_result);
  $rows = $row[0];

  $page_rows = 5;

  $last = ceil($rows/$page_rows);

  if($last <1){ $last = 1; }

  if($pn<1){$pn = 1;}
  elseif($pn > $last) {$pn = $last;}
  $limit = 'LIMIT ' . ($pn-1)*$page_rows . ', ' .$page_rows;
  $query = "SELECT * FROM `translator_interpreter_table` ORDER BY `translator_interpreter_id` desc $limit";

}else{
  $table_id = "translator_interpreter_id";
  $table = "translator_interpreter_table";
  $page_rows = 5;
  $last = numb_pages ($table_id,$table,$page_rows);
  $query = "SELECT * FROM `translator_interpreter_table`
  ORDER BY `translator_interpreter_id` desc ".pagination($table_id,$table,$page_rows,$pn);

}

  $result = mysqli_query($connection, $query);

 //confirm_query($result);



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
  <title>IICONN - Approve</title>
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
        <a class="navbar-brand" href="#featured"><?php echo "Welcome, ".$_SESSION['first_name']." ".$_SESSION['last_name'];?><span class="subhead"></span></a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
       <li><a href="index.php">Home</a></li>
      <li><a href="admindashboard.php">Manage Jobs</a></li>
        <li class="active"><a href="AdminInfo.php">Manage Accounts</a></li>
                <li><a href="FAQPages.php">FAQ</a>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>
<!---------------------------------------------------------------------------------------->
<div id="wrapper">



        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="width:250px;" >

            <ul class="sidebar-nav" >
                <li class="sidebar-brand" >


                    <a href="#">
                        Admin Dashboard
                    </a>
                </li>

                            <ul> <li><a href="AdminInfo.php">Manage Your Account</a></li>
                                <li><a href="manage_otheracc.php"> Manage Other Accounts</a></li>
                                <li><a  href="AdminRegister.php">Create new Account</a></li>
                                <li><a href="Aprrove.php">Approve Translator/Interpreter</a></li>
                                <li><a href="ChangePassword.php">Change password</a></li>
                            </ul>

            </div>



        <!-- /#sidebar-wrapper -->
 <div id="page-content-wrapper" style="padding-left:130px;">
            <div class="container-fluid">
                <div class="row">
                    <div class=".col-xs-6 .col-sm-3 ">
                      <div class="panel panel-default" >
                     <div class="panel-heading">
                     <div class="centerDiv">
            <h3>Approve New Translator / Interpreter</h3>
        </div></div>
        <div class="panel-body">
    <p></p>
  </div>
  <table class="table table-hover tr-header">

      <thead>
                <tr colspan=7>
                  <th>
                    <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                      <a class="firstname-order" href="?order=first_name&sort=asc">First Name</a>
                    <?php }else{?>
                      <a class="firstname-order" href="?order=first_name&sort=desc">First Name</a>
                    <?php }?>
                  </th>
                  <th>
                    <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                      <a class="firstname-order" href="?order=last_name&sort=asc">Last Name</a>
                    <?php }else{?>
                      <a class="firstname-order" href="?order=last_name&sort=desc">Last Name</a>
                    <?php }?>
                  </th>
                  <th>
                    <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                      <a class="firstname-order" href="?order=email&sort=asc">E-mail</a>
                    <?php }else{?>
                      <a class="firstname-order" href="?order=email&sort=desc">E-mail</a>
                    <?php }?>
                  </th>
                  <th>
                    <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                      <a class="firstname-order" href="?order=phone_number&sort=asc">Phone</a>
                    <?php }else{?>
                      <a class="firstname-order" href="?order=phone_number&sort=desc">Phone</a>
                    <?php }?>
                  </th>
                  <th>
                    <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                      <a class="firstname-order" href="?order=gender&sort=asc">Gender</a>
                    <?php }else{?>
                      <a class="firstname-order" href="?order=gender&sort=desc">Gender</a>
                    <?php }?>
                  </th>
                  <!-- <th>
                    Approved
                  </th> -->
                  <th>
                    View Profile
                  </th>
        </thead>
        <tbody>
                <?php while ( $value = mysqli_fetch_assoc($result) ){
                  ?>
                <tr>
                  <td>
                    <?php  echo $value['first_name']; ?>
                  </td>
                  <td>
                    <?php  echo $value['last_name']; ?>
                  </td>
                  <td>
                    <?php  echo $value['email']; ?>
                  </td>
                  <td>
                    <?php  echo $value['phone_number']; ?>
                  </td>
                  <td>
                    <?php  echo $value['gender']; ?>
                  </td>
                  <!-- <td>

                        <input type="checkbox" name="action1" class="action1" title="Action 1"
                        <?php echo "value=\"".$value['translator_interpreter_id']."\">" ?>
                      </span>

                  </td> -->
                  <td>
                            <?php echo"<a href=\"TranslatorAndInterpreterApprovalPage.php?id=".$value['translator_interpreter_id']."&id_update=".$value['translator_interpreter_id']."\"
                            class=\"btn btn-primary btn-xs\">View</a>";?>
                  </td>
                </tr>
                <?php } ?>

        </tbody>
  </table>
  <nav>
    <ul class="pagination">
      <li>
        <a href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php
      for($i=0; $i<$last; $i++){?>
      <li><a href="?pn=<?php echo $i+1;?>"><?php echo $i+1;?></a></li>
      <?php } ?>
      <li>
        <a href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
   </div>
    </div>
  </div>
</div>
</div>
</div>
                </div>
<div class="container-fluid">

   <!--- panel panel-default --------->
</div><!---container-fluid --------->



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
      <p>&copy; The Internationall Institute of Connecticut, Inc.</p>
      <hr>
	</div><!--/col-->
</div><!--/container-->
</footer>
<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<!-- <script type=text/javascript>
alert("hello");
</script> -->
<script>

$(".action1").click(function (event) {
    confirm("Please confirm that you want to approve this person");
  var value = $(event.target).val();
  $.ajax({
      type: "POST",
      url: "test1.php",
      //async: true,
      data: {
          action1: value // as you are getting in php $_POST['action1']
      },
      success: function (msg) {
        msg = parseInt(msg);
        if(msg > 1){

          window.location = "Aprrove.php";
        }
        else{

        }

      }
  });
});
</script>

</body>
</html>
