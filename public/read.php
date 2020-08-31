<?php 

if (isset($_POST['submit'])) 
{
    require "../config.php"; //Check config file
    
    try 
    {
        $connection = new PDO($dsn, $username, $password, $options); //Connect DB
		
        $sql = "SELECT * FROM assignment";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        $result = $statement->fetchAll();

    } 
    catch(PDOException $error) 
    {
		echo $sql . "<br>" . $error->getMessage(); //DB connect error
	}	
}
?>


<?php include "templates/header.php"; ?>

<!DOCTYPE html> 
<html lang="en"> <!-- Start Front-end code -->
<head>
    <meta charset="UTF-8">
    <title>Check assignment</title>
    <link rel="stylesheet" href="assets/css/outem.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
<?php  
    if (isset($_POST['submit'])) 
    {

        if ($result && $statement->rowCount() > 0) { ?> 

<h2>Coming Assignment List</h2> <br><br>

<?php 
                foreach($result as $row) { //loop result
            ?>

<h4> <!--show assignment list-->
    <strong>Unit: </strong> <?php echo $row['unitid']; ?> <?php echo $row['unitname']; ?> <br><br>
    <strong>Assignment Name: </strong><p style="color:blue"><?php echo $row['asname']; ?></p>
    <strong>Due date: </strong> <p style="color:red"><?php echo $row['duedate']; ?></p>
</h4>

<hr>

<?php }; //close the foreach
        }; 
    }; 
?>

<br>
<form method="post">

    <input type="submit" name="submit" value="View all" class="btn btn-success">

</form>
</wrapper>
</body>
</html>

<?php include "templates/footer.php"; ?>