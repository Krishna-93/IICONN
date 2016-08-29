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
{   $table_id = "translation_job_id";
    $table = "translation_job_table";
    $page_rows = 5;
    $last = numb_pages ($table_id,$table,$page_rows);
    //$query = "SELECT * FROM `translation_job_table` ".pagination($table_id,$table,$page_rows,$pn);
    $query = "SELECT * FROM `translation_job_table` order by `".$order_parameters .
     "` ". $sort_parameters. " ".pagination($table_id,$table,$page_rows,$pn);
}else if(!empty($keywordsearch))
{
  $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $keywordsearch);
  $table_id = "translation_job_id";
  $table = "translation_job_table";
  $page_rows = 5;
  $last = numb_pages($table_id,$table,$page_rows);
  if($_POST['filter']=="due_date" || $_POST['filter']=="date_of_submission")
  {
    $time = strtotime($searchquery);
    $newformat = date('Y-m-d',$time);
    $query = "SELECT * FROM `translation_job_table`
    WHERE `".$_POST['filter']."` LIKE '%".$newformat."%' ORDER BY `translation_job_id` "
    .pagination($table_id,$table,$page_rows,$pn);
  }else{
  $query = "SELECT * FROM `translation_job_table`
  WHERE `".$_POST['filter']."` LIKE '%".$searchquery."%' ORDER BY `translation_job_id` "
  .pagination($table_id,$table,$page_rows,$pn);}

