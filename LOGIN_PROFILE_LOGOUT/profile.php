<?php
    session_start();
    include ('../../front_end/bootstrap/refrence.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
</head>
<body>
    <div class="container">
        <h1>Profile</h1>
        <p class="lead">Welcome <?php echo $_SESSION['logUser']; ?></p>
        <p>Your Email is : <?php echo $_SESSION['logEmail']; ?></p>
        
        <p><a href="logout.php" class="btn btn-danger">Log Out</a></p>
    </div>
</body>
</html>