<?php require_once("includes/db.php"); ?>

<?php
if(!empty($_GET)) {
    $searchText = $_GET["searchText"];
    $searchBy = $_GET["searchBy"];
    $numOfRows = $_GET["numOfRows"];
    $startFrom = $_GET["startFrom"];
    if (!empty($searchBy)) {
        echo json_encode(getJobs($searchText, $searchBy, $numOfRows, $startFrom));
        return true;
    } else {
        return false;
    }

}
/*
function getJobsOnLoad() {
   return json_encode(getJobs("", "All", 20, 0));
}*/
function getJobs($searchLike, $searchColumn, $limit, $offset) {
    global $connection;
    $searchLike = trim(mysqli_real_escape_string($connection,stripslashes($searchLike)));
    /*$limit = sprintf("%d",$limit);*/
    $query = "SELECT `Title`, `Status`, `Assigned To`,`Submission Date`, `Last Name` FROM `vtranslation_job` ";
    $countQuery = "SELECT COUNT(`Title`) AS `Total` FROM `vtranslation_job` ";
    if (!($searchLike == "" OR $searchLike == "*") AND !($searchColumn == "All")) {
        $query .= "WHERE `". $searchColumn ."` LIKE '%". $searchLike ."%'";
        $countQuery .= "WHERE `". $searchColumn ."` LIKE '%". $searchLike ."%'";
    }
    $query .= "LIMIT ". $limit ." OFFSET ". $offset;

    $result = mysqli_query($connection, $query);
    $countresult = mysqli_query($connection, $countQuery);
    $jobsList = array();
    if($result){
        while($row=mysqli_fetch_assoc($result)) {
            array_push($jobsList, $row);
        }
        if ($countresult) {
            while($countrow=mysqli_fetch_assoc($countresult)) {
                array_push($jobsList, $countrow);
            }
        }
    }
    else{
        die("Database query failed. " . mysqli_error($connection));
    }
    mysqli_close($connection);
    return ($jobsList);
}
?>
