<?php

require_once "../config.php"; //Check config file
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = ""; //initialize with empty values
 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 //Data about submit data
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    } //If empty user name
    else
    {
        //username data
        $sql = "SELECT id FROM users WHERE username = :username"; //sql code
        
        if($stmt = $pdo_connection->prepare($sql))
        {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            $param_username = trim($_POST["username"]); //Set user name
            
            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                if($stmt->rowCount() == 1)
                {
                    $username_err = "This username is already exist."; //Already exist id error code
                } 
                else
                {
                    $username = trim($_POST["username"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    if(empty(trim($_POST["password"])))//Password data
    {
        $password_err = "Please enter a password."; //Empty PW data    
    } 
    elseif(strlen(trim($_POST["password"])) < 6) //PW is least six characters 
    {
        $password_err = "Password must have atleast 6 characters.";
    } 
    else
    {
        $password = trim($_POST["password"]); // Set PW
    }
    
    if(empty(trim($_POST["confirm_password"]))) //Check password
    {
        $confirm_password_err = "Please confirm password."; //If empty    
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match."; //If PW not match
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
        
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)"; //insert info sql
         
        if($stmt = $pdo_connection->prepare($sql))
        {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // set info
            
            if($stmt->execute())
            {
                header("location: login.php"); // Redirect to login page
            } 
            else
            {
                echo "Something went wrong. Please try again later.";
            }
        }
         
        unset($stmt); //close
    }
    
    unset($pdo_connection); //close connection
}
?>

<!DOCTYPE html> <!--Start front-end-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/outem.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p> <!--start form-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>