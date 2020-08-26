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


<h2>Results</h2>
<p>Select the assignment you want to modify</p> <br>

<?php foreach($result as $row) { ?> <!--reading result loop-->

<p>
    ID: <?php echo $row['id']; ?><br> 
    Unit ID: <?php echo $row['unitid']; ?><br>
    Unit name: <?php echo $row['unitname']; ?><br>
    Assignment name: <?php echo $row['asname']; ?><br> 
    Due date: <?php echo $row['duedate']; ?><br><br>
    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a> <!--Edit button-->
</p>

<hr>
<?php }; //close the foreach
?>





<?php include "templates/footer.php"; ?>