<?php
     include ('../../front_end/bootstrap/refrence.html');
    //clear all session variables
    /* if(isset( $_COOKIE[ session_name() ] )){
        //empty the cookie
        setcookie( session_name(), '' ,time()-86400 , '/');
        
    } */
    session_unset();
    
    //destroy the session
    
    echo "<div class='text'>You have been logged out! see you next time.</div><br>";

    /* Now if we want to verify that either the session array has any variable or not then we can just print the array and it will show nothing that means all the session variables have been cleared! */
    // print_r($_SESSION);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out</title>
</head>
<body>
    <a href="login.php" class="text-info">Log back in</a>
</body>
</html>