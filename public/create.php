<?php 
if (isset($_POST['submit'])) //when submit button click
{
    require "../config.php"; //check config file
    
    try 
    {
        $connection = new PDO($dsn, $username, $password, $options); //connect database
		
        $assignment = array( 
            "unitid" => $_POST['unitid'], 
            "unitname" => $_POST['unitname'],
            "asname" => $_POST['asname'],
            "duedate" => $_POST['duedate'], 
        );
        
        //insert sql code
        $sql = "INSERT INTO assignment (unitid, unitname, asname, duedate) VALUES (:unitid, :unitname, :asname, :duedate)";        
        
        $statement = $connection->prepare($sql);
        $statement->execute($assignment);

    } 
    catch(PDOException $error) 
    {
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php"; ?>

<!DOCTYPE html> 
<html lang="en"> <!-- Start Front-end code -->
<head>
    <meta charset="UTF-8">
    <title>Assignment Create</title>
    <link rel="stylesheet" href="assets/css/outem.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
<h2>Add a work</h2><br>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p>Assignment successfully added.</p> <!--show message when success add assignment--> 
<br>
<?php } ?>

<!--start create form-->
<form method="post">
    <label for="unitid">Unit ID</label>
    <input type="text" name="unitid" class="form-control" id="unitid">
    <br>

    <label for="unitname">Unit Name</label>
    <input type="text" name="unitname" class="form-control" id="unitname"><br>

    <label for="asname">Assignment Name</label>
    <input type="text" name="asname" class="form-control" id="asname"><br>

    <label for="duedate">Due Date</label>
    <input type="text" name="duedate" class="form-control" id="duedate"><br>

    <input type="submit" name="submit" value="Submit" class="btn btn-success"> <!--submit button-->

</form>
</div>
</body>
</html>

<?php include "templates/footer.php"; ?>