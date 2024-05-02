<?php

//include db
include '../dbh.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $votenumber = $_POST['votenumber'];
    $performance = $_POST['perfomance']; // corrected variable name
   
    // You should execute the SQL query to insert data into the database
    $sql = "INSERT INTO candidate (name, age, votenumber, perfomance) VALUES ('$name', '$age', '$votenumber', '$performance')";
    
    // Perform the query
    if(mysqli_query($conn, $sql)){
        echo "Candidate added successfully.";
    } else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Candidate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Candidate</h1>
        <form action="add_candidate.php" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" required>
            <label for="votenumber">Vote Number</label>
            <input type="number" name="votenumber" id="votenumber" required>
            <label for="performance">Performance</label> <!-- corrected id -->
            <input type="text" name="perfomance" id="performance" required> <!-- corrected id -->
            <button type="submit">Add Candidate</button>
        </form>
    </div>
</body>
</html>
