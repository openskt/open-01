<?php

// register.php
// Regist new staff or member

$page_title = 'Register';
include('html/header.html');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        // Initial Error Array
        $errors = array();
        
        // Check for a first name:
        if(empty($_POST['first_name'])) {
            $errors[] = 'Please enter your first name.';
        } else {
            $first_name = trim($_POST['first_name']);
        }
        
        // Check for a last name:
        if(empty($_POST['last_name'])) {
            $errors[] = 'Please enter your last name.';
        } else {
            $last_name = trim($_POST['last_name']);
        }
        
        // Check for an email address:
        if(empty($_POST['email'])) {
            $errors[] = 'Please enter your email address.';
        } else {
            $email = trim($_POST['email']);
        }
        
        // Check for a password and match against the confirmed passsword:
        if(!empty($_POST['pass1'])) {
            if($_POST['pass1'] != $_POST['pass2']) {
                $errors[] = 'Your password did not match the confirm password.';
            } else {
                $passwd = trim($_POST['pass1']);
            }
        } else {
            $errors[] = 'You forgot to enter your password.';
        }
        
        // If POST and No Error
        if(empty($errors)) {
            // Register User to Database
            // Connect to DB
            require('../mysqli_connect.php');
            
            // Make the query
            $q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) ".
                 "VALUES ('$first_name', '$last_name', '$email', SHA1('$passwd'), NOW()";
            
            // Run the query
            $r = @mysqli_query($dbc, $q);
            // If it ran OK
            if($r) {
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
?>
<div class="container">
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Add New Staff</legend>

<!-- Multiple Radios (inline) -->
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
      <input type="radio" name="title" id="radios-0" value="ms" checked="checked">
      Ms.
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="title" id="radios-1" value="mr">
      Mr.
    </label>
	</div>
  <div class="radio">
    <label for="radios-2">
      <input type="radio" name="title" id="radios-2" value="mrs">
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

<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="email" placeholder="staff@open.co.th" class="form-control input-md" required="">
  <span class="help-block">Email Address</span>  
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="picture">Picture</label>
  <div class="col-md-4">
    <input id="picture" name="email" type="file" class="form-control input-md" required="">
    <span class="help-block">Upload staff picture support JPG, TIFF and PNG</span>
  </div>
</div>

</fieldset>
</form>

    <h1>Register</h1>
    <form action="register.php" method="post">
        <p>Fist Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php
        if(isset($_POST['first_name'])) echo $_POST['first_name'];
        ?>"></p>
    
        <p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php
        if(isset($_POST['last_name'])) echo $_POST['last_name'];
        ?>"></p>
    
        <p>Email: <input type="text" name="email" size="15" maxlength="60" value="<?php
        if(isset($_POST['email'])) echo $_POST['email'];
        ?>"></p>
    
        <p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php
        if(isset($_POST['pass1'])) echo $_POST['pass1'];
        ?>"></p>
        
        <p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php
        if(isset($_POST['pass2'])) echo $_POST['pass2'];
        ?>"></p>
        
        <p><input type="submit" name="submit" value="Register"></p>
    </form>
</div>
<?php
include('html/footer.html');
?>