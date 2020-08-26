<?php

session_start(); //session start

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ //Check user logged in If not direct login page
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to assignment tracker</title>
    <link rel="stylesheet" href="assets/css/outem.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Semester2 assignment tracker site!</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <br><br>
    <p>
        <div style="border:2px solid Tomato;">
        <h4><strong>Do you want see assignment due date? Click below! </strong></h4> 
        <a href="read.php" class="btn btn-success">Show assignment list</a> <br><br></div>
        <br>
        <div style="border:2px solid DodgerBlue;">
        <h4>Edit Information</h4>
        <a href="create.php" class="btn btn-primary">create new</a> &ensp;&ensp;&ensp;&ensp;
        <a href="update.php" class="btn btn-info">update list</a> &ensp;&ensp;&ensp;&ensp;
        <a href="delete.php" class="btn btn btn-danger">Delete list</a> &ensp;&ensp;&ensp;&ensp; <br><br>
        </div>
    </p>
</body>
</html>
