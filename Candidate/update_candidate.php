<?php
// Include db
include '../dbh.php';

// Initialize variables for existing candidate details
$existing_id = $existing_name = $existing_age = $existing_votenumber = $existing_dob = $existing_villege = $existing_performance = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $existing_id = $_POST['existing_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $votenumber = $_POST['votenumber'];
    $dob = $_POST['dob'];
    $villege = $_POST['villege']; // corrected variable name
    $performance = $_POST['perfomance']; // corrected variable name

    // Update the existing candidate
    $sql_update = "UPDATE candidate SET name=?, age=?, votenumber=?, dob=?, villege=?, perfomance=? WHERE id=?";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "sissssi", $name, $age, $votenumber, $dob, $villege, $performance, $existing_id);

    if (mysqli_stmt_execute($stmt_update)) {
        echo "Candidate updated successfully.";
    } else {
        echo "Error updating candidate: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt_update);
}

// Fetch existing candidate details
$sql_existing = "SELECT * FROM candidate WHERE id = ?";
$stmt_existing = mysqli_prepare($conn, $sql_existing);
mysqli_stmt_bind_param($stmt_existing, "i", $_GET['id']);
mysqli_stmt_execute($stmt_existing);
$result_existing = mysqli_stmt_get_result($stmt_existing);

// Check if there is an existing candidate
if (mysqli_num_rows($result_existing) > 0) {
    $row_existing = mysqli_fetch_assoc($result_existing);
    // Assign existing details to variables
    $existing_id = $row_existing['id'];
    $existing_name = $row_existing['name'];
    $existing_age = $row_existing['age'];
    $existing_votenumber = $row_existing['votenumber'];
    $existing_dob = $row_existing['dob'];
    $existing_villege = $row_existing['villege']; // corrected column name
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

        <!-- Form to update an existing candidate -->
        <form action="update_candidate.php" method="post">
            <!-- Hidden input to store existing candidate ID -->
            <input type="hidden" name="existing_id" value="<?php echo $existing_id; ?>">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $existing_name; ?>" required>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" value="<?php echo $existing_age; ?>" required>
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="<?php echo $existing_dob; ?>" required>
            <label for="villege">Village</label>
            <input type="text" name="villege" id="villege" value="<?php echo $existing_villege; ?>" required>
            <label for="votenumber">Vote Number</label>
            <input type="number" name="votenumber" id="votenumber" value="<?php echo $existing_votenumber; ?>" required>
            <label for="perfomance">Performance</label>
            <input type="text" name="perfomance" id="perfomance" value="<?php echo $existing_performance; ?>" required>
            <button type="submit">Save Candidate</button>
        </form>
    </div>
</body>

</html>

<?php
// Close statement
mysqli_stmt_close($stmt_existing);

// Close connection
mysqli_close($conn);
?>
