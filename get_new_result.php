<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
if(isset($_SESSION['latest_row_id']) && !empty($_SESSION['latest_row_id'])){
  $query = "Select * FROM `translation_job_table` ORDER BY `translation_job_id` desc LIMIT 1";
  $row_result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($row_result);
  $latest_id = $row['translation_Job_id'];
  $prev_id = $_SESSION['latest_row_id'];


  if($latest_id>$prev_id){
  $query = "Select * FROM `translation_job_table` WHERE `translation_job_id` > '".$prev_id."'";
  $result = mysqli_query($connection, $query);
 echo "visited the top";
 print_r($result);

?>
  <tbody>

    <?php while ( $value = mysqli_fetch_assoc($result) ){
      ?>
    <tr>
      <td>
      <?php  echo $value['job_title']; ?>
      </td>
      <td>
        <?php  echo $value['first_name']; ?>
      </td>
      <td>
        <?php  echo $value['last_name']; ?>
      </td>
      <td>
        <?php  echo $value['address']; ?>
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
        <a href="job_list.php?id=1" class="btn btn-primary btn-xs">View</a>
      </td>
    </tr>

    <?php $_SESSION['latest_row_id'] = $value['translation_Job_id']; ?>

    <?php } }?>

  </tbody>
<?php }
else{
  $query = "Select * FROM `translation_job_table` ORDER BY `translation_job_id` desc LIMIT 1";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  $test = $row['translation_Job_id'];
  $_SESSION['latest_row_id'] = 10;
  echo "visited the bottom";

  exit();
}


?>
