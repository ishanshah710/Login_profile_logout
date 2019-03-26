<?php
/*
    STEPS WE NEED TO TAKE
    
    1. Build Login html form
    2. check if the form has been submitted
    3. Validate the form data
    4. Add form data to the variables
    5. Connect to the database
    6. Query the database for username submitted in      the form
        6.1  If no entries : show error message
    7. store basic user data from database to            variables
    8. Verify stored hashed password with the one        submitted in the form
        8.1 If invalid : show error message
    9. Start a session & create session variables
    10. Redirect to a "Profile page"
        10.1 Provide a link to "logout" page
        10.2 Add cookie clear to logout page
        10.3 Provide link to log back include
    11. Close the MySQL connection
*/
include ('../../front_end/bootstrap/refrence.html');
?>
<?php
    $err = '';
    if( isset( $_POST['login'] ) )
    {
        /* build a function to validate the form data */
        function validate( $data )
        {
            $data = trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }
        // create variables
        // wrap the data with our function
        $formUser = validate( $_POST['username'] );
        $formPass = validate( $_POST['pwd'] );
        
        // connect to the database
        $con = mysqli_connect('localhost','root','','india');
        
        //create sql query
        $query = "select Username,Email,Password from users where Username='$formUser'";
        
        //store the result
        $result = mysqli_query( $con , $query );
        
        //verify if result is returned
        if(mysqli_num_rows($result) > 0)
        {
            // store basic user data in variables
            while( $row = mysqli_fetch_assoc($result) )
            {
                $user = $row["Username"];
                $email = $row["Email"];
                $hashedPass = $row['Password'];
                
                // verify hashed password with the typed password
                if( password_verify($formPass , $hashedPass) )
                {
                    // start the session
                    session_start();    
                    // store the variables in session variables
                    $_SESSION["logUser"] = $user;
                    $_SESSION["logEmail"] = $email;
                    
                    //redirects users to profile.php
                    header("Location: profile.php");
                }
                else
                {
                    //error message
                    $err = "<div class='alert alert-danger'>Username and Password are not matching. Try again.</div>";
                }
            }
        }
        else
        {
            // there are no results
            $err = "<div class='alert alert-danger'>No Such User in database. Try again.<a class='close' data-dismiss='alert'>&times;</a></div>"; 
        }
        // close the connection
        mysqli_close($con);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <p class="lead">Use this form to log in to your account</p>
        
        <?php echo $err; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="UserName"><br>
                <input type="password" name="pwd" class="form-control" placeholder="Password">
            </div>
                <input type="submit" value="Log In" class="btn btn-primary" name="login">
        </form>
    </div>
</body>
</html>

<!-- To prevent resubmission of form 
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>  -->