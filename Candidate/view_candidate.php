<?php
    // Include database connection
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
    <link rel="stylesheet" href="s.css">
</head>
<body>
    <div class="container">
        <div class="candidates">
        <?php
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='candidate'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>"; // Use htmlspecialchars to prevent XSS attacks
                $photo_path = '' . htmlspecialchars($row['photo']);

                if (file_exists($photo_path)) {
                    // Display the profile picture if it exists
                    echo "<img src='pro.jpeg' alt='" . htmlspecialchars($row['name']) . "' width='200'>";
                } else {
                    // Display a placeholder image or message if no profile picture is available
                    echo "<p>No photo available</p>";
                }

                echo "<p><strong>Age:</strong> " . htmlspecialchars($row['age']) . "</p>"; // Sanitize output
                echo "<p><strong>Vote Number:</strong> " . htmlspecialchars($row['votenumber']) . "</p>"; // Sanitize output
                echo "<p><strong>Performance:</strong> " . htmlspecialchars($row['perfomance']) . "</p>"; // Sanitize output
                
                // Edit button
                echo "<a href='update_candidate.php?id=" . $row['id'] . "'><button>Edit</button></a>";
                
                echo "<a href='delete_candidate.php?id=" . $row['id'] . "'><button>Delete</button></a>";


                // Delete button
                // echo "<form method='POST' action='delete_candidate.php'>";
                // echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                // echo "<button type='submit' name='delete'>Delete</button>";
                echo "</form>";

                echo "</div>";
            }
        ?>
        </div>
    </div>
</body>
</html>

<?php
    // Free result set
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);
?>
