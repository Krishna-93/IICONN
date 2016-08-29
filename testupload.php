<?php
if(isset($_POST['submit']))
{

echo $name = $_FILES['file']['name'];

echo '<br>';
echo '<br>';

echo $tmp_name = $_FILES['file']['tmp_name'];

echo '<br>';
echo '<br>';

echo $_FILES['file']['type'];

echo '<br>';
echo '<br>';

echo $unique = uniqid();

echo '<br>';
echo '<br>';

//allows in the following order these file types to be uploaded
//.doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .zip, .rar
//some of these like .rar have two or more in the allowed array for different types of rars and zips
 $allowed = array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/pdf', 'application/zip','application/octet-stream', 'application/x-rar-compressed', 'application/octet-stream', 'application/x-zip-compressed', '');

 if(in_array($_FILES['file']['type'], $allowed)) {

if (isset($name)) {
  if (!empty($name)) {

    $server = "iiconn.club";
    $connection = ftp_connect($server) or die("Could not connect to $server");
    $username = "root";
    $password = "iiconnproject";
    $login = ftp_login($connection, $username, $password);

    // upload file
    if (ftp_put($connection, "/var/www/html/uploads/" . $name, $tmp_name, FTP_BINARY ))
      {
      echo "Successfully uploaded $tmp_name.";
      }
    else
      {
      echo "Error uploading $tmp_name.";
      }

    // close connection
    ftp_close($connection);



  }
  else {
    // echo "Please choose a file.";
  }
}
}
else {
      echo "file not allowed.";
}
}

?>


<form action="testupload.php" method="post" enctype="multipart/form-data" >
  <input type="file" name="file"> <br> <br>

  <input type="submit" value="submit" name="submit">


</form>
