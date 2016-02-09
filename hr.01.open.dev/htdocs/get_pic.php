<?php
if(isset($_GET['id'])) {
    
    $id = $_GET['id'];
    
    // Connection DB
    require('../mysqli_connect.php');
    
    $q = "SELECT type, size, data FROM bin_staff_picture WHERE id = '$id'";
    
    $r = @mysqli_query($dbc, $q);
    
    // If OK
    if($r) {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
        
        header("Content-length: ".$row['size']."");
        header("Content-type: ".$row['type']."");
        echo $row['data'];
        
        mysqli_free_result($r);
    } else {
        echo '<p class="error">Error!</p>';
        echo '<p>'.mysqli_error($dbc).'<br /><br /> with Query:'.$q.'</p>';
    }
    mysqli_close($dbc);
}
?>