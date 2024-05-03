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
    <link rel="stylesheet" href="../css/viewcard.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="header">
    <a href="#" class="logo">
        <img src="../image/pngegg.png" alt="" width="150px" height="70px"> </a>

    <nav class="navbar">
        <a href="#">home</a>
        <a href="#">Contact Us</a>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>
</header>
<div class="container">
    <div class="candidates">
        <?php
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='candidate'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>"; // Use htmlspecialchars to prevent XSS attacks
                echo '<img src="' .  htmlspecialchars($row['photo']) . '" alt="candidate Image" width="100">';

                echo "<p><strong>Age:</strong> " . htmlspecialchars($row['age']) . "</p>"; // Sanitize output
                echo "<p><strong>Vote Number:</strong> " . htmlspecialchars($row['votenumber']) . "</p>"; // Sanitize output
                echo "<p><strong>Date of Birth:</strong> " . htmlspecialchars($row['dob']) . "</p>"; // Sanitize output
                echo "<p><strong>Villege:</strong> " . htmlspecialchars($row['villege']) . "</p>"; // Sanitize output                
                echo "<p><strong>perfomance:</strong> " . htmlspecialchars($row['perfomance']) . "</p>"; // Sanitize output

                
                // Vote button
                echo "<a href='../add_vote/add_vote.php?id=" . $row['id'] . "'><button>Vote</button></a>";

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
