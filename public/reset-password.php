<?php

session_start(); //start session
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ //Check user logged in If not redirect login
    header("location: login.php");
    exit;
}
 
require_once "../config.php"; //Check config file
 
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = ""; //check empty value
 
if($_SERVER["REQUEST_METHOD"] == "POST") //about submit data check
{
    if(empty(trim($_POST["new_password"])))
    {
        $new_password_err = "Please enter the new password."; //if box empty error    
    } 
    elseif(strlen(trim($_POST["new_password"])) < 6)
    {
        $new_password_err = "Password must have atleast 6 characters."; //If password type 1-5 show error
    } 
    else
    {
        $new_password = trim($_POST["new_password"]); //require correct
    }
    

    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm the password."; //If empty
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password))
        {
            $confirm_password_err = "Password did not match."; //password didn't match show error
        }
    }
        
    if(empty($new_password_err) && empty($confirm_password_err))
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id"; //updqte sql code
        
        if($stmt = $pdo_connection->prepare($sql))
        {
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            
            $param_password = password_hash($new_password, PASSWORD_DEFAULT); //set password
            $param_id = $_SESSION["id"];
            
            if($stmt->execute())
            {
                session_destroy(); //finish session
                header("location: login.php"); // redirect login page
                exit(); //Byebye
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        unset($stmt); //close
    }
    unset($pdo_connection); //disconnection
}
?>
 
<!DOCTYPE html>
<html lang="en"> <!--start front-end code -->
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/outem.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>"> <!--label and txt box-->
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control"> <!--label and txt box-->
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"> <!--submit button-->
                <a class="btn btn-link" href="welcome.php">Cancel</a> <!--cancel button, go welcome page-->
            </div>
        </form>
    </div>    
</body>
</html>