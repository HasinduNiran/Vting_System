<?php
// Include db
include '../dbh.php';

// Retrieve candidates from the database
$sql = "SELECT * FROM candidate";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Candidates</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>View Candidates</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Vote Number</th>
                    <th>Performance</th>
                    <th>Action</th> <!-- New column for action button -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each row in the result set
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['age']."</td>";
                    echo "<td>".$row['votenumber']."</td>";
                    echo "<td>".$row['perfomance']."</td>";
                    // Add action button
                    echo "<td><a href='update_candidate.php?id=".$row['id']."'>Edit</a> | <a href='delete_candidate.php?id=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this candidate?\")'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Free result set
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>
