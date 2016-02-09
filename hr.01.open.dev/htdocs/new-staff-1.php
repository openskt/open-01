<?php

// new-staff-1.php
// Regist new staff - step 1

if($_SERVER['REQUEST_METHOD'] == "POST" && count($_FILES) > 0) {
  
  // Debug print all values
  /*
  print_r($_POST);
  print_r($_FILES);
  exit();
  */
  
  $fileName = $_FILES['staff_picture']['name'];
  $tmpName  = $_FILES['staff_picture']['tmp_name'];
  $fileSize = $_FILES['staff_picture']['size'];
  $fileType = $_FILES['staff_picture']['type'];
  
  if(is_uploaded_file($_FILES['staff_picture']['tmp_name'])) {
    
    // Build up data for insertion
    
    $fp       = fopen($tmpName, 'r');
    $content  = fread($fp, filesize($tmpName));
    $content  = addslashes($content);
    fclose($fp);
    
    //$binary_data = addslashes(file_get_contents($_FILES['staff_picture']['tmp_name']));
    //$picture_properties = getimagesize($_FILES['staff_picture']['tmp_name']);
    //$picture_type = $_FILES['staff_picture']['type'];
    
    // connect db
    require('../mysqli_connect.php');
    
    $q = "INSERT INTO bin_staff_picture (type, size, data)".
          " VALUES('$fileType', '$fileSize', '$content')";
          
    //echo $q;
    //exit();
    
    // Run query
    $r = @mysqli_query($dbc, $q);
    

    // If insert OK
    if($r) {
      header("Location: new-staff-2.php?pic_id=".mysqli_insert_id($dbc)."");
      mysqli_close($dbc);
      exit();
      echo "<h1>OK, result=".$r."</h1><p>Insert ID:".mysqli_insert_id($dbc)."</p>";
      
    } else {
      echo "<h1>System Error!</h1>";
      echo "<p>".mysqli_errno($dbc)." with query = ".$q."</p>";
    }
    
    // Close database connection
    mysqli_close($dbc);
    
  }

}

$page_title = 'Add New Staff Step 1';
include('html/header.html');

?>
<div class="container">
  <form class="form-inline" role="form" method="POST" enctype="multipart/form-data">
    <fieldset>
      
      <legend>Add new staff - Step 1 :: Upload Picture</legend>
      
      <div class="form-group">
        <label class="sr-only" for="picture">Picture:</label>
        <input type="file" name="staff_picture" class="form-control input-md" accept="image/*">
        <span class="help-block">Upload staff picture support JPG, TIFF, GIF and PNG format. Max size 64k.</span>
        <input type="hidden" name="MAX_FILE_SIZE" value="64000">
      </div>
      

    </fieldset>
    
    <button type="submit" class="btn btn-default">Submit</button>
  
  </form>
</div>

<?php
include('html/footer.html');
?>