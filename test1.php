<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<!-- <?php confirm_logged_in(); ?> -->

<?php
//  $checkbox = isset($_POST['action1'])?$_POST['action1']:'';
//
//   if(!empty($checkbox))
//   {
//      $query = "UPDATE `translator_interpreter_table`
//      SET  active = 'Active'
//      WHERE `translator_interpreter_id` = '".$checkbox."'";
//
//      $result = mysqli_query($connection, $query);
//       if($result) {
//            echo $checkbox;
//        } else {
//            echo "0";
//        }
// }

  $query_last_row = "SELECT * FROM `interpretation_job_table`
  WHERE `interpretation_job_id` = 1623658 ORDER BY `interpretation_job_id` DESC LIMIT 1";
  $result_last_row = mysqli_query($connection, $query_last_row);
  $row_last = mysqli_fetch_assoc($result_last_row);



  echo "<br/>";
  $date = strtotime($row_last['date of submission']);
  echo $date;

  echo "<br/>";
  $today = time();
  echo $today;
  echo "<br/>";

  $gap = ($today - $date)/(60*60*24);
  echo $gap;

   mysqli_close($connection);
   ?>
