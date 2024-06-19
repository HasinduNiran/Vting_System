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
    <style>
      /* CSS for the Vote button */
      .vote-btn {
          background-color: #28a745; /* Green background color */
          color: #fff; /* White text color */
          border: none;
          border-radius: 5px;
          padding: 8px 16px;
          font-size: 16px;
          cursor: pointer;
          text-decoration: none;
          margin-top: 10px;
      }

      .vote-btn:hover {
          background-color: #218838; /* Darker green color on hover */
      }
  </style>
</head>
<body>
<nav class="nav">
        <link rel="stylesheet" href="../Header/headcss.css" />
        <script src="../Header/headjs.js"></script>
        <div class="containerr">
            <h1 class="logo"><a href="index.php">One Shot Voting</a></h1>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="sign_up.php">Signup</a></li>
        
            </ul>
          </div>
        </nav>
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
                echo "<a href='../add_vote/add_vote.php?id=" . $row['id'] . "'><button class='vote-btn'>Vote</button></a>";

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
