<?php 

    require "../config.php"; //check config file
    require "common.php"; //check common file

    if (isset($_POST['submit'])) { //when you submit button click
        try {
            $connection = new PDO($dsn, $username, $password, $options);  //Connect db
            
            $assignment =[
              "id"         => $_POST['id'],
              "unitid" => $_POST['unitid'],
              "unitname"  => $_POST['unitname'],
              "asname"   => $_POST['asname'],
              "duedate"   => $_POST['duedate'],
              "date"   => $_POST['date'],
            ];
            
            //update sql code
            $sql = "UPDATE `assignment` 
                    SET id = :id, 
                    unitid = :unitid, 
                    unitname = :unitname, 
                    asname = :asname, 
                    duedate = :duedate, 
                        date = :date 
                    WHERE id = :id";

            $statement = $connection->prepare($sql);
            
            $statement->execute($assignment);

        } 
        catch(PDOException $error) 
        {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    if (isset($_GET['id'])) { //Get data DB
        
        try 
        {
            $connection = new PDO($dsn, $username, $password, $options); //connect DB
            
            $id = $_GET['id'];
            
            $sql = "SELECT * FROM assignment WHERE id = :id";
            
            $statement = $connection->prepare($sql);
            
            $statement->bindValue(':id', $id);
            
            $statement->execute();
            
            $assignment = $statement->fetch(PDO::FETCH_ASSOC);
            
        } 
        catch(PDOExcpetion $error) 
        {
            echo $sql . "<br>" . $error->getMessage();
        }
    } 
    else 
    {
        echo "No id - something went wrong"; //When not find id
        //exit;
    };


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
<h2>Edit a work</h2>
<?php if (isset($_POST['submit']) && $statement) : ?>
<br><br>
	<p style="color:blue">Assignment successfully updated.</p>
<?php endif; ?>
<br>
<!--start form-->
<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" class="form-control" value="<?php echo escape($assignment['id']); ?>" >
    
    <label for="unitid">Unit ID</label>
    <input type="text" name="unitid" id="unitid" class="form-control" value="<?php echo escape($assignment['unitid']); ?>">

    <label for="unitname">Unit Name</label>
    <input type="text" name="unitname" id="unitname" class="form-control" value="<?php echo escape($assignment['unitname']); ?>">

    <label for="asname">Assessment Name</label>
    <input type="text" name="asname" id="asname" class="form-control" value="<?php echo escape($assignment['asname']); ?>">

    <label for="duedate">Due date</label>
    <input type="text" name="duedate" id="duedate" class="form-control" value="<?php echo escape($assignment['duedate']); ?>">
    
    <label for="date">Work Date</label>
    <input type="text" name="date" id="date" class="form-control" value="<?php echo escape($assignment['date']); ?>">

    <br>
    <input type="submit" name="submit" value="Save" class="btn btn-success"> <!--submit button-->

</form>
</div>
</body>
</html>





<?php include "templates/footer.php"; ?>