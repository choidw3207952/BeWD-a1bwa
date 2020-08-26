<?php 

    require "../config.php"; //check config
    require "common.php"; //check common

    if (isset($_GET["id"])) 
    {
        try 
        {
            $connection = new PDO($dsn, $username, $password, $options); //connect DB
            
            $id = $_GET["id"];
            
            $sql = "DELETE FROM assignment WHERE id = :id"; //sql code

            $statement = $connection->prepare($sql);
            
            $statement->bindValue(':id', $id);
            
            $statement->execute();

            $success = "Assignment successfully deleted"; //delete success message

        } 
        catch(PDOException $error) 
        {
            echo $sql . "<br>" . $error->getMessage();
        }
    };

    try {
        $connection = new PDO($dsn, $username, $password, $options); //connect DB
		
        $sql = "SELECT * FROM assignment";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        $result = $statement->fetchAll();
    } 
    catch(PDOException $error) 
    {
        echo $sql . "<br>" . $error->getMessage();
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
<h2>Delete a user</h2>

<?php if ($success) echo $success; ?>

<!-- This is a loop, which will loop through each result in the array -->
<?php foreach($result as $row) { ?>

<p>
    ID: <?php echo escape($row['id']); ?><br> 
    Unit ID: <?php echo $row['unitid']; ?><br> 
    Unit name: <?php echo $row['unitname']; ?><br> 
    Assignment Name: <?php echo $row['asname']; ?><br> 
    Due date: <?php echo $row['duedate']; ?><br><br>
    <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
</p>

<hr>
<?php }; //close the foreach
?>
</div>
</body>
</html>



<?php include "templates/footer.php"; ?>