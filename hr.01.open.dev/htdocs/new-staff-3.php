<?php

// new-staff-1.php
// Regist new staff - step 1

$page_title = 'Add New Staff Step 1';
include('html/header.html');

$pic_id = $_GET['pic_id'];
$staff_id = $_GET['staff_id'];

?>
<div class="container">
  
  
  <form class="form-inline" role="form" method="POST">
    <fieldset>
      
      <legend>Add new staff - Step 3 :: Contact information</legend>
      
        <!-- <img src="get_pic.php?id=<?php echo $pic_id; ?>" class="img-thumbnail" width="150"> -->

        
        <div class="form-group">
          <label class="sr-only" for="address">Email:</label>
          <input type="email" class="form-control" id="address">
        </div>

      
    </fieldset>
  </form>
  
  
</div>





<?php
include('html/footer.html');
?>