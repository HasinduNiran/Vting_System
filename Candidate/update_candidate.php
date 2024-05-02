<?php
// Include db
include '../dbh.php';

// Initialize variables for existing candidate details
$existing_name = $existing_age = $existing_votenumber = $existing_performance = "";

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $votenumber = $_POST['votenumber'];
    $performance = $_POST['perfomance']; // corrected variable name
   
    if (!empty($_POST['existing_id'])) {
        // If an existing candidate ID is provided, update the existing candidate
        $existing_id = $_POST['existing_id'];
        $sql_update = "UPDATE candidate SET name=?, age=?, votenumber=?, perfomance=? WHERE id=?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "sissi", $name, $age, $votenumber, $performance, $existing_id);
        
        if(mysqli_stmt_execute($stmt_update)) {
            echo "Candidate updated successfully.";
        } else {
            echo "Error updating candidate: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt_update);
    } else {
        // If no existing candidate ID is provided, insert a new candidate
        $sql_insert = "INSERT INTO candidate (name, age, votenumber, perfomance) VALUES (?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "siss", $name, $age, $votenumber, $performance);
        
        if(mysqli_stmt_execute($stmt_insert)) {
            echo "New candidate added successfully.";
        } else {
            echo "Error adding new candidate: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt_insert);
    }
}

// Fetch existing candidate details
$sql_existing = "SELECT * FROM candidate LIMIT 1";
$result_existing = mysqli_query($conn, $sql_existing);

// Check if there is an existing candidate
if(mysqli_num_rows($result_existing) > 0) {
    $row_existing = mysqli_fetch_assoc($result_existing);
    // Assign existing details to variables
    $existing_id = $row_existing['id'];
    $existing_name = $row_existing['name'];
    $existing_age = $row_existing['age'];
    $existing_votenumber = $row_existing['votenumber'];
    $existing_performance = $row_existing['perfomance']; // corrected column name
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Candidate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Candidate</h1>
     
        <!-- Form to update an existing candidate or add a new one -->
        <form action="update_candidate.php" method="post">
            <!-- Hidden input to store existing candidate ID -->
            <input type="hidden" name="existing_id" value="<?php echo $existing_id; ?>">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $existing_name; ?>" required>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" value="<?php echo $existing_age; ?>" required>
            <label for="votenumber">Vote Number</label>
            <input type="number" name="votenumber" id="votenumber" value="<?php echo $existing_votenumber; ?>" required>
            <label for="performance">Performance</label>
            <input type="text" name="perfomance" id="performance" value="<?php echo $existing_performance; ?>" required>
            <button type="submit">Save Candidate</button>
        </form>
    </div>
</body>
</html>

<?php
// Free result set
if(isset($result_existing)) {
    mysqli_free_result($result_existing);
}

// Close connection
mysqli_close($conn);
?>
