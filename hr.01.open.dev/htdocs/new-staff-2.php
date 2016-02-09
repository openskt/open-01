<?php

// register.php
// Regist new staff or member

$page_title = 'Register';
include('html/header.html');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Initial Error Array
    $errors = array();
    
    // debug
    //print_r($_POST);
    //exit();
    
    // Trim sex and title
    $sex = trim($_POST['sex']);
    $title = trim($_POST['title']);
    
    // Check for a first name:
    if(empty($_POST['first_name'])) {
        $errors[] = 'Please enter staff first name.';
    } else {
        $first_name = trim($_POST['first_name']);
    }
    
    // Check for a last name:
    if(empty($_POST['last_name'])) {
        $errors[] = 'Please enter staff last name.';
    } else {
        $last_name = trim($_POST['last_name']);
    }
    
    // Check thai first name
    if(empty($_POST['thai_first_name'])) {
        $errors[] = 'Please enter Thai First Name';
    } else {
        $thai_first_name = trim($_POST['thai_first_name']);
    }
    
    // check thai last name
    if(empty($_POST['thai_last_name'])) {
        $errors[] = 'Please enter Thai Last Name';
    } else {
        $thai_last_name = trim($_POST['thai_last_name']);
    }
        
    //
    // TODO::
    // Check existing of staff on DB
    //
    
    // If POST and No Error
    if(empty($errors)) {
        
        $staff_pic_id = trim($_POST['pic_id']);
        // Register User to Database
        // Connect to DB
        require('../mysqli_connect.php');
        
        // Make the query
        $q = "INSERT INTO staff (first_name, last_name, thai_first_name, thai_last_name, sex, title, staff_picture_id) ".
             "VALUES ('$first_name', '$last_name', '$thai_first_name', '$thai_last_name', '$sex', '$title', '$staff_pic_id')";
        
        // debug again
        //echo "\$q=".$q;
        //exit();
        
        // Run the query
        $r = @mysqli_query($dbc, $q);
        // If it ran OK
        if($r) {
            
            header("Location: new-staff-3.php?pic_id=".$_POST['pic_id']."&staff_id=".mysqli_insert_id($dbc)."");
            mysqli_close($dbc);
            exit();
            // Print a message
            echo '<h1>Thanks you!</h1>
            <p>You are now registered.</p>';
        } else { // If it did not OK
            echo '<h1>System Error</h1>
            <p class="error">You could not be registered du to a system error. We apologize for any inconvenience.</p>';
            
            // Debuging message:
            echo '<p>'.mysqli_error($dbc).'<br /><br />Query: '.$q.'</p>';
        } // End of if (r) IF.
        
        // Close the database connection
        mysqli_close($dbc);
        
        // Include the footer and quit the script
        include('html/footer.html');
        exit();
        
    // Report the errors.
    } else {
        echo '<h1>Error!</h1>
        <p class="error">The following errors(s) occurred:<br />';
        foreach($errors as $msg) {
            // Print each error
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    }
        
// End if POST the main Submit conditional.
}

$pic_id = $_GET['pic_id'];

?>
<div class="container">
    
<form class="form-horizontal" action="" method="POST">
<fieldset>

<!-- Form Name -->
<legend>Add New Staff - Step 2 :: Personal Information</legend>

<!-- Multiple Radios (inline) -->
<div class="row">
    <div class="col-sm-2"><img src="get_pic.php?id=<?php echo $pic_id; ?>" class="img-thumbnail" width="150"></div>
    <div class="col-sm-10">
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="sex">Sex</label>
          <div class="col-md-4">
            <label class="radio-inline" for="radios-1">
              <input type="radio" name="sex" id="radios-1" value="female" checked="checked">
              Female
            </label>
            <label class="radio-inline" for="radios-0">
              <input type="radio" name="sex" id="radios-0" value="male">
              Male
            </label> 
          </div>
        </div>
        
        <!-- Multiple Radios -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="title">Title</label>
          <div class="col-md-4">
          <div class="radio">
            <label for="radios-0">
              <input type="radio" name="title" id="radios-0" value="Ms." checked="checked">
              Ms.
            </label>
                </div>
          <div class="radio">
            <label for="radios-1">
              <input type="radio" name="title" id="radios-1" value="Mr.">
              Mr.
            </label>
                </div>
          <div class="radio">
            <label for="radios-2">
              <input type="radio" name="title" id="radios-2" value="Mrs.">
              Mrs.
            </label>
                </div>
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="first_name">First Name</label>  
          <div class="col-md-4">
          <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control input-md" required="">
          <span class="help-block">Enter First Name here</span>  
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="last_name">Last Name</label>  
          <div class="col-md-4">
          <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control input-md" required="">
          <span class="help-block">Enter Last Name here</span>  
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="first_name">ชื่อ</label>  
          <div class="col-md-4">
          <input id="thai_first_name" name="thai_first_name" type="text" placeholder="ชื่อ" class="form-control input-md" required="">
          <span class="help-block">ใส่ชื่อภาษาไทย</span>  
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="thai_last_name">นามสกุล</label>  
          <div class="col-md-4">
          <input id="thai_first_name" name="thai_last_name" type="text" placeholder="นามสกุล" class="form-control input-md" required="">
          <span class="help-block">ใส่นามสกุลภาษาไทย</span>  
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="nick_name">Nickname</label>  
          <div class="col-md-4">
          <input id="nick_name" name="nick_name" type="text" placeholder="Nick Name" class="form-control input-md" required="">
          <span class="help-block">Put nick name here</span>  
          </div>
        </div>
        
        <div class="form-group" align="right">
        <input type="hidden" name="pic_id" value="<?php echo $pic_id; ?>">
        <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</div>





</fieldset>
</form>

</div>
<?php
include('html/footer.html');
?>