<?php 

    require "../config.php"; //check config file
    
    try 
    {
        $connection = new PDO($dsn, $username, $password, $options); //connect database
		
        $sql = "SELECT * FROM assignment"; //sql code
        
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } 
    catch(PDOException $error) 
    {
		echo $sql . "<br>" . $error->getMessage(); //get error message
	}	

?>

<?php include "templates/header.php"; ?>
<br>

<h2>Information Update Center</h2>
<p>Select the assignment you want to modify</p> <br>

<?php foreach($result as $row) { ?> <!--reading result loop-->

<p>
    <?php echo $row['unitid']; ?> <?php echo $row['unitname']; ?> <br><br>
    <strong>Assignment Name: </strong><?php echo $row['asname']; ?> <br><br>
    <Strong>Due date:</strong> <?php echo $row['duedate']; ?><br><br>
    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a>&ensp;&ensp; <!--Edit button-->
    <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a> <!--Delete button-->
</p>

<hr>
<?php }; //close the foreach
?>





<?php include "templates/footer.php"; ?>