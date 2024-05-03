<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Battle</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        body {
            background-image: url("battleBack.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        .contact-form {
            width: 90%;
            max-width: 450px;
            position: absolute;
            top: 50%; /* Adjust the vertical position of the form */
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9); /* Set background color with opacity */
            border-radius: 10px;
            padding: 50px 60px 70px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2); /* Add shadow to the border */
        }

        .form-group {
            margin-bottom: 20px; /* Adjust spacing between input fields */
        }

        label {
            font-weight: bold;
            display: block;
        }

        input, select, textarea {
            padding: 15px 10px;
            width: calc(100% - 20px); /* Adjust width to fit the container */
            font-family: 'Poppins', sans-serif;
            border-radius: 10px;
            border-style: none;
            background-color: rgb(145, 205, 207);
        }

        button {
            margin: 10px 0;
            padding: 15px;
            width: calc(100% - 20px); /* Adjust width to fit the container */
            background-color: rgb(61, 150, 202);
            border-style: none;
            border-radius: 20px;
            font-size: 15px;
            color: aliceblue;
            font-family: 'Poppins', sans-serif;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        button:hover {
            color: rgb(20, 129, 192);
            background-color: rgb(237, 237, 237);
        }

        h1 {
            text-align: center;
            text-decoration: underline;
            margin-bottom: 20px;
        }
    </style>
</head>
<?php
// Include the file that contains your database connection
include '../dbh.php';

// Fetch candidate data from the database
$query = "SELECT name FROM candidate";
$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    die("Error retrieving candidates: " . mysqli_error($conn));
}
?>

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
    <h1>Create Battle</h1>

    <div class="contact-form">
        <form action="addBattle.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Battle Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="player1">Player 1:</label>
                <select id="player1" name="player1" required>
                    <option value="">Select Player 1</option>
                    <?php
                    // Dynamically populate player 1 options
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="player2">Player 2:</label>
                <select id="player2" name="player2" required>
                    <option value="">Select Player 2</option>
                    <?php
                    // Reset data pointer back to the beginning
                    mysqli_data_seek($result, 0);

                    // Dynamically populate player 2 options
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <?php
    // Free result set
    mysqli_free_result($result);

    if (isset($_POST['submit'])) {
        // Retrieve form data and sanitize to prevent SQL injection
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $player1 = mysqli_real_escape_string($conn, $_POST['player1']);
        $player2 = mysqli_real_escape_string($conn, $_POST['player2']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        // SQL query to insert battle details into the database
        $sql = "INSERT INTO `battle` (`name`, `player1`, `player2`, `description`) VALUES ('$name', '$player1', '$player2', '$description')";

        // Execute the SQL query
        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">
            window.onload = function () { alert("Battle details saved successfully!"); 
                window.location.href = "viewbattle.php";}
            </script>'; // Redirect to viewbattle.php after successful insertion
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    ?>
    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var player1 = document.getElementById("player1").value;
            var player2 = document.getElementById("player2").value;
            var description = document.getElementById("description").value;

            // Check if any field is empty
            if (name.trim() === "" || player1.trim() === "" || player2.trim() === "" || description.trim() === "") {
                alert("Please fill in all fields.");
                return false;
            }

            // Check if name contains only letters
            var nameRegex = /^[a-zA-Z\s]+$/;
            if (!nameRegex.test(name)) {
                alert("Battle name must contain only letters.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