//$query = "select * from `translation_job_table` where `first_name` like '%".$search_keyword."%'";
}elseif (!empty($pn))
{
  $row_count = "Select COUNT(`translation_job_id`) FROM `translation_job_table`";
  $row_result = mysqli_query($connection, $row_count);
  $row = mysqli_fetch_row($row_result);
  $rows = $row[0];

  $page_rows = 5;

  $last = ceil($rows/$page_rows);

  if($last <1){ $last = 1; }

  if($pn<1){$pn = 1;}
  elseif($pn > $last) {$pn = $last;}
  $limit = 'LIMIT ' . ($pn-1)*$page_rows . ', ' .$page_rows;
  $query = "SELECT * FROM `translation_job_table` ORDER BY `translation_job_id` desc $limit";

}else{
  $table_id = "translation_job_id";
  $table = "translation_job_table";
  $page_rows = 5;
  $last = numb_pages ($table_id,$table,$page_rows);
  $query = "SELECT * FROM `translation_job_table`
  ORDER BY `translation_job_id` desc ".pagination($table_id,$table,$page_rows,$pn);

}

  $result = mysqli_query($connection, $query);

 //confirm_query($result);
 // if($_GET['switch_page_id']=== 1){
 //   redirect_to('interp_admindashboard.php');
 // }
 // if($_GET['switch_page_id'] === 2){
 //   redirect_to('admindashboard.php');
 // }



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
  <title>IICONN - Translation Job Table</title>
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
      <li class="active"><a href="staffdashboard.php">Manage Jobs</a></li>
        <li ><a href="Staffinfo.php">Manage Accounts</a></li>
                <li ><a  href="FAQPagesStaff.php">FAQ</a>
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
                        Staff Dashboard
                    </a>
                </li>
           <ul> <li>
                    <a href="staffdashboard.php">
                      <i class="fa fa-tachometer"></i>Dashboard
                    </a>
                </li>
                 <li><a href="CreateNewTranslationJobStaff.php">New Translation job</a></li>
                                <li><a href="CreateNewInterpretationJobStaff.php"> New Interpretation job</a></li>

                            </ul> </div>

        <!-- /#sidebar-wrapper -->
 <div id="page-content-wrapper" style="padding-left:100px;">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">
                      <div class="panel panel-default">
            <div class="panel-heading">


                    <div class=".col-xs-12 .col-sm-6 .col-lg-8">
                      <div class="panel panel-default" >
                     <div class="panel-heading">

                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-btn">
                          <select name="page_switch" id="page_switch" class="form-control">
                            <option value="staffdashboard.php">Translation Table</option>
                            <option value="interp_staffdashboard.php">Interpretation Table</option>
                          </select>
                      </span>
                    </div><!-- /input-group -->
                  </div>
                    <div class="col-sm-offset-4 col-md-offset-6 col-lg-offset-7">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <form action="staffdashboard.php" method="post" class="navbar-form" role="search">

                            <!-- <button type="button" class="btn btn-default dropdown-toggle"
                              type="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">Category <span class="caret"></span></button> -->
                          <select name="filter" class="form-control">
                              <option value="translation_Job_id">Job Number</option>
                              <option value="first_name">First Name</option>
                              <option value="last_name">Last Name</option>
                              <option value="job_title">Document Type</option>
                              <option value="date_of_submission">Date of Submission</option>
                              <option value="due_date">Due Date</option>
                              <option value="job_status">Job Status</option>
                              <option value="lang_from">Language From</option>
                              <option value="lang_to">Language To</option>
                          </select>
                          <!-- </button> -->

                          <div class="input-group add-on">
                            <input class="form-control" placeholder="Search" name="searchquery" id="srch-term" type="text">
                            <div class="input-group-btn">
                              <button class="btn btn-default" name="submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                          </div>
                          </form>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                </div>
            </div>
                  <div class="pcw-wrap">
                      <table class="table table-hover tr-header">
                        <thead>

                        <tr class="">
                          <th>
                            <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                              <a class="firstname-order" href="?order=translation_Job_id&sort=asc">Job Number</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=translation_Job_id&sort=desc">Job Number</a>
                            <?php }?>
                          </th>
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
                              <a class="firstname-order" href="?order=job_title&sort=asc">Document type</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=job_title&sort=desc">Document type</a>
                            <?php }?>
                          </th>
                          <th>
                            <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                              <a class="firstname-order" href="?order=date_of_submission&sort=asc">Date of Submission</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=date_of_submission&sort=desc">Date of Submission</a>
                            <?php }?>
                          </th>
                          <th>
                            <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                              <a class="firstname-order" href="?order=due_date&sort=asc">Due Date</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=due_date&sort=desc">Due Date</a>
                            <?php }?>
                          </th>
                          <th>
                            <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                              <a class="firstname-order" href="?order=job_status&sort=asc">Job Status</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=job_status&sort=desc">Job Status</a>
                            <?php }?>
                          </th>
                          <th>
                            <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                              <a class="firstname-order" href="?order=lang_from&sort=asc">Language From</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=lang_from&sort=desc">Language From</a>
                            <?php }?>
                          </th>
                          <th>
                            <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                              <a class="firstname-order" href="?order=lang_to&sort=asc">Language To</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=lang_to&sort=desc">Language To</a>
                            <?php }?>
                          </th>
                          <th>
                            <?php if($sort_parameters == 'desc' || $sort_parameters == ''){?>
                              <a class="firstname-order" href="?order=number_of_pages&sort=asc"># of Pages</a>
                            <?php }else{?>
                              <a class="firstname-order" href="?order=number_of_pages&sort=desc"># of Pages</a>
                            <?php }?>
                          </th>
                          <th>

                          </th>
                        </tr>

                      </thead>

                      <tbody>

                        <?php while ( $value = mysqli_fetch_assoc($result) ){
                          ?>
                        <tr>
                          <td>
                          <?php  echo $value['translation_Job_id']; ?>
                          </td>
                          <td>
                            <?php  echo $value['first_name']; ?>
                          </td>
                          <td>
                            <?php  echo $value['last_name']; ?>
                          </td>
                          <td>
                            <?php  echo $value['job_title']; ?>
                          </td>
                          <td>
                            <?php  echo $value['date_of_submission']; ?>
                          </td>
                          <td>
                            <?php  echo $value['due_date'] ?>
                          </td>
                          <td>
                            <?php  echo $value['job_status'] ?>
                          </td>
                          <td>
                            <?php  echo $value['lang_from']; ?>
                          </td>
                          <td>
                            <?php  echo $value['lang_to']; ?>
                          </td>
                          <td>
                            <?php  echo $value['number_of_pages']; ?>
                          </td>

                          <td>
                            
                            <?php echo "<a href=\"TranslationJobOverviewStaff.php?id=".$value['translation_Job_id']."&id_update=".$value['translation_Job_id']."\"
                            class=\"btn btn-primary btn-xs\">View</a>"; ?>

                          </td>
                        </tr>
                        <?php } ?>

                      </tbody>
                        <!-- replace with php foreach -->
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
                  </div> </div>
                 </div>

                </div> <!--- end of class panel --->
              </div> <!---- end of class "col-" --->
              </div> <!--- end of class "row" --->
            </div> <!--- end of container-fluid --->
        </div> <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->


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
<script>
  var get_new_result = function(){
    // alert('there');
    $.ajax({
      type : 'get',
      url : 'get_new_result.php',
    }).done(function(result){
      $('tbody').prepend(result);
    })
  }

  window.setInterval(get_new_result, 500000);
</script>
<script>
  var urlmenu = document.getElementById( 'page_switch' );
  urlmenu.onchange = function() {
  window.open( this.options[ this.selectedIndex ].value, '_self');
};
</script>
</body>
</html>
